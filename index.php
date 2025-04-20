<?php
    require_once './config/link.php';
    $selectUsers = " SELECT * FROM `users` ";
    $queryUsers = $link->query($selectUsers);
    $resultUsers = $queryUsers->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Document</title>
</head>
<body>
<header>
    <a href="#" class="logo">
        <img src="./images/logo.png" alt="" width="70px" height="70px">
    </a>
    <div class="links">
        <a href="#">Главная</a>
        <a href="#about">О нас</a>
        <a href="#contacts">Контакты</a>
        <a href="#catalog">Каталог</a>
        <a href="#reviwes">Отзывы</a>
        <button class="dropdown" id="dropdown">

        </button>
        <div class="dropdown-menu hidden" id="dropdownMenu">
            <a href="#">Главная</a>
            <a href="#about">О нас</a>
            <a href="#contacts">Контакты</a>
            <a href="#catalog">Каталог</a>
            <a href="#reviwes">Отзывы</a>
        </div>
        <button class="profile" id="profile">
            <img src="./images/logo.png" alt="" width="50px" height="50px">
        </button>
        <div class="profile-menu hidden" id="profileMenu">
            <a href="#">Профиль</a>
            <a href="#">Настройки</a>
            <a href="#">Вход</a>
        </div>
    </div>
</header>
<main class="images">
    <section>
        <article class="difference" id="difference">
            <img src="./images/нестол2.png" alt="Было" class="image image-before">
            <img src="./images/стол2.png" alt="Стало" class="image image-after" id="image-after">
            <button class="closeButton" id="closeButton">Закрыть</button>
            <div class="personal" id="personal">
                <p>Посмотрите свою комнату:</p>
                <input type="file" id="upload" accept="image/*">
            </div>
            <div class="slider" id="slider"></div>
            <div class="blurWindow" id="blurWindow"></div>
            <div class="content" id="content">
                <div class="content-left">
                    <div class="title">
                        <h1>Современное решение</h1>
                        <p>Затеяли ремонт или понравилась мебель? Мы поможем!</p>
                    </div>
                </div>
                <div class="content-right">
                    <button class="view" id="view">Посмотреть</button>
                </div>
            </div>
        </article>
    </section>
</main>
<main class="about" id="about">
    <section class="titleAbout">
        <h2>О нас</h2>
        <div class="line"></div>
    </section>
    <section class="windowAbout">
        <article class="blurAbout">
            
        </article>
        <article class="textAbout">
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum ex consequatur corrupti quam autem harum molestiae obcaecati! Atque, error mollitia!</p>
        </article>
    </section>
</main>
<main class="reviews" id="">
    <h2>Отзывы</h2>
    <div class="line"></div>
    <a href="./pages/comments.php" target="_self">Показать все отзывы</a>
    <section class="sliderComments">
        <article class="comments" id="comments">
            <?php foreach($resultUsers as $user){ ?>
                <div class="comment">
                    <div class="comment-top">
                        <div class="avatar">
                            <?php if (!empty($user['avatar-user'])){ ?>
                                <img src="data:image/jpeg;base64,<?= base64_encode($user['avatar-user']) ?>" alt="Аватар">
                            <?php } else{ ?>
                                <img src="./images/icon-profile.png" alt="Обычный аватар">
                            <?php } ?>
                        </div>
                        <div class="name">
                            <h3><?= $user['login-user'] ?></h3>
                        </div>
                    </div>
                    <div class="textComment">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quidem, expedita.</p>
                    </div>
                </div>
            <?php } ?>
        </article>
        <button class="previous" id="previous" hidden>
            <img src="./images/leftArrow.svg" alt="">
        </button>
        <button class="next" id="next">
            <img src="./images/rightArrow.svg" alt="">
        </button>
    </section>
</main>
<main class="registration" id="reg">
    <h1>Зарегистрироваться</h1>
    <div class="line"></div>
    <form action="./functions/upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="avatar">
        <input type="text" name="login" placeholder="Придумайте логин">
        <input type="password" name="password" placeholder="Придумайте пароль">
        <input type="password" name="password" placeholder="Повторите пароль" hidden>
        <input type="tel" name="phone" placeholder="Введите телефон">
        <input type="text" name="FIO" placeholder="Введите ФИО">
        <input type="submit" value="Зарегистрироваться">
    </form>
</main>
<footer>
    <a href="#" class="">
        <img src="" alt="">
    </a>
    <article class="social">
        
    </article>
</footer>
<script src="./scripts/script.js"></script>
</body>
</html>
