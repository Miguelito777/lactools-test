<?php
declare(strict_types=1);

namespace Src\BundedContext\User\Application;

use Src\BundedContext\User\Domain\User;
use Src\BundedContext\User\Domain\ValueObjects\UserEmail;
use Src\BundedContext\User\Domain\ValueObjects\UserName;
use Src\BundedContext\User\Infrastructure\Repositories\EloquentUserRepository;

class GetUserByCriteriaUseCase
{
    private $repository;

    public function __construct(EloquentUserRepository $repository) {
        $this->repository = $repository;
    }
    public function __invoke(
        string $userName,
        string $userEmail
    ) : ?User
    {
        $name =     new UserName($userName);
        $email =    new UserEmail($userEmail);

        $user = $this->repository->findByCriteria($name, $email);

        return $user; 
    }
}
