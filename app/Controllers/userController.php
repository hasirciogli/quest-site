<?php

namespace CONTROLLERS;
use PDO;

class userController extends \DATABASE\FFDatabaseInternal
{

    public function login($username, $password)
    {
        return false;
    }

    public static function cfun()
    {
        return new userController();
    }

}