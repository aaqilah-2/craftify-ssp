<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // Display all users
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Edit user role
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Update user role
    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|integer|in:1,2,3',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.users')->with('success', 'User role updated successfully.');
    }

    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    // Show customers and their profile info
    public function showCustomers() {
        $customers = User::where('role', UserRole::Customer->value)
            ->with('customerProfile') // Load the customer profile
            ->get();

        return view('admin.users.customers', compact('customers'));
    }

    // Show artisans and their profile info
    public function showArtisans() {
        $artisans = User::where('role', UserRole::Artisan->value)
            ->with('artisanProfile') // Load the artisan profile
            ->get();

        return view('admin.users.artisans', compact('artisans'));
    }

    // Create new user form
    public function create() {
        return view('admin.users.create');
    }

    // Store new user
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:1,2,3', // Admin, Artisan, or Customer
        ]);

        // Create the user with hashed password
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully!');
    }
}
