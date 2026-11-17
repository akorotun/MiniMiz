<header>

    <div class="container top-menu">
        <div>
            <div class="logo">
                <img src="/public/img/samuray.jpg" alt="Logo">
                <span>MiniMiz</span>
            </div>
        </div>
        <div class="nav">
            <a href="/">Головна</a>
            <a href="/contact/about">Про нас</a>
            <a href="/contact">Контакти</a>

            <?php if ($_COOKIE['login'] == ''): ?>
            <a href="/user/auth">Увійти</a>
            <?php else: ?>
            <a href="/user/dashboard">Кабінет користувача</a>
            <?php endif; ?>

        </div>
    </div>



</header>