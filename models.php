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
    $postsResult = mysqli_query($connection, 'SELECT * FROM post p JOIN users u ON p.user_id = u.id JOIN contents c ON p.content_id = c.id ORDER BY views DESC');
    $postsRows = mysqli_fetch_all($postsResult, MYSQLI_ASSOC);
    return $postsRows;
}
?>
