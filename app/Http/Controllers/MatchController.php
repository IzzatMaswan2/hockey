<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Matches;
use Illuminate\Http\Request;
use App\Models\MatchGroup;
use App\Models\Referee;
use App\Models\Team;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;


class MatchController extends Controller
{
    public function index()
    {
        $teamId = Auth::user()->teamID;

        // Step 1: Get all live matches for the given team
        $livematche = MatchGroup::with([
            'teamA:teamID,Name,logoURL', 
            'teamB:teamID,Name,logoURL', 
            'approvals' 
        ])
        ->where('match_status', 1)
        ->where(function ($query) use ($teamId) {
            $query->where('TeamAID', $teamId)->orWhere('TeamBID', $teamId);
        })
        ->get();

        $matchGroupIDs = $livematche->pluck('Match_groupID');

        $excludedMatchGroupIDs = Approval::select('Match_groupID')
            ->whereIn('Match_groupID', $matchGroupIDs)
            ->groupBy('Match_groupID')
            ->havingRaw('COUNT(*) = 2')
            ->pluck('Match_groupID');

            // dd($excludedMatchGroupIDs);

        $livematches = $livematche->whereNotIn('Match_groupID', $excludedMatchGroupIDs);
        
        // dd($livematches);
        // dd($livematches);

        $upcomingmatches = MatchGroup::with([
            'teamA:teamID,Name,logoURL', 
            'teamB:teamID,Name,logoURL', 
            'scoringReferee', 
            'timingReferee'
        ])
        ->where('match_status', 0)
        ->where(function ($query) use ($teamId) {
            $query->where('TeamAID', $teamId)->orWhere('TeamBID', $teamId);
        })
        ->get();
        

        $endedmatches = MatchGroup::with([
            'teamA:teamID,Name,logoURL', 
            'teamB:teamID,Name,logoURL',
            'approvals'
        ])
        ->where('match_status', 2) 
        ->where(function ($query) use ($teamId) {
            $query->where('TeamAID', $teamId)->orWhere('TeamBID', $teamId);
        })
        ->get();

        $endedmatches = $endedmatches->concat(
            MatchGroup::with([
                'teamA:teamID,Name,logoURL', 
                'teamB:teamID,Name,logoURL',
                'approvals'
                ])
                ->where('match_status', 1)
                ->whereIn('Match_groupID', $excludedMatchGroupIDs)
                ->get()
            );

        $approve = Approval::all()->keyBy('Match_groupID');
        $referee = Referee::all()->keyBy('id');
        $allmatches = MatchGroup::all()->keyBy('Match_groupID');

        return view('approval.match-score', compact('livematches', 'upcomingmatches', 'endedmatches', 'referee','allmatches', 'teamId'));
    }

