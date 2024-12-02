<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Account;
use App\Models\UserAccount;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Exports\SampleFileExport;

class AccountManageController extends Controller
{
    // Show the list of games
    public function index()
    {
        $accounts = Game::with(['accounts'])->get();
        $game = Game::get();
        
        return view('accountmanage.index', compact('accounts','game'));
    }

    // Show the form to create a new game
    public function create()
    {
        return view('accountmanage.create');
    }
    public function assignedAccount($id)
    {
        $accounts = Account::where('is_assigned', 1)
    ->where('game_id', $id) // Ensure is_assigned is 1 
    ->with(['game', 'userAccount.user'])
    ->get();
        return view('accountmanage.assignedaccount',compact('accounts'));
    }
    public function getAccount($id)
    {
        $account = Account::where('id',$id)->first();
        return response()->json($account);
    }
    public function updateAccount(Request $request)
    {
        if($request->input('active'))
        {
            $status = true;
        }else{
            $status = false;
        }
        Account::where('id', $request->input('id'))->update(['password' => $request->input('password'),'status'=>$status]);

        return redirect()->back()->with('success', 'Account updated successfully.');
    }
    // Store a new game
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'login_link' => 'required|url',
            'status' => 'required|in:active,inactive',
        ]);

        // Handle file upload for the logo
        $logoPath = $request->file('logo')->store('logos', 'public');

        Game::create([
            'name' => $validated['name'],
            'logo' => $logoPath,
            'login_link' => $validated['login_link'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('games.index')->with('success', 'Game created successfully.');
    }

    // Show the form to edit a game
    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    // Update a game
    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'login_link' => 'required|url',
            'status' => 'required|in:active,inactive',
        ]);

        // Update logo if a new one is uploaded
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $game->logo = $logoPath;
        }

        $game->update([
            'name' => $validated['name'],
            'login_link' => $validated['login_link'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('games.index')->with('success', 'Game updated successfully.');
    }

    public function show(Game $game)
    {
        if (request()->ajax()) {
            return response()->json($game);
        }
    }
    // Delete a game
    public function destroy(Game $game)
    {
        try {
            $game->delete();  // Delete the game from the database

            return response()->json([
                'message' => 'Game deleted successfully.'
            ], 200);  // Return a success response
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting game.'
            ], 500);  // Return an error response if something goes wrong
        }
    }

    /**
     * Disable a game.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function disable(Game $game)
    {
        // Update the game status to 'inactive'
        $game->status = 'inactive';
        Account::where('game_id',$game->id)->update(['status'=>0]);
        $game->save();

        return response()->json(['message' => 'Game disabled successfully']);
    }

    /**
     * Enable a game.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function enable(Game $game)
    {
        Account::where('game_id',$game->id)->update(['status'=>1]);
        // Update the game status to 'active'
        $game->status = 'active';
        $game->save();

        return response()->json(['message' => 'Game enabled successfully']);
    }


    /**
     * Upload an Excel file containing game account credentials.
     *
     * The file should have the following structure:
     *  - First column: game name
     *  - Second column: username
     *  - Third column: password
     *
     * The function will create a new account entry for each row in the Excel file
     * and assign the account to a user in a First-In-First-Out (FIFO) manner.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadAccounts(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048', // Validate file type and size
        ]);

        $file = $request->file('file');
        $data = Excel::toArray([], $file);

        // Process each row in the Excel file
        foreach ($data[0] as $key => $row) {
            if ($key != 0) { // Skip header row
                $gameName = $row[0];
                $username = $row[1];
                $password = $row[2];

                // Check if the game exists
                $game = Game::where('name', $gameName)->first();
                if ($game) {
                    $gameId = $game->id;

                    // Check if this username/password combination already exists for this game
                    $existingAccount = Account::where('game_id', $gameId)
                        ->where('username', $username)
                        ->where('password', $password)
                        ->exists();

                    if (!$existingAccount) {

                        // Create a new account if no duplicate found
                        $account = Account::create([
                            'game_id' => $gameId,
                            'username' => $username,
                            'password' => $password,
                            'is_assigned' => false,
                        ]);

                        // Find a user who does not already have an account for this specific game
                        $user = User::where('is_admin',0)->whereDoesntHave('userAccount', function ($query) use ($gameId) {
                            $query->whereHas('account', function ($q) use ($gameId) {
                                $q->where('game_id', $gameId);
                            });
                        })->first();

                        if ($user) {
                            // Assign the account to the user
                            UserAccount::create([
                                'user_id' => $user->id,
                                'account_id' => $account->id,
                                'assigned_at' => Carbon::now(),
                            ]);

                            // Update account as assigned
                            $account->update(['is_assigned' => true]);
                        }
                    }
                }
            }
        }
        // Return a success response
        return response()->json(['success' => 1]);
    }

    public function downloadSample()
    {
        return Excel::download(new SampleFileExport, 'sample_accounts.xlsx');
    }
}
