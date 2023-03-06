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

    <?php echo configs_site_favicon; ?>

    <title>Soru Sor!</title>


    <script src="/storage/js/public-requirements.js"></script>

</head>

<body class="p-0 m-0">

<?php

include __DIR__ . "/../datapages/header.php";

?>



<div class="container mx-auto min-h-[650px] transition-all duration-300">
    <div class="w-full h-[350px] overflow-hidden relative p-2 sm:p-3 transition-all duration-300">

        <div class="w-full h-full overflow-hidden rounded-md bg-blue-600 bg-[url('https://images.pexels.com/photos/8348625/pexels-photo-8348625.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')] bg-center bg-no-repeat bg-origin-content bg-cover"></div>

        <div class="flex md:w-[500px] flex-col justify-end w-full relative top-[-350px] h-[350px] flex text-white pl-3 pb-3">
            <span class="font-semibold text-3xl">Anonim olarak soru sor.</span>
            <p class="font-normal text-sm">
                Bizi kullanarak anonim soru sorabilirsiniz. Eğer onaylı bir hesaba sahip olsanız bile herhangi bir
                bilginiz yasal sorunlar dahil olmak üzere hiç kimse ile paylaşılmayaycak. Bol cevaplar dileriz :)
            </p>
        </div>
    </div>

    <div class="w-full">
        <span class="font-bold text-xl p-3">Filtre:</span>
        <div class="w-full"></div>
    </div>

    <div class="p-3 overflow-hidden">
        Buraya filtre sistemi koyulacak
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 md:flex-row w-full p-3 gap-4"
         id="qlist-1">

        <!--
    <div class="w-full">
        <a href="#" class="relative block overflow-hidden rounded-lg border border-gray-100 border-b-0 shadow-md border border-gray-200" >
            <img
                    alt="Office"
                    src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
                    class="h-56 w-full object-cover mb-5"
            />

            <div class="p-4 sm:p-6 lg:p-8">
                <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-green-300 via-blue-500 to-purple-600" ></span>

                <div class="sm:flex sm:justify-between sm:gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 sm:text-xl">
                            Eşimi aldatırken yakaladım
                        </h3>

                        <p class="mt-1 text-xs font-medium text-gray-600">&#x2022; Gizli Üye</p>
                    </div>

                    <div class="hidden sm:block sm:shrink-0">
                        <img
                                alt="Paul Clapton"
                                src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1180&q=80"
                                class="h-16 w-16 rounded-lg object-cover shadow-sm"
                        />
                    </div>
                </div>

                <div class="mt-4">
                    <p class="max-w-[40ch] text-sm text-gray-500">
                        Çok aşığım, Sizce boşanmalı mıyım ?
                    </p>
                </div>

                <dl class="mt-6 flex gap-4 sm:gap-6">
                    <div class="flex flex-col-reverse">
                        <dt class="text-sm font-medium text-gray-600">Paylaşıldı</dt>
                        <dd class="text-xs text-gray-500">31 Mayıs 2023</dd>
                    </div>

                    <div class="flex flex-col-reverse">
                        <dt class="text-sm font-medium text-gray-600">Okuma Süresi</dt>
                        <dd class="text-xs text-gray-500">~3 dakika</dd>
                    </div>
                </dl>
            </div>

        </a>
    </div>

    -->

    </div>


</div>


<script>




    $(document).ready(() => {

        $.ajax({
            url: getHost() + "/api/backend/quests",
            method: "POST",
            data: {
                "action": "list",
            },
            success: (data, status) => {
                console.log(data);

                if (data.status) {
                    data.data.forEach((item) => {
                        if (item.secret_mode) {
                            var itemx = $("<mainmenu-question-basement></mainmenu-question-basement>");

                            itemx.attr("qid", item.quest_id);

                            itemx.attr("base-header", item.header);
                            itemx.attr("base-content", kisalt(item.content, 30));

                            itemx.attr("is-secret", item.secret_mode ? 1 : 0);
                            itemx.attr("is-man", parseInt(item.user_gender));
                            itemx.attr("user-status", parseInt(item.user_status));
                            itemx.attr("base-image", (item.image_url == null ? "" : item.image_url));
                            itemx.attr("base-created-at", ((item.created_at == null || item.created_at == "") ? "" : item.created_at));
                            itemx.attr("base-read-min", item.content.length / 10);

                            $("#qlist-1").append(itemx);
                        }
                        else {
                            var itemx = $("<mainmenu-question-basement></mainmenu-question-basement>");

                            itemx.attr("qid", item.quest_id);

                            itemx.attr("base-header", item.header);
                            itemx.attr("base-content", kisalt(item.content, 30));

                            itemx.attr("is-secret", item.secret_mode ? 1 : 0);
                            itemx.attr("is-man", parseInt(item.user_gender));
                            itemx.attr("user-name", (item.user_name));
                            itemx.attr("user-surname", (item.user_surname));
                            itemx.attr("user-status", parseInt(item.user_status));
                            itemx.attr("base-image", (item.image_url == null ? "" : item.image_url));
                            itemx.attr("base-created-at", ((item.created_at == null || item.created_at == "") ? "" : item.created_at));
                            itemx.attr("base-read-min", item.content.length / 10);

                            $("#qlist-1").append(itemx);
                        }
                    })
                }
            },
            error: (v1, v2) => {
                console.log(v1);
                console.log(v2);
            }
        });
    });
</script>
<script src="/storage/js/custom-elements/index-cards.js"></script>
</body>

</html>