<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = new User;
        $user->user_role = $request->user_role;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->userName = $request->userName;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            "message" => "Registration successful",
        ], 201);
    }


    // user login
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4|max:12'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {

            return response(['message' => 'Bad credits'], 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }


    // user logout
    public function logout()
    {
        auth()->logout();
        return response()->json([
            "message" => "Logout Successful",
        ], 201);
    }


    //get user details
    public function userDetails()
    {
        $userId = Auth::id();
        $usersDetails = User::select('id', 'user_role', 'first_name', 'last_name', 'userName', 'email')
            ->where('id', '=', $userId)
            ->get();

        return response()->json($usersDetails, 200);
    }
}
