<?php
declare(strict_types=1);

namespace Src\BundedContext\User\Application;

use Src\BundedContext\User\Domain\Contracts\UserRepositoryContract;
use Src\BundedContext\User\Domain\ValueObjects\UserId;

final class DeleteUserUseCase
{
    private $repository;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $userId): void
    {
        $id = new UserId($userId);

        $this->repository->delete($id);
    }
}

