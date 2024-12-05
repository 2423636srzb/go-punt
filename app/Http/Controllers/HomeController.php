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

class HomeController extends Controller
{
    public function index()
    {
        $games = Game::where('status','active')->get();
        return view('home/main',compact('games'));
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

    //otp verification
    public function verifyOtp(Request $request)
    {
        $validated = $request->validate([
            'otp' => 'required|digits:6', // Validate the OTP input
        ]);
    
        $storedOtp = session('otp');
        $otpExpiresAt = session('otp_expires_at');
    
        if ($storedOtp && $otpExpiresAt && now()->lessThanOrEqualTo($otpExpiresAt)) {
            if ($validated['otp'] == $storedOtp) {
                // OTP is valid, clear it from the session
                session()->forget(['otp', 'otp_expires_at']);
    
                return response()->json([
                    'status' => 'success',
                    'message' => 'OTP verified successfully. You are now logged in.',
                ]);
            }
    
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid OTP.',
            ], 401);
        }
    
        return response()->json([
            'status' => 'error',
            'message' => 'OTP has expired. Please request a new one.',
        ], 401);
    }
    // Login function
    public function login(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
    
        // Attempt to log the user in
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], true)) {
            $user = Auth::user();
    
            // Check if the user is an admin
            if ($user->is_admin) {
                // Generate OTP and store it in session
                $otp = rand(100000, 999999); // Generate a random 6-digit OTP
                $expiresAt = now()->addMinutes(10); // Set OTP expiration time
    
                session(['otp' => $otp, 'otp_expires_at' => $expiresAt]);
    
                // Send OTP to admin's email
                try {
                    Mail::to($user->email)->send(new \App\Mail\OtpMail($otp));
    
                    return response()->json([
                        'status' => 'otp_required',
                        'message' => 'An OTP has been sent to your email for verification.',
                        'user_id' => $user->id, // Pass user ID for verification
                    ]);
                } catch (\Exception $e) {
                
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Failed to send OTP. Please try again later.',
                    ], 500);
                }
            }
    
            // If the user is not an admin, login normally
            return response()->json([
                'username' => $user->name,
                'is_admin' => $user->is_admin,
                'profile_image' => $user->profile_image == "" 
                    ? "https://placehold.co/40x40" 
                    : asset('storage/profile_images/' . $user->profile_image),
                'status' => 'success',
                'message' => 'Login successful. Welcome!',
            ]);
        } else {
            // If login fails
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid email or password.',
            ], 401); // 401 Unauthorized error
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
