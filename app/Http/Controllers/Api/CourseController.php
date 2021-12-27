<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Repositories\CourseRepository;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $repository;

    public function __construct(CourseRepository $repo)
    {
        $this->repository = $repo;
    }

    public function index()
    {
        return CourseResource::collection($this->repository->getAllCourses());
    }

    public function find($id)
    {
        return new CourseResource($this->repository->getCourse($id));
    }
}
