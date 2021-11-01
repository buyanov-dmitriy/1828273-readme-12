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
    $categoriesResult = mysqli_query($connection, 'SELECT * FROM contents');
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
    $postsResult = mysqli_query($connection, 'SELECT *, p.id AS postID FROM post p JOIN users u ON p.user_id = u.id JOIN contents c ON p.content_id = c.id ORDER BY views DESC');
    $postsRows = mysqli_fetch_all($postsResult, MYSQLI_ASSOC);
    return $postsRows;
}

/**
 * Получает посты из базы данных MySQL с фильтрацией по типу контента
 *
 * @param $connection Объект, который представляет соединение
 * с сервером MySQL
 * $contentFIlterID Целое число - id типа контента, по которому происходит фильтрация
 * @return array Отфильтрованные посты
 */
function getPostWithContentFilter($connection, $contentFIlterID) {
    $query = "SELECT *, p.id AS postID FROM post p JOIN users u ON p.user_id = u.id JOIN contents c ON p.content_id = c.id WHERE p.content_id = $contentFIlterID ORDER BY views DESC";
    $postsResult = mysqli_query($connection, $query);
    $postsRows = mysqli_fetch_all($postsResult, MYSQLI_ASSOC);
    return $postsRows;
}

/**
 * Получает пост из базы данных MySQL по id
 *
 * @param $connection Объект, который представляет соединение
 * с сервером MySQL
 * $postID Целое число - id искомого поста
 * @return array Пост
 */
function getPostById($connection, $postID) {
    $query = "SELECT * FROM post p JOIN contents c ON p.content_id = c.id JOIN users u ON p.user_id = u.id WHERE p.id = $postID";
    $postsResult = mysqli_query($connection, $query);
    $postsRows = mysqli_fetch_all($postsResult, MYSQLI_ASSOC);
    return $postsRows;
}

/**
 * Получает количество лайков поста из базы данных MySQL по id
 *
 * @param $connection Объект, который представляет соединение
 * с сервером MySQL
 * $postID Целое число - id искомого поста
 * @return array Пост
 */
function getLikeCount($connection, $postID) {
    $query = "SELECT COUNT(*) FROM likes WHERE post_id = $postID";
    $postsResult = mysqli_query($connection, $query);
    $postsRows = mysqli_fetch_all($postsResult, MYSQLI_ASSOC);
    return $postsRows;
}

/**
 * Получает количество комментариев поста из базы данных MySQL по id
 *
 * @param $connection Объект, который представляет соединение
 * с сервером MySQL
 * $postID Целое число - id искомого поста
 * @return array Пост
 */
function getCommentsCount($connection, $postID) {
    $query = "SELECT COUNT(*) FROM comments WHERE post_id = $postID";
    $postsResult = mysqli_query($connection, $query);
    $postsRows = mysqli_fetch_all($postsResult, MYSQLI_ASSOC);
    return $postsRows;
}

/**
 * Получает количество подписчиков пользователя из базы данных MySQL по id
 *
 * @param $connection Объект, который представляет соединение
 * с сервером MySQL
 * $userID Целое число - id пользователя
 * @return array Пост
 */
function getSubsCount($connection, $userID) {
    $query = "SELECT COUNT(*) FROM subscription WHERE user_id = $userID";
    $postsResult = mysqli_query($connection, $query);
    $postsRows = mysqli_fetch_all($postsResult, MYSQLI_ASSOC);
    return $postsRows;
}

/**
 * Получает количество публикаций пользователя из базы данных MySQL по id
 *
 * @param $connection Объект, который представляет соединение
 * с сервером MySQL
 * $userID Целое число - id пользователя
 * @return array Пост
 */
function getPostsCount($connection, $userID) {
    $query = "SELECT COUNT(*) FROM post WHERE user_id = $userID";
    $postsResult = mysqli_query($connection, $query);
    $postsRows = mysqli_fetch_all($postsResult, MYSQLI_ASSOC);
    return $postsRows;
}

?>
