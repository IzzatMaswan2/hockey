<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;


class PlayerController extends Controller
{
     //-----------------------------------------------------------------------------------------edit-------------------


    public function edit($id)
    {
        // Find the player by ID
        $player = Player::findOrFail($id);

        // Return the edit view with the player data
        return view('player.edit', compact('player'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'fullName' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'jerseyNumber' => 'required|integer',
            'position' => 'required|string|max:255',
        ]);

        // Find the player by ID and update their data
        $player = Player::findOrFail($id);
        $player->update($validatedData);

        // Redirect with success message
        return redirect()->route('player.view')->with('success', 'Player updated successfully.');

    }

     //-----------------------------------------------------------------------------------------delete-------------------


    public function destroy($id)
    {
        // Find the player by ID and delete the record
        $player = Player::findOrFail($id);
        $player->delete();

        // Redirect with success message
        return redirect()->route('player.view')->with('success', 'Player deleted successfully.');
    }


     //-----------------------------------------------------------------------------------------insert data------------------


    public function create()
    {
        // Return the view with the form
        return view('player');
    }

    public function index()
    {
        // Fetch all team from the database
        $player = Player::all();

        // Pass the data to the view
        return view('player.index', compact('player'));
    }

    public function view()
{
    // Fetch all teams from the database
    $players = Player::all();

    // Pass the data to the view
    return view('player-view', compact('players'));
}



    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'fullName' => 'required|string|max:255', 
            'contact' => 'required|string|max:255', 
            'jerseyNumber' => 'required|integer|max:255', 
            'position' => 'required|string|max:255',  
        ]);

        // Create a new Fixture record
        Player::create($validatedData);

        // Redirect with success message
        return redirect()->route('player.view')->with('success', 'Player added successfully.');

    }

 //-----------------------------------------------------------------------------------------export-------------------



    public function exportCsv()
    {
        $fileName = 'players.csv';
        $players = Player::all();

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=\"$fileName\"",
        ];

        $columns = ['ID', 'Full Name', 'Contact', 'Jersey Number', 'Position'];

        $callback = function() use ($players, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($players as $player) {
                $row = [
                    $player->id,
                    $player->fullName,
                    $player->contact,
                    $player->jerseyNumber,
                    $player->position,
                ];

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }



    //--------------------------------------------------------------( NOT WORKING :( )---import-------------------

    public function importForm()
    {
        // Return the view with the import form
        return view('player.import'); // Adjust the view name if it's different
    }

    public function importCsv(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'csvFile' => 'required|file|mimes:csv,txt',
        ]);

        // Get the uploaded file
        $file = $request->file('csvFile');
        $csvData = file_get_contents($file->getRealPath());

        // Create CSV Reader instance
        $reader = Reader::createFromString($csvData);

        // Set header offset if your CSV file has a header
        $reader->setHeaderOffset(0);

        // Iterate through the CSV records
        foreach ($reader->getRecords() as $record) {
            // Validate each record
            $validator = Validator::make($record, [
                'ID' => 'required|integer',
                'Full Name' => 'required|string',
                'Contact' => 'required|string',
                'Jersey Number' => 'required|integer',
                'Position' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Invalid CSV format')->withInput();
            }

            // Process the valid record
            Player::updateOrCreate(
                ['id' => $record['ID']], // Assuming 'ID' is used to match existing records
                [
                    'fullName' => $record['Full Name'],
                    'contact' => $record['Contact'],
                    'jerseyNumber' => $record['Jersey Number'],
                    'position' => $record['Position'],
                ]
            );
        }

        // Redirect with success message
        return redirect()->route('players.view')->with('success', 'Players imported successfully.');
    }
}