    public function submitScore(Request $request)
    {
        // dd($request);
        $request->validate([
            'match_id' => 'required|integer|exists:match_group,Match_groupID',
            'score_a' => 'required|integer',
            'score_b' => 'required|integer',
        ]);

        $match = MatchGroup::where('Match_groupID', $request->match_id)->first();
        // dd($match);

        $teamId = Auth::user()->teamID;
        // dd($teamId);

        $approvalCheck = Approval::where('Match_groupID', $request->match_id)->exists();
        // dd($approvalCheck);
        if ($approvalCheck) {
            if ($teamId == $match->TeamAID) {
                $approval = Approval::where('Match_groupID', $request->match_id)->first();

                // dd($approval->ScoreA);
                if($approval->ScoreA== $request->score_a && $approval->ScoreB== $request->score_b ) {
                    // dd('Same Score A and B');
                    $approval = Approval::where('Match_groupID', $request->match_id)->first();
                    $approval->approval_count = 2;
                    $approval->managerA_approved = 1;
                    // $approval->both_approved = true;
                    $approval->save();

                    $match->match_status = 2;
                    // $match->ScoreA = $request->score_a;
                    // $match->ScoreB = $request->score_b;
                    $match->approval_count = $approval->approval_count;
                    // $match->both_approved = $approval->both_approved;
                    $match->save();

                    // dd($match);
                    // dd($approval);
                } else {
                    $approval = Approval::create([
                        'Match_groupID' => $request->match_id,  
                        'ScoreA' => $request->score_a,
                        'ScoreB' => $request->score_b,
                        'managerA_approved' => 1,
                        'approval_count' => 1, 
                        'both_approved' => false,  
                    ]);
                    // dd('different Score A or B For Team A input');
                }

            } elseif ($teamId == $match->TeamBID) {
                $approval = Approval::where('Match_groupID', $request->match_id)->first();

                // dd($approval->ScoreA);
                if($approval->ScoreA== $request->score_a && $approval->ScoreB== $request->score_b ) {
                    // dd('Same Score A and B');
                    $approval = Approval::where('Match_groupID', $request->match_id)->first();
                    $approval->approval_count = 2;
                    $approval->managerB_approved = 1;
                    // $approval->both_approved = true;
                    $approval->save();

                    $match->match_status = 2;
                    // $match->ScoreA = $request->score_a;
                    // $match->ScoreB = $request->score_b;
                    $match->approval_count = $approval->approval_count;
                    // $match->both_approved = $approval->both_approved;
                    $match->save();

                    // dd($match);
                    // dd($approval);
                } else {
                    $approval = Approval::create([
                        'Match_groupID' => $request->match_id,  
                        'ScoreA' => $request->score_a,
                        'ScoreB' => $request->score_b,
                        'managerB_approved' => 1,
                        'approval_count' => 1, 
                        'both_approved' => false,  
                    ]);
                    // dd('different Score A or B Team B');
                }
                // dd($approval);

            }
        } else {
            if ($teamId == $match->TeamAID) {
                // dd('stop3');
                $approval = Approval::create([
                    'Match_groupID' => $request->match_id,  
                    'ScoreA' => $request->score_a,
                    'ScoreB' => $request->score_b,
                    'managerA_approved' => 1,
                    'approval_count' => 1, 
                    'both_approved' => false,  
                ]);
                // return redirect()->route('approval.match-score')->with('message', 'Score submitted for approval');
            } elseif ($teamId == $match->TeamBID) {
                // dd('stop4');
                $approval = Approval::create([
                    'Match_groupID' => $request->match_id,  
                    'ScoreA' => $request->score_a,
                    'ScoreB' => $request->score_b,
                    'managerB_approved' => 1,
                    'approval_count' => 1, 
                    'both_approved' => false,  
                ]);
            }
        }
        
        return redirect()->route('approval.match-score')->with('message', 'Score submitted for approval');
    }


