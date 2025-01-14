<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Game;
use App\Models\User;
use App\Models\UserGame;
use Illuminate\Http\Request;
use App\Exports\UserGamesExport;
use App\Imports\UserGamesImport;
use App\Models\AdminBankAccount;
use App\Models\Announcement;
use App\Models\UserAccount;
use App\Services\GoogleAnalyticsService;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class UsersController extends Controller
{
    protected $analytics;

    public function __construct(GoogleAnalyticsService $analytics)
    {
        $this->analytics = $analytics;
    }

    public function dashboard()
    {
        $user = Auth::user(); // Get the authenticated user

        $userAccounts = UserAccount::where('user_accounts.user_id', $user->id) // Filter by current user's ID
        ->where('accounts.status', 1) // Filter accounts with status = 1
        ->join('accounts', 'accounts.id', '=', 'user_accounts.account_id') // Join accounts table
        ->join('games', 'games.id', '=', 'accounts.game_id') // Join games table
        ->leftJoin('user_platform_transactions', function ($join) use ($user) {
            $join->on('user_platform_transactions.platform_id', '=', 'games.id') // Match platform_id with game_id
                 ->where('user_platform_transactions.user_id', '=', $user->id) // Match user_id
                 ->where('user_platform_transactions.status', '=', 'approved'); // Match status as approved
        })
        ->select(
            'accounts.id as account_id',
            'accounts.game_id as account_game_id',
            'accounts.username', // Select username
            'accounts.password', // Select password
            'accounts.status',
            'games.login_link',
            'games.id as game_id',
            'games.name as game_name', // Correct column for game name
            'games.logo as game_logo',
            DB::raw('SUM(user_platform_transactions.amount) as transaction_amount') // Sum the amount from transactions
        )
        ->groupBy(
            'accounts.id',
            'accounts.game_id',
            'accounts.username', // Include username in GROUP BY
            'accounts.password', // Include password in GROUP BY
            'accounts.status', 
            'games.login_link',
            'games.id',
            'games.name',
            'games.logo'
        )
        ->get();
    

        $userAccountsCount = UserAccount::where('user_accounts.user_id', $user->id) // Filter by current user's ID
    ->where('accounts.status', 1) // Filter accounts with status = 1
    ->join('accounts', 'accounts.id', '=', 'user_accounts.account_id') // Join accounts table
    ->join('games', 'games.id', '=', 'accounts.game_id') // Join games table
    ->count();
    
        $transactions = DB::table('user_platform_transactions')
            ->where('user_platform_transactions.user_id',$user->id)
            ->join('games', 'user_platform_transactions.platform_id', '=', 'games.id')  // Joining on platform_id
            ->select('user_platform_transactions.*', 'games.name as name')  // Selecting necessary columns
            ->limit(10)
            ->get();
            // dd($accounts);
        // You can pass the user data to the view
        $depositeSum = DB::table('user_platform_transactions')->where('status','Approved')->where('user_id',$user->id)->sum('amount');
        $depositePendingRequest = DB::table('user_platform_transactions')->where('user_id',$user->id)->where('status','pending')->count('id');
        $withDrawSum = DB::table('withdrawals')->where('status','Approved')->where('user_id',$user->id)->sum('amount');
        $withDrawSumPendingRequest = DB::table('withdrawals')->where('user_id',$user->id)->where('status','pending')->count('id');
        $lastApprovedRequest = DB::table('user_platform_transactions')
        ->where('user_id', $user->id)
        ->where('status', 'approved') // Fix the typo in 'statua' to 'status'
        ->orderBy('created_at', 'desc') // Assuming 'created_at' is the timestamp column
        ->first();
        return view('users.dashboard', compact('user','userAccounts','userAccountsCount','transactions','depositeSum','withDrawSum','depositePendingRequest','withDrawSumPendingRequest','lastApprovedRequest')); // Passing the user to the view
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
          
            $destinationPath = public_path('profile_images');
  
            // Get the original file name
            $fileName = time() . '_' . $request->file('profile_image')->getClientOriginalName();
        
            // Move the file to the public/logos directory
            $request->file('profile_image')->move($destinationPath, $fileName);
        
            // Save the file path to the database (relative path for access via `asset()`)
            $profileImagePath = 'profile_images/' . $fileName;


            $user->profile_image = $profileImagePath;
            $user->save();

            return response()->json(['success' => true, 'message' => 'Image uploaded successfully!', 'profile_image' => $profileImagePath]);
        }

        return response()->json(['success' => false, 'message' => 'No file selected.'], 400);
    }

    /**
     * Returns a view with a list of all non-admin users.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function usersList()
    {
        $users = User::where("is_admin", 0)->get();
        return view('users/usersList', compact('users'));
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

    public function getUser($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }
    public function updateUser(Request $request)
    {
        $user = User::find($request->user_id);
        if ($user) {
            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone_number = $request->phone;
            $user->name = $request->name;
            if ($request->has('password') && !empty($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            return redirect()->back()->with('success','User updated successfully');
        } else {
            return redirect()->back()->with('success','User does not update');
        }
       
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
        // dd($user->userAccount());
        $accounts = $user->userAccount()
            ->with('account.game') // Load the game related to each account
            ->get()
            ->map(function ($userAccount) {
                return $userAccount->account; // Extract the account details
            });
            $user = Auth::user();

        // Get transactions with optional status filter
        $transactions = DB::table('user_platform_transactions')
            ->where('user_platform_transactions.user_id',$user->id)
            ->join('games', 'user_platform_transactions.platform_id', '=', 'games.id')  // Joining on platform_id
            ->select('user_platform_transactions.*', 'games.name as name')  // Selecting necessary columns
            ->when($request->status, function ($query) use ($request) {
                // Apply status filter if it exists in the request
                return $query->where('user_platform_transactions.status', $request->status);
            })
            ->get();
            $withdawals = DB::table('withdrawals')
            ->where('withdrawals.user_id',$user->id)
            ->select('withdrawals.*')  // Selecting necessary columns
            ->get();
           

            // admin bank accounts
      
        // Return the view with filtered data
        return view('users/invoiceList', compact('accounts', 'transactions','user','withdawals'));
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
        $propertyId = '472074192'; // Replace with your property ID
        $activeUsers = $this->analytics->getActiveUsers($propertyId);
        $uniqueUsers = $this->analytics->getUniqueUsers($propertyId, '30daysAgo', 'today');
        // $activeUsers = User::where('user_status', 'active')->count();
        $transactions = DB::table('user_platform_transactions')
        ->join('games', 'user_platform_transactions.platform_id', '=', 'games.id')  // Joining on platform_id
        ->select('user_platform_transactions.*', 'games.name as name')  // Selecting necessary columns
        ->limit(10)
        ->get();
        $depositeSum = DB::table('user_platform_transactions')->where('status','Approved')->sum('amount');
        $depositePendingRequest = DB::table('user_platform_transactions')->where('status','pending')->count('id');
        $withDrawSum = DB::table('withdrawals')->where('status','Approved')->sum('amount');
        $withDrawSumPendingRequest = DB::table('withdrawals')->where('status','pending')->count('id');
        return view('admin/dashboard', compact('games', 'activeGamesCount', 'activeAndRecentGamesCount', 'totalUsers', 'activeUsers','transactions','depositeSum','withDrawSum','depositePendingRequest','withDrawSumPendingRequest','uniqueUsers'));
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
    public function webSiteSetting()
    {
        $user = Auth::user();
        $settings = DB::table('settings')->first();
        return view('settings/website',compact('settings','user'));
    }
    public function webSiteSettingUpdate(Request $request)
    {
        $settings = DB::table('settings')->first();
        $profileImagePath = $settings->logo;

        if ($request->hasFile('logo')) {
          
            $destinationPath = public_path('logo');
  
            // Get the original file name
            $fileName = time() . '_' . $request->file('logo')->getClientOriginalName();
        
            // Move the file to the public/logos directory
            $request->file('logo')->move($destinationPath, $fileName);
        
            // Save the file path to the database (relative path for access via `asset()`)
            $profileImagePath = 'logo/' . $fileName;
        }
       
            DB::table('settings')->update(['logo'=>$profileImagePath,'name'=>$request->name,'currency'=>$request->currency,'language'=>$request->language]);

        return redirect()->back()->with('success', 'Settings Updated Successfully');
          
        
    }
    public function webSiteAnnounceUpdate(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'announce' => 'required|string|max:500', // Adjust validation rules as needed
        ]);
    
        // Attempt to find the first announcement
        $announce = Announcement::first();
    
        if ($announce) {
            // Update the existing announcement
            $announce->announcetext = $request->input('announce'); // Replace 'text' with the actual column name
            $announce->save();
            return redirect()->back()->with('success', 'Announcememnt Updated Successfully');
          
        } else {
            // Create a new announcement
            Announcement::create([
                'announcetext' => $request->input('announce'), // Replace 'text' with the actual column name
            ]);
    
            return redirect()->back()->with('success', 'Announcememnt Created Successfully');
        }
    }

    public function fetchNotifications()
    {
        return Auth::user()->notifications; // or ->unreadNotifications
    }  
    
    public function markAsRead($notificationId)
    {
        Auth::user()->notifications()->find($notificationId)->markAsRead();
        return back();
    }
    public function showNotification()
    {
        // Fetch all notifications for the authenticated user
        $notifications = Auth::user()->notifications;

        return view('users.notifications', compact('notifications'));
    }
    
}
