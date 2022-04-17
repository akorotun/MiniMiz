<header>

    <div class="container top-menu">
        <div>
            <div class="logo">
                <img src="/public/img/самурай.jpg" alt="Logo">
                <span>MiniMiz</span>
            </div>
        </div>
        <div class="nav">
            <a href="/">Главная</a>
            <a href="/contact/about">Про нас</a>
            <a href="/contact">Контакты</a>

            <?php if ($_COOKIE['login'] == ''): ?>
            <a href="/user/auth">Войти</a>
            <?php else: ?>
            <a href="/user/dashboard">Кабинет пользователя</a>
            <?php endif; ?>

        </div>
    </div>



</header>