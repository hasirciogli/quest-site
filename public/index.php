<?php

if (true)
    error_reporting(E_ALL);
else
    error_reporting(~E_ALL);


error_reporting(E_ALL);

//die(var_dump($_SERVER));
//die (phpinfo());
$cfg_way = "./../app/Configs/Config.php";

if (!file_exists($cfg_way))
    Router::Route("setup/index.php");


require $_SERVER["DOCUMENT_ROOT"] . "/app/Kernel.php";

use Router\Router;
use View\View;
use View\pageTypes;
use UserController\UserController;
use SessionController\SessionController;

//$RouteSideUserController = new \USER_CONTROLLER\userController();


if (framework_is_debug_mode) {
    Router::get("/debug_display_errors", function () {
        View::Show("display_error", pageTypes::PAGE_TYPE_DERROR);
        die();
    });
}
Router::get("/xmlmap", function () {
    //Router::Route("login");
    View::Show("./../aSeo/sitemap1", pageTypes::PAGE_TYPE_NORMAL);
});

Router::get("/Ads.txt", function () {
    //Router::Route("login");
    View::Show("./../aSeo/adstxt", pageTypes::PAGE_TYPE_NORMAL);
});

Router::get("/", function () {
    //Router::Route("login");
    View::Show("home", pageTypes::PAGE_TYPE_NORMAL);
});

Router::get("/test", function () {
    //Router::Route("login");
    View::Show("test", pageTypes::PAGE_TYPE_NORMAL);
});

Router::get("/remote_owner_page", function () {
    //Router::Route("login");
    View::Show("owner/home", pageTypes::PAGE_TYPE_NORMAL);
});

Router::get("/login", function () {
    View::Show("login", pageTypes::PAGE_TYPE_NORMAL);
});

Router::get("/policy", function () {
    View::Show("../datapages/policy", pageTypes::PAGE_TYPE_NORMAL);
});

Router::Middleware("quest", true, function () {
    View::Show("quest", pageTypes::PAGE_TYPE_NORMAL);
}, function () {

});




Router::get("/makeprofile", function () {
    View::Show("user/makeprofile", pageTypes::PAGE_TYPE_NORMAL);
});

Router::Middleware("profile", \CONTROLLERS\userController::cfun()->isLogged(), function () {
    View::Show("user/profile", pageTypes::PAGE_TYPE_NORMAL);
}, function () {
    Router::Route("auth/login");
});






Router::Middleware("auth", !\CONTROLLERS\userController::cfun()->isLogged(), function () {
    View::Show("user/auth", pageTypes::PAGE_TYPE_NORMAL);
}, function () {
    Router::Route("profile");
});





Router::Middleware("storage", true, function () {
    require configs_site_rootfolder . "/storage/storagemanager.php";
}, function () {

});


Router::middleware("logout", \CONTROLLERS\userController::cfun()->isLogged(),
    function () {
        $LGTSC = new SessionController();
        $LGTSC->ResetSessionData();
        $LGTSC = null;
        Router::Route("");
    }, function () {
        Router::Route("");
    }
);

if (false) {
    Router::get("/register", function () {
        Router::Route("login");
        return;
        View::Show("register", pageTypes::PAGE_TYPE_NORMAL);
    });

    Router::get("/disclamier", function () {
        View::Show("disclamier", pageTypes::PAGE_TYPE_NORMAL);
    });

    Router::get("/pay", function () {
        View::Show("payment/pay", pageTypes::PAGE_TYPE_NORMAL);
    });

    Router::get("/success", function () {
        View::Show("payment/success", pageTypes::PAGE_TYPE_NORMAL);
    });

    Router::get("/unsuccess", function () {
        View::Show("payment/unsuccess", pageTypes::PAGE_TYPE_NORMAL);
    });

    Router::get("/policy", function () {
        View::Show("../datapages/policy", pageTypes::PAGE_TYPE_NORMAL);
    });

    Router::get("/test", function () {
        View::Show("test", pageTypes::PAGE_TYPE_NORMAL);
    });

    Router::get("/fatura", function () {
        View::Show("user/funcs/dfatura", pageTypes::PAGE_TYPE_NORMAL);
    });

    Router::get("/response_bank", function () {
        View::Show("response", pageTypes::PAGE_TYPE_NORMAL);
    });


    Router::middleware("dashboard", \AuthController\AuthController::isLogged(),
        function () {
            View::Show("user/dashboard", pageTypes::PAGE_TYPE_NORMAL);
        }, function () {
            Router::Route("login");
        }
    );

    Router::middleware("admin", \AuthController\AuthController::isAdmin(),
        function () {
            chkmntc();
            View::Show("admin/dashboard", pageTypes::PAGE_TYPE_NORMAL);
        }, function () {
            Router::Route("dashboard");
        }
    );

    Router::middleware("logout", \AuthController\AuthController::isLogged(),
        function () {
            $LGTSC = new SessionController();
            $LGTSC->ResetSessionData();
            $LGTSC = null;
            Router::Route("login");
        }, function () {
            Router::Route("login");
        }
    );
}


if (!Router::$isLoaded) {
    View::Show("404", pageTypes::PAGE_TYPE_ERROR);
}