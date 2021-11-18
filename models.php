<?php
/**
 * Устанавливает соединение с базой данных MySQL
 *
 * @return object Объект, который представляет соединение
 * с сервером MySQL
 */
function connectToMySQL($host, $user, $password, $database) {
    $connection = mysqli_connect($host, $user, $password, $database);
    if ($connection === false) {
        print("Ошибка подключения: " . mysqli_connect_error());
        //вставить шаблон с ошибкой подключения к БД
        exit();
    }
    else {
        mysqli_set_charset($connection, "utf8");
        return $connection;
    }
}

/**
 * Получает типы контента из базы данных MySQL
 *
 * @param $connection Объект, который представляет соединение
 * с сервером MySQL
 * @return array Типы контента
 */
function getTypesContent($connection) {
    $categoriesResult = mysqli_query($connection, 'SELECT
        id,
        name,
        class
    FROM contents');
    $categoriesRows = mysqli_fetch_all($categoriesResult, MYSQLI_ASSOC);
    return $categoriesRows;
}

/**
 * Получает посты и их авторов из базы данных MySQL
 *
 * @param $connection Объект, который представляет соединение
 * с сервером MySQL
 * @return array Посты с авторами
 */
function getPostWithAuthor($connection) {
    $postsResult = mysqli_query($connection, 'SELECT
        p.id AS postId,
        user_id,
        content_id,
        creation,
        title,
        content,
        author,
        picture,
        video,
        web,
        views,
        login,
        avatar,
        name,
        class
    FROM post p
    JOIN users u ON p.user_id = u.id
    JOIN contents c ON p.content_id = c.id
    ORDER BY views DESC');
    $postsRows = mysqli_fetch_all($postsResult, MYSQLI_ASSOC);
    return $postsRows;
}

/**
 * Получает посты из базы данных MySQL с фильтрацией по типу контента
 *
 * @param $connection Объект, который представляет соединение
 * с сервером MySQL
 * $contentFilterId Целое число - id типа контента, по которому происходит фильтрация
 * @return array Отфильтрованные посты
 */
function getPostWithContentFilter($connection, $contentFilterId) {
    $safeContentFilterId = mysqli_real_escape_string($connection, $contentFilterId);
    $query = "SELECT
        p.id AS postId,
        user_id,
        content_id,
        creation,
        title,
        content,
        author,
        picture,
        video,
        web,
        views,
        login,
        avatar,
        name,
        class
    FROM post p
    JOIN users u ON p.user_id = u.id
    JOIN contents c ON p.content_id = c.id
    WHERE p.content_id = $safeContentFilterId
    ORDER BY views DESC";
    $postsResult = mysqli_query($connection, $query);
    $postsRows = mysqli_fetch_all($postsResult, MYSQLI_ASSOC);
    return $postsRows;
}

/**
 * Получает пост из базы данных MySQL по id
 *
 * @param $connection Объект, который представляет соединение
 * с сервером MySQL
 * $postId Целое число - id искомого поста
 * @return запись из БД - пост
 */
function getPostById($connection, $postId) {
    $safePostId = mysqli_real_escape_string($connection, $postId);
    $query = "SELECT
        p.id AS postID,
        user_id,
        content_id,
        creation,
        title,
        content,
        author,
        picture,
        video,
        web,
        views,
        registration,
        login,
        avatar,
        name,
        class
    FROM post p
    JOIN contents c ON p.content_id = c.id
    JOIN users u ON p.user_id = u.id
    WHERE p.id = $safePostId";
    $postResult = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($postResult);
    return $post;
}

/**
 * Получает количество лайков поста из базы данных MySQL по id
 *
 * @param $connection Объект, который представляет соединение
 * с сервером MySQL
 * $postId Целое число - id искомого поста
 * @return целое число - количество лайков
 */
function getLikeCount($connection, $postId) {
    $safePostId = mysqli_real_escape_string($connection, $postId);
    $query = "SELECT * FROM likes WHERE post_id = $safePostId";
    $result = mysqli_query($connection, $query);
    $likeCount = mysqli_num_rows($result);
    return $likeCount;
}

/**
 * Получает количество комментариев поста из базы данных MySQL по id
 *
 * @param $connection Объект, который представляет соединение
 * с сервером MySQL
 * $postId Целое число - id искомого поста
 * @return целое число - количество комментариев
 */
function getCommentsCount($connection, $postId) {
    $safePostId = mysqli_real_escape_string($connection, $postId);
    $query = "SELECT * FROM comments WHERE post_id = $safePostId";
    $result = mysqli_query($connection, $query);
    $commentsCount = mysqli_num_rows($result);
    return $commentsCount;
}

/**
 * Получает количество подписчиков пользователя из базы данных MySQL по id
 *
 * @param $connection Объект, который представляет соединение
 * с сервером MySQL
 * $userId Целое число - id пользователя
 * @return целое число - количество подписчиков
 */
function getSubsCount($connection, $userId) {
    $safeUserId = mysqli_real_escape_string($connection, $userId);
    $query = "SELECT * FROM subscription WHERE user_id = $safeUserId";
    $result = mysqli_query($connection, $query);
    $subsCount = mysqli_num_rows($result);
    return $subsCount;
}

/**
 * Получает количество публикаций пользователя из базы данных MySQL по id
 *
 * @param $connection Объект, который представляет соединение
 * с сервером MySQL
 * $userId Целое число - id пользователя
 * @return целое число - количество постов
 */
function getPostsCount($connection, $userId) {
    $safeUserId = mysqli_real_escape_string($connection, $userId);
    $query = "SELECT * FROM post WHERE user_id = $safeUserId";
    $result = mysqli_query($connection, $query);
    $postsCount = mysqli_num_rows($result);
    return $postsCount;
}

/**
 * В ассоциативном массиве получает:
 * количество лайков поста;
 * количество комментариев поста;
 * количество подписчиков пользователя;
 * количество публикаций пользователя
 *
 * @param $connection Объект, который представляет соединение
 * с сервером MySQL
 * $postId Целое число - id искомого поста
 * $userId Целое число - id пользователя
 *
 * @return целое число - количество постов
 */
function getPostAndUserInformation($connection, $postId, $userId) {
    $likeCount = getLikeCount($connection, $postId);
    $commentsCount = getCommentsCount($connection, $postId);
    $subsCount = getSubsCount($connection, $userId);
    $postsCount = getPostsCount($connection, $userId);
    $information = array(
        'likeCount' => $likeCount,
        'commentsCount' => $commentsCount,
        'subsCount' => $subsCount,
        'postsCount' => $postsCount
    );
    return $information;
}

?>
