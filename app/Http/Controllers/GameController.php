<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Account;
use App\Models\UserAccount;
use App\Models\User;
use App\Models\GameAccountRequest;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Exports\SampleFileExport;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    // Show the list of games
    public function index()
    {
        $games = Game::orderBy('id', 'desc')->get();
        return view('games.list', compact('games'));
    }

    public function requestAccount(Request $request)
{
    $validated = $request->validate([
        'game_id' => 'required|exists:games,id',
    ]);

    $userId = auth()->id();
    $gameId = $request->game_id;

    // Check if the request already exists
    $exists = DB::table('game_account_request')
        ->where('user_id', $userId)
        ->where('game_id', $gameId)
        ->exists();

    if ($exists) {
        return response()->json(['success' => false, 'message' => 'You have already requested an account for this game.']);
    }

    // Insert request into table
    DB::table('game_account_request')->insert([
        'user_id' => $userId,
        'game_id' => $gameId,
        'status' => 'pending',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json(['success' => true, 'message' => 'Request submitted successfully.']);
}
public function accountsRequestList(){
    $requests = DB::table('game_account_request')
    ->join('users', 'users.id', '=', 'game_account_request.user_id')
    ->join('games', 'games.id', '=', 'game_account_request.game_id')
    ->select(
        'game_account_request.id',
        'users.name',
        'users.phone_number', // Make sure `phone` exists in users table
        'games.name as game_name',
        'games.logo as game_logo',
        'game_account_request.status',
        'game_account_request.created_at'
    )
    ->get();

return view('games.account_request', compact('requests'));
}

public function accountApprove(Request $request)
{
    try {
        DB::beginTransaction(); // Start transaction

        // Extract values from request
        $requestId = $request->request_id;

        $username = $request->username;
        $password = $request->password;
          $data =   GameAccountRequest::where('id', $requestId)->first();
          $userId = $data->user_id;
        $gameId = $data->game_id;
        // Step 1: Create an account
        $account = Account::create([
            'game_id' => $gameId,
            'username' => $username,
            'password' => $password, // Secure password storage
            'status' => 1, // Status set to approved
            'is_assigned' => 1, // Mark as assigned
        ]);

        // Step 2: Create a record in user_accounts
        UserAccount::create([
            'user_id' => $userId,
            'account_id' => $account->id,
            'assigned_at' => now(),
        ]);

        // Step 3: Update the request status to approved
        GameAccountRequest::where('id', $requestId)->update([
            'status' => 'approved'
        ]);

        DB::commit(); // Commit the transaction

        return response()->json(['success' => true, 'message' => 'Request approved successfully!']);
    } catch (\Exception $e) {
        DB::rollBack(); // Rollback on error
        return response()->json(['success' => false, 'message' => 'Error processing request: ' . $e->getMessage()], 500);
    }
}

public function accountReject(Request $request)
{
    $request->validate(['request_id' => 'required|exists:game_account_request,id']);

    DB::table('game_account_request')
        ->where('id', $request->request_id)
        ->update([
            'status' => 'rejected',
            'updated_at' => now()
        ]);

    return response()->json(['message' => 'Request rejected successfully']);
}
    public function accounts()
    {

        // Fetch all unassigned accounts
        $unassignedAccounts = DB::table('accounts')
            ->where('is_assigned', 0)
            ->get();

        foreach ($unassignedAccounts as $account) {
            // Find a user who doesn't have an account for the given game
            $user = DB::table('users')
            ->whereNotIn('id', function ($query) use ($account) {
                $query->select('user_id')
                    ->from('user_accounts')
                    ->join('accounts', 'user_accounts.account_id', '=', 'accounts.id')
                    ->where('accounts.game_id', $account->game_id);
            })
            ->where('is_admin', 0)  // Make sure the user is not an admin
            ->first();


            if ($user) {
                // Assign the account to the user
                DB::transaction(function () use ($account, $user) {
                    // Mark the account as assigned
                    DB::table('accounts')
                        ->where('id', $account->id)
                        ->update(['is_assigned' => 1]);

                    // Insert a record into user_accounts
                    DB::table('user_accounts')->insert([
                        'user_id' => $user->id,
                        'account_id' => $account->id,
                    ]);
                });
            }
        }

        $games = Game::withCount([
            'accounts as available_count' => function ($query) {
                $query->whereDoesntHave('userAccount'); // Accounts with no user assigned
            },
            'accounts as assigned_count' => function ($query) {
                $query->whereHas('userAccount'); // Accounts with a user assigned
            },
        ])->get();
        $platforms = Game::get();
        return view('games.index', compact('games', 'platforms'));
    }
    public function accountStore(Request $request)
    {
        try {


            $validated = $request->validate([
                'username' => 'required|string|max:255',
                'password' => 'required|string|max:255',
                'platform_id' => 'required|integer',
            ]);
        } catch (\Exception $error) {
            return redirect()->back()->with('error', 'Account assignment failed');
        }
        $gameId = $request->input('platform_id');
        $username = $request->input('username');
        $password = $request->input('password');
        $account = Account::create([
            'game_id' => $gameId,
            'username' => $username,
            'password' => $password,
            'is_assigned' => false,
        ]);

        // Find a user who does not already have an account for this specific game
        $user = DB::table('users')
        ->whereNotIn('id', function ($query) use ($account) {
            $query->select('user_id')
                ->from('user_accounts')
                ->join('accounts', 'user_accounts.account_id', '=', 'accounts.id')
                ->where('accounts.game_id', $account->game_id);
        })
        ->where('is_admin', 0)  // Make sure the user is not an admin
        ->first();


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
        return redirect()->back()->with('success', 'account created successfully');
    }
    public function listing()
    {
    }

    // Show the form to create a new game
    public function create()
    {
        return view('games.create');
    }

    // Store a new game
    public function store(Request $request)
    {

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'login_link' => 'required|url',
                'status' => 'required|in:active,inactive',
            ]);
        } catch (\Exception $error) {
            return redirect()->route('games.index')->with('error', 'Game creation failed');
        }


        // Handle file upload for the logo
        // $logoPath = $request->file('logo')->store('logos', 'public');
        $destinationPath = public_path('logos');

        // Get the original file name
        $fileName = time() . '_' . $request->file('logo')->getClientOriginalName();

        // Move the file to the public/logos directory
        $request->file('logo')->move($destinationPath, $fileName);

        // Save the file path to the database (relative path for access via `asset()`)
        $logoPath = 'logos/' . $fileName;
        Game::create([
            'name' => $validated['name'],
            'logo' => $logoPath,
            'login_link' => $validated['login_link'],
            'status' => $validated['status'],
        ]);
        return redirect()->route('games.index')->with('success', 'Game created successfully.');
    }

    // Show the form to edit a game
    // public function edit(Game $game)
    // {
    //     return view('games.edit', compact('game'));
    // }

    public function edit($id)
    {
        $game = Game::findOrFail($id); // Find the game by ID
        return response()->json($game); // Return the game data as JSON
    }

  // Update a game
