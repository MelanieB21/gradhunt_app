<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;




class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserCollection::make(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validar datos
        $request->validate([
            'data.attributes.name' => ['required', 'min:4'],
            'data.attributes.email' => ['required', 'email'],
            'data.attributes.password' => ['required'],
        ]); //Almacenar datos
        $user = User::create([
            'name' => $request->input('data.attributes.name'),
            'email' => $request->input('data.attributes.email'),
            'password' => $request->input('data.attributes.password'),
        ]);
        return UserResource::make($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if($request->method()=== 'UPDATE'){
            $request->validate([
                'data.attributes.name' => ['required', 'min:4'],
                'data.attributes.email' => ['required', 'email'],
                'data.attributes.password' => ['required'],
            ]);
            $user->update([
                'name'=> $request->input('data.attributes.name'),
                'email'=> $request->input('data.attributes.email'),
                'password'=> $request->input('data.attributes.password'),
            ]);
        }
        if($request->input('data.attributes.name')){
            $user->name=$request->input('data.attributes.name');
        }
        if($request->input('data.attributes.email')){
            $user->email=$request->input('data.attributes.email');
        }
        if($request->input('data.attributes.password')){
            $user->password=$request->input('data.attributes.password');
        }

        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);

    }
}
