<?php
    require_once '../config/link.php';
    session_start();
    $login = $_SESSION['login'];
    $selectUser = " SELECT * FROM `users` WHERE `login-user` = '$login' ";
    $queryUser = $link->prepare($selectUser);
    $queryUser->execute();
    $resultUser = $queryUser->fetchAll(PDO::FETCH_ASSOC);
    $selectUsers = " SELECT * FROM `users` 
        WHERE NULLIF(`comment-user`, '') IS NOT NULL 
        ORDER BY `users`.`date-comment-user` DESC ";
    $queryUsers = $link->prepare($selectUsers);
    $queryUsers->execute();
    $resultUsers = $queryUsers->fetchAll(PDO::FETCH_ASSOC);
    if($_SESSION['login'] == 'unknown' || $_SESSION == null){
        header('location: ../index.php');
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/userpagestyle.css">
    <title>Document</title>
</head>
<body>
    <header id="header">
        <a href="#" class="logo">
            <img src="../images/logo.png" alt="" width="70px" height="70px">
        </a>
        <div class="links">
            <a href="#main">Главная</a>
            <a href="#about">О нас</a>
            <a href="#contacts">Контакты</a>
            <a href="#reviews">Отзывы</a>
            <button class="dropdown" id="dropdown">
                <img src="../images/leftArrow.svg" alt="">
            </button>
            <div class="dropdown-menu hidden" id="dropdownMenu">
                <a href="#">Главная</a>
                <a href="#about">О нас</a>
                <a href="#contacts">Контакты</a>
                <a href="#reviews">Отзывы</a>
            </div>
            <button class="profile" id="profile">
                <?php foreach($resultUser as $user){ ?>
                    <?php if (!empty($user['avatar-user'])){ ?>
                                    <img src="data:image/jpeg;base64,<?= base64_encode($user['avatar-user']) ?>" alt="Аватар" width="50px" height="50px" class="avatarUser">
                                <?php } else{ ?>
                                    <img src="../images/icon-profile.png" alt="Обычный аватар" width="50px" height="50px">
                                <?php } ?>
                <?php } ?>
            </button>
            <div class="profile-menu hidden" id="profileMenu">
                <a href="../functions/exit.php" id="entryButton">Выход</a>
            </div>
        </div>
    </header>
    <main class="modal hidden">
        <section class="modal-top">
            <article class="modal-reg" id="modalReg">
                <h3>Регистрация</h3>
            </article>
            <article class="modal-entry" id="modalEntry">
                <h3>Вход</h3>
            </article>
            <article>
                <img src="../images/closeIcon.png" alt="" class="closeModal" id="closeModal">
            </article>
        </section>
    </main>
    <main class="backgroundModal hidden">
        
    </main>
    <main class="images" id="headerr">
        <section id="up">
            <article class="difference" id="difference">
                <img src="../images/нестол2.png" alt="Было" class="image image-before" id="image-before">
                <img src="../images/стол2.png" alt="Стало" class="image image-after" id="image-after">
                <button class="closeButton" id="closeButton">Закрыть</button>
                <form class="personal" id="personal">
                    <label for="upload">Посмотрите свою комнату:</label>
                    <input type="file" name="userRoom" id="upload">
                    <label for="furniture">Выберите что хотите видеть в комнате:</label>
                    <select name="furniture" id="furniture">
                        <option value="chair">Кресло</option>
                        <option value="table">Стол</option>
                    </select>
                    <input type="submit" value="Загрузить">
                </form>
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
    <main class="reviews" id="reviews">
        <section class="reviews-top">
            <h2>Отзывы</h2>
            <div class="line"></div>
        </section>
        <section class="sliderComments">
            <article class="comments" id="comments">
                <?php foreach($resultUsers as $user){ ?>
                    <div class="comment">
                        <div class="comment-top">
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
                            <div class="dateComment">
                                <p><?= $user['date-comment-user'] ?></p>
                            </div>
                        </div>
                        <div class="textComment">
                            <p><?= $user['comment-user'] ?></p>
                        </div>
                    </div>
                <?php } ?>
            </article>
            <button class="previous" id="previous" hidden>
                <img src="../images/leftArrow.svg" alt="">
            </button>
            <button class="next" id="next">
                <img src="../images/rightArrow.svg" alt="">
            </button>
        </section>
        <section class="allComments">
            <a href="../pages/comments.php" target="_self">Показать все отзывы</a>
        </section>
    </main>
    <main class="registration hidden" id="reg">
        <div class="registration-top">
            <h2>Зарегистрироваться</h2>
            <div class="line"></div>
        </div>
        <form action="./functions/registration.php" method="POST" enctype="multipart/form-data" class="formRegistration">
            <!-- <input type="date" name="dateComment" value="<?= date('Y-m-d') ?>" hidden> -->
            <label for="avatar">Загрузите аватар:</label>
            <input type="file" name="avatar" id="avatar">
            <input type="text" name="login" placeholder="Придумайте логин">
            <input type="password" name="password" placeholder="Придумайте пароль">
            <input type="tel" name="phone" placeholder="Введите телефон">
            <input type="text" name="FIO" placeholder="Введите ФИО">
            <input type="submit" value="Зарегистрироваться">
        </form>
    </main>
    <footer>
        <a href="#up" class="up">
            <img src="../images/rightArrow.svg" alt="" width="50px" height="50px">
        </a>
        <p class="copyright">© Дронов Д. С., 2025</p>
        <article class="menu-footer">
            <div class="links">
                <a href="#main">Главная</a>
                <a href="#about">О нас</a>
                <a href="#contacts">Контакты</a>
                <a href="#reviwes">Отзывы</a>
                <button class="dropdown" id="dropdown">
                    <img src="../images/leftArrow.svg" alt="">
                </button>
                <div class="dropdown-menu hidden" id="dropdownMenu">
                    <a href="#headerr">Главная</a>
                    <a href="#about">О нас</a>
                    <a href="#contacts">Контакты</a>
                    <a href="#reviwes">Отзывы</a>
                </div>
            </div>
        </article>
        <a href="#" class="logo">
            <img src="../images/logo.png" alt="" width="70px" height="70px">
        </a>
    </footer>
    <script src="../scripts/script.js"></script>
</body>
</html>