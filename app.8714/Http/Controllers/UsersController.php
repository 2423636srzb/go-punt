<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Game;
use App\Models\User;
use App\Models\UserGame;
use Illuminate\Http\Request;
use App\Exports\UserGamesExport;
use App\Imports\UserGamesImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function __construct() {}

    public function dashboard()
    {
        $user = Auth::user(); // Get the authenticated user
        // You can pass the user data to the view
        return view('users.dashboard', compact('user')); // Passing the user to the view
    }

    // Example for another method
    public function profile()
    {
        $user = Auth::user();

        return view('users.viewProfile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $request->user_id,
            'phone_number' => 'nullable|string|max:20',
            'language' => 'nullable|string|max:1000',
            'password' => 'nullable|string|min:8',
        ]);

        if ($request->filled('password')) {
            // If password is provided, hash and save it
            $validated['password'] = Hash::make($validated['password']);
        }

        // Find the user and update the details
        $user = User::find($request->user_id);
        if ($user) {
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->phone_number = $validated['phone_number'];
            $user->language = $validated['language'];
            if ($request->filled('password')) {
                $user->password = $validated['password'];
            }
            $user->save();

            return response()->json(['success' => true, 'message' => 'Profile updated successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'User not found']);
        }
    }

    public function updateUserStatus($id, $status)
    {
        // Find the user and update the details
        if ($status == 'disable') {
            $status = 'inactive';
        } else {
            $status = 'active';
        }

        $user = User::find($id);
        if ($user) {
            $user->user_status = $status;
            $user->save();
            return response()->json(['success' => true, 'message' => 'User status updated successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'User not found']);
        }
    }

    public function uploadProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = 'profile_' . $user->id . '.' . $file->getClientOriginalExtension();
            $path = $file->move(storage_path('app/public/profile_images'), $filename);

            $path = asset('storage/profile_images/' . $filename);

            $user->profile_image = $filename;
            $user->save();

            return response()->json(['success' => true, 'message' => 'Image uploaded successfully!', 'profile_image' => $path]);
        }

        return response()->json(['success' => false, 'message' => 'No file selected.'], 400);
    }

    public function usersList()
    {
        $games = Game::all();
        dd($games);
        $users = User::where("is_admin", 0)->get();
        return view('users/usersList', compact('users','games'));
    }


    /**
     * Shows a user's details.
     *
     * @param int $id The user ID
     *
     * @return \Illuminate\View\View
     */

    public function userDetail($id)
    {
        $user = User::findOrFail($id);  // Find the user or return 404 if not found
        //$user_games = $user->games()->pluck('name', 'id')->toArray();

        // Get the user's games
        $user_games = $user->games()
            ->select('games.id as game_id', 'games.name', 'games.logo')
            ->get()
            ->map(function ($game) {
                return [
                    $game->game_id,
                    $game->name,

                ];
            });

        $userJson = json_encode($user_games);
        $games = Game::all()->map(function ($game) {
            return [
                'id' => $game->id,
                'name' => $game->name,
                'logo_url' => asset('storage/' . $game->logo), // Ensure full path to logo
            ];
        })->keyBy('id')->toArray();
        $games = json_encode($games);

        //$gamesJson = response()->json($gamesJson);
        // dd($games);
        return view('users/userDetail', compact('user', 'games', 'userJson'));
    }


    public function updateAssignedGames(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $assignedGameIds = $request->input('assigned_game_ids', []); // IDs of games in the assigned list

        // Sync the user's assigned games with the selected IDs
        $user->games()->sync($assignedGameIds);

        return response()->json(['status' => 'success', 'message' => 'Assigned games updated successfully.']);
    }

    public function userAttachments(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $userGames = $user->games()->select('games.id as game_id', 'games.name', 'games.logo', 'games.login_link', 'user_games.username', 'user_games.password')->get();
        return view('users/assignPasswords', compact('user', 'userGames'));
    }

    public function updateAssignedUsernames(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        // Loop through all the games and update the credentials
        foreach ($request->games as $gameId => $credentials) {
            $userGame = UserGame::where('user_id', $userId)
                ->where('game_id', $gameId)
                ->first();

            if ($userGame) {
                // Update the credentials for the game
                $userGame->username = $credentials['username'];
                $userGame->password = $credentials['password'];
                $userGame->save();
            }
        }

        return redirect()->route('admin.users', $userId)->with('success', 'User credentials updated successfully.');
    }

    public function importUserGames(Request $request, $userId)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        $path = $request->file('file')->store('temp');
        // Excel::import(new UserGamesImport, storage_path('app/' . $path));
        Excel::import(new UserGamesImport($userId), storage_path('app/' . $path));

        return redirect()->route('admin.user.view', $userId)->with('success', 'User games updated successfully!');
    }


    public function paymentRequest(Request $request)
    {
        // Get the logged-in user
        $user = Auth::user();

        // Get user accounts
        $accounts = $user->userAccount()
            ->with('account.game') // Load the game related to each account
            ->get()
            ->map(function ($userAccount) {
                return $userAccount->account; // Extract the account details
            });

            $user = Auth::user();

        // Get transactions with optional status filter
        $transactions = DB::table('user_platform_transactions')
            ->join('games', 'user_platform_transactions.platform_id', '=', 'games.id')  // Joining on platform_id
            ->select('user_platform_transactions.*', 'games.name as name')  // Selecting necessary columns
            ->when($request->status, function ($query) use ($request) {
                // Apply status filter if it exists in the request
                return $query->where('user_platform_transactions.status', $request->status);
            })
            ->get();

        // Return the view with filtered data
        return view('users/invoiceList', compact('accounts', 'transactions','user'));
    }

    public function exportUserGames($userId)
    {
        return Excel::download(new UserGamesExport($userId), 'user_games.xlsx');
    }

    public function adminDashboard()
    {
        $games = Game::withCount([
            'accounts as available_count' => function ($query) {
                $query->whereDoesntHave('userAccount'); // Accounts with no user assigned
            },
            'accounts as assigned_count' => function ($query) {
                $query->whereHas('userAccount'); // Accounts with a user assigned
            },
        ])->get();

        $activeGamesCount = Game::where('status', 'active')->count();


        $dateThreshold = Carbon::now()->subDays(30); // 30 days ago

        $activeAndRecentGamesCount = Game::where('status', 'active')
            ->where('created_at', '>=', $dateThreshold)
            ->count();

        // Get total users
        $totalUsers = User::count();

        $activeUsers = User::where('user_status', 'active')->count();


        return view('admin/dashboard', compact('games', 'activeGamesCount', 'activeAndRecentGamesCount', 'totalUsers', 'activeUsers'));
    }

    // NOT USED Kept for Future Reference

    public function addUser()
    {
        return view('users/addUser');
    }

    public function usersGrid()
    {
        return view('users/usersGrid');
    }



    public function viewProfile()
    {
        return view('users/viewProfile');
    }
}
