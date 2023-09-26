<?php
declare(strict_types=1);
namespace Src\BundedContext\User\Domain;

use Src\BundedContext\User\Domain\ValueObjects\UserEmail;
use Src\BundedContext\User\Domain\ValueObjects\UserName;
use Src\BundedContext\User\Domain\ValueObjects\UserPassword;

final class User
{
    private $name;
    private $email;
    private $password;

    public function __construct(
        UserName $name,
        UserEmail $email,
        UserPassword $password,
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
    public function name() : UserName
    {
        return $this->name;
    }
    public function email() : UserEmail
    {
        return $this->email;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }

    public static function create(
        UserName    $name,
        UserEmail   $email,
        UserPassword $password
    ):User
    {
        $user = new self($name, $email, $password);
        
        return $user;
    }


}
