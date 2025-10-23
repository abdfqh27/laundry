<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status);
        }

        $users = $query->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        $roles = ['administrator', 'karyawan', 'customer'];
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'role' => 'required|in:administrator,karyawan,customer',
            'password' => 'required|string|min:8|confirmed',
            'is_active' => 'boolean',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['is_active'] = $request->has('is_active') ? true : false;

        User::create($validated);

        return redirect()->route('admin.users.index')
                       ->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit(User $user)
    {
        $roles = ['administrator', 'karyawan', 'customer'];
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user in storage
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'role' => 'required|in:administrator,karyawan,customer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active') ? true : false;

        // Update password jika diisi
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
            $validated['password'] = bcrypt($request->password);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
                       ->with('success', 'User berhasil diperbarui');
    }

    /**
     * Delete the specified user
     */
    public function destroy(User $user)
    {
        // Prevent deleting the last admin
        if ($user->role === 'administrator' && User::where('role', 'administrator')->count() === 1) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus admin terakhir');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
                       ->with('success', 'User berhasil dihapus');
    }

    /**
     * Toggle user status (active/inactive)
     */
    public function toggleStatus(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "User berhasil {$status}");
    }
}