<?php

namespace App\Http\Controllers\Api;



use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\Sdk;

class LoginController extends Controller
{

    public function aws()
    {
        $sharedConfig = [
            'region' => 'us-west-2',
            'version' => 'latest'
        ];
        // Create an SDK class used to share configuration across clients.
        $sdk = new Sdk($sharedConfig);
        // Create an Amazon S3 client using the shared configuration data.
        $client = $sdk->createS3();


        return response()->json([
            'message' => 'Success',
            'data' => $client
        ]);
    }

    public function login(LoginRequest $request)
    {

        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'token' => $request->user()->createToken($request->name)->plainTextToken,
                'message' => 'Success'
            ]);
        } else {
            return response()->json([
                'message' => 'Unhautorized'
            ], 401);
        }
    }
    // public function login(Request $request)
    // {
    //     $this->validateLogin($request);

    //     if (Auth::attempt($request->only('email', 'password'))) {
    //         return response()->json([
    //             'token' => $request->user()->createToken($request->name)->plainTextToken,
    //             'message' => 'Success'
    //         ]);
    //     }

    //     return response()->json([
    //         'message' => 'Unauthorized'
    //     ], 401);
    // }

    // public function validateLogin(Request $request)
    // {
    //     return $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //         'name' => 'required',

    //     ]);
    // }

    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken($request->name)->plainTextToken;

        return response()->json([
            'message' => 'Success',
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], 202);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Success'
        ];
    }
}