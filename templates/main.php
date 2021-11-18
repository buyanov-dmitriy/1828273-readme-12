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
                        <?php $activeClass = !isset($_GET['categoryId']) ? 'filters__button--active' : '' ?>
                        <a class="filters__button filters__button--ellipse filters__button--all <?=$activeClass?>" href="/index.php">
                            <span>Все</span>
                        </a>
                    </li>
                    <?php
                        foreach ($contentTypeIcons as $contentTypeIcon) {
                            print($contentTypeIcon);
                        }
                    ?>
                </ul>
            </div>
        </div>
        <div class="popular__posts">
            <?php
            foreach ($posts as $key => $post): ?>
            <article class="popular__post post post-<?=$post['class'];?>">
                <header class="post__header">
                    <h2><a href=<?='/post.php?postId=' . $post['postId']?>><?=$post['title'];?></a></h2>
                </header>
                <div class="post__main">
                    <?php
                        if (!empty($post['picture'])) {
                            $postContent = $post['picture'];
                        }
                        elseif (!empty($post['video'])) {
                            $postContent = $post['video'];
                        }
                        elseif (!empty($post['web'])) {
                            $postContent = $post['web'];
                        }
                        else {
                            $postContent = $post['content'];
                        }
                        $content = include_template('post-' . $post['class'] . '.php', ['content' => $postContent, 'title' => $post['title'], 'quote' => $post['author']]);
                        print($content);
                    ?>
                </div>
                <footer class="post__footer">
                    <div class="post__author">
                        <a class="post__author-link" href="#" title="Автор">
                            <div class="post__avatar-wrapper">
                                <img class="post__author-avatar" src="img/<?=$post['avatar'];?>" alt="Аватар пользователя">
                            </div>
                            <div class="post__info">
                                <b class="post__author-name"><?=$post['login'];?></b>
                                <?php $post_date = generate_random_date((int) ($key));
                                $post_date = $post['creation'];
                                ?>
                                <time title="<?php print(date('d.m.Y H:i', strtotime($post_date))) ?>" class="post__time" datetime="<?= $post_date; ?>"><?=showRelativeFormat($post_date);?> назад</time>
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
                                <span><?=$post['likeCount']?></span>
                                <span class="visually-hidden">количество лайков</span>
                            </a>
                            <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                                <svg class="post__indicator-icon" width="19" height="17">
                                    <use xlink:href="#icon-comment"></use>
                                </svg>
                                <span><?=$post['commentsCount']?></span>
                                <span class="visually-hidden">количество комментариев</span>
                            </a>
                        </div>
                    </div>
                </footer>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
