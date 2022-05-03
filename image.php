<?php
    session_start();
    $user_id = $_SESSION["user_id"] ?? false;
    $photo_id = intval($_GET["id"]);
    require "vendor/autoload.php";
    $db = new Photos\DB();
    $photo = $db->get_photo_by_id($photo_id);
    $comments = $db->get_photo_comments($photo_id);

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
    <title>Photo</title>
</head>
<body>
    
    <?php
        include "header.php";
    ?>

    <div id="image">
    <img src="<?=$photo["image"] ?>" alt="">
    <h1><?=$photo["text"]?></h1>
    <p>Автор: <?=$photo["name"]?></p>
    </div>

    <div class="comments">
        <div class="form">
              <textarea id="text"rows="5"></textarea>
              <button id="add_comment">Добавить</button>
        </div>
        <h2>Комментарии: </h2>
        <?php
         foreach($comments as $comment): ?>
         <div class="comment">
             <p class="author"><?=$comment["name"]?></p>
             <p class="text"><?=$comment["text"]?></p>
             <p class="date"><?=$comment["post date"]?></p>         
        </div>
        <?php endforeach; ?>
    </div>
<script src="image.js"></script>
</body>
</html>