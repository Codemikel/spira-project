<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use App\Http\Resources\v1\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (auth()->user()->hasPermissionTo('view users with courses')) {
            return UserResource::collection(User::latest()->paginate());
        }else{
            return response()->json([
                'message' => 'No tienes acceso a esta vista.'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