    public function approveMatch(Request $request)
    {
        
        $request->validate([
            'match_id' => 'required|integer|exists:match_group,Match_groupID',
            'approved' => 'required|boolean',
            'score_a' => 'nullable|integer',
            'score_b' => 'nullable|integer',
        ]);

        $teamId = Auth::user()->teamID;

        $match = MatchGroup::with([
            'teamA:teamID,Name,logoURL', 
            'teamB:teamID,Name,logoURL', 
            'approvals' 
        ])
        ->where('Match_groupID', $request->match_id)
        ->where(function ($query) use ($teamId) {
            $query->where('TeamAID', $teamId)->orWhere('TeamBID', $teamId);
        })
        ->first();

        if($match->match_status == 2) {
            if ($teamId == $match->TeamAID) {
                if($request->approved){
                    $approval = $match->approvals->first();
                    $approvalCount = $approval->approval_count;
                    $approvalCount = $approvalCount + 1;
                    $managerAApproved = 2;
                    $approval->managerA_approved = $managerAApproved;
                    $approval->approval_count = $approvalCount;
                    $approval->save();
                    // dd($approval);
                } elseif ($request->approved == 0) {
                    // dd('not approved');
                    $approval = $match->approvals->first();
                    $approvalCount = $approval->approval_count;
                    $approvalCount = $approvalCount + 1;
                    $managerANotApproved = 3; 
                    $approval->managerA_approved = $managerANotApproved;
                    $approval->approval_count = $approvalCount;
                    $approval->save();
                    // Conflict with the the submit score by manager A
                }
            } elseif ($teamId == $match->TeamBID) {
                if($request->approved){
                    $approval = $match->approvals->first();
                    $approvalCount = $approval->approval_count;
                    $approvalCount = $approvalCount + 1;
                    $managerBApproved = 2;
                    $approval->managerB_approved = $managerBApproved;
                    $approval->approval_count = $approvalCount;
                    $approval->save();
                    // dd($approval);
                } elseif ($request->approved == 0) {
                    // dd('not approved');
                    $approval = $match->approvals->first();
                    $approvalCount = $approval->approval_count;
                    $approvalCount = $approvalCount + 1;
                    $managerBNotApproved = 3; 
                    $approval->managerB_approved = $managerBNotApproved;
                    $approval->approval_count = $approvalCount;
                    $approval->save();
                    // Conflict with the the submit score by manager B themselve
                }
            } 
            // dd($approval);
            if($approval->managerA_approved == 2 && $approval->managerB_approved == 2) {
                $match->approval_count = $approval->approval_count;
                $match->both_approved = true;
                $approval->both_approved = true;
                $match->ScoreA = $approval->ScoreA;
                $match->ScoreB = $approval->ScoreB;
                // dd('Stop');
                $approval->save();
                $match->save();
            } elseif($approval->managerA_approved >= 3 || $approval->managerB_approved >= 3) {
                $match->approval_count = $approval->approval_count;
                $approval->both_approved = false;
                $match->both_approved = false; 
                $match->error = 1;
                $approval->save();
                $match->save();
                // dd('haha');
            }
        } elseif ($match->match_status == 1) {
            if ($teamId == $match->TeamAID) {
                $approval = $match->approvals->firstwhere('managerB_approved',1);
                // dd($approval);
                if($request->approved){
                    $approvalCount = $approval->approval_count;
                    $approvalCount = $approvalCount + 1;
                    $managerAApproved = 2;
                    $managerBApproved = 2;
                    $approval->managerA_approved = $managerAApproved;
                    $approval->managerB_approved = $managerBApproved;
                    $approval->approval_count = $approvalCount;
                    $approval->save();
                    // dd($approval);
                } elseif ($request->approved == 0) {
                    // dd('not approved');
                    $approvalCount = $approval->approval_count;
                    $approvalCount = $approvalCount + 1;
                    $managerANotApproved = 3; 
                    $managerBApproved = 2;
                    $approval->managerA_approved = $managerANotApproved;
                    $approval->managerB_approved = $managerBApproved;
                    $approval->approval_count = $approvalCount;
                    $approval->save();
                    // Conflict with the the submit score by manager A
                }
            } elseif ($teamId == $match->TeamBID) {
                $approval = $match->approvals->firstwhere('managerA_approved',1);
                if($request->approved){
                    $approvalCount = $approval->approval_count;
                    $approvalCount = $approvalCount + 1;
                    $managerAApproved = 2;
                    $managerBApproved = 2;
                    $approval->managerA_approved = $managerAApproved;
                    $approval->managerB_approved = $managerBApproved;
                    $approval->approval_count = $approvalCount;
                    $approval->save();
                    // dd($approval);
                } elseif ($request->approved == 0) {
                    // dd('not approved');
                    $approvalCount = $approval->approval_count;
                    $approvalCount = $approvalCount + 1;
                    $managerBNotApproved = 3; 
                    $managerAApproved = 2;
                    $approval->managerA_approved = $managerBNotApproved;
                    $approval->managerB_approved = $managerAApproved;
                    $approval->approval_count = $approvalCount;
                    $approval->save();
                    // Conflict with the the submit score by manager A
                }
            } 
            
            $checkApprovalCount = $match->approvals->where(function ($approval) {
                return $approval->managerA_approved == 2 && $approval->managerB_approved == 2;
            })->count();
            $checkProcessed = $match->approvals->where(function ($approval) {
                return $approval->managerA_approved >= 2 && $approval->managerB_approved >= 2;
            })->count();
            if ($checkProcessed == 2) {
                if($checkApprovalCount == 2) {
                    $match->approval_count = $approval->approval_count;
                    $approval->both_approved = false;
                    $match->both_approved = false; 
                    $match->match_status = 2;
                    $match->error = 1;
                    $approval->save();
                    $match->save();
                } elseif ($checkApprovalCount == 0) {
                    $match->approval_count = $approval->approval_count;
                    $approval->both_approved = false;
                    $match->both_approved = false; 
                    $match->match_status = 2;
                    $match->error = 1;
                    $approval->save();
                    $match->save();
                } elseif ($checkApprovalCount == 1) {
                    $trueScore = $match->approvals->where(function ($approval) {
                        return $approval->managerA_approved == 2 && $approval->managerB_approved == 2;
                    })->first();
                    $match->approval_count = $trueScore->approval_count;
                    $match->both_approved = true;
                    $trueScore->both_approved = true;
                    $match->ScoreA = $trueScore->ScoreA;
                    $match->ScoreB = $trueScore->ScoreB;
                    $match->match_status = 2;
                    // dd('Stop');
                    // dd($trueScore);
                    $trueScore->save();
                    $match->save();
                }
            }
        }
        

        return redirect()->route('approval.match-score')->with('message', $request->approved ? 'Score approved' : 'Score rejected, awaiting approval from other manager');
    }

