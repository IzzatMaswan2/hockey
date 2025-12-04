<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LiveMatchController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerStatMatchController;
use App\Http\Controllers\PlayerStatMatchInsertController;
use App\Http\Controllers\LiveStatMatchController;
use App\Http\Controllers\MatchTeamController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\RefereeController;
use App\Http\Controllers\ScoreboardController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\TournamentlistController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\Statistic\StatisticController;
use App\Http\Controllers\KnockoutStageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\ParticipantController;

Route::get('/fixtures', [FixtureController::class, 'index'])->name('fixture.index');
Route::get('/matches', function () {
    return view('matches');
});

//FIXTURE
Route::get('/fixture/tournamentlist', [FixtureController::class, 'tournamentList'])->name('tournament.list');
Route::get('/fixture/index/{id}', [FixtureController::class, 'index'])->name('fixture.index');

//Article
// Route::get('/article', [FixtureController::class, 'index'])->name('article.index');
Route::get('/article', [ArticleController::class, 'create'])->name('article.create');
Route::post('/article', [ArticleController::class, 'store'])->name('article.store');

Route::get('/article/{id}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/forum', function () {
    $latestArticle = \App\Models\Article::latest()->first();
    if ($latestArticle) {
        return redirect()->route('article.show', $latestArticle->id);
    }
    return redirect()->route('article.create')->with('info', 'No articles available.');
});
Route::put('/article/{id}', [ArticleController::class, 'update'])->name('article.update');
Route::put('/article/{id}/archive', [ArticleController::class, 'archiveArticle'])->name('article.archive');
Route::put('//unarchive/{id}', [ArticleController::class, 'unarchive'])->name('article.unarchive');


Route::prefix('statistics')->group(function () {
    Route::get('/tournaments', [StatisticController::class, 'index'])->name('stat.tournaments.index');
    Route::get('/tournaments/{id}/matches', [StatisticController::class, 'showMatches'])->name('stat.matches.index');
    Route::get('/matches/{id}/statistics', [StatisticController::class, 'showStatistics'])->name('statistics.index');
    Route::post('/matches/{id}/statistics', [StatisticController::class, 'storeStatistic'])->name('statistics.store');
    Route::get('/edit/{PlayerStatMatchID}', [StatisticController::class, 'editStatistic'])->name('statistics.edit');
    Route::put('/update/{PlayerStatMatchID}', [StatisticController::class, 'updateStatistic'])->name('statistics.update');
    Route::delete('/delete/{PlayerStatMatchID}', [StatisticController::class, 'destroyStatistic'])->name('statistics.destroy');
    Route::post('/matches/start/{Match_groupID}', [StatisticController::class, 'startMatch'])->name('matches.start');
    Route::get('/matches/{id}/details', [StatisticController::class, 'getMatchDetails']);
    Route::post('/tournament/update-stats', [StatisticController::class, 'updateTournamentStats'])->name('tournament.updateStats');
});


Route::get('/contact', [MessageController::class, 'showForm']);

Route::get('/match-score', [MatchController::class, 'index'])->middleware('auth')->name('approval.match-score');
Route::post('/match-score/submit', [MatchController::class, 'submitScore'])->name('match-score.submit');
Route::post('/approve-match', [MatchController::class, 'approveMatch'])->name('approve-match');
Route::get('/match-details/{id}', [MatchController::class, 'getMatchDetails']);

Route::get('/match-score/knockout', [MatchController::class, 'knockoutindex'])->middleware('auth')->name('knockout.approval.match-score');
Route::post('/match-score/knockout/submit', [MatchController::class, 'knockoutsubmitScore'])->name('knockout.match-score.submit');
Route::post('/approve-match/knockout', [MatchController::class, 'knockoutapproveMatch'])->name('knockout.approve-match');
Route::get('/match-details/knockout/{id}', [MatchController::class, 'getKnockoutMatchDetails']);
Route::post('/matches/start/{id}', [MatchController::class, 'startknockoutMatch'])->name('knockoutmatches.start');





Route::get('/managematch', function () {
    return view('admin.managematch');
});

//Dashboard Admin
// Route::get('/dashboard', [DashboardController::class, 'index']);
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route::get('/dashboard', [GoalController::class, 'index']);



