<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository
{
    protected $model;

    public function __construct(Module $model)
    {
        $this->model = $model;
    }

    public function getModuleByCourseId(string $courseId)
    {
        return $this->model
            ->with('lessons.views')
            ->where('course_id', $courseId)
            ->get();
    }
}
