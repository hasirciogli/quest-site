<div class="fixed w-full h-screen bg-slate-50 z-[99] left2-[-300px] duration-300 hidden left-[-100%]"
     id="mobile-sidebar">
    <div class="flex w-full h-14 bg-blue-500 border-b text-white">
        <div class="flex w-full pl-3 h-full items-center"> Merhaba Anonin! </div>
        <div class="w-14 h-14 flex items-center justify-center text-2xl hover:bg-white hover:text-blue-500 hover:cursor-pointer duration-300"
             id="close-mobile-sidebar_btn"> X </div>
    </div>
</div>

<header aria-label="Site Header" class="border-b border-gray-100 shadow">
    <div class="mx-auto flex h-16 max-w-screen-2xl items-center justify-between sm:px-6 lg:px-8">
        <div class="flex items-center gap-4">
            <button type="button" class="p-2 lg:hidden" id="open-mobile-sidebar_btn">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <a href="/" class="flex">
                <div class="flex w-full md:w-[200px] justify-center md:justify-start md:text-base xl:text-xl font-semibold h-full flex items-center transition-all duration-300">
                    domainlazim.com
                </div>
            </a>
        </div>

        <div class="flex flex-1 items-center justify-end gap-8">
            <nav aria-label="Site Nav"
                 class="hidden lg:flex lg:gap-4 lg:text-xs lg:font-bold lg:uppercase lg:tracking-wide lg:text-gray-500">
                <!--<a href="/about"
                   class="block h-16 border-b-4 border-transparent leading-[4rem] hover:border-current hover:text-red-700">
                    About
                </a>

                <a href="/news"
                   class="block h-16 border-b-4 border-transparent leading-[4rem] hover:border-current hover:text-red-700">
                    News
                </a>-->

                <a href="/products"
                   class="block h-16 border-b-4 border-transparent leading-[4rem] hover:border-current hover:text-red-700">
                    Var mı bilen?
                </a>

                <a href="/contact"
                   class="block h-16 border-b-4 border-transparent leading-[4rem] hover:border-current hover:text-red-700">

                </a>
            </nav>

            <div class="flex items-center">
                <div class="flex items-center divide-x divide-gray-100 border-x border-gray-100">
                        <span>
                            <a href="/cart" class="block border-b-4 border-transparent p-6 hover:border-red-700">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>

                                <span class="sr-only">Cart</span>
                            </a>
                        </span>

                    <span>
                            <a href="/profile" class="block border-b-4 border-transparent p-6 hover:border-red-700">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>

                                <span class="sr-only"> Account </span>
                            </a>
                        </span>

                    <span class="hidden sm:block">
                            <a href="/search" class="block border-b-4 border-transparent p-6 hover:border-red-700">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>

                                <span class="sr-only"> Search </span>
                            </a>
                        </span>
                </div>
            </div>
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