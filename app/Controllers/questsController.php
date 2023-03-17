<?php

namespace CONTROLLERS;
use DATABASE\FFDatabase;
use DATABASE\FFDatabaseInternal;
use PDO;
use SessionController\SessionController;

class questsController extends \DATABASE\FFDatabaseInternal
{

    public function getAllQuests()
    {
        $db = $this->init();

        if ($db) {
            $v = $db->connection->prepare("SELECT * FROM quests ORDER BY created_at DESC LIMIT 50 ");
            $v2 = $v->execute([]);
            $v3 = $v->fetchAll(PDO::FETCH_ASSOC);

            if ($v2 && $v->rowCount() > 0) {
                foreach ($v3 as $item) {

                    $xid = $item["id"];
                    $uid = $item["owner_id"];
                    $smode = $item["secret_mode"] ? true : false;

                    $vv = $db->connection->prepare("SELECT * FROM users WHERE id='" . $uid . "'");
                    $vv2 = $vv->execute([]);
                    $vv3 = $vv->fetch(PDO::FETCH_ASSOC);

                    if ($vv->rowCount() > 0) {
                        if (false)
                            continue;

                        if ($smode) {
                            $habersX[] = [
                                "quest_id" => $xid,
                                "secret_mode" => $smode,
                                "image_url" => $item["image_url"],
                                "category" => $item["category"],
                                "header" => $item["header"],
                                "content" => $item["content"],
                                "created_at" => $item["created_at"],
                                "user_gender" => $vv3["gender"],
                                "user_status" => $vv3["status"],
                            ];
                        } else {
                            $habersX[] = [
                                "quest_id" => $xid,
                                "secret_mode" => $smode,
                                "owner_id" => $uid,
                                "image_url" => $item["image_url"],
                                "category" => $item["category"],
                                "header" => $item["header"],
                                "content" => $item["content"],
                                "created_at" => $item["created_at"],
                                "user_id" => $vv3["id"],
                                "user_name" => $vv3["name"],
                                "user_gender" => $vv3["gender"],
                                "user_status" => $vv3["status"],
                            ];
                        }

                    }

                }
                return [true, $habersX ?? "no-record"];
            } else {
                return [false, "Soru yok!"];
            }

        } else
            return [false, "null hata"];
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
    public function likeQuestBySession($target_quest){
        $sc = SessionController::CreateInstance();

        if ($sc->Get("is_logged") == 1)
        {
            $suid = $sc->Get("logged_user_id");
            $questU = \DATABASE\FFDatabase::cfun()->select("users")->where("id", $suid)->run()->get();

            if ($questU != "no-record" && $questU)
            {
                $questL = \DATABASE\FFDatabase::cfun()->select("likes")->where("liked_by", $suid)->where("liked_to", $target_quest)->run()->get();

                if ($questL && $questL == "no-record")
                {
                    $questsLikeAdd = \DATABASE\FFDatabase::cfun()->insert("likes", [["liked_to", $target_quest], ["liked_by", $suid]])->run();

                    if ($questsLikeAdd->x)
                    {
                        return [true, $this->getLikeCountByQuest($target_quest)];
                    }
                    else
                        return [false, "Like Eklenemedi, zaten beğenmişsin."];
                }
                else{
                    if ($questL && $questL != "no-record")
                        return [false, "Zaten beğenmişsin." ];
                    else
                        return [false, "veritabanı hatası 1"];
                }
            }
            else{
                return [false, "veritabanı hatası 2"];
            }
        }
        return [false, "Giriş yapman gerek"];
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
    public function addNewQuestionBySession($header = "", $category = "", $content = "", $secretmode = 0, $imageurl = ""){
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
    public function removeQuestionBySession($qid){
        $sc = SessionController::CreateInstance();

        if ($sc->Get("is_logged") == 1)
        {
            $suid = $sc->Get("logged_user_id");
            $questU = \DATABASE\FFDatabase::cfun()->select("users")->where("id", $suid)->run()->get();

            if ($questU != "no-record" && $questU)
            {
                if ($questU["status"] == 0)
                    return [false, "Yasaklanmış kullancılar, Kısıtlanır ve bazı özellikleri kullanamazlar."];

                $questCheck = \DATABASE\FFDatabase::cfun()->select("quests")->where("id", $qid)->run()->get();

                if ($questCheck != "no-record" && $questCheck && is_array($questCheck))
                {
                    if ($questU["id"] != $questCheck["owner_id"])
                        return [false, "Sahibi olmadığın soruyu silemezsin!"];

                    $ffdiv1 = FFDatabaseInternal::cfun()->init();
                    $ffdiv2 = $ffdiv1->connection->prepare("DELETE FROM quests WHERE id=?");
                    $ffdiv3 = $ffdiv2->execute([$qid]);


                    if ($ffdiv3)
                    {
                        return [true, "Soru başarayıyla silindi."];
                    }
                    else
                        return [false, "Soru silinemedi hata var #847851"];

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
    public function editQuestionBySession($qid, $header, $content, $category, $image_uri){
        $sc = SessionController::CreateInstance();

        if ($sc->Get("is_logged") == 1)
        {
            $suid = $sc->Get("logged_user_id");
            $questU = \DATABASE\FFDatabase::cfun()->select("users")->where("id", $suid)->run()->get();

            if ($questU != "no-record" && $questU)
            {
                if ($questU["status"] == 0)
                    return [false, "Yasaklanmış kullancılar, Kısıtlanır ve bazı özellikleri kullanamazlar."];

                $questCheck = \DATABASE\FFDatabase::cfun()->select("quests")->where("id", $qid)->run()->get();

                if ($questCheck != "no-record" && $questCheck && is_array($questCheck))
                {
                    if ($questU["id"] != $questCheck["owner_id"])
                        return [false, "Sahibi olmadığın soruyu düzenleyemezsin!"];

                    $updateStatus = FFDatabase::cfun()->update("quests", [
                            ["header", $header],
                            ["content", $content],
                            ["category", $category],
                            ["image_uri", $image_uri],
                        ])->where("id", $qid)->run();


                    if ($updateStatus->x)
                    {
                        return [true, "Soru başarayıyla Güncellendi."];
                    }
                    else
                        return [false, "Soru silinemedi hata var #5945486"];

                }
                else{
                    return [false, "Geçersiz hata #48716518"];
                }

            }
            else{
                return [false, "database-error #5598741894--*"];
            }
        }
        return [false, "Giriş yapmalısın"];
    }

    public static function cfun()
    {
        return new questsController();
    }

}