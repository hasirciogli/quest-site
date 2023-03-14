<!doctype html>
<html lang="en" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php echo configs_site_libs; ?>
    <?php echo configs_adsense_cfg; ?>

    <title>Soru Sor!</title>

    <script src="/storage/js/public-requirements.js"></script>
</head>

<body class="p-0 m-0 dark:bg-dc-50">

<?php

include __DIR__ . "/../datapages/header.php";

?>

<div class="flex flex-row z-[5000] top-0 left-0 fixed text-xs lg:text-sm p-1 rounded hidden opacity-20" id="qadd-mover-base">
    <div id="qadd-mover-text" class=" font-bold"></div>
</div>

<div class="flex flex-row">
    <div class="hidden lg:flex w-2/12 h-20">

    </div>

    <div class="flex fex-row w-full">

        <div class="w-full lg:w-8/12 p-2">
            <div class="flex flex-col w-full h-full border border-gray-200 dark:border-dhover-300 shadow rounded p-5">
                <div class="">
                    <div class="flex mt-1 items-center flex-row border rounded border-1 border-gray-300 dark:border-dhover-300" id="qadd-target-header">
                        <input type="text" id="qadd-header" placeholder="Soru başlığı girin" class="dark:bg-transparent dark:text-white w-full text-sm border-0 outline-0 focus:ring-0 text-base p-0 p-3 rounded">
                    </div>
                    <div class="flex mt-2 flex-row border rounded border-1 border-gray-300 overflow-hidden dark:border-dhover-300"" id="qadd-target-content">
                        <textarea class="dark:bg-transparent dark:text-white w-full text-sm border-r-0 border-t-0 border-b-0 border-0 border-gray-300 outline-0 focus:ring-0 p-0 outline-0 focus:outline-0 focus:border-gray-300 p-3 focus:ring-0 ring-0 min-h-[200px] rounded" placeholder="Sormak istediğiniz sorunun içeriği nedir ?" id="qadd-content"></textarea>
                    </div>

                    <div class="flex mt-2 items-center flex-row border rounded border-1 border-gray-300 dark:border-dhover-300" id="qadd-target-image">
                        <p class="hidden min-w-[110px] p-3">Soru başlığı: </p>
                        <input type="text" id="qadd-imagelink" placeholder="Soru başlığı için resim linki girin" class="dark:bg-transparent dark:text-white w-full text-sm border-0 outline-0 focus:ring-0 text-base p-0 p-3 rounded">
                    </div>

                    <div class="flex mt-2 items-center flex-row border rounded border-1 border-gray-300 dark:border-dhover-300" id="qadd-target-category">
                        <p class="hidden min-w-[110px] p-3">Soru başlığı: </p>
                        <input type="text" id="qadd-category" placeholder="Virgül ile kategori belirtin, Örnek: var-mi-bilen, onerim-var" class="dark:bg-transparent dark:text-white w-full text-sm border-0 outline-0 focus:ring-0 text-base p-0 p-3 rounded">
                    </div>

                    <div class="flex flex-row items-center mt-2 overflow-hidden py-3 fffonts-nunito">
                        <div class="flex w-6 h-6 bg-gray-200 rounded overflow-hidden">
                            <input type="checkbox" class="w-full h-full ring-0 focus:ring-0 bg-slate-200 border border-slate-300 dark:border-0 dark:border-none p-0 m-0 rounded" id="qadd-anonymousmode">
                        </div>
                        <label for="qadd-anonymousmode" class="ml-3 mt-1 text-sm dark:text-white">Gizli olarak sormak istiyorum</label>
                    </div>


                    <div class="flex flex-row items-center mt-10">
                        <div class="flex w-full justify-end text-sm">
                            <button id="cancel-a-new-question" class="bg-red-600 mr-3 p-2 text-white outline outline-0 hover:outline-1 hover:outline-red-800 duration-300 rounded fffonts-golostext text-bold">İptal et</button>
                            <button id="ask-a-new-question" class="bg-blue-600 p-2 text-white outline outline-0 hover:outline-1 hover:outline-blue-800 duration-300 rounded fffonts-golostext text-bold disabled:text-slate-300 disabled disabled:bg-blue-800">Sorunu sor</button>
                        </div>
                    </div>

                    <script src="/storage/js/add-new-question.js"></script>

                </div>
            </div>
        </div>

        <div class="hidden lg:flex w-4/12 p-2">
            <div class="flex w-full h-full border border-gray-200 dark:border-dhover-300 shadow rounded p-3 dark:text-white">
                <div class="font-semibold text-md fffonts-golostext">Benzer Sorular</div>
            </div>
        </div>

    </div>

    <div class="hidden lg:flex w-2/12 h-20">

    </div>
</div>
</body>
</html>