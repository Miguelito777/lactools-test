<?php
declare(strict_types=1);

namespace Src\BundedContext\User\Infrastructure\Repositories;


use App\Models\User as EloquentUserModel;
use Src\BundedContext\User\Domain\Contracts\UserRepositoryContract;
use Src\BundedContext\User\Domain\User;
use Src\BundedContext\User\Domain\ValueObjects\UserEmail;
use Src\BundedContext\User\Domain\ValueObjects\UserId;
use Src\BundedContext\User\Domain\ValueObjects\UserName;
use Src\BundedContext\User\Domain\ValueObjects\UserPassword;

final class EloquentUserRepository implements UserRepositoryContract
{
    private $eloquentUserModel;

    public function __construct() {
        $this->eloquentUserModel = new EloquentUserModel();
    }
    
    public function find(UserId $id): ?User
    {
        $user = $this->eloquentUserModel->findOrFail($id->value());
        // Return Domain User model
        return new User(
            new UserName($user->name),
            new UserEmail($user->email),
            new UserPassword($user->password),
        );
    }

    public function save (User $user) : void
    {
        $newUser = $this->eloquentUserModel;

        $data = [
            'name'      => $user->name()->value(),
            'email'     => $user->email()->value(),
            'password'  => $user->password()->value(),
        ];
        $newUser->create($data);
    }

    public function findByCriteria (UserName $name, UserEmail $email) : ?User
    {
        $user = $this->eloquentUserModel
                ->where('name', $name->value())
                ->where('email', $email->value())
                ->firstOrFail();
        
        return new User(
            new UserName($user->name),
            new UserEmail($user->email),
            new UserPassword($user->password),
        );
    }

    public function update(UserId $id, User $user): void
    {
        $userToUpdate = $this->eloquentUserModel;

        $data = [
            'name'  => $user->name()->value(),
            'email' => $user->email()->value(),
        ];

        $userToUpdate
            ->findOrFail($id->value())
            ->update($data);
    }

    public function delete(UserId $id): void
    {
        $this->eloquentUserModel
            ->findOrFail($id->value())
            ->delete();
    }
}
