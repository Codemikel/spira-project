<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\CourseResource;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CourseResource::collection(Course::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'hours'  => 'required',
        ]);

        $course = Course::create([
            'name' => $request->name,
            'hours' => $request->hours
        ]);

        return response()->json([
            'message' => 'Curso creado con exito'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return new CourseResource($course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required',
            'hours'  => 'required',
        ]);

        $course->update([
            'name' => $request->name,
            'hours' => $request->hours
        ]);

        return response()->json([
            'message' => 'Curso actualizado'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return response()->json([
            'message' => 'Curso eliminado'
        ], 204);
    }
}
