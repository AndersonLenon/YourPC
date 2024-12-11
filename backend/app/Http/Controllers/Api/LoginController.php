<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\LoginRequest;
use Exception;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(LoginRequest $request){
        try{
            $token = $request->user->createToken('token')->plainTextToken;
            return compact('token');
        }catch(Exception $error){
            $this->errorHandler('Erro ao realizar login!!!',$error);
        }
    }

    public function logout(Request $request){
        try{
            $request->user()->tokens()->delete();//deslogar de todas as sessões | dispositivos
            return response()->json(['message' => 'Logout realizado com sucesso!!!']);
        }catch(Exception $error){
            $this->errorHandler('Erro ao realizar logout!!!',$error);
        }
    }
}
