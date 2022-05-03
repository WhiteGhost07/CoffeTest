<header>
        <div class="popup">
            <a href="i.php">Главная</a>
            <a id="show_add_photo" href="#">Фото</a>
            <a href="user.php">Личный кабинет</a>
            <?php if ($user_id) : ?>
                <a href="logout.php">Выйти</a>
            <?php endif; ?>
        </div>

        <div class="icon">
            <img src="list.png" alt="">
        </div>

</header>