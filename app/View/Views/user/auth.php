<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php echo configs_site_libs; ?>

    <title>Authentication in progress</title>

    <script src="/storage/js/public-requirements.js"></script>
</head>

<body class="flex flex-col dark:bg-dc-50 dark:text-white">

<?php
//require __DIR__ . "/../../datapages/header.php";


function renderLoginPage()
{ ?>

    <div class="flex items-center w-full h-screen">
        <div class="mx-auto w-full md:w-[550px] md:bg-white dark:md:bg-dh-100 md:shadow-md md:border md:rounded-md md:border-gray-200 dark:md:border-dhover-300 px-4 py-16 sm:px-6 lg:px-8">
                <div class="flex flex-col items-center mx-auto max-w-lg text-center">
                    <img src="/storage/image/site-images/anonymous.png" class="h-14 mb-2" alt="">
                    <h1 class="text-2xl font-bold sm:text-3xl dark:text-white">Giriş Yap</h1>

                    <p class="mt-1 text-gray-500 dark:text-gray-300">
                        Sorularınıza cevap almanın bir diğer yolu
                    </p>
                </div>

                <div class="mx-auto mt-8 mb-0 max-w-md space-y-4">
                    <div class="w-full">
                        <label for="username" class="sr-only">Username:</label>

                        <div class="relative">
                            <input type="text" class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm dark:bg-transparent dark:text-white" id="username" placeholder="Enter Username" />

                            <span class="absolute inset-y-0 right-0 grid place-content-center px-4">
                                <ion-icon name="person-outline"></ion-icon>
                            </span>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="sr-only">Password:</label>

                        <div class="relative">
                            <input type="password" class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm dark:bg-transparent dark:text-white" id="password"  placeholder="Enter password" />

                            <span class="absolute inset-y-0 right-0 grid place-content-center px-4">
                            <ion-icon name="key-outline"></ion-icon>
                        </span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between dark:text-white">
                        <p class="text-sm text-gray-500 dark:text-white">
                            Demek hesabın yok hah? dert etme
                            <a class="underline" href="./register">Kaydol</a>
                        </p>

                        <button id="btn" class="inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white">
                            Giriş
                        </button>
                    </div>
                </div>
            </div>
    </div>


    <script>
        $(document).ready(() => {

            function getHost(add = "") {
                var cstr = window.location.toString();
                return (cstr.substring(0, 5) == "https" ? "https" : "http") + "://" + window.location.hostname + add;
            }
            function kisalt(str, len) {
                if (str.length > len) {
                    return str.substr(0, len) + "...";
                }

                return str;
            }


            var btnClicked = false;
            $("#btn").click(() => {
                if (btnClicked)
                    return;
                btnClicked = true;
                $.ajax({
                    url: getHost() + "/api/backend/user",
                    method: "POST",
                    data: {
                        "action": "login",
                        "username": $("#username").val(),
                        "password": $("#password").val(),
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
            });
        });
    </script>

<?php }







function renderRegisterPage()
{ ?>

<div class="flex items-center w-full h-screen">
    <div class="mx-auto w-full md:w-[550px] md:bg-white dark:md:bg-dh-100 md:shadow-md md:border md:rounded-md md:border-gray-200 dark:md:border-dhover-300 px-4 py-16 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center mx-auto max-w-lg text-center">
            <img src="/storage/image/site-images/anonymous.png" class="h-14 mb-2" alt="">
            <h1 class="text-2xl font-bold sm:text-3xl dark:text-white">Kayıt ol</h1>

            <p class="mt-1 text-gray-500 dark:text-gray-300">
                Sorularınıza cevap almanın bir diğer yolu
            </p>
        </div>

        <div class="mx-auto mt-8 mb-0 max-w-md space-y-4">
            <div class="w-full">
                <label for="username" class="sr-only">Username:</label>

                <div class="relative">
                    <input type="text" class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm dark:bg-transparent dark:text-white" id="username" placeholder="Kullanıcı Adı" />

                    <span class="absolute inset-y-0 right-0 grid place-content-center px-4">
                        <ion-icon name="person-outline"></ion-icon>
                    </span>
                </div>
            </div>

            <div>
                <label for="password" class="sr-only">Şifre:</label>

                <div class="relative">
                    <input type="password" class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm dark:bg-transparent dark:text-white" id="password"  placeholder="Şifre" />

                    <span class="absolute inset-y-0 right-0 grid place-content-center px-4">
                            <ion-icon name="key-outline"></ion-icon>
                        </span>
                </div>
            </div>

            <div>
                <label for="password" class="sr-only">Tekrar Şifre:</label>

                <div class="relative">
                    <input type="password" class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm dark:bg-transparent dark:text-white" id="repassword"  placeholder="Tekrar Şifre"/>

                    <span class="absolute inset-y-0 right-0 grid place-content-center px-4">
                            <ion-icon name="key-outline"></ion-icon>
                        </span>
                </div>
            </div>

            <div class="flex items-center justify-between dark:text-white">
                <p class="text-sm text-gray-500 dark:text-white">
                    Hesabın mı var? Zaman harcama
                    <a class="underline" href="./login">Giriş Yap</a>
                </p>

                <button id="btn" class="inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white">
                    Kaydol
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(() => {


        var btnClicked = false;
        $("#btn").click(() => {
            if (btnClicked)
                return;
            btnClicked = true;
            $.ajax({
                url: getHost("/api/backend/user"),
                method: "POST",
                data: {
                    "action": "register",
                    "username": $("#username").val(),
                    "password": $("#password").val(),
                    "repassword": $("#repassword").val(),
                },
                success: (data, status) => {
                    console.log(data);
                    if (data.status)
                    {
                        ffMakeAlert("success", "", data.data);
                        setTimeout(() => {
                            window.location.href = getHost("/auth/login");
                        }, 2222);
                    }
                    else{
                        ffMakeAlert("success", "", data.data.err);
                        btnClicked = false;
                    }
                },
                error: (v1, v2) => {
                    console.log(v1);
                    console.log(v2);
                }
            });
        });
    });
</script>

<?php } ?>




















</body>
</html>



<?php

function restoreLink()
{
    header("Refresh: 0.5, url = /auth/login");
    die("Restoring Wait");
}

$urli = explode("/", \Router\Router::AnalyzeUri());


if (!isset($urli[2]) || $urli[2] == "")
    restoreLink();

if (count($urli) > 3)
    restoreLink();

$target_quest = $urli[2];


switch ($target_quest) {
    case "login":
        renderLoginPage();
        break;
    case "register":
        renderRegisterPage();
        break;
    case "forget-username":
        die("yes sir");
        break;
    case "forget-password":
        die("yes sir");
        break;
    default:
        restoreLink();
        break;
}

?>