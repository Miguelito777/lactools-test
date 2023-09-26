<?php
declare(strict_types=1);

namespace Src\BundedContext\User\Application;

use Src\BundedContext\User\Domain\Contracts\UserRepositoryContract;
use Src\BundedContext\User\Domain\User;
use Src\BundedContext\User\Domain\ValueObjects\UserEmail;
use Src\BundedContext\User\Domain\ValueObjects\UserName;
use Src\BundedContext\User\Domain\ValueObjects\UserPassword;

final class CreateUserUseCase
{
    private $repository;

    public function __construct(UserRepositoryContract $repository) {
        $this->repository = $repository;
    }

    public function __invoke(
        string $userName,
        string $userEmail,
        string $userPassword
    ) : void
    {
        $name       = new UserName($userName);
        $email      = new UserEmail($userEmail);
        $password      = new UserPassword($userPassword);

        $user = User::create($name, $email, $password);

        $this->repository->save($user);


    }
}