    public function getMatchDetails(Request $request)
    {
        // Fetch the match with the related teamA and teamB details
        $match = MatchGroup::with(['teamA:id,name,logoURL', 'teamB:id,name,logoURL'])
            ->find($request->id);

        // Check if the match was found
        if (!$match) {
            return response()->json(['error' => 'Match not found'], 404);
        }

        // Return the match details along with team information
        return response()->json([
            'match_id' => $match->Match_groupID,
            'teamA_name' => $match->teamA->name ?? 'Unknown Team A',
            'teamA_logo' => $match->teamA->logoURL ?? null,
            'teamB_name' => $match->teamB->name ?? 'Unknown Team B',
            'teamB_logo' => $match->teamB->logoURL ?? null,
            'date' => $match->Date,
            'start_time' => $match->start_time,
            'end_time' => $match->end_time,
            'venue' => $match->Venue,
            'scoring_referee' => $match->ScoringRefereeID ?? 'N/A',
            'timing_referee' => $match->TimingRefereeID ?? 'N/A',
        ]);
    }

    // knockout side 

    public function knockoutindex()
    {
        $teamId = Auth::user()->teamID;

        // dd($teamId);
        // Step 1: Get all live matches for the given team
        $livematche = Matches::with([
            'team1:teamID,Name,logoURL', 
            'team2:teamID,Name,logoURL', 
            'approvals' 
        ])
        ->where('match_status', 1)
        ->where('knockout', 1)
        ->where(function ($query) use ($teamId) {
            $query->where('team1_id', $teamId)->orWhere('team2_id', $teamId);
        })
        ->get();

        // dd($livematche);

        $matchGroupIDs = $livematche->pluck('id');

        // dd($matchGroupIDs);

        $excludedMatchGroupIDs = Approval::select('match_id')
            ->whereIn('match_id', $matchGroupIDs)
            ->groupBy('match_id')
            ->havingRaw('COUNT(*) = 2')
            ->pluck('match_id');


            // dd($excludedMatchGroupIDs);

        $livematches = $livematche->whereNotIn('id', $excludedMatchGroupIDs);
        
        // dd($livematches);

        $upcomingmatches = Matches::with([
            'team1:teamID,Name,logoURL', 
            'team2:teamID,Name,logoURL', 
            'scoringReferee', 
            'timingReferee'
        ])
        ->where('match_status', 0)
        ->where('knockout', 1)
        ->where(function ($query) use ($teamId) {
            $query->where('team1_id', $teamId)->orWhere('team2_id', $teamId);
        })
        ->get();
        
        // dd($upcomingmatches);

        $endedmatches = Matches::with([
            'team1:teamID,Name,logoURL', 
            'team2:teamID,Name,logoURL', 
            'approvals' 
        ])
        ->where('match_status', 2) 
        ->where('knockout', 1)
        ->where(function ($query) use ($teamId) {
            $query->where('team1_id', $teamId)->orWhere('team2_id', $teamId);
        })
        ->get();

        $endedmatches = $endedmatches->concat(
            Matches::with([
                'team1:teamID,Name,logoURL', 
                'team2:teamID,Name,logoURL', 
                'approvals' 
                ])
                ->where('match_status', 1)
                ->where('knockout', 1)
                ->whereIn('id', $excludedMatchGroupIDs)
                ->get()
            );

        $approve = Approval::all()->keyBy('match_id');
        $referee = Referee::all()->keyBy('id');
        $allmatches = Matches::all()->keyBy('match_id');

        return view('approval.knockoutmatch-score', compact('livematches', 'upcomingmatches', 'endedmatches', 'referee','allmatches', 'teamId'));
    }

