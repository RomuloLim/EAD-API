<?php

namespace App\Repositories;

use App\Models\Lesson;

class LessonRepository
{
    protected $model;

    public function __construct(Lesson $model)
    {
        $this->model = $model;
    }

    public function getLessonsByModuleId(string $moduleId)
    {
        return $this->model
                    ->where('module_id', $moduleId)
                    ->get();
    }

    public function getLesson(string $id)
    {
        return $this->model->findOrFail($id);
    }
}
