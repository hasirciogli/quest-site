<?php

$userController = \CONTROLLERS\userController::cfun()->getSessionUser();
if (!$userController[0])
    \Router\Router::Route("login");

?>

<!doctype html>
<html lang="en">

<head>
    <?php echo configs_site_libs; ?>

    <title>Profile of </title>
</head>

<body>


<?php

require __DIR__ . "/../../datapages/header.php";

 ?>


<div class="container mx-auto bg-red-300">
123
</div>



</body>
</html>



<?php

function restoreLink()
{
    header("Refresh: 0.5, url = /auth/login");
    die("Restoring Wait");
}

$urli = explode("/", \Router\Router::AnalyzeUri());

if (count($urli) > 3)
    restoreLink();

$target_quest = isset($urli[2]) && $urli[2] != "" ? $urli[2] : "";


switch ($target_quest) {
    default:
        //renderMain();
        break;
}

?>