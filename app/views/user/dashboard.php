<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Кабінет користувача">
    <title>Кабінет користувача</title>

    <link rel="stylesheet" href="/public/css/main.css">
    <link rel="stylesheet" href="/public/css/form.css">
    <!-- подключаємо шрифти Font Awesome -->
    <script src="https://kit.fontawesome.com/d5dce6c679.js" crossorigin="anonymous"></script>

</head>
<body>
    <?php require 'public/blocks/header.php' ?>

    <div class="container main">
        <h1>Кабінет користувача</h1><br>

        <p>Привіт, <b><?=$data['user_info']['login']?></b></p>

            <form action="/user/dashboard" method="post" class="form-control">
                <input type="hidden" name="exit_btn">
                <button type="submit" class="btn">Вийти</button>
            </form>
    </div>

    <?php //require 'public/blocks/footer.php' ?>

</body>
</html>