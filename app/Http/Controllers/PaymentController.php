<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\User;
use App\Models\Withdrawal;
use App\Notifications\TransactionStatusNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    //

    public function requestPayment()
    {
        // $user = Auth::user();
        $depositRequests = DB::table('user_platform_transactions')
        ->join('games', 'user_platform_transactions.platform_id', '=', 'games.id')  // Joining on platform_id
        ->select('user_platform_transactions.*', 'games.name as name', 'games.logo')  // Selecting necessary columns
        ->orderBy('user_platform_transactions.created_at', 'desc')  // Ordering by created_at in descending order
        ->get();
    
    $withdrawalRequests = DB::table('withdrawals')
        ->select('withdrawals.*')
        ->orderBy('withdrawals.created_at', 'desc')  // Ordering by created_at in descending order
        ->get();
        return view('payments/paymentRequest',compact('depositRequests','withdrawalRequests'));
    }

    public function getPaymentRequest($id)
    {
      
        $paymentRequest = DB::table('user_platform_transactions')
            ->join('games', 'user_platform_transactions.platform_id', '=', 'games.id')
            ->join('users', 'user_platform_transactions.user_id', '=', 'users.id')
            ->select(
                'user_platform_transactions.amount',
                'user_platform_transactions.utr_number',
                'user_platform_transactions.created_at',
                'user_platform_transactions.image',
                'games.name as name',
                'users.username as user_name',
                'user_platform_transactions.id'
            )
            ->where('user_platform_transactions.id', $id)
            ->first(); 
        return response()->json($paymentRequest);
    }
    
    public function acceptPaymentRequest($id)
    {
        // Update the transaction status to "approved"
        $updated = DB::table('user_platform_transactions')->where('id', $id)->update(['status' => 'approved']);
    
        if ($updated) {
            // Retrieve the updated transaction
            $transaction = DB::table('user_platform_transactions')->where('id', $id)->first();
    
            if ($transaction && isset($transaction->user_id)) {
                // Find the associated user
                $user = User::find($transaction->user_id);
    
                if ($user) {
                    // Send notification to the user
                    $user->notify(new TransactionStatusNotification($transaction, 'approved'));
    
                    // Redirect with success message
                    return redirect()->back()->with('success', 'Payment Request Accepted Successfully');
                }
    
                // User not found
                return redirect()->back()->withErrors(['error' => 'User associated with this transaction not found.']);
            }
    
            // Transaction record not found
            return redirect()->back()->withErrors(['error' => 'Transaction record not found.']);
        }
    
        // Update operation failed
        return redirect()->back()->withErrors(['error' => 'Failed to approve the payment request.']);
    }
    
    public function rejectPaymentRequest($id)
    {
       $updated = DB::table('user_platform_transactions')->where('id',$id)->update(['status'=>'rejected']);
        
        if ($updated) {
            // Retrieve the updated transaction
            $transaction = DB::table('user_platform_transactions')->where('id', $id)->first();
    
            if ($transaction && isset($transaction->user_id)) {
                // Find the associated user
                $user = User::find($transaction->user_id);
    
                if ($user) {
                    // Send notification to the user
                    $user->notify(new TransactionStatusNotification($transaction, 'Rejected'));
    
                    // Redirect with success message
                    return redirect()->back()->with('success', 'Payment Request Rejected Successfully');
                }
            }
            return redirect()->back()->with('success' , 'Payment Request Rejected Successfully');
        }

       
    }

    public function rejectWithdrawRequest($id)
    {
        $updated = DB::table('withdrawals')->where('id',$id)->update(['status'=>'rejected']);

        if ($updated) {
            // Retrieve the updated transaction
            $transaction = DB::table('withdrawals')->where('id', $id)->first();
    
           
                // Find the associated user
                $user = User::find($transaction->user_id);
    
               
                    // Send notification to the user
                    $user->notify(new TransactionStatusNotification($transaction, 'Rejected'));
    
                    // Redirect with success message
                    return redirect()->back()->with('success', 'Payment Request Rejected Successfully');
                
            }
            return redirect()->back()->with('error' , 'Payment Request Not Rejected');
        }


    
    public function acceptWithdrawRequest($id)
    {
        $updated = DB::table('withdrawals')->where('id',$id)->update(['status'=>'approved']);
        if ($updated) {
            // Retrieve the updated transaction
            $transaction = DB::table('withdrawals')->where('id', $id)->first();
    
           
                // Find the associated user
                $user = User::find($transaction->user_id);
    
               
                    // Send notification to the user
                    $user->notify(new TransactionStatusNotification($transaction, 'Approved'));
    
                    // Redirect with success message
                    
                    return redirect()->back()->with('success' , 'Withdrawal Request Approved Successfully');
            }
      
        return redirect()->back()->with('error' , 'Withdrawal Request Not Approved');
    }

  

    public function getWithdrawalData($id)
    {
        // Fetch the withdrawal data
        $withdrawal = Withdrawal::find($id);
    
        // If withdrawal exists, fetch the associated bank account and user data
        if ($withdrawal) {
            $bank = BankAccount::find($withdrawal->bank_account_id);  // Get the bank account linked to the withdrawal
            $user = User::find($withdrawal->user_id);  // Get the user who made the withdrawal request
    
            // Initialize variables to hold the payment details
            $paymentDetail = '';
            $bankName = '';
            $branchName = '';
            $ifcNumber = '';
            $cryptoQRCode = '';
            $upiQRCode = '';
    
            // Check if the bank account exists and set the payment details
            if ($bank) {
                if ($bank->payment_method == 'bank-transfer') {
                    $paymentDetail = $bank->account_number;  // Use account number for bank transfer
                    $bankName = !empty($bank->bank_name) ? $bank->bank_name : null;  // Set bank name if available
                    $branchName = !empty($bank->branch_name) ? $bank->branch_name : null;  // Set branch name if available
                    $ifcNumber = !empty($bank->ifc_number) ? $bank->ifc_number : null;  // Set IFC number if available
                } elseif ($bank->payment_method == 'crypto') {
                    $paymentDetail = $bank->crypto_wallet;  // Use crypto wallet for crypto payment
                  $QRCode = $bank->upi_qr_code ? $bank->upi_qr_code : null; // Set crypto QR code if available
                } elseif ($bank->payment_method == 'upi') {
                    $paymentDetail = $bank->upi_number;  // Use UPI number for UPI payment
                    $QRCode = $bank->upi_qr_code ?$bank->upi_qr_code : null;

  // Set UPI QR code if available
                }
            }
    
            // Prepare the response data
            $response = [
                'id' => $id,
                'user_name' => $user ? $user->username : 'Not Available',  // Get the user's name
                'amount' => $withdrawal->amount,  // Withdrawal amount
                'bank_account_id' => $withdrawal->bank_account_id,  // Bank account ID
                'status' => $withdrawal->status,  // Status of the withdrawal
                'created_at' => $withdrawal->created_at->format('Y-m-d H:i:s'),  // Created date and time
                'payment_method' => $bank ? $bank->payment_method : 'Not Available',  // Payment method (Bank Transfer, Crypto, or UPI)
                'payment_detail' => $paymentDetail,  // Account number, crypto wallet, or UPI number based on payment method
                'bankName' => $bankName,  // Bank name (or null if not available)
                'branchName' => $branchName,  // Branch name (or null if not available)
                'QRCode' => $QRCode,  // UPI QR code (or null if not available)
                'ifcNumber' => $ifcNumber,  // IFC number (or null if not available)
            ];
    
            // Return the data as a JSON response
            return response()->json($response);
        }
    
        // If withdrawal doesn't exist, return an error message
        return response()->json(['error' => 'Withdrawal not found'], 404);
    }
    
    

}
