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
        return $this->model
            ->with('modules.lessons.views')
            ->get();
    }

    public function getCourse(string $id)
    {
        return $this->model
            ->with('modules.lessons')
            ->findOrFail($id);
    }
}
