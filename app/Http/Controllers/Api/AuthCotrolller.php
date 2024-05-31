<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class AuthCotrolller extends Controller
{

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'data.attributes.name' => ['required', 'string', 'min:4'],
            'data.attributes.email' => ['required', 'email', 'lowercase', 'unique:users,email'],
            'data.attributes.password' => ['required', 'confirmed'],
        ]
            //'data.attributes.password'=>[
                //'required',
                //'string',
                //'min:8',//minimo de 8 carcteres
                //'regex:/[a-z]/', //al menos una letraminuscula
                //'regex:/[A-Z]/', //al menos una letra mayuscula
                //'regex:/[0-9]/', //al menos un numero
                 //'regex:/[@$!%*#?&]/', //al menos un caracter especial
                 //],

    );

    $user = User::create([
        'name' => $request->input('data.attributes.name'),
        'email' => $request->input('data.attributes.email'),
        'password' => $request->input('data.attributes.password')

    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'user'=>$user,
        'token'=>$token
    ]);

    }
    public function login(Request $request){
        $credentials = $request->validate([ 
            'data.attributes.email' => ['required', 'email', 'lowercase', 'unique:users,email'],
            'data.attributes.password' => ['required', 'confirmed'],
        ]);
         //extraer los datos  de email y password directo del request
        
         $credentials = [
            'email' => $request->input('data.attributes.email'),
            'password' => $request->input('data.attributes.password')
         ];
         if (Auth::attempt($credentials)){
            $user = Auth::user(); //el usuario es autentificado
            $token = $user->createToken('auth_token')->plainTextToken;
            $cookie = cookie('cookie_token', $token, 60 * 24);
            return response(["token" => $token], Response::HTTP_OK)->withCookie($cookie);
         }
         else{
            return response(["message" => "Credenciales inválidas"], Response::HTTP_UNAUTHORIZED);
        }
    }

}
