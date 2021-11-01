<?php
require_once('helpers.php');
require_once('tools.php');
require_once('models.php');
require_once('config.php');

$is_auth = rand(0, 1);
$user_name = 'Буянов Дмитрий'; // укажите здесь ваше имя
$title = 'readme: популярное';

$page_content = include_template('main.php', ['categories' => getTypesContent($connect), 'posts' => getPostWithAuthor($connect), 'connect' => $connect]);
$layout_content = include_template('layout.php', ['title' => $title, 'content' => $page_content, 'is_auth' => $is_auth]);
print($layout_content);
?>
