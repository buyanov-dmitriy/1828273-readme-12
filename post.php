<?php
require_once('helpers.php');
require_once('models.php');
require_once('config.php');
require_once('tools.php');

if (isset($_GET['postId'])) {
    $currentPost = getPostById($connect, $_GET['postId']);
    if (!empty($currentPost)) {
        $information = getPostAndUserInformation($connect, $_GET['postId'], $currentPost['user_id']);
        $postContent = include_template('post-' . $currentPost['class'] . '-main.php',
            ['img_url' => $currentPost['picture'],
            'url' => $currentPost['web'],
            'title' => $currentPost['title'],
            'youtube_url' => $currentPost['video'],
            'text' => $currentPost['content'],
            'author' => $currentPost['author']
        ]);
        $postPage = include_template('post-template.php',
            ['postContent' => $postContent,
            'title' => $currentPost['title'],
            'postClass' => $currentPost['class'],
            'login' => $currentPost['login'],
            'avatar' => $currentPost['avatar'],
            'likesCount' => $information['likeCount'],
            'commentsCount' => $information['commentsCount'],
            'views' => $currentPost['views'],
            'subsCount' => $information['subsCount'],
            'postsCount' => $information['postsCount'],
            'registration' => $currentPost['registration']
        ]);
        print($postPage);
    }
}
else {
    http_response_code(404);
}
