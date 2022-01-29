<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReplySupport;
use App\Http\Resources\ReplySupportResource;
use App\Repositories\ReplySupportRepository;

class ReplySupportController extends Controller
{

    protected $repository;

    public function __construct(ReplySupportRepository $repo)
    {
        $this->repository = $repo;
    }

    public function store(StoreReplySupport $request)
    {
        $reply = $this->repository->createNewReplyToSupport($request->validated());

        return new ReplySupportResource($reply);
    }
}
