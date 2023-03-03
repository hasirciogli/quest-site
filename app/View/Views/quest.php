<?php

$urli = \Router\Router::AnalyzeUri();

$urli = explode("/", $urli);


if (!isset($urli[2]) || $urli[2] == "" || !is_numeric($urli[2]) || $urli[2] <= 0)
{
    header("Refresh: 1, url = /");
    die("?");
}

$target_quest = $urli[2];

{
    $quest = \DATABASE\FFDatabase::cfun()->select("quests")->where("id", $target_quest)->run()->get();

    if (!$quest || $quest == "no-record")
    {
        header("Refresh: 1, url = /");
        die("?");
    }
}

{
    $questU = \DATABASE\FFDatabase::cfun()->select("users")->where("id", $quest["owner_id"])->run()->get();

    if (!$questU || $questU == "no-record")
    {
        header("Refresh: 1, url = /");
        die("?");
    }
}

{
    $questL = \DATABASE\FFDatabase::cfun()->select("likes")->where("liked_to", $quest["id"])->run()->getAll();

    if (!$questL)
    {
        header("Refresh: 1, url = /");
        die("?");
    }
}

{
    $questV = \DATABASE\FFDatabase::cfun()->select("users")->where("id", $quest["owner_id"])->run()->get();

    if (!$questV || $questV == "no-record")
    {
        header("Refresh: 1, url = /");
        die("?");
    }
}

$userController = \CONTROLLERS\userController::cfun();
$questsController = \CONTROLLERS\questsController::cfun();

//var_dump($quest);
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
            integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="/storage/css/index.css">

    <?php echo configs_site_favicon; ?>

    <title>Soru Sor!</title>
</head>
<body>


<?php

include __DIR__ . "/../datapages/header.php";

?>

<div class="flex flex-row">
    <div class="hidden lg:flex w-2/12 h-20">

    </div>

    <div class="flex fex-row w-full">

        <div class="w-full lg:w-8/12 p-2">
            <div class="flex flex-col w-full h-full bg-white border border-gray-200 shadow rounded p-5">
                <div class="flex flex-row w-full">
                    <img src="/storage/image/site-images/question-mark.png" class="h-10 w-10" alt="">
                    <div class="flex items-center w-full p-2">
                        <?php

                        foreach (explode(",", $quest["category"]) as $item) {
                            if (!$item || $item == "")
                                continue;

                            echo '<a href="/category/'.$item.'"><span class="bg-slate-200 rounded text-gray-600 text-xs p-1 mr-1 hover:bg-green-500 hover:text-white duration-300">'.$item.'</span></a>';
                        }

                        ?>
                    </div>
                    <div class="flex flex-row w-full h-full justify-end">
                        <div class="flex items-center">
                            <img src="/storage/image/site-images/trending-topic.gif" class="h-10" title="Popüler" alt="">
                        </div>
                    </div>

                </div>
                <h1 class="mt-3 font-semibold text-3xl fffonts-nunito"><?php echo $quest["header"] ?></h1>
                <div class="flex flex-row mt-5">
                    <img src="/storage/image/site-images/user-man.png" class="w-20 h-20" alt="">
                    <?php

                    if ($quest["secret_mode"] == 1)
                    {
                    ?>

                        <div class="flex flex-col justify-center h-full p-2">
                            <div class="fffonts-golostext">Gizli Üye</div>
                            <div class="fffonts-golostext">Level: xxx | Yaş: xx</div>
                        </div>
                    <?php } else{
                    ?>
                        <div class="flex flex-col justify-center h-full p-2">
                            <a href="/user-profile/<?php echo $questU["id"] ?>"><div class="fffonts-golostext"><?php echo $questU["name"] . " " . $questU["surname"];  ?></div></a>
                            <div class="fffonts-golostext">Level: <?php echo $questU["level"] ?> | Yaş: <3</div>
                        </div>
                    <?php }
                    ?>
                </div>
                <div class="mt-5">
                    <p><?php echo $quest["content"] ?></p>
                    <div class="flex flex-row items-center mt-10">
                        <img src="/storage/image/site-images/hearth-blank.png" class="w-6 h-6 hover:cursor-pointer <?php echo $questsController->imILiked($target_quest) ? "hidden" : ""; ?>" alt="" id="make-like-button-for-quest">
                        <img src="/storage/image/site-images/hearth-yellow.png" class="w-6 h-6 hover:cursor-pointer <?php echo $questsController->imILiked($target_quest) ? "" : "hidden"; ?>" alt="" id="make-unlike-button-for-quest">
                        <div class="ml-2 text-sm"><?php echo is_array($questL) ? count($questL) : "0"; ?> Likes</div>
                    </div>

                    <script>
                        /*$(document).ready(() => {
                            $("#make-like-button-for-quest").click(() => {
                                $("#make-like-button-for-quest")[0].classList.contains("hidden") ? "" : $("#make-like-button-for-quest")[0].classList.add("hidden");
                                $("#make-unlike-button-for-quest")[0].classList.contains("hidden") ? $("#make-unlike-button-for-quest")[0].classList.remove("hidden") : "";
                            });

                            $("#make-unlike-button-for-quest").click(() => {
                                $("#make-unlike-button-for-quest")[0].classList.contains("hidden") ? "" : $("#make-unlike-button-for-quest")[0].classList.add("hidden");
                                $("#make-like-button-for-quest")[0].classList.contains("hidden") ? $("#make-like-button-for-quest")[0].classList.remove("hidden") : "";
                            });
                        });*/
                    </script>

                </div>
            </div>
        </div>

        <div class="hidden lg:flex w-4/12 p-2">
            <div class="flex w-full h-full bg-white border border-gray-200 shadow rounded p-3">
                <div class="font-semibold text-xl fffonts-golostext">Benzer Sorular</div>
            </div>
        </div>

    </div>

    <div class="hidden lg:flex w-2/12 h-20">

    </div>
</div>

</body>
</html>