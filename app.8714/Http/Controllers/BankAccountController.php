<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankAccountController extends Controller
{

    public function bankAccount() {
        return view('users.user_bank');
    }

    public function store(Request $request)
    {
        // Validate the form input
        $validated = $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_holder_name' => 'required|string|max:255',
            'iban_number' => 'nullable|string|max:255',
        ]);

        try {
            // Create a new bank account record
            $bankAccount = BankAccount::create([
                'user_id' => Auth::id(),  // Store the currently logged-in user's ID
                'bank_name' => $validated['bank_name'],
                'account_number' => $validated['account_number'],
                'account_holder_name' => $validated['account_holder_name'],
                'iban_number' => $validated['iban_number'] ?? null,
            ]);

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'Bank account successfully saved.',
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
        // Validate the incoming request
        $validatedData = $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_holder_name' => 'required|string|max:255',
            'iban_number' => 'nullable|string|max:255',
        ]);

        try {
            // Find the bank account that belongs to the authenticated user
            $bankAccount = BankAccount::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            // Update the bank account
            $bankAccount->update($validatedData);

            // Return a success JSON response
            return response()->json(['status' => 'success', 'message' => 'Bank account updated successfully!']);
        } catch (\Exception $e) {
            // Catch any errors and return a JSON error response
            return response()->json(['status' => 'error', 'message' => 'An error occurred while updating the bank account.'], 500);
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
