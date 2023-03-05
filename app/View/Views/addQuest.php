<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php echo configs_site_libs; ?>
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
                <div class="">
                    <div class="flex items-center flex-row border rounded border-1 border-gray-300">
                        <p class="hidden min-w-[110px] p-3">Soru başlığı: </p>
                        <input type="text" id="" placeholder="Soru başlığı girin" class="w-full border-0 outline-0 focus:ring-0 text-base p-0 p-3">
                    </div>
                    <div class="flex mt-2 flex-row border rounded border-1 border-gray-300 overflow-hidden">
                        <div class="hidden flex flex-col h-[100px] justify-start">
                            <p class="min-w-[110px] p-2">Soru başlığı: </p>
                        </div>
                        <textarea class="w-full border-r-0 border-t-0 border-b-0 border-0 border-gray-300 outline-0 focus:ring-0 p-0 outline-0 focus:outline-0 focus:border-gray-300 p-3 focus:ring-0 ring-0 min-h-[200px]" placeholder="Sormak istediğiniz sorunun içeriği nedir ?" id="quest-content"></textarea>
                    </div>
                    <div class="flex flex-row items-center mt-2 overflow-hidden py-3 fffonts-nunito">
                        <div class="w-6 h-6 bg-gray-200">
                            <input type="checkbox" class="w-full h-full ring-0 focus:ring-0" id="wants-to-be-anonymous">
                        </div>
                        <label for="is-anonim" class="ml-3 mt-1">Gizli olarak sormak istiyorum</label>
                    </div>

                    <div class="flex flex-row items-center mt-10">
                        <div class="flex w-full justify-end text-sm">
                            <button id="cancel-a-new-question" class="bg-red-600 mr-3 p-2 text-white outline outline-0 hover:outline-1 hover:outline-red-800 duration-300 rounded fffonts-golostext text-bold">İptal et</button>
                            <button id="ask-a-new-question" class="bg-blue-600 p-2 text-white outline outline-0 hover:outline-1 hover:outline-blue-800 duration-300 rounded fffonts-golostext text-bold">Sorunu sor</button>
                        </div>
                    </div>

                    <script>
                        $(document).ready(() => {
                            $("#ask-a-new-question").click(() => {
                                .checked);
                            });

                            $("#cancel-a-new-question").click(() => {
                                $("#make-unlike-button-for-quest")[0].classList.contains("hidden") ? "" : $("#make-unlike-button-for-quest")[0].classList.add("hidden");
                                $("#make-like-button-for-quest")[0].classList.contains("hidden") ? $("#make-like-button-for-quest")[0].classList.remove("hidden") : "";
                            });
                        });
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