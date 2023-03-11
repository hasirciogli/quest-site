
<?php

$huController = \CONTROLLERS\userController::cfun();

$isUserLogged = $huController->isLogged();

if ($isUserLogged)
    @$___temp___user = $huController->getSessionUser();
    @$loggedUser = $___temp___user[0] ? $___temp___user[1] : null;
    //$loggedUser = $___temp___user[0] ? $___temp___user[1] : null;
?>

<div class="fixed w-full h-screen bg-slate-50 dark:bg-dc-50 z-[99] left2-[-300px] duration-300 hidden left-[-100%]" id="mobile-sidebar">
    <div class="flex flex-col items-end justify-end w-full h-full">
        <div class="flex w-full h-14 bg-blue-500 dark:bg-dh-50 border-b dark:border-dhover-300 text-white">
            <div class="flex w-full pl-3 h-full items-center fffonts-exo2"> Merhaba Anonin! </div>
            <div class="w-14 h-14 flex items-center justify-center text-2xl hover:bg-white hover:text-blue-500 hover:cursor-pointer fffonts-exo2" id="close-mobile-sidebar_btn">X</div>
        </div>

        <div class="flex items-end w-full h-full">

        </div>

        <?php if($isUserLogged) { ?>
            <div class="flex flex-row items-end w-full h-[60px] border-t border-t-slate-200 dark:border-t-dhover-300">
                <div class="flex items-center justify-center w-[60px] h-[60px] rounded-full overflow-hidden">
                    <img src="/storage/image/site-images/anonymous.png" class="w-[50px] h-[50px] rounded-full overflow-hidden border dark:border-dhover-300" alt="">
                </div>

                <div class="flex flex-col items-start justify-center w-full h-full dark:text-white p-2">
                    <span class="text-sm fffonts-golostext"><?php echo $loggedUser["name"] . " " . $loggedUser["surname"]; ?></span>
                    <span class="text-xs fffonts-quicksand"><?php echo "Level: " . $loggedUser["level"]; ?></span>
                </div>
            </div>
        <?php } else { ?>
            <div class="flex flex-row items-end w-full h-[60px] border-t border-t-slate-200 dark:border-t-dhover-300">
                <a href="/auth">
                    <span class="text-sm fffonts-golostext">Dostum giriş yapman gerek.</span>
                </a>
            </div>
        <?php } ?>
    </div>
</div>

<header aria-label="Site Header" class="border-b border-gray-100 dark:border-dh-100 shadow dark:bg-dh-50">
    <div class="mx-auto flex h-16 max-w-screen-2xl items-center justify-between sm:px-6 lg:px-8">
        <div class="flex items-center gap-4">
            <button type="button" class="ml-3 sm:ml-0 p-2 lg:hidden" id="open-mobile-sidebar_btn">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <a href="/" class="flex">
                <div class="flex w-full md:w-[200px] dark:text-white justify-center md:justify-start md:text-base xl:text-xl font-semibold h-full flex items-center transition-all duration-300">
                    Anonim<span class="text-red-600">sor.com</span>
                </div>
            </a>
        </div>

        <div class="flex items-center justify-end">
            <nav aria-label="Site Nav" class="hidden lg:flex items-center lg:gap-2 lg:text-xs lg:font-bold lg:uppercase lg:tracking-wide lg:text-gray-500">
                <!--<a href="/about"
                   class="block h-16 border-b-4 border-transparent leading-[4rem] hover:border-current hover:text-red-700">
                    About
                </a>

                <a href="/news"
                   class="block h-16 border-b-4 border-transparent leading-[4rem] hover:border-current hover:text-red-700">
                    News
                </a>-->

                <!--<a href="/products" class="block h-16 leading-[4rem] hover:text-black">
                    Var mı bilen?
                </a>-->

                <ion-icon name="sunny-outline" class="text-lg mr-2 hover:cursor-pointer text-black dark:text-white" id="toggle-darkmode-w8f4r8w4qwe84qw9r4"></ion-icon>

                <a href="/quest/add" style="font-size: 0.66rem" class="flex normal-case mr-2 py-1 px-2 bg-green-100 dark:bg-green-500 hover:bg-green-200 dark:hover:bg-green-600 text-green-600 dark:text-green-50 font-semibold rounded duration-300">
                    soru sor
                </a>

                <?php if($isUserLogged) { ?>

                    <div class="flex items-center justify-center w-10 h-10">
                        <a href="/profile"  class="w-9 hover:w-10 h-9 hover:h-10 rounded-full overflow-hidden border border-1 border-slate-800 dark:border-slate-200 dark:border-2 dark:bg-dh-50 bg-slate-50 shadow shadow-slate-800 dark:shadow-slate-700 hover:cursor-pointer duration-100">
                            <img src="" alt="" class="w-full h-full" onerror="this.onerror=null; this.src='/storage/image/site-images/anonymous.png'">
                        </a>
                    </div>

                <?php }
                else { ?>

                    <div class="flex items-center mr-2 normal-case">
                        <a href="/auth/login" class="flex font-semibold text-gray-100 hover:text-white text-xs fffonts-opensans py-2 px-3 bg-blue-600 hover:bg-blue-700 rounded shadow duration-300">
                            Giriş yap
                        </a>
                    </div>

                <?php } ?>
            </nav>
        </div>
    </div>
</header>

<script>
    $(document).ready(() => {
        var open_mobile_sidebar_animating = false;
        $("#open-mobile-sidebar_btn").click(() => {

            console.log("31");

            $("#mobile-sidebar").css("opacity", "0");
            $("#mobile-sidebar")[0].classList.remove("hidden");
            $("#mobile-sidebar").animate({ left: "0px", opacity: "1" });

            setTimeout(() => {
                $("#mobile-sidebar")[0].classList.remove("hidden");
            }, 600);

        });

        $("#close-mobile-sidebar_btn").click(() => {
            $("#mobile-sidebar").css("opacity", "1");
            $("#mobile-sidebar")[0].classList.remove("hidden");
            $("#mobile-sidebar").animate({ left: "-100%", opacity: "0" });

            setTimeout(() => {
                $("#mobile-sidebar")[0].classList.add("hidden");
            }, 600);
        });
    });
</script>