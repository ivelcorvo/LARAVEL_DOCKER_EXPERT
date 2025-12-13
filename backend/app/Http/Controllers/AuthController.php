<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService){}

    #############################################################################
    #### CRIAR USUÁRIO ####
    public function register(RegisterRequest $request)
    {    
        // {
        //     "name": "Matheus",
        //     "email": "matheus@example.com",
        //     "password": "12345678",
        //     "password_confirmation": "12345678"
        // }    
        $user  = $this->authService->register($request->validated());
        $token = $user->createToken('api_token')->plainTextToken;        

        return response()->json([
            'message' => 'Usuário registrado com sucesso.',
            'token'   => $token,
            'user'    => $user
        ], 201);
    }

    #############################################################################
    #### LOGIN USUÁRIO ####
    public function login(LoginRequest $request)
    {
        $user = $this->authService->validateLogin($request->validated());        

        if (!$user) {
            return response()->json([
                'message' => 'Credenciais inválidas.'
            ], 401);
        }
        
        $token = $user->createToken('api_token')->plainTextToken;        

        return response()->json([
            'message' => 'Login realizado com sucesso.',
            'token'   => $token,
            'user'    => $user
        ], 200);
    }

    #############################################################################
    #### LOGOUT USUÁRIO ####
    // public function logout()
    // {
    //     auth()->user()->tokens()->delete();        
    //     return response()->json([
    //         'message' => 'Logout realizado.'
    //     ], 200);
    // }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout realizado.'
        ]);
    }

    #############################################################################
    #### DADOS USUÁRIO ####
    // public function me()
    // {        
    //     return response()->json(auth()->user());
    // }
    public function me(Request $request) // 
    {            
        return response()->json($request->user());
    }

}
