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

        if (auth()->user()->hasPermissionTo('view users with courses')) {
            $students = User::role('student')->latest()->paginate();
            return UserResource::collection($students);
        }else{
            return response()->json(403);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
    
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $user = new User([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => bcrypt($validatedData['password']),
        ]);

        $user->assignRole('student');

        $user->save();

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user){
        
        if (auth()->user()->hasPermissionTo('view users with courses')) {
            return new UserResource($user);
        }else{
            return response()->json([
                'message' => 'No tienes acceso a esta vista.'
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user){
        
        $validatedData = $request->validate([
            'name' => 'nullable|string',
            'email' => 'email|unique:users,email,' . $user->id, 
            'phone' => 'string',
            'password' => 'nullable|string|min:6', 
        ]);

        
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'];

        
        if (isset($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return new UserResource($user);
    }    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user){
        $user->delete();
    }

    public function showCourses(){
        
        $user = auth()->user();

        if ($user->hasPermissionTo('view assigned courses')) {
            $assignedCourses = $user->assignedCourses;

            return UserResource::collection($assignedCourses);

        } else {

            return response()->json(['message' => 'Access denied'], 403);
            
        }
    }
}
