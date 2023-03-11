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

                return [true, "Giriş Başarılı, Yönlendiriliyorsunuz..."];
            }
            else{
                return [false, "Belirsiz Hata #458"];
            }
        }
        else{
            return [false, "Belirsiz Hata #766"];
        }
    }
    public function register($username,  $password, $repassword)
    {
        if (strlen($username) < 3 || strlen($username) > 10)
            return [false, "Kullanıcı adı en az 5, en fazla 10 karater olmalıdır"];

        if (strlen($password) < 8 || strlen($password) > 16)
            return [false, "Şifre adı en az 8, en fazla 16 karater olmalıdır"];

        if ($password != $repassword)
        {
            if (strlen($repassword) < 8)
                return [false, "Şifreler uyuşmuyor :)"];
            else
                return [false, "Şifreler uyuşmuyor"];
        }



        $ures = \DATABASE\FFDatabase::cfun()->select("users")->where("username", $username)->run()->get();

        if ($ures)
        {
            if ($ures != "no-record" && is_array($ures))
            {
                return [false, "Kullanıcı Zaten Kayıtlı"];
            }
            else{
                if ($ures == "no-record")
                {
                    $registerResult = \DATABASE\FFDatabase::cfun()->insert("users", [["username", $username], ["password", $password]])->run();
                    if ($registerResult->x)
                    {
                        return [true, "Kayıt başarılı, Lütfen giriş yapın"];
                    }
                    else{
                        return [false, "Belirsiz Hata $584"];
                    }
                }
                else
                    return [false, "Belirsiz Hata #88"];
            }
        }
        else{
            return [false, "Belirsiz Hata #99"];
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