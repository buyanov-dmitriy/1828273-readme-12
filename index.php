<?php
require_once('helpers.php');
require_once('tools.php');
date_default_timezone_set('Europe/Moscow');

$is_auth = rand(0, 1);
$user_name = 'Буянов Дмитрий'; // укажите здесь ваше имя
$title = 'readme: популярное';

$page_content = include_template('main.php');
$layout_content = include_template('layout.php', ['title' => 'readme: популярное', 'content' => $page_content, 'is_auth' => $is_auth]);
print($layout_content);
?>
