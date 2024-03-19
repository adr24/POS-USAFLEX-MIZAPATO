<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Http\Resources\Auth\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login( AuthLoginRequest $request )
    {
        $credentials = $request->validated();

        if( !Auth::attempt($credentials) )
        {
            return response()->json([
                "message" => "Correo o contraseña incorrectos"
            ], 422);
        }


        $user = User::find( Auth::user()['id'] );
        $token = $user->createToken('token')->plainTextToken;
        
        return response()->json([
            'user' => new UserResource($user),
            'token' => $token
        ]);
    }

    public function register( AuthRegisterRequest $request )
    {
        $credentials = $request->validated();
        $user = User::create($credentials);

        return response()->json([
            "message" => "Usuario registrado con exito",
            "user" => new UserResource($user),
        ], 201);

    }

    public function logout( Request $request )
    {
        $user = $request->user();   
        $user->currentAccessToken()->delete();

        return response()->json([
            "message" => "La sesion se cerro correctamente",
        ]);
    }

    public function checkToken( Request $request )
    {
        $user = $request->user();  
        return response()->json([
            "user" => new UserResource($user),
        ]);
    }
}
