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

    <link rel="stylesheet" href="/storage/css/index.css">

    <?php echo configs_site_favicon; ?>

    <title>Soru Sor!</title></head>
<body>

<input type="text" placeholder="username" id="username">
<input type="text" placeholder="password" id="password">

<img src="http://localhost/api/backend/ppmanager?action=getpp&uid=1" alt="" class="w-20 h-20 bg-red-300">

<script>
    $(document).ready(() => {
        $("#btn").click(() => {
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
</body>
</html>