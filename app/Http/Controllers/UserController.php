<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Fetch all users
        return view('admin.user.index', compact('users'));
    }
    
    public function delete(Request $request)
    {
        $id = $request->id; // Fixed incorrect variable reference
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'User not found.'], 404);
    }
}
