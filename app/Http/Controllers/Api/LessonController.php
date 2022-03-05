<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreView;
use App\Http\Resources\LessonResource;
use App\Repositories\LessonRepository;

class LessonController extends Controller
{
    protected $repository;

    public function __construct(LessonRepository $repo)
    {
        $this->repository = $repo;
    }

    public function index($moduleId)
    {
        return LessonResource::collection($this->repository->getLessonsByModuleId($moduleId));
    }

    public function show($id)
    {
        return new LessonResource($this->repository->getLesson($id));
    }

    public function viewed(StoreView $request)
    {
        $this->repository->markLessonViewed($request->lesson);

        return response()->json(['success' => true]);
    }
}
