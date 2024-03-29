<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Src\BundedContext\User\Application\GetUserUseCase;
use Src\BundedContext\User\Infrastructure\Repositories\EloquentUserRepository;

class GetUserController extends Controller
{
    /**
     * @var \Src\BoundedContext\User\Infrastructure\GetUserController
     */
    private $getUserController;

    public function __construct(
        \Src\BundedContext\User\Infrastructure\GetUserController $getUserController
    )
    {
        $this->getUserController = $getUserController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = new UserResource($this->getUserController->__invoke($request));

        return response($user, 200);
    }    
}
