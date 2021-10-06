<?php
$connection = mysqli_connect("localhost", "root", "", "readme"); //пароль убрал, так как у меня там много БД лежит своих
mysqli_set_charset($connection, "utf8");
$categoriesResult;
$categoriesRows;
$postsResult;
$postsRows;
$sqlQueries = [
    'selectTypeContent' => 'SELECT * FROM contents',
    'selectPostsWithAuthor' => 'SELECT * FROM post p JOIN users u ON p.user_id = u.id JOIN contents c ON p.content_id = c.id ORDER BY views DESC'
];
if ($connection == false) {
    print("Ошибка подключения: " . mysqli_connect_error());
}
else {
    $categoriesResult = mysqli_query($connection, $sqlQueries['selectTypeContent']);
    $categoriesRows = mysqli_fetch_all($categoriesResult, MYSQLI_ASSOC);
    $postsResult = mysqli_query($connection, $sqlQueries['selectPostsWithAuthor']);
    $postsRows = mysqli_fetch_all($postsResult, MYSQLI_ASSOC);
}
?>
<div class="container">
        <h1 class="page__title page__title--popular">Популярное</h1>
    </div>
    <div class="popular container">
        <div class="popular__filters-wrapper">
            <div class="popular__sorting sorting">
                <b class="popular__sorting-caption sorting__caption">Сортировка:</b>
                <ul class="popular__sorting-list sorting__list">
                    <li class="sorting__item sorting__item--popular">
                        <a class="sorting__link sorting__link--active" href="#">
                            <span>Популярность</span>
                            <svg class="sorting__icon" width="10" height="12">
                                <use xlink:href="#icon-sort"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="sorting__item">
                        <a class="sorting__link" href="#">
                            <span>Лайки</span>
                            <svg class="sorting__icon" width="10" height="12">
                                <use xlink:href="#icon-sort"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="sorting__item">
                        <a class="sorting__link" href="#">
                            <span>Дата</span>
                            <svg class="sorting__icon" width="10" height="12">
                                <use xlink:href="#icon-sort"></use>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="popular__filters filters">
                <b class="popular__filters-caption filters__caption">Тип контента:</b>
                <ul class="popular__filters-list filters__list">
                    <li class="popular__filters-item popular__filters-item--all filters__item filters__item--all">
                        <a class="filters__button filters__button--ellipse filters__button--all filters__button--active" href="#">
                            <span>Все</span>
                        </a>
                    </li>
                    <?php
                        foreach ($categoriesRows as $category) {
                            $contentTypeIcon = include_template('content-type-icon.php', ['category' => $category['name'], 'class' => $category['class']]);
                            print($contentTypeIcon);
                        }
                    ?>
                </ul>
            </div>
        </div>
        <div class="popular__posts">
            <?php foreach ($postsRows as $key => $card): ?>
            <article class="popular__post post post-<?=$card['class'];?>">
                <header class="post__header">
                    <h2><?=$card['title'];?></h2>
                </header>
                <div class="post__main">
                    <?php
                        $cardContent;
                        if ($card['picture'] != '') {
                            $cardContent = $card['picture'];
                        }
                        elseif ($card['video'] != '') {
                            $cardContent = $card['video'];
                        }
                        elseif ($card['web'] != '') {
                            $cardContent = $card['web'];
                        }
                        else {
                            $cardContent = $card['content'];
                        }
                        $content = include_template('post-' . $card['class'] . '.php', ['content' => $cardContent, 'title' => $card['title'], 'quote' => $card['author']]);
                        print($content);
                    ?>
                </div>
                <footer class="post__footer">
                    <div class="post__author">
                        <a class="post__author-link" href="#" title="Автор">
                            <div class="post__avatar-wrapper">
                                <img class="post__author-avatar" src="img/<?=$card['avatar'];?>" alt="Аватар пользователя">
                            </div>
                            <div class="post__info">
                                <b class="post__author-name"><?=$card['login'];?></b>
                                <?php $post_date = generate_random_date((int) ($key));
                                $post_date = $card['creation'];
                                ?>
                                <time title="<?php print(date('d.m.Y H:i', strtotime($post_date))) ?>" class="post__time" datetime="<?= $post_date; ?>"><?php print(show_relative_format($post_date)); ?></time>
                            </div>
                        </a>
                    </div>
                    <div class="post__indicators">
                        <div class="post__buttons">
                            <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                                <svg class="post__indicator-icon" width="20" height="17">
                                    <use xlink:href="#icon-heart"></use>
                                </svg>
                                <svg class="post__indicator-icon post__indicator-icon--like-active" width="20" height="17">
                                    <use xlink:href="#icon-heart-active"></use>
                                </svg>
                                <span>0</span>
                                <span class="visually-hidden">количество лайков</span>
                            </a>
                            <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                                <svg class="post__indicator-icon" width="19" height="17">
                                    <use xlink:href="#icon-comment"></use>
                                </svg>
                                <span>0</span>
                                <span class="visually-hidden">количество комментариев</span>
                            </a>
                        </div>
                    </div>
                </footer>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
