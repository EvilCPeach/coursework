<?php
    require_once '../config/link.php';
    session_start();
    $selectUsers = " SELECT * FROM `users` 
        WHERE NULLIF(`comment-user`, '') IS NOT NULL 
        ORDER BY `users`.`date-comment-user` ASC ";
    if(isset($_GET['sort'])){
        if($_GET['sort'] == 'DESC'){
            $selectUsers = " SELECT * FROM `users` 
        WHERE NULLIF(`comment-user`, '') IS NOT NULL 
        ORDER BY `users`.`date-comment-user` DESC ";
        }
        else if($_GET['sort'] == 'ASC'){
            $selectUsers = " SELECT * FROM `users` 
            WHERE NULLIF(`comment-user`, '') IS NOT NULL 
            ORDER BY `users`.`date-comment-user` ASC ";
        }
    }
    $queryUsers = $link->prepare($selectUsers);
    $queryUsers->execute();
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
    <a href="./userpage.php" target="_self">Назад</a>
    <h1>Отзывы</h1>
    <main class="allComments">
    <form action="" method="GET">
        <label for="sort">Сортировать по:</label>
        <select name="sort" id="sort">
            <option value="ASC">старым комментариям</option>
            <option value="DESC">новым комментариям</option>
        </select>
        <input type="submit" value="Принять">
    </form>
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
                            <p><?= $user['date-comment-user'] ?></p>
                        </div>
                    </article>
                    <article class="textComment">
                        <p><?= $user['comment-user'] ?></p>
                    </article>
                </section>
            <?php } ?>
    </main>
</body>
</html>