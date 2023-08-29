<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'hours'
    ];

    public function assignedStudents(){
        return $this->belongsToMany(User::class, 'classrooms', 'course_id', 'user_id')
            ->withTimestamps()
            ->onDelete('cascade');
    }

}
