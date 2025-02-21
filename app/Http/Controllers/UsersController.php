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
use App\Models\Account;
use App\Models\Bonus;
use App\Models\UserForgotRequest;
use App\Services\GoogleAnalyticsService;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use App\Services\SportsService;

class UsersController extends Controller
{
    protected $analytics;
    protected $sportsService;

    public function __construct(GoogleAnalyticsService $analytics,SportsService $sportsService )
    {
        $this->analytics = $analytics;
        $this->sportsService = $sportsService;
    }

    public function dashboard()
    {
        $user = Auth::user(); // Get the authenticated user

        $userAccounts = UserAccount::where('user_accounts.user_id', $user->id) // Filter by current user's ID
        ->where('accounts.status', 1) // Filter accounts with status = 1
        ->join('accounts', 'accounts.id', '=', 'user_accounts.account_id') // Join accounts table
        ->join('games', 'games.id', '=', 'accounts.game_id') // Join games table
        ->leftJoin('user_platform_transactions', function ($join) use ($user) {
            $join->on('user_platform_transactions.platform_id', '=', 'games.id')
                 ->where('user_platform_transactions.user_id', '=', $user->id)
                 ->where('user_platform_transactions.status', '=', 'approved');
        })
        ->leftJoin('user_forgot_request', function ($join) {
            $join->on('user_forgot_request.user_account_id', '=', 'user_accounts.id')
                 ->where('user_forgot_request.status', '=', 'Pending');
        })
        ->select(
            'user_accounts.id',
            'accounts.id as account_id',
            'accounts.game_id as account_game_id',
            'accounts.username',
            'accounts.password',
            'accounts.status',
            'games.login_link',
            'games.id as game_id',
            'games.name as game_name',
            'games.logo as game_logo',
            DB::raw('SUM(user_platform_transactions.amount) as transaction_amount'),
            'user_forgot_request.status as forgot_request_status'
        )
        ->groupBy(
            'user_accounts.id',
            'accounts.id',
            'accounts.game_id',
            'accounts.username',
            'accounts.password',
            'accounts.status',
            'games.login_link',
            'games.id',
            'games.name',
            'games.logo',
            'user_forgot_request.status'
        )
        ->get();

        $totalBonus = Bonus::where('user_id', $user->id)
        ->where('redem', 0)
        ->sum('bonus');



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
        return view('users.dashboard', compact( 'totalBonus','user','userAccounts','userAccountsCount','transactions','depositeSum','withDrawSum','depositePendingRequest','withDrawSumPendingRequest','lastApprovedRequest')); // Passing the user to the view
    }

    public function bonus(Request $request)
    {
        try {
            // Validate incoming request
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'amount' => 'required|numeric|min:1',
                'game_id' => 'nullable|exists:games,id', // Ensure game_id exists if provided
            ]);

            // Save bonus in database
            Bonus::create([
                'user_id' => $request->user_id,
                'bonus' => $request->amount,
                'granted_by' => auth()->id(), // Store admin ID
                'dedicated_to' => $request->game_id ?? null, // Save game_id if exists, else null
            ]);

            return response()->json(['success' => true, 'message' => 'Bonus granted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


public function bonusList(){

    $bonuses = DB::table('bonuses')
    ->join('users as u1', 'bonuses.user_id', '=', 'u1.id') // User who received bonus
    ->join('users as u2', 'bonuses.granted_by', '=', 'u2.id') // Admin who granted the bonus
    ->leftJoin('user_accounts', 'bonuses.plateform_id', '=', 'user_accounts.id') // Allow NULL platform
    ->leftJoin('accounts', 'user_accounts.account_id', '=', 'accounts.id')
    ->leftJoin('games', 'accounts.game_id', '=', 'games.id')
    ->select(
        'bonuses.id',
        'u1.name as user_name',
        'bonuses.bonus',
        'bonuses.created_at as granted_date',
        'u2.name as granted_by',
        DB::raw('COALESCE(games.name, "None") as platform_name'), // If NULL, return "None"
        'bonuses.redem'
    )
    ->get();



return view('bonus.index',compact('bonuses'));
}
    public function assignBonus(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'user_account_id' => 'required|exists:user_accounts,id',
            'game_name' => 'required|string',
        ]);

        // Update all bonuses where user_id matches and redem is 0
        $affectedRows = Bonus::where('user_id', $request->user_id)
            ->where('redem', 0)
            ->update([
                'redem' => 1,
                'plateform_id' => $request->user_account_id, // Assign platform ID
            ]);

        if ($affectedRows > 0) {
            return response()->json(['message' => "Bonus successfully assigned to {$request->game_name}!"]);
        } else {
            return response()->json(['message' => "No available bonus found to assign."], 400);
        }
    }
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'user_account_id' => 'required|exists:user_accounts,id',
            'game_name' => 'required|string',
            'account_name' => 'required|string',
            'password' => 'required|string',
            'requested_by' => 'required|string',
        ]);

        // Save the request in the `user_forgot_request` table
        UserForgotRequest::create([
            'user_account_id' => $request->user_account_id,
            'game_name' => $request->game_name,
            'account_name' => $request->account_name,
            'password' => $request->password,
            'requested_by' => $request->requested_by,
            'status' => 'Pending',
        ]);

        return response()->json(['success' => true, 'message' => 'Password reset request submitted successfully']);
    }

