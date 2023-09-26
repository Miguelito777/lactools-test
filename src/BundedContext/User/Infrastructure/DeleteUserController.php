<?php
declare(strict_types=1);

namespace Src\BundedContext\User\Infrastructure;

use Src\BundedContext\User\Application\DeleteUserUseCase;
use Illuminate\Http\Request;
use Src\BundedContext\User\Infrastructure\Repositories\EloquentUserRepository;

final class DeleteUserController
{
    private $repository;

    public function __construct(EloquentUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $userId = (int)$request->id;

        $deleteUserUseCase = new DeleteUserUseCase($this->repository);
        $deleteUserUseCase->__invoke($userId);
    }
}
