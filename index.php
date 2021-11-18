<?php
require_once('helpers.php');
require_once('tools.php');
require_once('models.php');
require_once('config.php');

$isAuth = rand(0, 1);
$userName = 'Буянов Дмитрий'; // укажите здесь ваше имя
$title = 'readme: популярное';

$posts = getPostWithAuthor($connect);
if (isset($_GET['categoryId'])) {
    $posts = getPostWithContentFilter($connect, $_GET['categoryId']);
}
foreach($posts as &$post) {
    $likeCount = getLikeCount($connect, $post['postId']);
    $commentsCount = getCommentsCount($connect, $post['postId']);
    $post += ['likeCount' => $likeCount];
    $post += ['commentsCount' => $commentsCount];
}

$categories = getTypesContent($connect);
$contentTypeIcons = array();
foreach ($categories as $category) {
    switch($category['name']) {
        case ('Фото'):
            $width = 22;
            $height = 18;
            break;
        case ('Видео'):
            $width = 24;
            $height = 16;
            break;
        case ('Текст'):
            $width = 20;
            $height = 21;
            break;
        case ('Цитата'):
            $width = 21;
            $height = 20;
            break;
        default:
            $width = 21;
            $height = 18;
    }; //определили ширину и высоту иконки
    $params = array(
        'categoryId' => $category['id']
    );
    $currentUrl = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $currentUrl = explode('?', $currentUrl);
    $currentUrl = $currentUrl[0];
    $url = $currentUrl . '?' . http_build_query($params, '\n');
    $activeClass = '';
    if (isset($_GET['categoryId'])) {
        $activeClass = $_GET['categoryId'] === $category['id'] ? 'filters__button--active' : '';
    }
    $contentTypeIcon = include_template('content-type-icon.php', ['activeClass' => $activeClass, 'url' => $url, 'category' => $category['name'], 'width' => $width, 'height' => $height, 'class' => $category['class']]);
    array_push($contentTypeIcons, $contentTypeIcon);
}

$pageContent = include_template('main.php', ['posts' => $posts, 'contentTypeIcons' => $contentTypeIcons]);
$layoutContent = include_template('layout.php', ['userName' => $userName, 'title' => $title, 'content' => $pageContent, 'isAuth' => $isAuth]);

print($layoutContent);