public function passwordRequestList(){
    UserForgotRequest::where('is_read', 0)->update(['is_read' => 1]);
    $forgotList = UserForgotRequest::orderBy('created_at', 'desc')->get();
    return view('forgot_request.forgot_list',compact('forgotList'));

}

public function getUnreadCount()
{
    // If you're using a boolean flag:
    $count = UserForgotRequest::where('is_read', 0)->count();
    return response()->json(['count' => $count]);
}

public function approvePassword(Request $request)
{
    try {
        $request->validate([
            'id' => 'required|exists:user_forgot_request,id',
            'password' => 'required',
        ]);

        // Find the UserForgotRequest entry
        $requestEntry = UserForgotRequest::find($request->id);
        if (!$requestEntry) {
            return response()->json(['success' => false, 'message' => 'Request not found.'], 404);
        }

        // Find the associated UserAccount
        $userAccount = UserAccount::find($requestEntry->user_account_id);
        if (!$userAccount) {
            return response()->json(['success' => false, 'message' => 'User account not found.'], 404);
        }

        // Find the related Account
        $account = Account::find($userAccount->account_id);
        if (!$account) {
            return response()->json(['success' => false, 'message' => 'Account not found.'], 404);
        }

        // Update the password securely
        $account->password = $request->password;
        $account->save();

        // Update the request status
        $requestEntry->status = 'Approved';
        $requestEntry->save();

        return response()->json(['success' => true, 'message' => 'Password updated successfully.']);

    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
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
            // 'email' => 'required|email|unique:users,email,' . $request->user_id,
            'phone_number' => 'nullable|string|max:20',
            // 'language' => 'nullable|string|max:1000',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->filled('password')) {
            // If password is provided, hash and save it
            $validated['password'] = Hash::make($validated['password']);
        }

        // Find the user and update the details
        $user = User::find($request->user_id);
        if ($user) {
            $user->name = $validated['name'];
            // $user->email = $validated['email'];
            $user->phone_number = $validated['phone_number'];
            // $user->language = $validated['language'];
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
    if ($status == 'enable') {
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
        $games = Game::all();
        // dd($games);
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
    public function liveMatches(){
        $sportsData = $this->sportsService->getAllSportsData();

        $liveFootball = [];
        $liveCricket = [];
        $liveTennis  = [];
        $matchKey    = []; // Store MatchIDs to check for duplicates

        // Only loop if $sportsData is a non-empty array.
        if (is_array($sportsData) && count($sportsData) > 0) {
            foreach ($sportsData as $match) {
                // Ensure required keys exist and check if the match is live and now playing
                if (isset($match['IsLive'], $match['NowPlaying']) && $match['IsLive'] == 1 && $match['NowPlaying'] == 1) {
                    $matchID = $match['MatchID'] ?? $match['id'] ?? null;

                    // Proceed only if matchID is valid and hasn't been processed before.
                    if ($matchID && !in_array($matchID, $matchKey)) {
                        $matchKey[] = $matchID;

                        switch ($match['Type'] ?? null) {
                            case 'FOOTBALL':
                                $liveFootball[] = $match;
                                break;
                            case 'CRICKET':
                                $liveCricket[] = $match;
                                break;
                            case 'TENNIS':
                                $liveTennis[] = $match;
                                break;
                        }
                    }
                }
            }
        }
        return view('users.live_matches',compact('liveFootball', 'liveCricket', 'liveTennis'));
    }

    public function liveStream($eventId,$sportId,$channelId){
        return view('users.live_stream',compact('eventId','sportId','channelId'));
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