    public function knockoutsubmitScore(Request $request)
    {
        
        $request->validate([
            'match_id' => 'required|integer|exists:match_group,Match_groupID',
            'score_a' => 'required|integer',
            'score_b' => 'required|integer',
        ]);

        // dd($request);
        // dd('Hello1');


        // dd($request);
        $match = Matches::where('id', $request->match_id)->first();
        // dd($match);

        $teamId = Auth::user()->teamID;
        // dd($teamId);

        $approvalCheck = Approval::where('match_id', $request->match_id)->exists();
        // dd($approvalCheck);
        if ($approvalCheck) {
            if ($teamId == $match->team1_id) {
                $approval = Approval::where('match_id', $request->match_id)->first();

                // dd($approval->ScoreA);
                if($approval->ScoreA== $request->score_a && $approval->ScoreB== $request->score_b ) {
                    // dd('Same Score A and B');
                    $approval = Approval::where('match_id', $request->match_id)->first();
                    $approval->approval_count = 2;
                    $approval->managerA_approved = 1;
                    // $approval->both_approved = true;
                    $approval->save();

                    $match->match_status = 2;
                    // $match->ScoreA = $request->score_a;
                    // $match->ScoreB = $request->score_b;
                    $match->approval_count = $approval->approval_count;
                    // $match->both_approved = $approval->both_approved;
                    $match->save();

                    // dd($match);
                    // dd($approval);
                } else {
                    $approval = Approval::create([
                        'match_id' => $request->match_id,  
                        'ScoreA' => $request->score_a,
                        'ScoreB' => $request->score_b,
                        'managerA_approved' => 1,
                        'approval_count' => 1, 
                        'both_approved' => false,  
                    ]);
                    // dd('different Score A or B For Team A input');
                }

            } elseif ($teamId == $match->team2_id) {
                $approval = Approval::where('match_id', $request->match_id)->first();
                // dd($request->match_id);
                // dd($approval->ScoreA);
                if($approval->ScoreA== $request->score_a && $approval->ScoreB== $request->score_b ) {
                    // dd('Same Score A and B');
                    $approval = Approval::where('match_id', $request->match_id)->first();
                    $approval->approval_count = 2;
                    $approval->managerB_approved = 1;
                    // $approval->both_approved = true;
                    $approval->save();

                    $match->match_status = 2;
                    // $match->ScoreA = $request->score_a;
                    // $match->ScoreB = $request->score_b;
                    $match->approval_count = $approval->approval_count;
                    // $match->both_approved = $approval->both_approved;
                    $match->save();

                    // dd($match);
                    // dd($approval);
                } else {
                    // dd($request->match_id);
                    $approval = Approval::create([
                        'match_id' => $request->match_id,  
                        'ScoreA' => $request->score_a,
                        'ScoreB' => $request->score_b,
                        'managerB_approved' => 1,
                        'approval_count' => 1, 
                        'both_approved' => false,  
                    ]);
                    // dd('different Score A or B Team B');
                }
                // dd($approval);

            }
        } else {
            // dd('Hello Else');
            if ($teamId == $match->team1_id) {
                // dd('stop3');
                $approval = Approval::create([
                    'match_id' => $request->match_id,  
                    'ScoreA' => $request->score_a,
                    'ScoreB' => $request->score_b,
                    'managerA_approved' => 1,
                    'approval_count' => 1, 
                    'both_approved' => false,  
                ]);
                // return redirect()->route('approval.match-score')->with('message', 'Score submitted for approval');
            } elseif ($teamId == $match->team2_id) {
                // dd($request->match_id);
                $approval = Approval::create([
                    'match_id' => $request->match_id,  
                    'ScoreA' => $request->score_a,
                    'ScoreB' => $request->score_b,
                    'managerB_approved' => 1,
                    'approval_count' => 1, 
                    'both_approved' => false,  
                ]);
                // dd($approval);
            }
            // dd('escape');
        }
        
        // dd($approval);
        return redirect()->route('knockout.approval.match-score')->with('message', 'Score submitted for approval');
    }


