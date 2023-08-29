<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use App\Http\Resources\v1\UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        return UserResource::collection(User::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable',
            'password' => 'required'
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password
        ]);

        $user->assignRole('student');

        $user->save();

        return response()->json([
            'message' => 'Usuario creado',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user){
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user){
        
        $request->validate([
            'name' => 'nullable|string',
            'email' => 'email|unique:users,email,' . $user->id, 
            'phone' => 'string',
            'password' => 'nullable|string|min:6', 
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password
        ]);

        return response()->json([
            'message' => 'Usuario actualizado'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user){
        $user->delete();
    }
}
