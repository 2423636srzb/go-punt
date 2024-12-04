<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use App\Models\PlatformTransaction;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\TransactionStatusNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class PlatformTransactionController extends Controller
{


    public function storeTransaction(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'platform_id' => 'required|exists:games,id', // Corrected to match the foreign key in the games table
            'amount' => 'required|numeric|min:0',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Ensures only valid image files are uploaded
        ]);

        $imagePath = null;
        // Handle the file upload if a file is provided
        if ($request->hasFile('file')) {

            $destinationPath = public_path('transactions');
  
            // Get the original file name
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
        
            // Move the file to the public/logos directory
            $request->file('file')->move($destinationPath, $fileName);
        
            // Save the file path to the database (relative path for access via `asset()`)
            $imagePath = 'transactions/' . $fileName;

            // $imagePath = $request->file('file')->store('transactions', 'public');
        }

        // Create the transaction record
        $transaction = PlatformTransaction::create([
            'user_id' => Auth::id(), // Get the currently authenticated user ID
            'platform_id' => $validatedData['platform_id'],
            'amount' => $validatedData['amount'],
            'utr_number' => $request->utr_number,
            'image' => $imagePath,
            'status' => 'pending', // Default status for a new transaction
        ]);
        $status = 'Created';
        $admin = User::where('is_admin',1)->get(); // Assuming you use roles.
        Notification::send($admin, new TransactionStatusNotification($transaction, $status));
        // Return a JSON response indicating success
        return response()->json([
            'success' => true,
            'message' => 'Transaction submitted successfully.',
        ]);
    }

    public function destroy($id)
{
    $transaction = PlatformTransaction::find($id);

    if (!$transaction) {
        return response()->json(['error' => 'Transaction not found.'], 404);
    }

    // Delete the transaction
    $transaction->delete();

    // Return a success response
    return response()->json(['success' => 'Transaction deleted successfully.']);
}


public function submitWithdrawal(Request $request) 
{
    // Validate the data
    $request->validate([
        'amount' => 'required|numeric|min:1',
        'bankId' => 'nullable|exists:bank_accounts,id',
    ]);

    // Get the user
    $user = Auth::user();

    // Store withdrawal record
    $withdrawal = new Withdrawal([
        'user_id' => $user->id,
        'amount' => $request->amount,
        'status' => 'pending',
        'bank_account_id' => $request->bankId,
    ]);

        $transaction = $withdrawal->save();
   

        return response()->json(['message' => 'Withdrawal request submitted successfully.']);
   
}


public function withdrawDestroy($id)
{

    $withdrawal = Withdrawal::find($id);

    if (!$withdrawal) {
        return response()->json(['error' => 'Withdrawal not found.'], 404);
    }

    // Delete the transaction
    $withdrawal->delete();

    // Return a success response
    return response()->json(['success' => 'Withdrawal deleted successfully.']);
}

}
