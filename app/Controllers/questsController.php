<?php

namespace CONTROLLERS;
use PDO;
use SessionController\SessionController;

class questsController extends \DATABASE\FFDatabaseInternal
{

    public function getAllQuests()
    {
        $db = $this->init();

        if ($db) {
            $v = $db->connection->prepare("SELECT * FROM quests LIMIT 50");
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
                                "user_surname" => $vv3["surname"],
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

    public static function cfun()
    {
        return new questsController();
    }

}