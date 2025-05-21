<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'nohp' => 'required|string|max:15',
            'password' => 'required',
        ]);

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Data tidak valid',
            ], 401);
        }

        $user = auth()->user();
        
        return response()->json([
            
            'token' => $user->createToken('auth_token')->plainTextToken,
        ]); 
    }
}
