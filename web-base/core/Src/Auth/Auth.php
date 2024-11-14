<?php

namespace Src\Auth;

use Src\Session;

class Auth
{
    private static IdentityInterface $user;

    public static function init(IdentityInterface $user): void
    {
        self::$user = $user;
        if(self::user())
        {
            self::login(self::user());
        }
    }
    public static function login(IdentityInterface $user): void
    {
        self::$user = $user;
        Session::set('id', self::$user->getId());
    }

    public static function attempt(array $credentails): bool
    {
        if ($user = self::$user->attemptIdentity($credentails))
        {
            self::login($user);
            return true;
        }
        return false;
    }
    public static function user()
    {
        $id = Session::get('id');
        return self::$user->findIdentity($id);
    }

    public static function logout(): bool
    {
        Session::clear('id');
        return true;
    }
}