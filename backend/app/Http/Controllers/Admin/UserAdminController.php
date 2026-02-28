<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserAdminController extends Controller
{
    /**
     * Show all users.
     */ 
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Change user role (admin / user).
     */
    public function changeRole(User $user)
    {
        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        return redirect()->route('admin.users')
            ->with('success', 'Role updated successfully');
    }

    /**
     * Delete a user.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users')
            ->with('success', 'User deleted successfully');
    }
}
