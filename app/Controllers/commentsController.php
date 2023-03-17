<?php

namespace CONTROLLERS;
use DATABASE\FFDatabaseInternal;
use PDO;
use SessionController\SessionController;

class commentsController extends FFDatabaseInternal
{

    public function getAllComments($target)
    {
        $db = $this->init();
        $isLoggedUserId = null;
        if(userController::cfun()->isLogged())
            $isLoggedUserId = SessionController::CreateInstance()->Get("logged_user_id");

        if ($db) {
            $v = $db->connection->prepare("SELECT * FROM comments WHERE writed_to='" . $target . "' ORDER BY created_at DESC");
            $v2 = $v->execute([]);
            $v3 = $v->fetchAll(PDO::FETCH_ASSOC);

            if ($v2 && $v->rowCount() > 0) {
                foreach ($v3 as $item) {

                    $xid = $item["id"];
                    $uid = $item["writed_by"];
                    $smode = $item["secret_mode"] == 1 ? true : false;

                    $vv = $db->connection->prepare("SELECT * FROM users WHERE id='" . $uid . "'");
                    $vv2 = $vv->execute([]);
                    $vv3 = $vv->fetch(PDO::FETCH_ASSOC);

                    if ($vv->rowCount() > 0) {
                        if (false)
                            continue;

                        if ($smode) {
                            $habersX[] = [
                                "comment_id" => $xid,
                                "secret_mode" => $smode,
                                "content" => $item["content"],
                                "created_at" => $item["created_at"],
                                "user_gender" => $vv3["gender"],
                                "user_status" => $vv3["status"],
                                "is_local_owned" => ($isLoggedUserId != null && $isLoggedUserId == $uid) ? true : false,
                            ];
                        } else {
                            $habersX[] = [
                                "comment_id" => $xid,
                                "secret_mode" => $smode,
                                "writed_by" => $uid,
                                "content" => $item["content"],
                                "created_at" => $item["created_at"],
                                "user_id" => $vv3["id"],
                                "user_name" => $vv3["name"],
                                "user_username" => $vv3["username"],
                                "user_gender" => $vv3["gender"],
                                "user_status" => $vv3["status"],
                                "user_image" => $vv3["image_uri"],
                                "is_local_owned" => ($isLoggedUserId != null && $isLoggedUserId == $uid) ? true : false,
                            ];
                        }

                    }

                }
                return [true, $habersX ?? "no-comments-found"];
            } else {
                return [false, "no-comments-found"];
            }

        } else
            return [false, "Belirlenemeyen Hata"];
    }

    public function imILiked($qid){
        $sc = SessionController::CreateInstance();

        if ($sc->Get("is_logged") == 1)
        {
            $questL = \DATABASE\FFDatabase::cfun()->select("likes")->where("liked_by", $sc->Get("logged_user_id"))->where("liked_to", $qid)->run()->getAll();

            if ($questL != "no-record" && $questL && count($questL) > 0)
            {
                return true;
            }
            else{
                return false;
            }
        }
        return false;
    }

    public function getLikeCountByQuest($qid){
        $questL = \DATABASE\FFDatabase::cfun()->select("likes")->where("liked_to", $qid)->run()->getAll();

        if ($questL && $questL != "no-record")
            return [true, count($questL)];
        else{
            if ($questL && $questL == "no-record")
                return [true, 0];
            else
                return [false, "database-error"];
        }
    }

