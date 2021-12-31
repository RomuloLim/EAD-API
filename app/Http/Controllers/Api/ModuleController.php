<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleResource;
use App\Repositories\ModuleRepository;

class ModuleController extends Controller
{
    protected $repository;

    public function __construct(ModuleRepository $repo)
    {
        $this->repository = $repo;
    }

    public function index($id)
    {
        $modules = $this->repository->getModuleByCourseId($id);

        return ModuleResource::collection($modules);
    }
}
