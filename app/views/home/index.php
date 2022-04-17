<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Главная страница интернет магазина">
    <title>MiniMiz</title>

    <link rel="stylesheet" href="/public/css/main.css">
    <link rel="stylesheet" href="/public/css/form.css">
    <!-- подключаем шрифты Font Awesome -->
    <script src="https://kit.fontawesome.com/d5dce6c679.js" crossorigin="anonymous"></script>

</head>
<body>
<?php require 'public/blocks/header.php' ?>

<div class="container main">

    <h1>Мы <span class="mini">MiniMiz</span>ируем Вашу ссылку</h1>
    <h3>и сделаем ее красивой</h3>

    <form action="/" method="post" class="form-control">
        <input type="text" name="link_long" placeholder="Введите Вашу длинную ссылку" value="<?=$_POST['link_long']?>"><br>
        <input type="text" name="link_short" placeholder="Введите вариант короткой ссылки" value="<?=$_POST['link_short']?>"><br>
        <div class="error"><?=$data['message']?></div>
        <div class="crop">
            <img class="crop_img" src="/public/img/unnamed.gif" alt="crop">

            <?php if ($_COOKIE['login'] == ''): ?>
                <button class="btn_block">Доступно после авторизации</button>
            <?php else: ?>

            <button class="btn" id="send">Обрезать</button>
            <?php endif; ?>

        </div>
    </form>
    <br>
    <?php if ($_COOKIE['login'] == ''): ?>
        <h3>Сначала необходимо <a href="user/reg">зарегистрироваться</a><br>
        Если у Вас уже есть аккаунт, пройдите <a href="user/auth">авторизацию</a></h3>
    <?php else: ?>
        <?php if ($data['links'] != null): ?>
            <h3>Mini ссылки:</h3>
            <?php for ($i=0; $i < count($data['links']); $i++): ?>
                <div class="links">
                    <p><b>Длинная: </b><?=$data['links'][$i]['link_long']?></p>
                    <p><b>Короткая: </b><a href="<?='/s/' . $data['links'][$i]['link_short']?>"><?=$_SERVER["SERVER_NAME"] . '/s/' . $data['links'][$i]['link_short']?></a></p>
                    <form action="/" method="post">
                        <input type="hidden" name="id" value="<?=$data['links'][$i]['id']?>">
                        <button type="submit" class="btn btn_links">Удалить</button>
                    </form>
                </div>
            <?php endfor ?>
        <?php endif; ?>
    <?php endif; ?>


</div>

<?php require 'public/blocks/footer.php' ?>

</body>
</html>