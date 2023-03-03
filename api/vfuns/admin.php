<?php


require __DIR__ . "/../internal_funcs/PluginBaseController.php";

class PluginController
{
    public function run($params)
    {
        //die("ok" . var_dump($params));
    }

    public function category($params)
    {
        if (!PBSController::cfun()->requireOnlyPost())
            makeResponse(400, "Bad Request", false, [
                "err" => "you just need a post request",
            ]);

        if (!PBSController::cfun()->checkNullOrBlankInPost(["action"]))
            makeResponse(400, "Bad Request", false, [
                "err" => "please use correct post parameters",
            ]);

        {
            function addCategoryInternal()
            {

                if (!PBSController::cfun()->checkNullOrBlankInPost(["name"]))
                    makeResponse(400, "Bad Request", false, [
                        "err" => "please use correct post parameters",
                    ]);

                if (!PBSController::cfun()->checkNullOrBlankInPost(["code"]))
                    makeResponse(400, "Bad Request", false, [
                        "err" => "please use correct post parameters",
                    ]);

                $name = $_POST["name"];
                $code = $_POST["code"];

                $addStatus = \CONTROLLERS\categoryController::cfun()->addCategory($name, $code);

                if ($addStatus[0])
                    makeResponse(200, "Success", true, []);
                else
                    makeResponse(200, "Bad Request", false, [
                        "err" => $addStatus[1],
                    ]);
            }
        }

        {
            function removeCategoryInternal()
            {

                if (!PBSController::cfun()->checkNullOrBlankInPost(["name"]))
                    makeResponse(400, "Bad Request", false, [
                        "err" => "please use correct post parameters",
                    ]);

                if (!PBSController::cfun()->checkNullOrBlankInPost(["code"]))
                    makeResponse(400, "Bad Request", false, [
                        "err" => "please use correct post parameters",
                    ]);

                $name = $_POST["name"];
                $code = $_POST["code"];

                $addStatus = \CONTROLLERS\categoryController::cfun()->addCategory($name, $code);

                if ($addStatus[0])
                    makeResponse(200, "Success", true, []);
                else
                    makeResponse(200, "Bad Request", false, [
                        "err" => $addStatus[1],
                    ]);
            }
        }


        $action = $_POST["action"];

        switch ($action) {
            case "add":
                addCategoryInternal();
                return;
                break;

            case "list":
                addCategoryInternal();
                return;
                break;
            default:
                makeResponse(400, "Internal Server Error", false, [
                    "err" => "Function is blank",
                ]);
                break;
        }


        // TODO: do login here...

        // example: YourInternalUserController()->cfun()->login($_POST["username"], $_POST["password"]);

        makeResponse(200, "Success", false, [
            "info" => "Successfully logged in",
            "userFields" => [
                "username" => $_POST["username"],
                "password" => $_POST["password"],
                "params" => $params
            ]
        ]);

        makeResponse(500, "Internal Server Error", false, [
            "err" => "Function is blank",
        ]);
    }

    public static function cfun($params)
    {
        $pc = new PluginController();
        $pc->run($params);
        return $pc;
    }
}
