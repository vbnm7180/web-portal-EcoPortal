<?php

require_once 'templates.php'; //подключение файла отрисовки страницы

$db = mysqli_connect( 'localhost', 'root', '', 'ecoportal' ); //соединение с бд 'ecoportal'
mysqli_select_db( $db, 'ecoportal' ); //присваивание имени для дальнейшего обращения к бд

/*Получение переменной page из Get-запроса при переходе по разделам сайта
Берется page, если она не существует ( первое открытие ), то page = main*/
$page = $_GET['page'] ?? 'main';

//выбор страницы
switch( $page ) {
    case 'main':
    $res = mysqli_query( $db, 'SELECT * FROM `articles` WHERE `id`=1' ); //выбор заголовка и текста страницы из бд
    $row = mysqli_fetch_array( $res ); //обработка выбранных данных
    $title = $row[1]; //заголовок страницы
    $text = $row[2]; //текст страницы
    $imglink = $row[3]; //ссылка на картинку страницы
	break;
	
    case 'glob_warm':
    $res = mysqli_query( $db, 'SELECT * FROM `articles` WHERE `id`=2' );
    $row = mysqli_fetch_array( $res );
    $title = $row[1];
    $text = $row[2];
    $imglink = $row[3];
	break;
	
    case 'red_book':
    $res = mysqli_query( $db, 'SELECT * FROM `articles` WHERE `id`=3' );
    $row = mysqli_fetch_array( $res );
    $title = $row[1];
    $text = $row[2];
    $imglink = $row[3];
	break;
	
    default:header( 'HTTP/1.0 404 Not Found' );
    echo 'Страница не найдена';
    break;
}
show_page( $title, $text, $imglink ); //функция отрисовки страницы из templates.php

?>
