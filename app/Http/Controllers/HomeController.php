<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Game;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Mail;
use App\Models\OTP;
use App\Notifications\WhatsAppOTPNotification;
use App\Services\OtpService;
use App\Services\SportsService;

class HomeController extends Controller
{

    protected $otpService;
    protected $sportsService;

    public function __construct(OtpService $otpService,SportsService $sportsService)
    {
        $this->otpService = $otpService;
        $this->sportsService = $sportsService;
    }

    public function index()
    {
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
        // else {
        //     // Log warning if needed.
        //     \Log::warning('Sports API returned empty or invalid data.');
        // }

        $games = Game::where('status', 'active')->get();

        return view('home/main', compact('games', 'liveFootball', 'liveCricket', 'liveTennis'));
    }


    public function score(){

        $sportsData = $this->sportsService->getSpecificSportData();
        dd($sportsData);
    }
    public function loginPage()
    {
        // Return the login page view
        return view('home/signIn');
    }

    public function signupPage()
    {
        // Return the login page view
        return view('home/signUp');
    }
    public function verifyOtp(Request $request)
    {
        // Validate the OTP input
        $validated = $request->validate([
            'otp' => 'required|digits:6',
        ]);

        // Retrieve the stored OTP and credentials from session
        $storedOtp = OTP::where('user_id', session('otp_user_id'))
                        ->where('otp', $validated['otp'])
                        ->first();

        // Check if the OTP is valid and has not expired
        if ($storedOtp && now()->lessThanOrEqualTo($storedOtp->expires_at)) {
            // OTP is valid, clear it from the session

            // Authenticate the user using the stored credentials
            $credentials = [
                'email' => session('otp_email'),
                'password' => session('otp_password'),
            ];

            // Remove OTP and other session data
            session()->forget(['otp', 'otp_expires_at', 'otp_email', 'otp_password']);

            // Delete OTP record from database after successful verification
            $storedOtp->delete();

            // Attempt to log the user in
            if (Auth::attempt($credentials, true)) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'OTP verified successfully. You are now logged in.',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Authentication failed. Please try again.',
                ], 401);
            }
        }

        // If OTP is invalid or expired, clear session data and delete the record
        session()->forget(['otp', 'otp_expires_at', 'otp_email', 'otp_password']);

        // Delete the OTP record from the database if it exists
        if ($storedOtp) {
            $storedOtp->delete();
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid or expired OTP.',
        ], 401);
    }




    public function login(Request $request)
{
    // Validate the request
    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8',
    ]);

    // Attempt to find the user by email
    $user = User::where('email', $validated['email'])->first();

    if (!$user) {
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid email or password.',
        ], 401);
    }

    // Check if the user is an admin
    if ($user->is_admin) {
        // Verify password
        if (!Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid email or password.',
            ], 401);
        }

        // Generate OTP and store it in the database
        $otp = rand(100000, 999999);
        $expiresAt = now()->addMinutes(10);

        // Store OTP in the 'otps' table
        OTP::create([
            'user_id' => $user->id,
            'otp' => $otp,
            'expires_at' => $expiresAt,
        ]);

        // Store the user credentials (email, password, user_id) in session
        session([
            'otp_user_id' => $user->id,
            'otp_email' => $user->email,
            'otp_password' => $validated['password'],  // Store password (to authenticate later)
        ]);

        // Send OTP to admin's email
        try {
            Mail::to($user->email)->send(new \App\Mail\OtpMail($otp));
            // $this->otpService->sendOtp($user->phone_number, $otp);
            // $user->notify(new WhatsAppOTPNotification($otp));
            // $phoneNumber = $user->phone_number;
            //  $maskedPhone = substr($phoneNumber, 0, 3) . str_repeat('*', strlen($phoneNumber) - 6) . substr($phoneNumber, -3);

            return response()->json([
                'status' => 'otp_required',
                'message' => 'An OTP has been sent to your email for verification.',
                // 'masked_phone' => $maskedPhone,
            ]);
        } catch (\Exception $e) {
           report($e);
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    // Non-admin users login directly
    if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], true)) {
        return response()->json([
            'status' => 'success',
            'message' => 'Login successful. Welcome!',
        ]);
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid email or password.',
        ], 401);
    }
}


    public function forgotPassword()
    {
        //
        return view('home/forgotPassword');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone_number' => 'required|string|max:20|unique:users,phone_number',
            'password' => 'required|string|min:8'
        ]);

        try {
            // Create the new user
            $user = User::create([
                'username' => $validated['username'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'password' => Hash::make($validated['password']),
            ]);

            $account = Account::where('is_assigned', 0)->first();

            if ($account) {
                UserAccount::create([
                    'user_id' => $user->id,
                    'account_id' => $account->id,
                    'assigned_at' => now(),
                ]);

                // Mark the account as assigned
                $account->update(['is_assigned' => 1]);
            }

            // Optionally, log the user in
            Auth::login($user);

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'User successfully created.',
            ]);
        } catch (\Exception $e) {
            Log::error('User creation error: ' . $e->getMessage());

            // Return a structured error response with an `errors` key
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while creating the user. Please try again.',
                'errors' => [
                    'general' => [$e->getMessage()], // Wrap error message in an array
                ],
            ], 500);
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();  // Logout the user
        $request->session()->invalidate();  // Invalidate the session
        $request->session()->regenerateToken();  // Regenerate CSRF token to prevent session fixation

        return response()->json(['message' => 'Logged out successfully']);
    }

    public function calendar()
    {
        return view('calendar');
    }

    public function chatMessage()
    {
        return view('chatMessage');
    }

    public function chatEmpty()
    {
        return view('chatEmpty');
    }

    public function veiwDetails()
    {
        return view('veiwDetails');
    }

    public function email()
    {
        return view('email');
    }

    public function error1()
    {
        return view('error');
    }

    public function faq()
    {
        return view('faq');
    }

    public function gallery()
    {
        return view('gallery');
    }

    public function kanban()
    {
        return view('kanban');
    }

    public function pricing()
    {
        return view('pricing');
    }

    public function termsCondition()
    {
        return view('termsCondition');
    }

    public function widgets()
    {
        return view('widgets');
    }
    public function chatProfile()
    {
        return view('chatProfile');
    }
}
