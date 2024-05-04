<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\FuncCall;

class AuthController extends Controller
{
    //login
    public function login (Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // check user is exist

        $user =User::where('email',$request->email)->first();

        // check the password is correct

        if (!$user || !Hash::check($request->password, $user->password)){
        return response([
            'message' => ['These credentials do not match our records.']
        ], 404);
        }

        // generate token
        $token = $user->createToken('auth-token')->plainTextToken;

        return response ([
            'user' => $user,
            'token' => $token,
        ], 200);

    // if (!auth()->attempt($request->only('email','password'))){
    //     return response()->json([
    //         'message' => 'Invalid login details'
    //     ], 401);
    // }
    // $user = auth()->user();

    // $token = $user->createToken('tokrn')->plainTextToken;

    // return response()->json([
    //     'user' => $user,
    //     'token' => $token
    // ]);

    }

     //logout
     public function logout (Request $request){

        //request user kemudian token yang ada apa terus di hapus
        $request->user()->currentAccessToken()->delete();

        return response ([
            'message' => 'Logged out succesfully',
        ], 200);
    }
}
