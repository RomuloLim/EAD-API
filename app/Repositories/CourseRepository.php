<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    protected $model;

    public function __construct(Course $model)
    {
        $this->model = $model;
    }

    public function getAllCourses()
    {
        return Course::get();
    }

    public function getCourse(string $id)
    {
        return Course::findOrFail($id);
    }
}
