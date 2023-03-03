<?php

$userControllerResponse = \CONTROLLERS\userController::cfun()->getSessionUser();

if (!$userControllerResponse[0])
    \Router\Router::Route("login");

$sessionUser = $userControllerResponse[1];

?>

<!doctype html>
<html lang="en">

<head>
    <?php echo configs_site_libs; ?>

    <title>Profile of <?php echo $sessionUser["name"] . " " . $sessionUser["surname"]; ?></title>
</head>

<body>


    <?php

    require __DIR__ . "/../../datapages/header.php";

    ?>


    <div class="flex flex-col md:flex-row md:flex-row container mx-auto md:rounded overflow-hidden md:mt-5 md:border border-gray-200 shadow-md shadow-gray-200 duration-700">
        <div class="flex flex-col md:w-5/12 lg:w-4/12 xl:w-3/12 md:h-[600px] md:border-r md:border-r-gray-300 duration-700">
            <div class="flex flex-row w-full h-[135px] items-center justify-start p-5 border-b border-b-gray-200 duration-700">
                <img src="/storage/image/site-images/user-man.png" class="w-16 md:w-20 duration-700" alt="">
                <div class="flex flex-col ml-2">
                    <?php

                    $____dogumTarihi____ = isset($sessionUser["birth_date"]) && $sessionUser["birth_date"] != "" ? $sessionUser["birth_date"] : date("Y-m-d");
                    //$____bugun____ = date("Y-m-d H:i:s");
                    $____bugun____ = date("Y-m-d");
                    $____diff____ = date_diff(date_create($____dogumTarihi____), date_create($____bugun____));
                    //$____bAe____  = $____diff____->format('%y.%m.%d : %H:%i:%s');
                    $____bAe____  = $____diff____->format('%y.%m.%d');

                    ?>
                    <span class="text-sm md:text-md font-semibold"><?php echo $sessionUser["name"] . " " . $sessionUser["surname"]; ?></span>
                    <span class="text-xs md:text-sm font-semibold" title="Kişini yaşı sırasıya YIL AY GÜN olarak belirtilmiştir">Level: <?php echo (int)number_format($sessionUser["level"], 0, ".", ","); ?>, Yaş: <?php echo isset($sessionUser["birth_date"]) && $sessionUser["birth_date"] != "" ? $____bAe____ : "Belirtilmemiş"; ?></span>
                </div>
            </div>

            <div class="hidden md:flex h-full flex-col justify-between  bg-white">
                <div class="">
                    <nav aria-label="Main Nav" class="flex flex-col space-y-1">

                        <a href="#" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-gray-700">
                            <img src="/storage/image/site-images/gear.png" class="h-5 w-5 opacity-75" alt="">

                            <span class="text-sm font-medium"> Genel ayarlar </span>
                        </a>

                        <a href="#" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-gray-700">
                            <img src="/storage/image/site-images/security.png" class="h-5 w-5 opacity-100" alt="">

                            <span class="text-sm font-medium"> Güvenlik ayarları </span>
                        </a>

                        <a href="/logout" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-gray-700">
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
                                <strong class="block font-medium"><?php echo $sessionUser["name"] . " " . $sessionUser["surname"]; ?></strong>

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