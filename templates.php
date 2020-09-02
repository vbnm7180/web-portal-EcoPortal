<?php 

function show_page($title,$text,$imglink)
{
    $page=$_GET['page'] ?? 'main'; //выбор page_id для вывода комментариев страницы

switch($page){
    case 'main':
        $page_id=1;
    break;
    case 'glob_warm':
        $page_id=2;
    break;
    case 'red_book':
        $page_id=3;
    break;
}

    ?>
<!-- разрыв кода -->
<!doctype html>
<html>

<head>
    <title>EcoPortal</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/block-styles-desktop.css">
    <link rel="stylesheet" href="./css/block-styles-mobile.css">
    <link rel="stylesheet" href="./css/font-sizes.css">
    <link rel="stylesheet" href="./css/font-styles.css">
    <link rel="stylesheet" href="./css/blueimp-gallery.min.css">
    <script> 
        //функция проверки капчи до отправки страницы
        function checkForm(form) {

            if (!form.captcha.value.match(/^\d{5}$/)) {
                alert('Вы отправили пустую или неверную капчу. Введите капчу заново.');
                form.captcha.focus();
                return false;
            }
            return true;
        }
    </script>
</head>

<body class="body text-Quarion text-20px-000">

    <!-- header -->
    <header class="header flex-center">
        <div class="header__content">
            <a class="header__logo text-20px-000-bold" href="#"><img src="./images/logo.png" class="header__logo-img"><span class="header__logo-text"><span class="header__logo-eco-word">Eco</span>Portal</span>
            </a>
            <div class="header__phone text-20px-000">8 (960) 345-57-74</div>
        </div>
    </header>

    <!-- nav -->
    <nav class="nav flex-center">
        <div class="nav__content">
            <form action="index.php" method="get" class="nav__item">
                <input type="hidden" name="page" value="main">
                <input type="submit" value="Главная" class="nav__submit nav__submit_eco-theme text-18px-696969">
            </form>
            <form action="index.php" method="get" class="nav__item">
                <input type="hidden" name="page" value="red_book">
                <input type="submit" value="Красная книга" class="nav__submit nav__submit_eco-theme text-18px-696969">
            </form>
            <form action="index.php" method="get" class="nav__item">
                <input type="hidden" name="page" value="glob_warm">
                <input type="submit" value="Глобальное потепление" class="nav__submit nav__submit_eco-theme text-18px-696969">
            </form>
        </div>
    </nav>

    <!-- article -->
    <article class="article flex-center">
        <div class="article__content">
            <h1 class="article__header" align="center">
                <?php
                echo "$title"; //вывод заголовка
                ?>
                    <!-- разрыв кода -->
            </h1>
            <img class="article__img" src="
            <?php
                echo " $imglink "; //вывод картинки
                ?>">
            <p class="article__text">
                <?php
                echo "$text"; //вывод текста
                ?>
                    <!-- разрыв кода -->  
            </p>
            <div>
    </article>

    <article class="article flex-center">
        <div class="article__content">
            <h1 class="article__header" align="center">
                Комментарии
            </h1>

            <?php
              $db=mysqli_connect('localhost','root','','ecoportal');
              mysqli_select_db($db,'ecoportal');
              $result_set = mysqli_query($db,"SELECT * FROM `comments` WHERE `page_id`='$page_id'"); //Вытаскиваем все комментарии для данной страницы
              while ($str = mysqli_fetch_array($result_set)) //цикл для вывода всех кооментариев. mysqli_fetch_array берет результат и сдвигает указатель на следующий
              {

                //Вывод комментариев $str[2] -ник, $str[4] -дата, $str[3] -текст
                // Преобразуем спецсимволы в HTML-сущности
                $str[2]=htmlspecialchars($str[2]); 
                $str[3]=htmlspecialchars($str[3]); 
                $str[3]=nl2br(trim($str[3]));

                echo "
                <div class=\"comment comment_eco-theme text-16px-000\">
                  <div class=\"comment__header comment__header_eco-theme\">
                    <div>
                    $str[2] 
                    </div>
                    <div>
                    $str[4]
                  </div>
                </div>
                  <div class=\"comment__content comment__content_eco-theme\">
                  $str[3] 
                  </div>
                </div>
                ";
              }
            ?>

            <!-- форма отправки комментария -->
                <form class="comment-form" name="comment" action="comment.php" method="post" onsubmit="return checkForm(this);">
                    <p>
                        Добавить комментарий
                    </p>
                    <input class="comment-form__username" type="text" name="name" placeholder="Имя" required>
                    <textarea class="comment-form__text" name="text_comment" placeholder="Ваш комментарий..." required></textarea>

                    <!-- капча -->
                    <p><img src="/captcha.php" width="200" height="50" border="1" alt="CAPTCHA"></p>
                    <p><input class="captcha-input" type="text" size="6" maxlength="5" name="captcha" value=""></p>
                    <p class="captcha-help text-16px-000">Введите капчу</p>

                    <p>
                        <input type="hidden" name="page_id" value="<?php echo "$page_id"?>">
                        <input class="comment-form__send text-18px-fff comment-form__send_eco-theme" type="submit" value="Отправить">
                    </p>
                </form>

        </div>
    </article>

    <!-- footer -->
    <footer class="footer flex-center text-14px-696969">
        Copyright
    </footer>

</body>

</html>
<?php
    }
    ?>