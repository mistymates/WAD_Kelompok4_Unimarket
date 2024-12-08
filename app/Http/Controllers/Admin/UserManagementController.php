<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        // Fetch all users
        $users = User::all();
        return response()->json($users);
    }

    public function updateUser(Request $request, $userId)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $userId,
            'role' => 'sometimes|string|in:buyer,seller,admin',
        ]);

        $user = User::findOrFail($userId);

        $user->update($validated);

        return response()->json(['user' => $user, 'message' => 'User updated successfully']);
    }

    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
