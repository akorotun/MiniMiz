<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Обратная связь">
    <title>Контакты</title>

    <link rel="stylesheet" href="/public/css/main.css">
    <link rel="stylesheet" href="/public/css/form.css">

    <!-- подключаем шрифты Font Awesome -->
    <script src="https://kit.fontawesome.com/d5dce6c679.js" crossorigin="anonymous"></script>

</head>
<body>
<?php require 'public/blocks/header.php' ?>

<div class="container main">
    <h1>Обратная связь</h1>
    <p>Напишите нам, если у вас есть вопросы</p>
    <form action="/contact" method="post" class="form-control">
        <input type="text" name="name" placeholder="Введите имя" value="<?=$_POST['name']?>"><br>
        <input type="email" name="email" placeholder="Введите email" value="<?=$_POST['email']?>"><br>
        <input type="text" name="age" placeholder="Введите возраст" value="<?=$_POST['age']?>"><br>
        <textarea name="message" placeholder="Введите сообщение"><?=$_POST['message']?></textarea>
        <div class="error"><?=$data['message']?></div>
        <button class="btn" id="send">Отправить</button>
    </form>

</div>

<?php require 'public/blocks/footer.php' ?>

</body>
</html>