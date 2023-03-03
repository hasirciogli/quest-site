<!doctype html>
<html lang="en">

<head>
    <?php echo configs_site_libs; ?>

    <title>Authentication in progress</title>
</head>

<body class="flex flex-col">


<?php
//require __DIR__ . "/../../datapages/header.php";


function renderLoginPage()
{ ?>

    <div class="flex items-center w-full h-screen">
        <div class="mx-auto w-full md:w-[550px] md:bg-white md:shadow-md md:border md:rounded-md md:border-gray-200 px-4 py-16 sm:px-6 lg:px-8">
                <div class="flex flex-col items-center mx-auto max-w-lg text-center">
                    <img src="/storage/image/site-images/anonymous.png" class="h-14 mb-2" alt="">
                    <h1 class="text-2xl font-bold sm:text-3xl">Giriş Yap</h1>

                    <p class="mt-1 text-gray-500">
                        Sorularınıza cevap almanın bir diğer yolu
                    </p>
                </div>

                <div class="mx-auto mt-8 mb-0 max-w-md space-y-4">
                    <div class="w-full">
                        <label for="username" class="sr-only">Username:</label>

                        <div class="relative">
                            <input type="text" class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm" id="username" placeholder="Enter Username" />

                            <span class="absolute inset-y-0 right-0 grid place-content-center px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </span>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="sr-only">Password:</label>

                        <div class="relative">
                            <input type="password" class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm" id="password"  placeholder="Enter password" />

                            <span class="absolute inset-y-0 right-0 grid place-content-center px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-500">
                            Demek hesabın yok hah? dert etme
                            <a class="underline" href="">Kaydol</a>
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
            $("#btn").click(() => {
                //toastr["success"]("My name is Inigo Montoya. You killed my father. Prepare to die!");
                $.ajax({
                    url: "http://localhost/api/backend/user",
                    method: "POST",
                    data: {
                        "action": "login",
                        "username": $("#username").val(),
                        "password": $("#password").val(),
                    },
                    success: (data, status) => {
                        console.log(data);
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
        die("yes sir");
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