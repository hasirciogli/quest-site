<?php

//session_start();


require $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";

require $_SERVER["DOCUMENT_ROOT"] . "/app/Configs/Config.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Database/Database.php";

require $_SERVER["DOCUMENT_ROOT"] . "/app/FFunctions/SessionsFromMysql.php";

require $_SERVER["DOCUMENT_ROOT"] . "/app/FFunctions/ErrorHandler.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/FFunctions/FCrypter.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/FFunctions/FrameworkFunctions.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/FFunctions/DataLogger.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/FFunctions/phpbase64image.php";


require $_SERVER["DOCUMENT_ROOT"] . "/app/Models/SessionModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Models/AuthModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Models/RestApiModel.php";


require $_SERVER["DOCUMENT_ROOT"] . "/app/Controllers/SessionController.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Controllers/OwnerController.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Controllers/userController.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Controllers/questsController.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Controllers/categoryController.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Controllers/commentsController.php";


require $_SERVER["DOCUMENT_ROOT"] . "/app/Route/Router.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Route/ApiRouter.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/View/View.php";


$sessionEx = new SessionsFromMysql();