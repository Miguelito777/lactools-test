<?php

namespace Src\BundedContext\User\Application;

use Src\BundedContext\User\Domain\Contracts\UserRepositoryContract;
use Src\BundedContext\User\Domain\User;
use Src\BundedContext\User\Domain\ValueObjects\UserId;

final class GetUserUseCase
{
    private $repository;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $userId): ?User
    {
        $id = new UserId($userId);

        $user = $this->repository->find($id);

        return $user;
    }    
}
