<?php

require __DIR__ . "/../internal_funcs/PluginBaseController.php";

class PluginController
{
    public function run($params)
    {
        //die("ok" . var_dump($params));
    }

    public function quests ( $params ) {
        if (!PBSController::cfun()->requireOnlyPost())
            makeResponse(400, "Bad Request", false, [
                "err" => "you just need a post request",
            ]);

        if (!PBSController::cfun()->checkNullOrBlankInPost(["action"]))
            makeResponse(400, "Bad Request", false, [
                "err" => "please use correct post parameters",
            ]);



        {
            function listQuests() {

                $questsStatus = \CONTROLLERS\questsController::cfun()->getAllQuests();

                if ($questsStatus[0])
                    makeResponse(200, "Success", true, $questsStatus[1]);
                else
                    makeResponse(200, "Bad Request", false, [
                        "err" => $questsStatus[1],
                    ]);
            }
        }





        $action = $_POST["action"];

        switch ($action)
        {
            case "list":
                listQuests();
                return;
                break;
            default:
                makeResponse(400, "Internal Server Error", false, [
                    "err" => "Function is blank",
                ]);
                break;
        }
    }

    public function user($params){
        if (!PBSController::cfun()->requireOnlyPost())
            makeResponse(400, "Bad Request", false, [
                "err" => "you just need a post request",
            ]);

        if (!PBSController::cfun()->checkNullOrBlankInPost(["action"]))
            makeResponse(400, "Bad Request", false, [
                "err" => "please use correct post parameters",
            ]);


        {
            function login() {
                if (!PBSController::cfun()->checkNullOrBlankInPost(["username", "password"]))
                    makeResponse(400, "Bad Request", false, [
                        "err" => "please use correct post parameters",
                    ]);
                if (!isset($_COOKIE["PHPSESSID"]) || $_COOKIE["PHPSESSID"] == "" || !$_COOKIE["PHPSESSID"])
                    makeResponse(400, "Bad Request", false, [
                        "err" => "please use correct post parameters",
                    ]);

                $ucStatus = \CONTROLLERS\userController::cfun()->login($_POST["username"], $_POST["password"]);

                if ($ucStatus[0])
                    makeResponse(200, "Success", true, $ucStatus[1]);
                else
                    makeResponse(200, "Bad Request", false, [
                        "err" => $ucStatus[1],
                    ]);
            }
        }





        $action = $_POST["action"];

        switch ($action)
        {
            case "login":
                login();
                return;
                break;
            default:
                makeResponse(400, "Internal Server Error", false, [
                    "err" => "Function is blank",
                ]);
                break;
        }
    }

    public static function cfun($params)
    {
        $pc = new PluginController();
        $pc->run($params);
        return $pc;
    }
}
