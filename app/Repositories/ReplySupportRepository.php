<?php

namespace App\Repositories;

use App\Models\Support;
use App\Models\User;

class SupportRepository
{
    protected $model;

    public function __construct(Support $support)
    {
        $this->model = $support;
    }

    public function createNewSupport(array $data): Support
    {
        return $this->getUserAuth()
                    ->supports()
                    ->create([
                        'lesson_id' => $data['lesson'],
                        'status' => $data['status'],
                        'description' => $data['description'],
                    ]);
    }

    public function getSupports(array $filters = [])
    {
        return $this->getUserAuth()
            ->supports()
            ->where(function ($q) use ($filters) {
                if (isset($filters['lesson'])) {
                    $q->where('lesson_id', $filters['lesson']);
                }
                if (isset($filters['status'])) {
                    $q->where('status', $filters['status']);
                }
                if (isset($filters['filter'])) {
                    $filter = $filters['filter'];
                    $q->where('description', 'LIKE', "%{$filter}%");
                }
            })
            ->orderBy('updated_at')
            ->get();
    }

    public function createNewRepplyToSupport(string $supportId, array $data)
    {
        $user = $this->getUserAuth();

        return $this->getSupport($supportId)
            ->replies()
            ->create([
                'description' => $data['description'],
                'user_id' => $user->id,
            ]);
    }

    private function getSupport(string $supportId)
    {
        return $this->model->findOrFail($supportId);
    }

    private function getUserAuth(): User
    {
//        return auth()->user();
        return User::first();
    }
}