    public function knockoutapproveMatch(Request $request)
    {
        
        $request->validate([
            'match_id' => 'required|integer|exists:match_group,Match_groupID',
            'approved' => 'required|boolean',
            'score_a' => 'nullable|integer',
            'score_b' => 'nullable|integer',
        ]);

        $teamId = Auth::user()->teamID;

        $match = Matches::with([
            'team1:teamID,Name,logoURL', 
            'team2:teamID,Name,logoURL', 
            'approvals' 
        ])
        ->where('id', $request->match_id)
        ->where(function ($query) use ($teamId) {
            $query->where('team1_id', $teamId)->orWhere('team2_id', $teamId);
        })
        ->first();

        // dd($match);

        if($match->match_status == 2) {
            if ($teamId == $match->team1_id) {
                if($request->approved){
                    $approval = $match->approvals->first();
                    $approvalCount = $approval->approval_count;
                    $approvalCount = $approvalCount + 1;
                    $managerAApproved = 2;
                    $approval->managerA_approved = $managerAApproved;
                    $approval->approval_count = $approvalCount;
                    $approval->save();
                    // dd($approval);
                } elseif ($request->approved == 0) {
                    // dd('not approved');
                    $approval = $match->approvals->first();
                    $approvalCount = $approval->approval_count;
                    $approvalCount = $approvalCount + 1;
                    $managerANotApproved = 3; 
                    $approval->managerA_approved = $managerANotApproved;
                    $approval->approval_count = $approvalCount;
                    $approval->save();
                    // Conflict with the the submit score by manager A
                }
            } elseif ($teamId == $match->team2_id) {
                if($request->approved){
                    $approval = $match->approvals->first();
                    $approvalCount = $approval->approval_count;
                    $approvalCount = $approvalCount + 1;
                    $managerBApproved = 2;
                    $approval->managerB_approved = $managerBApproved;
                    $approval->approval_count = $approvalCount;
                    $approval->save();
                    // dd($approval);
                } elseif ($request->approved == 0) {
                    // dd('not approved');
                    $approval = $match->approvals->first();
                    $approvalCount = $approval->approval_count;
                    $approvalCount = $approvalCount + 1;
                    $managerBNotApproved = 3; 
                    $approval->managerB_approved = $managerBNotApproved;
                    $approval->approval_count = $approvalCount;
                    $approval->save();
                    // Conflict with the the submit score by manager B themselve
                }
            } 
            // dd($approval);
            if($approval->managerA_approved == 2 && $approval->managerB_approved == 2) {
                $match->approval_count = $approval->approval_count;
                $match->both_approved = true;
                $approval->both_approved = true;
                $match->Score1 = $approval->ScoreA;
                $match->Score2 = $approval->ScoreB;
                // dd('Stop');
                $approval->save();
                $match->save();
                return $this->createAdvanceMatch($match);

            } elseif($approval->managerA_approved >= 3 || $approval->managerB_approved >= 3) {
                $match->approval_count = $approval->approval_count;
                $approval->both_approved = false;
                $match->both_approved = false; 
                $match->error = 1;
                $approval->save();
                $match->save();
                // dd('haha');
            }
        } elseif ($match->match_status == 1) {
            if ($teamId == $match->team1_id) {
                $approval = $match->approvals->firstwhere('managerB_approved',1);
                // dd($approval);
                if($request->approved){
                    $approvalCount = $approval->approval_count;
                    $approvalCount = $approvalCount + 1;
                    $managerAApproved = 2;
                    $managerBApproved = 2;
                    $approval->managerA_approved = $managerAApproved;
                    $approval->managerB_approved = $managerBApproved;
                    $approval->approval_count = $approvalCount;
                    $approval->save();
                    // dd($approval);
                } elseif ($request->approved == 0) {
                    // dd('not approved');
                    $approvalCount = $approval->approval_count;
                    $approvalCount = $approvalCount + 1;
                    $managerANotApproved = 3; 
                    $managerBApproved = 2;
                    $approval->managerA_approved = $managerANotApproved;
                    $approval->managerB_approved = $managerBApproved;
                    $approval->approval_count = $approvalCount;
                    $approval->save();
                    // Conflict with the the submit score by manager A
                }
            } elseif ($teamId == $match->team2_id) {
                $approval = $match->approvals->firstwhere('managerA_approved',1);
                if($request->approved){
                    $approvalCount = $approval->approval_count;
                    $approvalCount = $approvalCount + 1;
                    $managerAApproved = 2;
                    $managerBApproved = 2;
                    $approval->managerA_approved = $managerAApproved;
                    $approval->managerB_approved = $managerBApproved;
                    $approval->approval_count = $approvalCount;
                    $approval->save();
                    // dd($approval);
                } elseif ($request->approved == 0) {
                    // dd('not approved');
                    $approvalCount = $approval->approval_count;
                    $approvalCount = $approvalCount + 1;
                    $managerBNotApproved = 3; 
                    $managerAApproved = 2;
                    $approval->managerA_approved = $managerBNotApproved;
                    $approval->managerB_approved = $managerAApproved;
                    $approval->approval_count = $approvalCount;
                    $approval->save();
                    // Conflict with the the submit score by manager A
                }
            } 
            
            $checkApprovalCount = $match->approvals->where(function ($approval) {
                return $approval->managerA_approved == 2 && $approval->managerB_approved == 2;
            })->count();
            $checkProcessed = $match->approvals->where(function ($approval) {
                return $approval->managerA_approved >= 2 && $approval->managerB_approved >= 2;
            })->count();
            if ($checkProcessed == 2) {
                if($checkApprovalCount == 2) {
                    $match->approval_count = $approval->approval_count;
                    $approval->both_approved = false;
                    $match->both_approved = false; 
                    $match->match_status = 2;
                    $match->error = 1;
                    $approval->save();
                    $match->save();
                } elseif ($checkApprovalCount == 0) {
                    $match->approval_count = $approval->approval_count;
                    $approval->both_approved = false;
                    $match->both_approved = false; 
                    $match->match_status = 2;
                    $match->error = 1;
                    $approval->save();
                    $match->save();
                } elseif ($checkApprovalCount == 1) {
                    $trueScore = $match->approvals->where(function ($approval) {
                        return $approval->managerA_approved == 2 && $approval->managerB_approved == 2;
                    })->first();
                    $match->approval_count = $trueScore->approval_count;
                    $match->both_approved = true;
                    $trueScore->both_approved = true;
                    $match->score1 = $trueScore->ScoreA;
                    $match->score2 = $trueScore->ScoreB;
                    $match->match_status = 2;
                    // dd('Stop');
                    // dd($trueScore);
                    $trueScore->save();
                    $match->save();
                    return $this->createAdvanceMatch($match);
                }
            }
        }
        

        return redirect()->route('knockout.approval.match-score')->with('message', $request->approved ? 'Score approved' : 'Score rejected, awaiting approval from other manager');
    }

