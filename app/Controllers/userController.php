<?php

namespace CONTROLLERS;
use PDO;
use SessionController\SessionController;

class userController extends \DATABASE\FFDatabaseInternal
{

    public function isLogged()
    {
        return true;
    }

    public function login($username,  $password)
    {
        $ures = \DATABASE\FFDatabase::cfun()->select("users")->where("username", $username)->where("password", $password)->run()->get();

        if ($ures)
        {
            if ($ures != "no-record" && is_array($ures))
            {
                $sc = SessionController::CreateInstance();
                $sc->Set("is_logged", 1);
                $sc->Set("logged_user_id", $ures["id"]);

                return [true, ""];
            }
            else{
                return [false, "invalid-credentials"];
            }
        }
        else{
            return [false, "invalid-error"];
        }
    }

    public static function cfun()
    {
        return new userController();
    }

}