<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Withdrawal;
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
        DB::table('user_platform_transactions')->where('id',$id)->update(['status'=>'approved']);
        return redirect()->back()->with('success' , 'Payment Request Accepted Successfully');
       
    }
    public function rejectPaymentRequest($id)
    {
        DB::table('user_platform_transactions')->where('id',$id)->update(['status'=>'rejected']);
        return redirect()->back()->with('success' , 'Payment Request Rejected Successfully');
       
    }

    public function rejectWithdrawRequest($id)
    {
        DB::table('withdrawals')->where('id',$id)->update(['status'=>'rejected']);
        return redirect()->back()->with('success' , 'Withdrawal Request Rejected Successfully');
    }
    public function acceptWithdrawRequest($id)
    {
        DB::table('withdrawals')->where('id',$id)->update(['status'=>'approved']);
        return redirect()->back()->with('success' , 'Withdrawal Request Approved Successfully');
    }

  

public function getWithdrawalData($id)
{
    // Fetch the withdrawal data
    $withdrawal = Withdrawal::find($id);

    // If withdrawal exists, fetch the associated bank name
    if ($withdrawal) {
        $bank = BankAccount::find($withdrawal->bank_account_id);

        // Prepare the response data
        $response = [
            'id' => $id,
            'user_id' => $withdrawal->user_id,
            'amount' => $withdrawal->amount,
            'bank_account_id' => $withdrawal->bank_account_id,
            'status' => $withdrawal->status,
            'created_at' => $withdrawal->created_at->format('Y-m-d H:i:s'),
            'payment_method' => $bank ? $bank->payment_method: 'Not Available',
        ];

        // Return the data as a JSON response
        return response()->json($response);
    }

    // If withdrawal doesn't exist, return an error message
    return response()->json(['error' => 'Withdrawal not found'], 404);
}

}