    public function addNewComment($target, $content, $secretMode){
        $sc = SessionController::CreateInstance();

        if ($sc->Get("is_logged") == 1)
        {
            $suid = $sc->Get("logged_user_id");
            $questU = \DATABASE\FFDatabase::cfun()->select("users")->where("id", $suid)->run()->get();

            if ($questU != "no-record" && $questU)
            {
                $quest = \DATABASE\FFDatabase::cfun()->select("comments")->where("writed_to", $target)->run()->get();
                if ($quest)
                {
                    if (\DATABASE\FFDatabase::cfun()->insert("comments", [
                        ["content", $content],
                        ["writed_by", $questU["id"]],
                        ["secret_mode", $secretMode],
                        ["writed_to", $target],
                    ])->run()->x)
                    {
                        return [true, "Yorum yaptın, Yaşasın! 😆"];
                    }
                    else
                        return [false, "Like Eklenemedi, zaten beğenmişsin."];
                }
                else if ($quest == "no-record")
                    return [false, "Bulunmayan bir soru hakkında yorum yapamazsın."];
                else if (!is_array($quest) || !$quest)
                    return [false, "Sebebi bilinmeye hata, Daha sonra tekrar deneyiniz. #498461"];
                else
                    return [false, "Sebebi bilinmeye hata, Daha sonra tekrar deneyiniz. #5616516894"];
            }
            else{
                return [false, "veritabanı hatası 2"];
            }
        }
        return [false, "Giriş yapman gerek"];
    }
    public function removeComment($cid){
        $sc = SessionController::CreateInstance();

        if ($sc->Get("is_logged") == 1)
        {
            $suid = $sc->Get("logged_user_id");
            $commentU = \DATABASE\FFDatabase::cfun()->select("users")->where("id", $suid)->run()->get();

            if ($commentU != "no-record" && $commentU)
            {
                if ($commentU["status"] == 0)
                    return [false, "Yasaklanmış kullancılar, Kısıtlanır ve bazı özellikleri kullanamazlar."];

                $commentCheck = \DATABASE\FFDatabase::cfun()->select("comments")->where("id", $cid)->run()->get();

                if ($commentCheck != "no-record" && $commentCheck && is_array($commentCheck))
                {
                    if ($commentU["id"] != $commentCheck["writed_by"])
                        return [false, "Sahibi olmadığın yorumu silemezsin!"];

                    $ffdiv1 = FFDatabaseInternal::cfun()->init();
                    $ffdiv2 = $ffdiv1->connection->prepare("DELETE FROM comments WHERE id=?");
                    $ffdiv3 = $ffdiv2->execute([$commentCheck["id"]]);

                    if ($ffdiv3)
                    {
                        return [true, "Yorum başarıyla silindi."];
                    }
                    else
                        return [false, "Yorum silinemedi hata var #847851"];

                }
                else{
                    return [false, "Geçersiz hata #4981218946"];
                }

            }
            else{
                return [false, "database-error #1894917--*"];
            }
        }
        return [false, "Giriş yapmalısın"];
    }

    public function unLikeQuestBySession($target_quest){
        $sc = SessionController::CreateInstance();

        if ($sc->Get("is_logged") == 1)
        {
            $suid = $sc->Get("logged_user_id");
            $questU = \DATABASE\FFDatabase::cfun()->select("users")->where("id", $suid)->run()->get();

            if ($questU != "no-record" && $questU)
            {
                $questL = \DATABASE\FFDatabase::cfun()->select("likes")->where("liked_by", $suid)->where("liked_to", $target_quest)->run()->get();

                if ($questL && $questL != "no-record")
                {

                    $conn = FFDatabaseInternal::init();
                    $v = $conn->connection->prepare("DELETE FROM likes WHERE id='{$questL["id"]}'");
                    $v2 = $v->execute([]);
                    $v3 = $v->fetch(PDO::FETCH_ASSOC);

                    if ($v2)
                    {
                        return [true, $this->getLikeCountByQuest($target_quest)];
                    }
                    else
                        return [false, "Like Silinemedi, Veritabanı hatası."];
                }
                else{
                    if ($questL && $questL == "no-record")
                        return [false, "Beğenmemişsin ki"];
                    else
                        return [false, "veritabanı hatası 111"];
                }
            }
            else{
                return [false, "veritabanı hatası 1"];
            }
        }
        return [false, "need-login"];
    }
    public function addNewWuestionBySession($header = "", $category = "", $content = "", $secretmode = 0, $imageurl = ""){
        $sc = SessionController::CreateInstance();

        if ($sc->Get("is_logged") == 1)
        {
            $suid = $sc->Get("logged_user_id");
            $questU = \DATABASE\FFDatabase::cfun()->select("users")->where("id", $suid)->run()->get();

            if ($questU != "no-record" && $questU)
            {
                if ($questU["status"] == 0)
                    return [false, "user-banned"];

                if ($header == "-")
                    $header = "";

                if ($category == "-")
                    $category = "";

                if ($content == "-")
                    $content = "";

                if ($imageurl == "-")
                    $imageurl = "";

                $addNewQuestStatus = \DATABASE\FFDatabase::cfun()->insert("quests", [["owner_id", $questU["id"]], ["category", $category], ["header", $header], ["content", $content], ["secret_mode", $secretmode], ["image_url", $imageurl]])->run();

                if ($addNewQuestStatus->x)
                {
                    return [true, "added-successfully"];
                }
                else
                    return [false, "no-error"];

            }
            else{
                return [false, "database-error #1"];
            }
        }
        return [false, "need-login"];
    }

    public static function cfun()
    {
        return new commentsController();
    }

}