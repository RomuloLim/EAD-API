<?php

namespace Tests\Feature;

use App\Models\User;

trait UtilsTrait
{
    public function createToken()
    {
        $user = User::factory()->create();
        return $user->createToken('test')->plainTextToken;
    }

    public function defaultHeaders()
    {
        $token = $this->createToken();

        return [
            'Authorization' => "Bearer {$token}"
        ];
    }
}
