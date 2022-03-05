<?php

namespace Tests\Feature;

use App\Models\Course;
use Symfony\Component\HttpFoundation\Response as Status;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use UtilsTrait;

    public function test_unauthenticated()
    {
        $response = $this->getJson('/courses');

        $response->assertStatus(Status::HTTP_UNAUTHORIZED);
    }

    public function test_get_all_courses()
    {
        $response = $this->getJson('/courses', $this->defaultHeaders());

        $response->assertStatus(Status::HTTP_OK);
    }

    public function test_get_all_courses_total()
    {
        Course::factory(10)->create();

        $response = $this->getJson('/courses', $this->defaultHeaders());

        $response->assertStatus(Status::HTTP_OK)
                        ->assertJsonCount(10, 'data');
    }

    public function test_get_single_course_unauthenticated()
    {
        $response = $this->getJson('/course/fake_id');

        $response->assertStatus(Status::HTTP_UNAUTHORIZED);
    }

    public function test_find_course_not_found()
    {
        $response = $this->getJson('/course/fake-id', $this->defaultHeaders());

        $response->assertStatus(Status::HTTP_NOT_FOUND);
    }

    public function test_find_course_success()
    {
        $course = Course::factory(10)->create();

        $response = $this->getJson("/course/{$course->random()->id}", $this->defaultHeaders());

        $response->assertStatus(Status::HTTP_OK);
    }
}
