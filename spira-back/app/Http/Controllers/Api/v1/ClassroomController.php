<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ClassroomResource;
use App\Http\Resources\v1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Classroom;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        if (auth()->user()->hasPermissionTo('view users with courses')) {
            return ClassroomResource::collection(Classroom::latest()->paginate());
        }else{
            return response()->json([], 403);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'course_id' => 'required'
        ]);

        $course = Classroom::create([
            'user_id' => $request->user_id,
            'course_id' => $request->user_id,
        ]);

        return response()->json([
            'message' => 'Curso asignado a estudiante con exito'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        return new ClassroomResource($classroom);
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