Route::get('/home', function () {
    return view('dashboard');
});
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('/contacts', [PageController::class, 'storeContact']);
Route::get('/contacts/{id}', [PageController::class, 'showContact']);

// admin manage page fo user 
Route::get('/adminmanagepage', [PageController::class, 'showpage'])->name('show.page');
Route::get('about/edit', [PageController::class, 'editAbout'])->name('about.edit');
Route::post('faqs', [PageController::class, 'FAQstore'])->name('faqs.store');
Route::post('home/update', [PageController::class, 'updateHome'])->name('home.update');
Route::post('achievement/update', [PageController::class, 'updateAchivement'])->name('achievements.update');
Route::post('meet/update', [PageController::class, 'updateMeet'])->name('meetTeams.update');
Route::post('about/update', [PageController::class, 'updateAbout'])->name('about.update');
Route::post('/admin/contact/update', [PageController::class, 'updateContactInfo'])->name('contact.update');
Route::post('faqs/update', [PageController::class, 'FAQupdate'])->name('faq.update');

// Tournament
Route::post('/tournament/create', [TournamentController::class, 'create'])->name('tournament.create');
Route::post('/tournament/store', [TournamentController::class, 'store'])->name('tournament.store');
Route::get('/tournament', function () { return view('tournament');})->name('tournament');
Route::get('/tournaments-view', [TournamentController::class, 'index'])->name('tournaments.index');
Route::get('/getTournamentTeams/{id}', [TournamentController::class, 'getTeams']);
Route::get('/getTournamentCategories/{id}', [TournamentController::class, 'getCategories']);
Route::get('/get-categories-by-tournament/{tournament}', [TournamentController::class, 'getCategories2']);

Route::resource('categories', CategoryController::class);
Route::get('/tournaments/{tournament}/categories', [CategoryController::class, 'getTournamentCategories']);
Route::post('/tournaments/{tournament}/categories', [CategoryController::class, 'storeTournamentCategory']);
Route::put('/tournaments/{tournament}/categories/{category}', [CategoryController::class, 'update']);
// Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
Route::get('/getCategoryTeams/{tournamentId}/{categoryId}', [CategoryController::class, 'getCategoryTeams']);




//REGISTER (PUBLIC)
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::post('/tournament-details', [RegisteredUserController::class, 'storeManagerTournament'])->name('tournament-details');

//ADD MANAGER (MANAGEMANAGERS)
// Route::get('/manageuser', function () {return view('manageuser');});
// Route::get('/manageuser', [RegisteredUserController::class, 'createManager'])->name('admin.manageuser');
Route::post('/manageuser', [RegisteredUserController::class, 'storeManager'])->name('manageuser.store');
// Route::get('/manageuser', [RegisteredUserController::class, 'listUsers'])->name('admin.manageuser');
Route::get('/managenew', function () {return view('admin.manageuser');});
Route::put('/manageuser/{id}/archive', [RegisteredUserController::class, 'archive'])->name('manageuser.archive');
Route::get('/manageuser', [RegisteredUserController::class, 'index'])->name('admin.manageuser');
Route::put('/manageuser/{id}/update', [RegisteredUserController::class, 'update'])->name('manageuser.update');
Route::put('/manageuser/unarchive/{id}', [RegisteredUserController::class, 'unarchive'])->name('manageuser.unarchive');

//ADD ADMIN
Route::post('/manageadmin', [RegisteredUserController::class, 'storeAdmin']);
Route::get('/manageadmin', [RegisteredUserController::class, 'listAdmin'])->name('admin.manageadmin');
Route::get('/managenew2', function () {return view('admin.manageadmin');});
Route::put('/manageadmin/{id}/archive', [RegisteredUserController::class, 'archiveadmin'])->name('manageadmin.archive');
Route::get('/manageadmin', [RegisteredUserController::class, 'indexadmin'])->name('admin.manageadmin');
Route::put('/manageadmin/unarchive/{id}', [RegisteredUserController::class, 'unarchiveAdmin'])->name('manageadmin.unarchive');

