<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OperatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api_operator', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        Auth::setTTL(5);
        $token = Auth::guard("api_operator")->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }


        $user = Auth::guard("api_operator")->user();
        return response()->json([
            'status' => 'success',
            'user' => $user,

            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
        // }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:operators',
            'password' => 'required|string|min:6',
        ]);

        $user = Operator::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::guard('api_operator')->login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'Operator created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout()
    {
        Auth::guard('api_operator')->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }


    public function me()
    {
        $user = auth('api_operator')->user();

        if ($user)
            return response()->json([
                'status' => 'success',
                'user' => $user,

            ]);
        else
            return response()->json([
                'status' => 'error',

            ]);
    }
}
