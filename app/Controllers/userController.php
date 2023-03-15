<?php

namespace CONTROLLERS;
use PDO;
use PhpBase64Image\phpbase64image;
use SessionController\SessionController;

class userController extends \DATABASE\FFDatabaseInternal
{
    public function isLogged()
    {
        return SessionController::CreateInstance()->Get("is_logged") == 1 ? true : false;
    }

    public function checkProfileCompletedStatus()
    {
        if (!$this->isLogged())
        {
            \Router\Router::Route("auth");
            die(":)");
        }

        $sUser = $this->getSessionUser();

        if($sUser[0] && $sUser[1]["profile_completed"] == 0)
        {
            \Router\Router::Route("makeprofile");
            die(":)");
        }
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
                return [false, "Böyle bir kullanıcı bulunmamaktadır."];
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
    public function makeprofile($name,  $gender, $bdate, $job, $pp)
    {
        $sc = SessionController::CreateInstance();

        if ($sc->Get("is_logged") == 0)
            return [false, "lk önce giriş yapmalısın"];

        $sessionUser = userController::cfun()->getSessionUser()[1];

        if (strlen($name) < 3 || strlen($name) > 30)
            return [false, "Adın en az 3, en fazla 30 karater olmalıdır"];

        if ($gender != 0 && $gender != 1)
            return [false, "? :d"];



        if($pp == "-")
        {
            $ures = \DATABASE\FFDatabase::cfun()->update("users", [
                ["name", $name],
                ["gender", $gender],
                ["birth_date", $bdate],
                ["image_uri", $pp],
                ["profile_completed", 1],
            ])->where("id", $sessionUser["id"])->run();

            if($ures->x)
                return [true, "Profilini başarılı bir şekilde oluşturdun!"];
            else
                return [false, "Veritabanı hatası..."];
        }
        else{
            $image_data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $pp));

            if (((strlen($image_data) / 1000) / 1000) > 2)
                return [false, "Lütfen resim boyutunu 2mb veya daha az olarak belirleyin."];

            $image_header = substr($image_data, 0, 3);

            if ($image_header == "\xFF\xD8\xFF" || $image_header == "\x89\x50\x4E" || $image_header == "\x47\x49\x46") {

                $ures = \DATABASE\FFDatabase::cfun()->update("users", [
                    ["name", $name],
                    ["gender", $gender],
                    ["birth_date", $bdate],
                    ["image_uri", $pp],
                    ["profile_completed", 1],
                ])->where("id", $sessionUser["id"])->run();


                return [true, "Profilini başarılı bir şekilde oluşturdun!"];


            } else {
                return [false, "Lütfen geçerli bir resim dosyası gönder"];
            }
        }
    }
    public function getpp($uid)
    {
        $uppres = \DATABASE\FFDatabase::cfun()->select("users")->where("id", $uid)->run()->get();

        if($uppres && $uppres != "no-record" && is_array($uppres)){
            die($uppres["image_uri"]);
        }
        else
            return [false, "Veritabanı hatası..."];
    }

    public function getSessionUser()
    {
        $sc = SessionController::CreateInstance();
        $il = $sc->Get("is_logged");
        $lui = $sc->Get("logged_user_id");

        if ($il)
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