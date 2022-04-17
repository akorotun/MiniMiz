<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Регистрация">
    <title>Регистрация</title>

    <link rel="stylesheet" href="/public/css/main.css">
    <link rel="stylesheet" href="/public/css/form.css">

    <!-- подключаем шрифты Font Awesome -->
    <script src="https://kit.fontawesome.com/d5dce6c679.js" crossorigin="anonymous"></script>

</head>
<body>
    <?php require 'public/blocks/header.php' ?>

    <div class="container main">
        <h1>Регистрация</h1>

        <form action="/user/reg" method="post" class="form-control">
            <input type="text" name="login" placeholder="Введите логин" value="<?=$_POST['login']?>"><br>
            <input type="email" name="email" placeholder="Введите email" value="<?=$_POST['email']?>"><br>
            <input type="password" name="pass" placeholder="Введите пароль" value="<?=$_POST['pass']?>"><br>
            <input type="password" name="re_pass" placeholder="Повторите пароль" value="<?=$_POST['re_pass']?>"><br>
            <div class="error"><?=$data['message']?></div>
            <button class="btn" id="send">Готово</button>
        </form>
        <?php
        if ($data['params'] != '') {
            echo '<h2>Есть дополнительный параметр</h2><br>Данные из URL: ' . '<b>' . $data['params'] . '</b>';
        }
        ?>

    </div>

    <?php require 'public/blocks/footer.php' ?>

</body>
</html>