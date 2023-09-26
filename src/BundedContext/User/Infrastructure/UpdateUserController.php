<?php
declare(strict_types=1);

namespace Src\BundedContext\User\Infrastructure;

use Illuminate\Http\Request;
use Src\BundedContext\User\Application\GetUserUseCase;
use Src\BundedContext\User\Application\UpdateUserUseCase;
use Src\BundedContext\User\Infrastructure\Repositories\EloquentUserRepository;

final class UpdateUserController
{
    private $repository;

    public function __construct(EloquentUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $userId = (int)$request->id;

        $getUserUseCase = new GetUserUseCase($this->repository);
        $user           = $getUserUseCase->__invoke($userId);

        $userName              = $request->input('name') ?? $user->name()->value();
        $userEmail             = $request->input('email') ?? $user->email()->value();
        $userPassword          = $user->password()->value();

        $updateUserUseCase = new UpdateUserUseCase($this->repository);
        $updateUserUseCase->__invoke(
            $userId,
            $userName,
            $userEmail,
            $userPassword
        );

        $updatedUser = $getUserUseCase->__invoke($userId);

        return $updatedUser;
    }    
}
