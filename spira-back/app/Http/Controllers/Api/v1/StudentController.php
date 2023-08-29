<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\StudentResource;
use Illuminate\Http\Request;
use App\Models\User;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = User::role('student')->latest()->paginate();
        return StudentResource::collection($students);
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new StudentResource($user);
    }

}
