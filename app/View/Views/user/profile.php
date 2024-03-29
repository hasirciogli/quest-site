<?php


if (!\CONTROLLERS\userController::cfun()->isLogged())
    \Router\Router::Route("auth");

$userControllerResponse = \CONTROLLERS\userController::cfun()->getSessionUser();

\CONTROLLERS\userController::cfun()->checkProfileCompletedStatus();

$sessionUser = $userControllerResponse[1];

?>

<!doctype html>
<html lang="en" class="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php echo configs_site_libs; ?>
    <?php echo configs_adsense_cfg; ?>

    <title>Profile of <?php echo $sessionUser["name"]?></title>
    <script src="/storage/js/public-requirements.js"></script>
</head>

<body class="m-0 p-0 dark:bg-dc-50">


    <?php

    require __DIR__ . "/../../datapages/header.php";

    ?>


    <div class="flex flex-col md:flex-row md:flex-row container mx-auto md:rounded overflow-hidden md:mt-5 md:border dark:border-dhover-300 border-gray-200 shadow-md shadow-gray-200 dark:shadow-dhover-400 duration-700">
        <div class="flex flex-col md:w-5/12 lg:w-4/12 xl:w-3/12 md:h-[600px] md:border-r md:border-r-gray-300 dark:border-dhover-300 duration-700">
            <div class="flex flex-row w-full h-[135px] items-center justify-start p-5 border-b border-b-gray-200 dark:border-dhover-300 duration-700">
                <img src="" id="profile-lt-image-ls" onload="this.onload=null; this.src=getLoaderGifLink()" onerror="this.error = null; this.src='<?php echo $sessionUser["gender"] == 1 ? "/storage/image/site-images/user-man.png" : "/storage/image/site-images/user-woman.png"; ?>'" class="w-16 h-16 md:w-20 md:h-20 duration-700 rounded-full overflow-hidden" alt="">
                <div class="flex flex-col ml-2 dark:text-white">
                    <?php

                    $____dogumTarihi____ = isset($sessionUser["birth_date"]) && $sessionUser["birth_date"] != "" ? $sessionUser["birth_date"] : date("Y-m-d");
                    //$____bugun____ = date("Y-m-d H:i:s");
                    $____bugun____ = date("Y-m-d");
                    $____diff____ = date_diff(date_create($____dogumTarihi____), date_create($____bugun____));
                    //$____bAe____  = $____diff____->format('%y.%m.%d : %H:%i:%s');
                    $____bAe____  = $____diff____->format('%y.%m.%d');

                    ?>
                    <span class="text-sm md:text-md font-semibold"><?php echo $sessionUser["name"]; ?></span>
                    <span class="text-xs md:text-sm font-semibold" title="Kişini yaşı sırasıya YIL AY GÜN olarak belirtilmiştir">Level: <?php echo (int)number_format($sessionUser["level"], 0, ".", ","); ?>, Yaş: <?php echo isset($sessionUser["birth_date"]) && $sessionUser["birth_date"] != "" ? $____bAe____ : "Belirtilmemiş"; ?></span>
                </div>

                <script>
                    $.ajax({
                        url: getHost("/api/backend/ppmanager?action=getpp&uid=<?php echo $sessionUser["id"]; ?>"),
                        success: (data) => {
                            setTimeout(() => {
                                $("#profile-lt-image-ls").attr("src", data);
                            }, 800);
                        }
                    })
                </script>
            </div>

            <div class="hidden md:flex h-full flex-col justify-between">
                <div class="">
                    <nav aria-label="Main Nav" class="flex flex-col space-y-1">

                        <a href="#" class="flex items-center gap-2 px-4 py-2 text-gray-700 dark:text-gray-200 dark:hover:text-white hover:bg-gray-200 dark:hover:bg-dh-100 hover:text-gray-700">
                            <img src="/storage/image/site-images/gear.png" class="h-5 w-5 opacity-75" alt="">

                            <span class="text-sm font-medium"> Genel ayarlar </span>
                        </a>

                        <a href="#" class="flex items-center gap-2 px-4 py-2 text-gray-700 dark:text-gray-200 dark:hover:text-white hover:bg-gray-200 dark:hover:bg-dh-100 hover:text-gray-700">
                            <img src="/storage/image/site-images/security.png" class="h-5 w-5 opacity-100" alt="">

                            <span class="text-sm font-medium"> Güvenlik ayarları </span>
                        </a>

                        <a href="/logout" class="flex items-center gap-2 px-4 py-2 text-gray-700 dark:text-gray-200 dark:hover:text-white hover:bg-gray-200 dark:hover:bg-dh-100 hover:text-gray-700">
                            <img src="/storage/image/site-images/logout.png" class="h-5 w-5 opacity-100" alt="">

                            <span class="text-sm font-medium"> Çıkış yap </span>
                        </a>
                    </nav>
                </div>

                <!--<div class="sticky inset-x-0 bottom-0 border-t border-gray-100">
                    <div class="flex items-center gap-2 bg-white p-4 hover:bg-gray-50">
                        <img alt="Man" src="/storage/image/site-images/user-man.png" class="h-10 w-10 rounded-full object-cover" />

                        <div>
                            <p class="text-xs">
                                <strong class="block font-medium"><?php echo $sessionUser["name"]; ?></strong>

                                <span> mail tanımlı değil </span>
                            </p>
                        </div>
                    </div>
                </div>-->
            </div>

        </div>
        <div class="flex w-full md:w-9/12 lg:w-8/12 h-[600px]">



        </div>
    </div>



</body>

</html>



<?php

function restoreLink()
{
    header("Refresh: 0.5, url = /auth/login");
    die("Restoring Wait");
}

$urli = explode("/", \Router\Router::AnalyzeUri());

if (count($urli) > 3)
    restoreLink();

$target_quest = isset($urli[2]) && $urli[2] != "" ? $urli[2] : "";


switch ($target_quest) {
    default:
        //renderMain();
        break;
}

?>