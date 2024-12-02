<?php

namespace App\Http\Controllers;
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
            ->select('user_platform_transactions.*', 'games.name as name','games.logo')  // Selecting necessary columns
            ->get();

            $withdrawalRequests  = DB::table('withdrawals')
            ->select('withdrawals.*') 
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
}
