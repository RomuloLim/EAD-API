<?php

namespace Tests\Feature\Auth;

use Symfony\Component\HttpFoundation\Response as Status;

use App\Models\User;
use Tests\Feature\UtilsTrait;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use UtilsTrait;

    public function test_fail_auth()
    {
        $response = $this->postJson('/auth');

        $response->assertStatus(Status::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_auth()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/auth', [
            'email' => $user->email,
            'password' => 'password',
            'device_name' => 'test'
        ]);

        $response->assertStatus(Status::HTTP_OK);
    }

    public function test_fail_logout()
    {
        $response = $this->postJson('/logout');

        $response->assertStatus(Status::HTTP_UNAUTHORIZED);
    }

    public function test_logout()
    {
        $response = $this->postJson('/logout', [], $this->defaultHeaders());

        $response->assertStatus(Status::HTTP_OK);
    }

    public function test_fail_get_me()
    {
        $response = $this->getJson('/me');

        $response->assertStatus(Status::HTTP_UNAUTHORIZED);
    }

    public function test_get_me()
    {
        $response = $this->getJson('/me', $this->defaultHeaders());

        $response->assertStatus(Status::HTTP_OK);
    }
}
