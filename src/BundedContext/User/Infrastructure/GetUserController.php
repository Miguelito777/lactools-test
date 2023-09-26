<?php

namespace Src\BundedContext\User\Infrastructure;

use Illuminate\Http\Request;
use Src\BundedContext\User\Application\GetUserUseCase;
use Src\BundedContext\User\Infrastructure\Repositories\EloquentUserRepository;

class GetUserController
{
    private $repository;

    /**
     * @var Src\BundedContext\User\Infrastructure\Repositories\EloquentUserRepository
     */
    public function __construct(EloquentUserRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $userId         = (int)$request->id;
        $getUserUseCase = new GetUserUseCase($this->repository);
        $user           = $getUserUseCase->__invoke($userId);
        return $user;
    }    
}
