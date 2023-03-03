<?php

namespace CONTROLLERS;
use PDO;
use SessionController\SessionController;

class userController extends \DATABASE\FFDatabaseInternal
{
    public function isLogged()
    {
        return SessionController::CreateInstance()->Get("is_logged") == 1 ? true : false;
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

    public function getSessionUser()
    {
        $sc = SessionController::CreateInstance();
        $il = $sc->Get("is_logged");
        $lui = $sc->Get("logged_user_id");

        if ($il && $lui)
        {
            $ures = \DATABASE\FFDatabase::cfun()->select("users")->where("id", $lui)->run()->get();
            if ($ures)
            {
                if ($ures != "no-record" && is_array($ures))
                {
                    return [true, $ures];
                }
                else{
                    return [false, "invalid-credentials"];
                }
            }
            else{
                return [false, "invalid-error"];
            }
        }
        else{
            return [false, "invalid-session-data-or-not-initialized-idk-of-the-error-.d"];
        }
    }

    public static function cfun()
    {
        return new userController();
    }

}