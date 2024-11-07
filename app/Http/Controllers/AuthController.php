<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistroRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{


    public function register(RegistroRequest $request){
        $data = $request->validated();// internamente se comunica con el rule del request

        //Crear usuario
        $user = User::create([
            'name'=> $data['name'], 
            'email'=> $data['email'], 
            'password'=> $data['password']
        ]);
        return [
            'token' => $user->createToken('token')->plainTextToken,          
            'user' => $user
        ];
    }

    public function login(LoginRequest $request){
        $data = $request->validated();
        //REVISAR EL PASSWORD
        if(!Auth::attempt($data)){
            return response([
              'errors' => ['El email o el password son incorrectos']
            ], 422);

        }
        //AUTENTICAR AL USUARIO:
        $user = Auth::user();
        return [
            'token' => $user->createToken('token')->plainTextToken,          
            'user' => $user
        ];

    }

    public function logout(Request $request){

        $user = $request->user();
        $user->currentAccessToken()->delete();

        return [
            'user' => null
        ];
    }

}
