<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class StaffController extends Controller
{
    public function index()
    { 
        $permissions = Permission::all();
        $admins = User::where('is_admin', 1)->with('permissions')->get();
        return view('staff.index', compact('admins','permissions'));
    }

    public function create()
    {
        $permissions =Permission::all(); // Fetch all permissions
        return view('admin.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        // Validate the form input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone_number' => 'required|integer',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);
        try {
            // Create the user
            $user = User::create([
                'username' => $validated['name'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'password' => bcrypt($validated['password']),
                'is_admin' => 1, // Mark as admin since you're only giving permissions to admin users
            ]);
    
            // Assign permissions to the user
            if (isset($validated['permissions'])) {
                $user->givePermissionTo($validated['permissions']);
            }
            return redirect()->back()->with('success', 'Operation completed successfully!');

            // return response()->json([
            //     'status' => 'success',
            //     'message' => 'User added successfully!',
            // ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add user: ' . $e->getMessage(),
            ], 500);
        }
    }
    

    public function edit(User $admin)
    {
        $permissions = Permission::all();
        return view('admin.edit', compact('admin', 'permissions'));
    }

    public function update(Request $request, User $admin)
    {
       
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|string',
            'phone_number' => 'required|string',
            'permissions' => 'array',
        ]);

        // dd($admin->id);

        $admin->update([
            'username' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $admin->password,
        ]);
    
        // Sync permissions
        $admin->syncPermissions($validated['permissions'] ?? []);
    
        return redirect()->back()->with('success', 'Admin updated successfully.');
    }
    
    

    public function destroy(User $admin)
{
    // Remove all permissions associated with the user
    $admin->syncPermissions([]); // Clears all permissions

    // Delete the user from the database
    $admin->delete();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Admin and their permissions deleted successfully.');
}

}
