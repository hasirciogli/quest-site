<?php

$urli = \Router\Router::AnalyzeUri();

$urli = explode("/", $urli);

if (!isset($urli[2]) || $urli[2] == "" || $urli[2] == "add"){
    if(\CONTROLLERS\userController::cfun()->isLogged())
    {
        require __DIR__ . "/addQuest.php";
        return;
    }
    else{
        header("Refresh: 2, url = /auth");
        die("Giriş yapman gerek, Lütfen bekle...");
    }

    return;
}

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


$sessionUser = $userController->getSessionUser();

//var_dump($quest);
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php echo configs_site_libs; ?>
    <?php echo configs_site_favicon; ?>

    <script src="/storage/js/public-requirements.js"></script>

    <title>Soru Sor!</title>
</head>
<body>


<?php

include __DIR__ . "/../datapages/header.php";

?>

<div class="flex flex-row">
    <div class="hidden lg:flex w-2/12 h-20">

    </div>

    <div class="flex flex-col w-full">

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

                            $____dogumTarihi____ = isset($questU["birth_date"]) && $questU["birth_date"] != "" ? $questU["birth_date"] : date("Y-m-d");
                            //$____bugun____ = date("Y-m-d H:i:s");
                            $____bugun____ = date("Y-m-d");
                            $____diff____ = date_diff(date_create($____dogumTarihi____), date_create($____bugun____));
                            //$____bAe____  = $____diff____->format('%y.%m.%d : %H:%i:%s');
                            $____bAe____  = $____diff____->format('%y.%m.%d');
                            ?>
                            <div class="flex flex-col justify-center h-full p-2">
                                <a href="/user-profile/<?php echo $questU["id"] ?>"><div class="fffonts-golostext font-semibold"><?php echo $questU["name"] . " " . $questU["surname"];  ?></div></a>
                                <div class="fffonts-golostext" title="Kişini yaşı sırasıya YIL AY GÜN olarak belirtilmiştir">Level: <?php echo $questU["level"] ?> | Yaş: <?php echo (isset($questU["birth_date"]) && $questU["birth_date"] != "" ? $____bAe____ : "Belirtilmemiş"); ?></div>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <div class="mt-5">
                        <p class="  overflow-hidden break-all"><?php echo $quest["content"] ?></p>
                        <div class="flex flex-row items-center mt-10">
                            <img src="/storage/image/site-images/hearth-blank.png" class="w-6 h-6 hover:cursor-pointer <?php echo $questsController->imILiked($target_quest) ? "hidden" : ""; ?>" alt="" id="make-like-button-for-quest" base-quest-id="<?php echo $target_quest; ?>">
                            <img src="/storage/image/site-images/hearth-yellow.png" class="w-6 h-6 hover:cursor-pointer <?php echo $questsController->imILiked($target_quest) ? "" : "hidden"; ?>" alt="" id="make-unlike-button-for-quest" base-quest-id="<?php echo $target_quest; ?>">
                            <div class="ml-2 text-sm" id="quest-likes-count"><?php echo is_array($questL) ? count($questL) : "0"; ?> Likes</div>
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

        <div class="w-full p-2">
            <div class="w-full lg:w-8/12 rounded text-xl fffonts-golostext">
                <span class="text-base sm:text-xl">Yorumlar <span id="q-coments-count" class="ml-1 text-sm font-normal">0</span></span>


                <?php if($userController->isLogged()){
                    $isMan = $sessionUser[1]["gender"];
                    $nLink = ($isMan == 1) ? ("/storage/image/site-images/user-man.png") : ("/storage/image/site-images/user-woman.png");
                    ?>

                    <div class="mt-2 mb-2 flex w-full min-h-[30px] sm:min-h-[140px] rounded overflow-hidden border shadow duration-300 transition-all">
                        <div class="hidden sm:flex justify-center duration-300 transition-all">
                            <img
                                    class="m-2 w-full h-full w-[60px] h-[60px] duration-300 transition-all"
                                    src="<?php echo $sessionUser[1]["image_uri"]?>"
                                    alt=""
                                    onerror="this.onerror=null; this.src='<?php echo $nLink;?>'"
                            >
                        </div>
                        <div class="border-l flex flex-col w-full h-full p-3 duration-300 transition-all">

                            <span class="text-xs sm:text-base text-black">Düşünceni paylaş</span>

                            <div class="text-xs sm:text-base w-full min-h-[30px] sm:min-h-[160px] mt-2 duration-300 transition-all">
                                <textarea name="" id="" class="flex w-full min-h-[100px] sm:min-h-[160px] border-slate-300 focus:ring-0 focus:border-slate-300 duration-300 transition-all"></textarea>
                            </div>

                            <div class="text-sm sm:text-base flex w-full justify-end text-sm mt-3 duration-300 transition-all">
                                <button id="cancel-a-new-question" class="text-xs sm:text-base bg-red-600 mr-3 p-2 text-white outline outline-0 hover:outline-1 hover:outline-red-800 duration-300 rounded fffonts-golostext text-semibold">İptal et</button>
                                <button id="ask-a-new-question" class="text-xs sm:text-base bg-blue-600 p-2 text-white outline outline-0 hover:outline-1 hover:outline-blue-800 duration-300 rounded fffonts-golostext text-semibold disabled:text-slate-300 disabled disabled:bg-blue-800">paylaş</button>
                            </div>

                        </div>
                    </div>

                <?php }?>

            </div>
        </div>

    </div>

    <div class="hidden lg:flex w-2/12 h-20">

    </div>
</div>


<script src="/storage/js/like-to-question.js"></script>

</body>
</html>