//MANAGE PLAYERS
Route::post('/manageplayer', [RegisteredUserController::class, 'storePlayer']);
Route::get('/manageplayer', [RegisteredUserController::class, 'listPlayer'])->name('manageplayer');
Route::get('/managenew3', function () {return view('manageplayer');});
Route::put('/manageplayer/{id}/archive', [RegisteredUserController::class, 'archivePlayer'])->name('manageplayer.archive');
Route::get('/manageplayer', [RegisteredUserController::class, 'indexPlayer'])->name('manageplayer');
Route::put('/manageplayer/{id}/update', [RegisteredUserController::class, 'updatePlayer'])->name('manageplayer.update');

//MANAGE TOURNAMENT
// Route::get('/managetournament', function () {return view('managetournament');});
// Route::get('/managetournament', [TournamentController::class, 'create'])->name('managetournament');
Route::post('/managetournament', [TournamentController::class, 'store'])->name('managetournament.store');
Route::get('/managetournament/{id}', [TournamentController::class, 'show'])->name('managetournament.show');
Route::post('/managetournament/{id}', [TournamentController::class, 'update'])->name('managetournament.update');
Route::put('/managetournament/{id}/archive', [TournamentController::class, 'archive'])->name('managetournament.archive');
Route::get('/managetournament', [TournamentController::class, 'index'])->name('managetournament');
Route::put('/managetournament/unarchive/{id}', [TournamentController::class, 'unarchiveTournament'])->name('managetournament.unarchive');

//MANAGE VENUE
Route::get('/managevenue', function () {return view('managevenue');});
Route::get('/managevenue', [VenueController::class, 'create'])->name('managevenue');
Route::post('/managevenue', [VenueController::class, 'store'])->name('managevenue.store');
Route::get('/managevenue/{id}', [VenueController::class, 'show'])->name('managevenue.show');
Route::post('/managevenue/{id}', [VenueController::class, 'update'])->name('managevenue.update');
Route::put('/managevenue/{id}/archive', [VenueController::class, 'archiveVenue'])->name('managevenue.archive');
Route::get('/managevenue', [VenueController::class, 'index'])->name('managevenue');
Route::post('/managevenue/unarchive/{id}', [VenueController::class, 'unarchiveVenue'])->name('managevenue.unarchive');

//Formation (Manager)
Route::post('/formation/store', [PlayerController::class, 'store'])->name('player.store');
Route::post('/formation/change', [PlayerController::class, 'change'])->name('player.change');
Route::get('/formation', [PlayerController::class, 'view'])->name('formation');

// // Route::get('/team', function () { return view('team');})->name('team');
// Route::get('/formation/index', [FormationController::class, 'index'])->name('formation.index');
// Route::get('/formation', [FormationController::class, 'view'])->name('formation.view');
// Route::get('/formation', [FormationController::class, 'create'])->name('formation.create');
// Route::post('/formation', [FormationController::class, 'store'])->name('formation.store');
// Route::get('/formation/{id}/edit', [FormationController::class, 'edit'])->name('formation.edit');
// Route::post('/formation/{id}', [FormationController::class, 'update'])->name('formation.update');

// Routes for TournamentlistController (for 'tournamentlist')
Route::get('/tournamentlist', [TournamentlistController::class, 'create'])->name('tournamentlist.view');
Route::post('/tournamentlist', [TournamentlistController::class, 'store'])->name('tournamentlist.store');
Route::get('/tournamentlist/{id}', [TournamentlistController::class, 'show'])->name('tournamentlist.details');
// Route::get('/tournamentlist/{id}', [TournamentlistController::class, 'showa'])->name('tournament-details');


//Player Dashbard
Route::get('/player-dashboard', [PlayerController::class, 'dashboardPlayer'])
->name('player-dashboard')
->middleware('auth');
//Manager Dashboard
Route::get('/manager-dashboard', [PlayerController::class, 'dashboard'])
    ->name('manager-dashboard')
    ->middleware('auth');

// Line-Up (Manager)
Route::get('/line-up', function () {return view('line-up');});
Route::get('/line-up', [PlayerController::class, 'showLineUp'])->name('line-up');

//profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*End Manager Route */
/* User Route */
Route::get('/api/check-auth', function () {
    return response()->json(['loggedIn' => Auth::check()]);
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/playerstatmatch', [PlayerStatMatchInsertController::class, 'create'])->name('playerstatmatch.create');
Route::post('/playerstatmatch', [PlayerStatMatchInsertController::class, 'store'])->name('playerstatmatch.store');

Route::get('/livematch/{matchGroupId}', [LiveStatMatchController::class, 'showLiveMatch'])->name('livematch');
Route::get('/match/{matchGroupId}' , [MatchTeamController::class, 'showMatchDetails'])->name('matchDetail');

Route::get('/live-matches', [LiveMatchController::class, 'showLiveMatch'])
    ->name('live-matches');
// Route::get('/tournament',  [LiveMatchController::class, 'showLiveMatch'])
//     ->name('live-matches');
Route::get('/livematch', function () {
    return view('livematch');
});

Route::get('/', [HomeController::class, 'Home'])->name('user.Home');

Route::get('/livematch', function () {
    return view('user.livematch');
});

Route::get('/group', function () {
    return view('user.group');
});



Route::get('/about', function () {
    return view('user.about');
});

Route::get('/contact', function () {
    return view('user.contact');
});

Route::get('/contact',  [PageController::class, 'showcontactinfo'])
    ->name('showcontactinfo');

Route::post('/contact', [MessageController::class, 'store'])->name('contact.store');



// Route::get('/profile', function () {
//     return view('profile.edit');
// })->middleware(['auth','verified'])->name('profile');

Route::get('/fixture', function () {
    return view('fixture');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// admin manage page fo user 
Route::get('/adminmanagepage', [PageController::class, 'showpage'])->name('show.page');
Route::get('about/edit', [PageController::class, 'editAbout'])->name('about.edit');
Route::post('faqs', [PageController::class, 'FAQstore'])->name('faqs.store');
Route::post('home/update', [PageController::class, 'updateHome'])->name('home.update');
Route::post('achievement/update', [PageController::class, 'updateAchivement'])->name('achievements.update');
Route::post('meet/update', [PageController::class, 'updateMeetTeam'])->name('meetTeams.update');
Route::post('about/update', [PageController::class, 'updateAbout'])->name('about.update');
Route::post('/admin/contact/update', [PageController::class, 'updateContactInfo'])->name('contact.update');
Route::post('faqs/update', [PageController::class, 'FAQupdate'])->name('faq.update');
Route::delete('/faqs/{id}', [PageController::class, 'FAQdestroy'])->name('faqs.destroy');
Route::post('footer/update', [PageController::class, 'footerupdate'])->name('footer.update');

/* User Route */


Route::get('/test', function () {
    return view('test');
});

Route::get('/playerstatmatch', [PlayerStatMatchInsertController::class, 'create'])->name('playerstatmatch.create');
Route::post('/playerstatmatch', [PlayerStatMatchInsertController::class, 'store'])->name('playerstatmatch.store');

Route::get('/livematch/{matchGroupId}', [LiveStatMatchController::class, 'showLiveMatch'])->name('livematch');
Route::get('/match/{matchGroupId}' , [MatchTeamController::class, 'showMatchDetails'])->name('matchDetail');

Route::get('/live-matches', [LiveMatchController::class, 'showLiveMatch'])
    ->name('live-matches');
Route::get('/tournament',  [LiveMatchController::class, 'showLiveMatch'])
    ->name('live-matches');
Route::get('/livematch', function () {
    return view('livematch');
});

Route::get('/', [HomeController::class, 'Home'])->name('user.Home');

Route::get('/livematch', function () {
    return view('user.livematch');
});

Route::get('/group', function () {
    return view('user.group');
});

Route::get('/about', function () {
    return view('user.about');
});

Route::get('/contact', function () {
    return view('user.contact');
});

Route::get('/contact',  [PageController::class, 'showcontactinfo'])
    ->name('showcontactinfo');

Route::post('/contact', [MessageController::class, 'store'])->name('contact.store');

Route::get('/user', function () {
    return view('user.user');
})->middleware(['auth','verified'])->name('user');

Route::get('/fixture', function () {
    return view('fixture');
});

Route::get('/footer', [LayoutController::class, 'footer'])->name('profile.partials.footer');

//MANAGE MATCHES
Route::get('/matches/matches', [MatchesController::class, 'index'])->name('matches.index');
Route::post('/matches', [MatchesController::class, 'store']) ->name('matches.store');
Route::get('/matches', [MatchesController::class, 'create'])->name('matches.create');
Route::put('/matches/{id}/update', [MatchesController::class, 'update'])->name('matches.update');
Route::get('/matches/{matches}/edit', [MatchesController::class, 'edit'])->name('matches.edit');
Route::get('/groups/{tournamentId}', [MatchesController::class, 'getGroupsByTournament']);
Route::post('/matches/auto-create', [MatchesController::class, 'autoCreateMatches'])->name('matches.auto-create');
Route::get('/get-groups-by-tournament/{tournamentId}', [MatchesController::class, 'getGroupsByTournament']);
Route::get('/get-groups-by-tournament-and-category/{tournament}/{category}', [MatchesController::class, 'getGroupsByTournamentAndCategory']);

Route::resource('participants', ParticipantController::class);
// Route::delete('/participants/{id}', [ParticipantController::class, 'destroy'])
//     ->name('participants.destroy');
Route::put('participants/{id}/archive', [ParticipantController::class, 'archive'])->name('participants.archive');
Route::put('participants/{id}/unarchive', [ParticipantController::class, 'unarchive'])->name('participants.unarchive');


// referee
Route::get('/referee', [RefereeController::class, 'index'])->name('referee.index');
Route::post('/referee', [RefereeController::class, 'store'])->name('referee.store');;
Route::put('/referee/{id}/update', [RefereeController::class, 'update'])->name('referee.update');
Route::post('/referee/{id}/delete', [RefereeController::class, 'destroy'])->name('referee.destroy');
Route::get('/referee/{referee}/edit', [MatchesController::class, 'edit'])->name('referee.edit');

require __DIR__.'/auth.php';



Route::get('/scoreboard/{tournamentId}/matches', [ScoreboardController::class, 'filterMatches'])->name('scoreboard.filterMatches');
Route::get('/scoreboard', [ScoreboardController::class, 'index'])->name('scoreboard.index');
Route::post('/scoreboard/updateScores', [ScoreboardController::class, 'updateScores'])->name('scoreboard.updateScores');

Route::get('/scoreboard/tournamentlist', [ScoreboardController::class, 'tournamentList'])->name('tournament.list');
Route::get('/scoreboard/{tournamentId}/matches', [ScoreboardController::class, 'filterMatches'])->name('scoreboard.filterMatches');
Route::get('/scoreboard/{tournamentID}', [ScoreboardController::class, 'index'])->name('scoreboard.index');
Route::get('/get-match-details', [ScoreboardController::class, 'getMatchDetails'])->name('scoreboard.getMatchDetails');
Route::post('/scoreboard/updateMatch', [ScoreboardController::class, 'updateMatch'])->name('scoreboard.updateMatch');
Route::post('/update-match/{Match_groupID}', [ScoreboardController::class, 'updateMatch'])->name('update.match');

Route::middleware(['role:Manager'])->group(function () {
    
});

Route::middleware(['role:Admin'])->group(function () {
    
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


//MANAGE GROUP
Route::get('/manage-group', [GroupsController::class, 'index'])->name('managegroup.index');
Route::post('/managegroup', [GroupsController::class, 'store']) ->name('managegroup.store');
Route::get('/managegroup', [GroupsController::class, 'create'])->name('managegroup.create');
Route::get('/get-teams-and-groups-by-tournament', [GroupsController::class,'getTeamsAndGroupsByTournament'])->name('managegroup.getTeamsAndGroupsByTournament');
Route::get('/getTournamentTeams/{id}', [GroupsController::class, 'getTournamentTeams']);


Route::get('/tournament/{id}/knockout', [KnockoutStageController::class, 'getTopTeams'])->name('knockout.advance');
Route::post('/select-knockout-teams', [KnockoutStageController::class, 'createKnockoutMatches'])->name('knockout.create');
Route::get('/tournament/knockoutmatch/{tournament_id}', [KnockoutStageController::class, 'showKnockoutMatches'])->name('knockout.match');
Route::put('/knockout/{id}', [KnockoutStageController::class, 'update'])->name('update.knockout');