    public function getknockoutMatchDetails(Request $request)
    {
        // dd($request);
        $match = Matches::with(['team1:id,name,logoURL', 'team2:id,name,logoURL','venue'])
            ->find($request->id);

        // Check if the match was found
        if (!$match) {
            return response()->json(['error' => 'Match not found'], 404);
        }

        // Return the match details along with team information
        return response()->json([
            'match_id' => $match->id,
            'teamA_name' => $match->team1->name ?? 'Unknown Team A',
            'teamA_logo' => $match->team1->logoURL ?? null,
            'teamB_name' => $match->team2->name ?? 'Unknown Team B',
            'teamB_logo' => $match->team2->logoURL ?? null,
            'Date' => $match->date,
            'start_time' => $match->start_time,
            'end_time' => $match->end_time,
            'venue' => $match->venue->name,
            'scoring_referee' => $match->scoring_refereeID ?? 'N/A',
            'timing_referee' => $match->timing_refereeID ?? 'N/A',
        ]);
    }

    public function createAdvanceMatch($match)
    {
        $winner = $this->determineWinner($match);
        if (!$winner) {
            return redirect()->back()->with('error', 'Match resulted in a tie, please resolve.');
        }
    
        $nextStage = $match->stage / 2;
        $side = $match->side;   // "left" or "right"
        $oriside2 = $match->side2;  // Original side2 value
        $side2 = $this->normalizeSide2($match->side2); // Normalized side2
    
        // Check if a match exists in the next stage for the same side
        $existingMatch = Matches::where('tournament_id', $match->tournament_id)
            ->where('stage', $nextStage)
            ->where('side', $side)
            ->where('side2', $side2)
            ->first();
    
        if ($existingMatch) {
            $this->assignWinnerToMatch($existingMatch, $winner, $side, $oriside2);
        } else {
            $this->createNewMatch($match, $nextStage, $winner, $side, $oriside2,
            $side2);
        }
    
        return redirect()->route('knockout.approval.match-score')->with('message', 'Score approved');
    }
    
