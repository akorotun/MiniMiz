<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Головна сторінка minimiz">
    <title>MiniMiz</title>

    <link rel="stylesheet" href="/public/css/main.css">
    <link rel="stylesheet" href="/public/css/form.css">
    <!-- підключаємо шрифти Font Awesome -->
    <script src="https://kit.fontawesome.com/d5dce6c679.js" crossorigin="anonymous"></script>

</head>
<body>
<?php require 'public/blocks/header.php' ?>

<div class="container main">

    <h1>Ми <span class="mini">MiniMiz</span>уємо ваше посилання</h1>
    <h3>та зробимо його красивішим</h3>

    <form action="/" method="post" class="form-control">
        <input type="text" name="link_long" placeholder="Введіть ваше довге посилання" value="<?=$_POST['link_long']?>"><br>
        <input type="text" name="link_short" placeholder="Введіть варіант короткого посилання" value="<?=$_POST['link_short']?>"><br>
        <div class="error"><?=$data['message']?></div>
        <div class="crop">
            <img class="crop_img" src="/public/img/unnamed.gif" alt="crop">

            <?php if ($_COOKIE['login'] == ''): ?>
                <button class="btn_block">Доступно після авторизації</button>
            <?php else: ?>

            <button class="btn" id="send">Обрізати</button>
            <?php endif; ?>

        </div>
    </form>
    <br>
    <?php if ($_COOKIE['login'] == ''): ?>
        <h3>Спочатку необхідно <a href="user/reg">зареєструватися</a><br>
            Якщо у Вас вже є обліковий запис, пройдіть <a href="user/auth">авторизацію</a></h3>
    <?php else: ?>
        <?php if ($data['links'] != null): ?>
            <h3>Mini посилання:</h3>
            <?php for ($i=0; $i < count($data['links']); $i++): ?>
                <div class="links">
                    <p><b>Довга: </b><?=$data['links'][$i]['link_long']?></p>
                    <p><b>Коротка: </b><a href="<?='/s/' . $data['links'][$i]['link_short']?>"><?=$_SERVER["SERVER_NAME"] . '/s/' . $data['links'][$i]['link_short']?></a></p>
                    <form action="/" method="post">
                        <input type="hidden" name="id" value="<?=$data['links'][$i]['id']?>">
                        <button type="submit" class="btn btn_links">Вилучити</button>
                    </form>
                </div>
            <?php endfor ?>
        <?php endif; ?>
    <?php endif; ?>


</div>

<?php require 'public/blocks/footer.php' ?>

</body>
</html>