<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use App\Models\PlatformTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        PlatformTransaction::create([
            'user_id' => Auth::id(), // Get the currently authenticated user ID
            'platform_id' => $validatedData['platform_id'],
            'amount' => $validatedData['amount'],
            'utr_number' => $request->utr_number,
            'image' => $imagePath,
            'status' => 'pending', // Default status for a new transaction
        ]);

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
    // dd($request->all());
    // Validate the data coming from the form
    $request->validate([
        'amount' => 'required|numeric|min:1',
        'accountOption' => 'required|string',
        'bankId' => 'nullable|exists:bank_accounts,id', // for existing bank accounts
        'newAccountData.bankName' => 'nullable|string|max:255',
        'newAccountData.accountNumber' => 'nullable|string|max:255',
        'newAccountData.accountHolderName' => 'nullable|string|max:255',
        'newAccountData.iban' => 'nullable|string|max:255',
    ]);

    // Get the logged-in user
    $user = Auth::user();

    // Initialize bankId to null
    $bankId = null;

    if ($request->accountOption == 'newAccount') {
        // Save the new bank account details to the bank_accounts table
        $bankAccount = new BankAccount([
            'user_id' => $user->id,
            'bank_name' => $request->newAccountData['bankName'],
            'account_number' => $request->newAccountData['accountNumber'],
            'account_holder_name' => $request->newAccountData['accountHolderName'],
            'iban' => $request->newAccountData['iban'],
        ]);

        // Save the new bank account
        $bankAccount->save();

        // Set the bankId to the newly created bank account's id
        $bankId = $bankAccount->id;  // This is the bank_account_id that needs to be saved
    } else {
        // Use the saved bank account id from the selection
        $bankId = $request->bankId;
    }

    // Store the withdrawal record in the withdrawals table
    $withdrawal = new Withdrawal([
        'user_id' => $user->id,
        'amount' => $request->amount,
        'status' => 'pending',
        'bank_account_id' => $bankId,  // Store the bank account id here
    ]);

    $withdrawal->save();

    return response()->json(['message' => 'Withdrawal request submitted successfully.']);
}


}
