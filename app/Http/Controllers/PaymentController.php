<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PaymentController extends Controller
{
    //

    public function requestPayment()
    {
        $paymentRequests = DB::table('user_platform_transactions')
            ->join('games', 'user_platform_transactions.platform_id', '=', 'games.id')  // Joining on platform_id
            ->select('user_platform_transactions.*', 'games.name as name','games.logo')  // Selecting necessary columns
            ->get();
        return view('payments/paymentRequest',compact('paymentRequests'));
    }

    public function getPaymentRequest($id)
    {
        $paymentRequests = DB::table('user_platform_transactions')
        ->join('games', 'user_platform_transactions.platform_id', '=', 'games.id')  // Joining games table on platform_id
        ->join('users', 'user_platform_transactions.user_id', '=', 'users.id')  
        ->select('user_platform_transactions.*', 'games.name as name','users.name as user_name')  // Selecting necessary columns, alias for clarity
        ->where('user_platform_transactions.id', $id)  // Filtering by transaction ID
        ->first(); 
       return response()->json($paymentRequests);
        // return response()->json(['success' => true, 'message' => 'Profile updated successfully']);

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
