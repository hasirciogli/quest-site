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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script src="/storage/js/twcss.config.js"></script>
    <script src="/storage/js/darkmode.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" integrity="sha512-oe8OpYjBaDWPt2VmSFR+qYOdnTjeV9QPLJUeqZyprDEQvQLJ9C5PCFclxwNuvb/GQgQngdCXzKSFltuHD3eCxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="/storage/css/index.css">
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/0.3.11/alertify.core.css" integrity="sha512-eZih0rne5vAjEWet1syNsU3LTj1TygGLuLq304xv+JZeaIqi1E1OCbYFD0YPMqhgqFYoOH28QJzJIj+wkVWm+A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/0.3.11/alertify.bootstrap.css" integrity="sha512-eauod+oRhJ84heQKG7Koq4RFiVEXhqhi14M+3+m/6XPJ/FmRHz4yDJ9mtz1X8HdOmQjdX69Wg8/rKal7lgEfsw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/0.3.11/alertify.js" integrity="sha512-7Qu5pr+fIUNnTgU03DC5Y1b3brNO64CQUCT1X+hEcbMM8NGasu+WWBVtF7byk01X+gFdZqSPDpOV3y5lFair0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    '. configs_site_favicon);

define("configs_adsense_gtag", '
    <!-- Google tag (gtag.js) -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8788843794744295" crossorigin="anonymous"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2GRPH57JN7"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag("js", new Date());
    
      gtag("config", "G-2GRPH57JN7");
    </script>
    <!-- Google tag (gtag.js) -->
    ');
?>