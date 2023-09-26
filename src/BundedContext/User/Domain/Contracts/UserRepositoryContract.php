<?php
declare(strict_types=1);

namespace Src\BundedContext\User\Domain\Contracts;

use Src\BundedContext\User\Domain\User;
use Src\BundedContext\User\Domain\ValueObjects\UserEmail;
use Src\BundedContext\User\Domain\ValueObjects\UserId;
use Src\BundedContext\User\Domain\ValueObjects\UserName;

interface UserRepositoryContract
{
    public function find(UserId $id): ?User;
    
    public function save(User $user) : void;

    public function findByCriteria(UserName $userName, UserEmail $userEmail): ?User;

    public function update(UserId $userId, User $user): void;

    public function delete(UserId $id): void;
}
