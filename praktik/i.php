<?php
    session_start();
    $user_id =  $_SESSION["user_id"] ?? false;
    require "vendor/autoload.php";
    $db = new Photos\DB();
    $data = $db->get_all_photos();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@1,300&family=Rubik+Wet+Paint&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="s.css">
    <link rel="stylesheet" href="media.css">
    <title>Coffe</title>
   
</head>
<body>

    <?php include "header.php" ?>

    <h1>Галерея</h1>
        <div id="grid">
            <?php foreach ($data as $photo): ?>
                <?= (new Photos\Photo($photo["id"], $photo["image"], $photo["text"]))->get_html() ?>
            <?php endforeach; ?>
        </div>

    

    <div id="popup_photo">
        <img src="" alt="">
    </div>

    <script src="script.js"></script>
</body>
</html>
