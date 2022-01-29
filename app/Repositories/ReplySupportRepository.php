<?php

namespace App\Repositories;

use App\Models\ReplySupport;
use App\Repositories\Traits\RepositoryTrait;

class ReplySupportRepository
{
    protected $model;

    use RepositoryTrait;

    public function __construct(ReplySupport $support)
    {
        $this->model = $support;
    }

    public function createNewReplyToSupport(array $data)
    {
        $user = $this->getUserAuth();

        return $this->model
            ->create([
                'support_id' => $data['support_id'],
                'description' => $data['description'],
                'user_id' => $user->id,
            ]);
    }
}
