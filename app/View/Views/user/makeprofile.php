<?php

$userController = \CONTROLLERS\userController::cfun();

if (!$userController->isLogged())
    \Router\Router::Route("auth");

$sessionUser = $userController->getSessionUser();

if (!$sessionUser[0])
    die("Internal Process Session Error #628655");

if ($sessionUser[1]["profile_completed"] == "1")
    \Router\Router::Route("profile");

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <?php echo configs_site_libs; ?>

    <title>Document</title>

    <script src="/storage/js/public-requirements.js"></script>

</head>
<body class="dark:bg-dc-50">


<div class="flex flex-col items-center h-screen w-full">

    <?php require __DIR__ . "/../../datapages/header.php"?>


    <div class="flex flex-col h-full w-full items-center justify-around">
        <h1 class="bg-gradient-to-r from-green-300 via-blue-500 to-purple-600 bg-clip-text text-3xl font-extrabold text-transparent sm:text-5xl uppercase" >
            Neredeyse bitti dostum

            <span class="block text-base text-center md:text-2xl md:mt-2"> haydi! profilini yaratalım </span>
        </h1>

        <div class="flex items-center flex-row w-full md:container md:mx-auto text-black dark:text-white">
            <div class="hidden lg:flex w-full h-[450px] bg-red-200 sm:w-[500px] mx-auto rounded dark:bg-dh-50 border dark:border-dhover-300 dark:hover:border-dhover-100 overflow-hidden">

                <div class="dark:bg-dh-50 shadow-shadow-500 shadow-3xl rounded-primary relative mx-auto flex h-full w-full max-w-[550px] flex-col items-center bg-white bg-cover bg-clip-border p-[16px] dark:text-white dark:shadow-none">
                    <div class="relative mt-1 flex h-32 w-full justify-center rounded-xl bg-cover" style='background-image: url("https://i.ibb.co/FWggPq1/banner.png");'>
                        <div class="absolute -bottom-12 flex h-[88px] w-[88px] items-center justify-center rounded-full border-[4px] border-white bg-pink-400">
                            <img class="h-full w-full rounded-full" src="/storage/image/site-images/user-man.png" alt="" id="profile-s-image"/>
                        </div>
                    </div>
                    <div class="mt-16 flex flex-col items-center">
                        <h4 class="dark:text-white text-blue-900 text-xl font-bold" id="profile-s-name">Mustafa Hasırcıoğlu</h4>
                        <p class="dark:text-slate-300 text-slate-400 text-base font-normal">Website Owner</p>
                    </div>
                    <div class="mt-6 mb-3 flex gap-4 md:!gap-14">
                        <div class="flex flex-col items-center justify-center">
                            <h3 class="text-bluePrimary text-2xl font-bold">17</h3>
                            <p class="text-lightSecondary text-sm font-normal">Posts</p>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <h3 class="text-bluePrimary text-2xl font-bold">9.7K</h3>
                            <p class="text-lightSecondary text-sm font-normal">Followers</p>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <h3 class="text-bluePrimary text-2xl font-bold">434</h3>
                            <p class="text-lightSecondary text-sm font-normal">Following</p>
                        </div>
                    </div>
                </div>


            </div>


            <div class="flex w-full h-[450px] sm:w-[500px] mx-auto sm:rounded sm:dark:bg-dh-50 sm:border dark:border-dhover-300 dark:hover:border-dhover-100 overflow-hidden">

                <div class="bg-transparent sm:ark:bg-dh-50 shadow-shadow-500 shadow-3xl sm:rounded relative mx-auto flex h-full w-full max-w-[550px] flex-col items-center bg-cover bg-clip-border p-[16px] dark:text-white dark:shadow-none">
                    <div class="w-full p-3">
                        <span class="text-xs text-slate-600 fffonts-opensans dark:text-white">Adım ve Soyadım</span>
                        <input type="text" class="w-full text-xs p-3 py-4 dark:bg-dh-50 rounded border-1 ring-0 outline-0 focus:outline-0 focus:ring-0 border-slate-300 focus:border-blue-600 dark:border-dhover-300" id="name-input">
                    </div>

                    <div class="flex flex-row items-center w-full p-3 gap-4">
                        <div class="flex flex-col w-full">
                            <span class="text-xs text-slate-600 fffonts-opensans dark:text-white">Cinsiyetim</span>
                            <select name="cars" class="w-full text-xs p-3 py-4 dark:bg-dh-50 border-1 ring-0 outline-0 focus:outline-0 focus:ring-0 border-slate-300 focus:border-blue-600 dark:border-dhover-300 transition-all duration-300" id="gender-input">
                                <option value="1">Erkek +</option>
                                <option value="0">Kadın -</option>
                            </select>
                        </div>

                        <div class="flex flex-col w-full">
                            <span class="text-xs text-slate-600 fffonts-opensans dark:text-white">Doğum tarihim</span>
                            <input id="age-input" type="date" class="w-full text-xs p-3 py-4 dark:bg-dh-50 border-1 ring-0 outline-0 focus:outline-0 focus:ring-0 border-slate-300 focus:border-blue-600 dark:border-dhover-300 transition-all duration-300">
                        </div>
                    </div>

                    <div class="w-full p-3">
                        <span class="text-xs text-slate-600 fffonts-opensans dark:text-white">Ben bir</span>
                        <select name="cars" class="w-full text-xs p-3 py-4 dark:bg-dh-50 border-1 ring-0 outline-0 focus:outline-0 focus:ring-0 border-slate-300 focus:border-blue-600 dark:border-dhover-300 transition-all duration-300" id="job-input">
                            <option value="0">Belirtmek İstemiyorum</option>
                            <option value="1">Öğretmenim</option>
                            <option value="2">Siyasetçiyim</option>
                            <option value="3">Hukukçuyum</option>
                            <option value="4">Yazılımcıyım</option>
                        </select>
                    </div>

                    <div class="w-full p-3">
                        <span class="text-xs text-slate-600 fffonts-opensans dark:text-white">Profil Resmim</span>
                        <input type="file" id="pp-input" class="w-full text-xs dark:bg-dh-50 border-1 ring-0 outline-0 focus:outline-0 focus:ring-0 border-slate-300 focus:border-blue-600 dark:border-dhover-300 transition-all duration-300">
                    </div>


                    <div class="flex items-end w-full h-full">
                        <div class="flex w-full justify-end">
                            <input type="button" class="px-3 py-2 text-xs bg-blue-600 rounded-sm text-white fffonts-opensans lowercase" value="Proilini oluştur" id="create-profile-button">
                        </div>
                    </div>


                </div>


            </div>


            <script>
                $("document").ready(() => {
                    $("#name-input").keyup(function(){
                        var cVal = $(this).val();
                        if (cVal.length <= 0)
                        {
                            $("#profile-s-name")[0].innerHTML = "Mustafa Hasırcıoğlu";
                            return;
                        }
                        $("#profile-s-name")[0].innerHTML = cVal;
                    });

                    $("#gender-input").change(function(){
                        var cVal = $(this).val();
                        if($("#pp-input").val() != "")
                            return;
                        $("#profile-s-image").attr("src", cVal == 1 ? "/storage/image/site-images/user-man.png" : "/storage/image/site-images/user-woman.png");
                    });



                    $("#pp-input").change(async function() {
                        var loadedFile = $(this)[0].files[0];
                        if((loadedFile.size / 1000 / 1000) > 2)
                        {
                            ffMakeAlert("error", "", "Lütfen 2mb veya daha az resim dosyası seçin");
                            $(this).val("");
                            return;
                        }

                        if (loadedFile.type.split("/")[0] != "image")
                        {
                            ffMakeAlert("error", "", "Lütfen sadece resim dosyası seçin");
                            $(this).val("");
                            return;
                        }

                        var file = loadedFile;
                        var base64 = await convertBase64(file);
                        $("#profile-s-image")[0].src = base64;
                    });










                    $("#create-profile-button").click(async() => {
                        $.ajax({
                            url: getHost() + "/api/backend/user",
                            method: "POST",
                            data: {
                                "action": "makeprofile",
                                "name": $("#name-input").val(),
                                "gender": $("#gender-input").val(),
                                "age": $("#age-input").val(),
                                "job": "boş iş",
                                "pp": $("#pp-input").val() == "" ? "-" : await convertBase64($("#pp-input")[0].files[0]),
                            },
                            success: (data, status) => {
                                console.log(data);
                                if (data.status)
                                {
                                    ffMakeAlert("success", "", data.data);
                                    setTimeout(() => {
                                        location.reload();
                                    }, 2222);
                                }
                                else{
                                    ffMakeAlert("error", "", data.data.err);
                                    btnClicked = false;
                                }
                            },
                            error: (v1, v2) => {
                                console.log(v1);
                                console.log(v2);
                            }
                        });
                    })










                });




            </script>


        </div>


    </div>
</div>


</body>
</html>