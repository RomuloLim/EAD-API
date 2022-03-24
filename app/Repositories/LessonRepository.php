<?php

namespace App\Repositories;

use App\Models\Lesson;
use App\Repositories\Traits\RepositoryTrait;

class LessonRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(Lesson $model)
    {
        $this->model = $model;
    }

    public function getLessonsByModuleId(string $moduleId)
    {
        return $this->model
                    ->where('module_id', $moduleId)
                    ->with('supports.replies')
                    ->get();
    }

    public function getLesson(string $id)
    {
        return $this->model->findOrFail($id);
    }

    public function markLessonViewed(string $lessonId)
    {
        $user = $this->getUserAuth();

        $view = $user->views()->where('lesson_id', $lessonId)->first();

        if ($view) {
            return $view->update([
                'qtd' => $view->qtd + 1,
            ]);
        }

        return $user->views()->create([
            'lesson_id' => $lessonId
        ]);
    }
}
