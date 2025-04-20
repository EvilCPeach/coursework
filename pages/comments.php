<?php
    require_once '../config/link.php';
    $selectUsers = " SELECT * FROM `users` ";
    $queryUsers = $link->query($selectUsers);
    $resultUsers = $queryUsers->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/commentsStyle.css">
    <title>Document</title>
</head>
<body>
    <a href="../index.php" target="_self">Назад</a>
    <h1>Отзывы</h1>
    <main class="allComments">
    <?php foreach($resultUsers as $user){ ?>
                <section class="comment">
                    <article class="comment-top">
                        <div class="avatar">
                            <?php if (!empty($user['avatar-user'])){ ?>
                                <img src="data:image/jpeg;base64,<?= base64_encode($user['avatar-user']) ?>" alt="Аватар">
                            <?php } else{ ?>
                                <img src="../images/icon-profile.png" alt="Обычный аватар">
                            <?php } ?>
                        </div>
                        <div class="name">
                            <h3><?= $user['login-user'] ?></h3>
                        </div>
                    </article>
                    <article class="textComment">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quidem, expedita.</p>
                    </article>
                </section>
            <?php } ?>
    </main>
</body>
</html>