    // Function to normalize the side2 value
    private function normalizeSide2($side2)
    {
        if ($side2 == 'A' || $side2 == 'C') {
            return 'A';
        } elseif ($side2 == 'B' || $side2 == 'D') {
            return 'B';
        } elseif ($side2 == 'E' || $side2 == 'G') {
            return 'C';
        } elseif ($side2 == 'F' || $side2 == 'H') {
            return 'D';
        } elseif ($side2 == 'I' || $side2 == 'K') {
            return 'E';
        } elseif ($side2 == 'J' || $side2 == 'L') {
            return 'F';
        } elseif ($side2 == 'M' || $side2 == 'O') {
            return 'G';
        } elseif ($side2 == 'N' || $side2 == 'P') {
            return 'H';
        }
        
        return $side2; // Return as-is if no condition is met
    }
    
    // Determine if original side2 is "top" or "bottom"
    private function isTop($side2)
    {
        return in_array($side2, ['A', 'B', 'E', 'F', 'I', 'J', 'M', 'N']);
    }
    
    // Determine the winner based on scores
    private function determineWinner($match)
    {
        if ($match->score1 > $match->score2) {
            return $match->team1_id;
        } elseif ($match->score2 > $match->score1) {
            return $match->team2_id;
        }
        return null;
    }
    
    // Assign the winner to the correct position in an existing match using original side2
    private function assignWinnerToMatch($match, $winner, $side, $oriside2)
    {
        if ($this->isTop($oriside2) && is_null($match->team1_id)) {
            $match->team1_id = $winner;
        } elseif (!$this->isTop($oriside2) && is_null($match->team2_id)) {
            $match->team2_id = $winner;
        } else {
            return redirect()->back()->with('error', 'Both positions for this match are already filled.');
        }
        $match->save();
    }
    
    // Create a new match with the winner assigned to the correct position using original side2
    private function createNewMatch($match, $nextStage, $winner, $side, $oriside2, $side2)
    {
        Matches::create([
            'tournament_id' => $match->tournament_id,
            'team1_id' => $this->isTop($oriside2) ? $winner : null,
            'team2_id' => !$this->isTop($oriside2) ? $winner : null,
            'match_status' => 0,
            'knockout' => 1,
            'stage' => $nextStage,
            'side' => $side,
            'side2' => $side2,
        ]);
    }
    

    
    public function startknockoutMatch($id)
    {
        $match = Matches::findOrFail($id);
        // dd($match);
        $match->match_status = 1; // Change status to 1
        $match->save();

        return redirect()->back()->with('success', 'Match started successfully.');
    }
}
