<?php
    session_start();
    $user_id = $_SESSION["user_id"] ?? false;
    if ($user_id){
        require "vendor/autoload.php";
        $db = new Photos\DB();
        $data = $db->get_user_photos($user_id);
    }
    else 
    {
        $data = [];
    }
    if (isset($_GET["error"])) {
    $error =  "Неверный логин или пароль!";
    }
    if (isset($_GET["sign_error"])) {
        $sign_error = $_GET["sign_error"];
        }
        if (isset($_GET["sign_null"])){
        $sign_null = "Пустое значение!";
        }
        if (isset($_GET["sign_success"])) {
            $sign_success =  "Успешная регистрация!";
            }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@1,300&family=Rubik+Wet+Paint&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="s.css">
    <link rel="stylesheet" href="media.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffe User</title>
</head>
<body>
    <?php include "header.php" ?>

    <?php if ($user_id): ?>
        <h1>Галерея <?php echo $_SESSION['user_name'];?> </h1>
    <?php endif; ?>
        <div id="grid">
            <?php foreach ($data as $photo): ?>
                <?= (new Photos\Photo($photo["id"], $photo["image"], $photo["text"]))->get_html() ?>
            <?php endforeach; ?>
        </div>
    <?php if ($user_id): ?>  

        <!-- Foto Users -->
        
        <?php else: ?>
            <div class="form">
            <form action="./login.php" method="post">
                    <h2>Авторизация</h2>
                    <input type="text" placeholder="Логин" name="login">
                    <input type="password" placeholder="Пароль" name="password">
                    <button>Вход</button>
                    <?php if (isset($_GET["error"])): ?>
                    <p class="error"><?=$error?></p>
                    <?php endif ?>
                </form>
                <form action="signup.php" method="post">
                    <h2>Регистрация</h2>
                    <input type="text" placeholder="Имя пользователя" name="name">
                    <input type="text" placeholder="Логин" name="login">
                    <input type="password" placeholder="Пароль" name="password">
                    <button>Зарегистрироваться</button>
                    <?php if (isset($_GET["sign_error"])): ?>
                    <p class="error"><?=$sign_error?></p>
                    <?php endif ?>
                    <?php if (isset($_GET["sign_success"])): ?>
                    <p class="success"><?=$sign_success?></p>
                    <?php endif ?>
                    <?php if (isset($_GET["sign_null"])): ?>
                    <p class="error"><?=$sign_null?></p>
                    <?php endif ?>
                </form>
            </div>
    <?php endif; ?>

    <?php include "add_form.php"; ?>

    <div id="popup_photo">
        <img src="" alt="">
    </div>
    <script src="script.js"></script>
</body>
</html>