public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'login_link' => 'required|url',
        'status' => 'required|in:active,inactive',
    ]);

    $updateData = [
        'name' => $validated['name'],
        'login_link' => $validated['login_link'],
        'status' => $validated['status'],
    ];

    // Check if the user has uploaded a new file
    if ($request->hasFile('logo')) {
        // Define the destination path within the public directory
        $destinationPath = public_path('logos');

        // Get the original file name
        $fileName = time() . '_' . $request->file('logo')->getClientOriginalName();

        // Move the file to the public/logos directory
        $request->file('logo')->move($destinationPath, $fileName);

        // Save the file path (relative path for access via `asset()`)
        $logoPath = 'logos/' . $fileName;

        // Add the logo path to the update data
        $updateData['logo'] = $logoPath;
    }

    // Update the game in the database
    Game::where('id', $id)->update($updateData);

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
            // Begin a database transaction
            DB::beginTransaction();

            // Fetch all account IDs associated with this game
            $accountIds = DB::table('accounts')
                ->where('game_id', $game->id)
                ->pluck('id');

            // Delete all entries in the user_accounts table linked to these accounts
            DB::table('user_accounts')
                ->whereIn('account_id', $accountIds)
                ->delete();

            // Delete all accounts associated with this game
            DB::table('accounts')
                ->where('game_id', $game->id)
                ->delete();

            // Finally, delete the game
            $game->delete();

            // Commit the transaction
            DB::commit();

            return response()->json([
                'message' => 'Game and associated accounts deleted successfully.'
            ], 200);

        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            return response()->json([
                'message' => 'Error deleting game.',
                'error' => $e->getMessage()
            ], 500);
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

        Account::where('game_id', $game->id)->update(['status' => 0]);
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


        // Update the game status to 'active'
        $game->status = 'active';
        Account::where('game_id', $game->id)->update(['status' => 1]);
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
    public function uploadAccountsMultiple(Request $request)
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
                        $user = DB::table('users')
                        ->whereNotIn('id', function ($query) use ($account) {
                            $query->select('user_id')
                                ->from('user_accounts')
                                ->join('accounts', 'user_accounts.account_id', '=', 'accounts.id')
                                ->where('accounts.game_id', $account->game_id);
                        })
                        ->where('is_admin', 0)  // Make sure the user is not an admin
                        ->first();


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
