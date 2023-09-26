<?php

namespace Src\BundedContext\User\Infrastructure;

use Src\BundedContext\User\Application\CreateUserUseCase;
use Src\BundedContext\User\Application\GetUserByCriteriaUseCase;

use Illuminate\Http\Request ;
use Illuminate\Support\Facades\Hash;

final class CreateUserController
{
    private $repository;

    public function __construct(
        \Src\BundedContext\User\Infrastructure\Repositories\EloquentUserRepository $repository
    )
    {
        $this->repository = $repository;   
    }
    
    public function __invoke(Request $request)
    {
        $userName       = $request->input('name');
        $userEmail      = $request->input('email');
        $userPassword   = Hash::make($request->input('password'));
        
        $createUserUseCase = new CreateUserUseCase($this->repository);
        $createUserUseCase->__invoke(
            $userName,
            $userEmail,
            $userPassword
        );
        
        $getUserByCriteriaUseCase = new GetUserByCriteriaUseCase($this->repository);

        $newUser                  = $getUserByCriteriaUseCase->__invoke($userName, $userEmail);
        return $newUser;
    }
}
