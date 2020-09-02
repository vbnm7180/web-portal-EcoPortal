<?php

session_start();
if($_POST['captcha'] != $_SESSION['digit']) //провека капчи

//если она не верна выводим сообщение
{
  echo "<!doctype=html>
        <html>
        <head>
           <link rel=\"stylesheet\" href=\"./css/block-styles-desktop.css\">
           <link rel=\"stylesheet\" href=\"./css/block-styles-mobile.css\">
           <link rel=\"stylesheet\" href=\"./css/font-sizes.css\">
           <link rel=\"stylesheet\" href=\"./css/font-styles.css\"> 
        </head>
        <body class=\"text-Quarion\">
          <div class=\"warning-content\">
            <div class=\"captcha-warning text-25px-000\">Капча введена неверно! Попробуйте ввести капчу заново.</div>
            <input class=\"captcha-warning-button captcha-warning-button_eco-theme text-18px-000\" type=\"button\" onclick=\"history.back();\" value=\"Назад\"/>
          </div>
        </body>
        </html>    
            "; ;
session_destroy();}

//если все верно, выводим комментарий
else

{
  //session_destroy();
  /* Отправляем данные из формы */

  $name = $_POST["name"];
  $page_id = $_POST["page_id"];
  $text_comment = $_POST["text_comment"];

  //дата
  date_default_timezone_set('Europe/Samara');
  $months=array('','января', 'февраля','марта', 'апреля','мая','июня','июля','августа','сентября','октября','ноября','декабря');
  $date = date(' d ') . $months[(int)date('n')] . date(' Y') . date(' H:i');

  //Сохранение переноса строк
   //$text_comment=substr(nl2br(trim($text_comment)),0,1000);

   //подключение к бд
   $db=mysqli_connect('localhost','root','','ecoportal'); 
  mysqli_select_db($db,'ecoportal');
  $new_name=mysqli_real_escape_string($db,$name); //Экранируются символы для безопасной отправки в бд
  $new_page_id=mysqli_real_escape_string($db,$page_id);
  $new_text_comment=mysqli_real_escape_string($db,$text_comment);
  $new_date=mysqli_real_escape_string($db,$date);
  mysqli_query($db,"INSERT INTO `comments` (`name`, `page_id`, `text_comment`,`date`) VALUES ('$new_name', '$new_page_id', '$new_text_comment','$new_date')");// Добавляем комментарий в таблицу
  header("Location: ".$_SERVER["HTTP_REFERER"]);// Делаем реридект обратно
}
?>