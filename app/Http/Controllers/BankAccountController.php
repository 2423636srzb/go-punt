<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BankAccountController extends Controller
{

   
    
    public function sendOtp(Request $request)
    {
        try {
            $otp = random_int(100000, 999999); // Generate a 6-digit OTP
    
            $user = auth()->user();
    
            // Send OTP via email
            Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($user) {
                $message->to($user->email)->subject('Your OTP Code');
            });
    
            // Save OTP (hashed) in session with expiry
            session(['otp' =>$otp, 'otp_expiry' => now()->addMinutes(5)]);
    
            return response()->json(['status' => 'success', 'message' => 'OTP sent successfully', 'otp' => $otp]);
        } catch (\Throwable $e) {
            Log::error("Failed to send OTP: " . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to send OTP.'], 500);
        }
    }
    

    public function verifyOtp(Request $request)
{
    $enteredOtp = $request->input('otp');

    // Retrieve OTP and expiry from session
    $storedOtp = session('otp');
    $otpExpiry = session('otp_expiry');

    if (!$storedOtp || !$otpExpiry || now()->greaterThan($otpExpiry)) {
        return response()->json(['status' => 'error', 'message' => 'OTP expired or invalid.']);
    }

    if ($enteredOtp == $storedOtp) {
        // OTP is valid, clear the session
        session()->forget(['otp', 'otp_expiry']);
        return response()->json(['status' => 'success', 'message' => 'OTP verified successfully.']);
    }

    return response()->json(['status' => 'error', 'message' => 'Invalid OTP.']);
}

public function edit($id)
{
    $bankAccount = BankAccount::find($id);

    if (!$bankAccount) {
        return response()->json(['status' => 'error', 'message' => 'Bank account not found.'], 404);
    }

    return response()->json(['status' => 'success', 'data' => $bankAccount]);
}


    public function store(Request $request)
    {

        // Validate the form input based on the selected payment method
        $validated = $request->validate([
            'payment_method' => 'required|in:bank-transfer,upi,crypto',
            'account_holder_name' => 'required|max:255',
            'account_number' => 'required_if:payment_method,bank-transfer|max:255',
            'crypto_wallet' => 'required_if:payment_method,crypto|max:255',
            'bank_name' => 'required_if:payment_method,bank-transfer|max:255',
            'ifc_number' => 'required_if:payment_method,bank-transfer|max:255',
            'upi_number' => 'required_if:payment_method,upi|max:255',
            'upi_qr_code' => 'nullable|mimes:jpg,png,jpeg|max:2048',
        ]);
    
        try {

            $imagePath = null;
        // Handle the file upload if a file is provided
        if ($request->hasFile('upi_qr_code')) {

            $destinationPath = public_path('QRCodes');
  
            // Get the original file name
            $fileName = time() . '_' . $request->file('upi_qr_code')->getClientOriginalName();
        
            // Move the file to the public/logos directory
            $request->file('upi_qr_code')->move($destinationPath, $fileName);
        
            // Save the file path to the database (relative path for access via `asset()`)
            $imagePath = 'QRCodes/' . $fileName;

            // $imagePath = $request->file('file')->store('transactions', 'public');
        }
            // Handle UPI QR Code file upload if applicable
            // $upiQrCodePath = null;
            // if ($request->hasFile('upi_qr_code') && $request->file('upi_qr_code')->isValid()) {
            //     $upiQrCodePath = $request->file('upi_qr_code')->store('upi_qr_codes', 'public');
            // }
    
            // Initialize payment data
            $paymentData = [
                'user_id' => Auth::id(),
                'payment_method' => $validated['payment_method'],
                'account_holder_name' => $validated['account_holder_name'],
            ];
    
            // Add fields based on payment method
            if ($validated['payment_method'] === 'bank-transfer') {
                $paymentData = array_merge($paymentData, [
                    'account_number' => $validated['account_number'],
                    // 'iban_number' => $validated['iban_number'] ?? null,
                    'bank_name' => $validated['bank_name'],
                    'ifc_number' => $validated['ifc_number'],
                ]);
            } elseif ($validated['payment_method'] === 'upi') {
                $paymentData = array_merge($paymentData, [
                    'upi_number' => $validated['upi_number'],
                    'upi_qr_code' => $imagePath,
                ]);
            } elseif ($validated['payment_method'] === 'crypto') {
                $paymentData = array_merge($paymentData, [
                    'crypto_wallet' => $validated['crypto_wallet'],
                    'upi_qr_code' => $imagePath,

                ]);
            }
    
            // Save the data in the database
            $paymentRecord = BankAccount::create($paymentData);
    
            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'Payment method successfully saved.',
                'data' => $paymentRecord,
            ]);
        } catch (\Exception $e) {
            // Return error response if something goes wrong
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'payment_method' => 'required|in:bank-transfer,upi,crypto',
        'account_holder_name' => 'required|max:255',
        'account_number' => 'required_if:payment_method,bank-transfer|max:255',
        'crypto_wallet' => 'required_if:payment_method,crypto|max:255',
        'bank_name' => 'required_if:payment_method,bank-transfer|max:255',
        'ifc_number' => 'required_if:payment_method,bank-transfer|max:255',
        'upi_number' => 'required_if:payment_method,upi|max:255',
        'upi_qr_code' => 'nullable|mimes:jpg,png,jpeg|max:2048',
    ]);

    try {
        // Find the existing payment record
        $paymentRecord = BankAccount::findOrFail($id);

        // Handle UPI QR Code file upload if applicable
        $upiQrCodePath = $paymentRecord->upi_qr_code; // Keep existing QR code path
        if ($request->hasFile('upi_qr_code') && $request->file('upi_qr_code')->isValid()) {
            // Delete the old file if it exists
            if ($upiQrCodePath) {
                Storage::delete('public/' . $upiQrCodePath);
            }
            $upiQrCodePath = $request->file('upi_qr_code')->store('upi_qr_codes', 'public');
        }

        // Initialize updated payment data
        $paymentData = [
            'payment_method' => $validated['payment_method'],
            'account_holder_name' => $validated['account_holder_name'],
        ];

        // Add fields based on payment method
        if ($validated['payment_method'] === 'bank-transfer') {
            $paymentData = array_merge($paymentData, [
                // 'bank_name' => $validated['bank_name'],
                'account_number' => $validated['account_number'],
                // 'iban_number' => $validated['iban_number'] ?? null,
                'bank_name' => $validated['bank_name'],
                'ifc_number' => $validated['ifc_number'],
            ]);
        } elseif ($validated['payment_method'] === 'upi') {
            $paymentData = array_merge($paymentData, [
                'upi_number' => $validated['upi_number'],
                'upi_qr_code' => $upiQrCodePath,
            ]);
        } elseif ($validated['payment_method'] === 'crypto') {
            $paymentData = array_merge($paymentData, [
                'crypto_wallet' => $validated['crypto_wallet'],
                'upi_qr_code' => $upiQrCodePath,

            ]);
        }

        // Update the record in the database
        $paymentRecord->update($paymentData);

        // Return success response
        return response()->json([
            'status' => 'success',
            'message' => 'Payment method successfully updated.',
            'data' => $paymentRecord,
        ]);
    } catch (\Exception $e) {
        // Return error response if something goes wrong
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
        ], 500);
    }
}



    public function destroy(Request $request, $id)
    {
        try {
            // Find the bank account by ID
            $bankAccount = BankAccount::findOrFail($id);

            // Delete the bank account
            $bankAccount->delete();

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'Bank account deleted successfully.',
            ]);
        } catch (\Exception $e) {
            // Handle any errors that may occur
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete the bank account. Please try again.',
            ], 500); // 500 for server error
        }
    }
}
