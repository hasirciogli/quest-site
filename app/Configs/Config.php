<?php

define("configs_site_rootfolder", $_SERVER["DOCUMENT_ROOT"]);
define("configs_site_favicon", '<link rel="icon" type="image/png" href="/storage/image/site-images/anonymous.png">');


define("configs_site_version", "1.1");


define("configs_db_host"            , "localhost");
define("configs_db_username"        , "root");
define("configs_db_name"            , "anonimol.com");
define("configs_db_password"        , "1234");

define("configs_mail_host", "mail..com");
define("configs_mail_username", "admin@.com");
define("configs_mail_from", "admin@.com");
define("configs_mail_sender", ".com");
define("configs_mail_port", 587);
define("configs_mail_password", "");


define("configs_host_domain", "localhost");
define("configs_host_ssl", "http");


define("configs_payment_backtr", "");


define("configs_api_prefix", "api");

define("configs_framework_version", "1.0");


define("framework_is_debug_mode", true);

define("configs_site_libs", '
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
            integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" integrity="sha512-oe8OpYjBaDWPt2VmSFR+qYOdnTjeV9QPLJUeqZyprDEQvQLJ9C5PCFclxwNuvb/GQgQngdCXzKSFltuHD3eCxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="/storage/css/index.css">
    '. configs_site_favicon);


?>