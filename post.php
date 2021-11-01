<?php
require_once('helpers.php');
require_once('models.php');
include('config.php');
require_once('tools.php');

if (isset($_GET['postId'])) {
    $currentPost = getPostById($connect, $_GET['postId']);
    if (count($currentPost) === 1) {
        $likesCount = getLikeCount($connect, $_GET['postId']);
        $commentsCount = getCommentsCount($connect, $_GET['postId']);
        $subsCount = getSubsCount($connect, $currentPost[0]['user_id']);
        $postsCount = getPostsCount($connect, $currentPost[0]['user_id']);
        $post_content = include_template('post-' . $currentPost[0]['class'] . '-main.php',
        ['img_url' => $currentPost[0]['picture'],
        'url' => $currentPost[0]['web'],
        'title' => $currentPost[0]['title'],
        'youtube_url' => $currentPost[0]['video'],
        'text' => $currentPost[0]['content'],
        'author' => $currentPost[0]['author']
    ]);
        $post_page = include_template('post-template.php',
        ['post_content' => $post_content,
        'title' => $currentPost[0]['title'],
        'postClass' => $currentPost[0]['class'],
        'login' => $currentPost[0]['login'],
        'avatar' => $currentPost[0]['avatar'],
        'likesCount' => $likesCount[0]['COUNT(*)'],
        'commentsCount' => $commentsCount[0]['COUNT(*)'],
        'views' => $currentPost[0]['views'],
        'subsCount' => $subsCount[0]['COUNT(*)'],
        'postsCount' => $postsCount[0]['COUNT(*)'],
        'registration' => $currentPost[0]['registration']
    ]);
        print($post_page);
    }
}
else {
    http_response_code(404);
}
?>
