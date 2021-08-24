USE readme;

/*Добавление списка типов контента для постов*/
INSERT INTO `contents` (`id`, `name`, `class`)
  VALUES
    (1, 'Текст', 'text'),
    (2, 'Цитата', 'quote'),
    (3, 'Картинка', 'photo'),
    (4, 'Видео', 'video'),
    (5, 'Ссылка', 'link');

/*Добавление списка пользователей*/
INSERT INTO `users` (`id`, `registration`, `email`, `login`, `password`, `avatar`)
  VALUES
    (1, '2021-08-10 20:52:41', 'user_1@gmail.com', 'user_1', '1user', 'avatar_adress_user_1'),
    (2, '2021-08-01 18:32:12', 'user_2@gmail.com', 'user_2', '2user', 'avatar_adress_user_2'),
    (3, '2021-08-07 15:10:32', 'user_3@gmail.com', 'user_3', '3user', 'avatar_adress_user_3');

/*Добавление списка постов*/
INSERT INTO `post` (`id`, `user_id`, `content_id`, `creation`, `title`, `content`, `author`, `picture`, `video`, `web`, `views`)
  VALUES
    (1, 1, 1, '2021-08-12 10:52:41', 'Это 1ый пост: текст', 'Это содержимое текстового поста с id = 1', NULL, NULL, NULL, NULL, 44),
    (2, 1, 4, '2021-08-14 11:12:34', 'Это 2ой пост: видео', NULL, NULL, NULL, 'link_to_video_2', NULL, 14),
    (3, 1, 2, '2021-08-16 17:22:14', 'Это 3ий пост: цитата', NULL, 'Автор цитаты 3го поста', NULL, NULL, NULL, 5),
    (4, 2, 3, '2021-08-03 12:12:12', 'Это 4ый пост: картинка', NULL, NULL, 'link_to_picture_4', NULL, NULL, 76),
    (5, 2, 5, '2021-08-07 16:21:11', 'Это 5ый пост: ссылка', NULL, NULL, NULL, NULL, 'linkt_to_website_5', 34),
    (6, 2, 1, '2021-08-17 12:21:22', 'Это 6ой пост: текст', 'Это содержимое текстового поста с id = 6', NULL, NULL, NULL, NULL, 42),
    (7, 3, 4, '2021-08-10 11:12:34', 'Это 7ой пост: видео', NULL, NULL, NULL, 'link_to_video_7', NULL, 74),
    (8, 3, 2, '2021-08-14 17:22:14', 'Это 8ой пост: цитата', NULL, 'Автор цитаты 8го поста', NULL, NULL, NULL, 58),
    (9, 3, 3, '2021-08-17 12:12:12', 'Это 9ый пост: картинка', NULL, NULL, 'link_to_picture_9', NULL, NULL, 76);

/*Добавление списка комментариев*/
INSERT INTO `comments`(`id`, `user_id`, `post_id`, `creation`, `content`)
  VALUES
    (1, 1, 4, '2021-08-13 12:12:12', 'Это 1й комментарий'),
    (2, 1, 5, '2021-08-14 16:21:11', 'Это 2й комментарий'),
    (3, 1, 6, '2021-08-18 12:21:22', 'Это 3й комментарий'),
    (4, 2, 7, '2021-08-13 10:52:41', 'Это 4й комментарий'),
    (5, 2, 8, '2021-08-15 11:12:34', 'Это 5й комментарий'),
    (6, 2, 9, '2021-08-19 11:12:34', 'Это 6й комментарий'),
    (7, 3, 1, '2021-08-14 11:12:34', 'Это 7й комментарий'),
    (8, 3, 2, '2021-08-15 17:22:14', 'Это 8й комментарий'),
    (9, 3, 3, '2021-08-18 12:12:12', 'Это 9й комментарий');

/*получить список постов с сортировкой по популярности и вместе с именами авторов и типом контента*/
SELECT p.id, login, name, creation, title, content, author, picture, video, web, views FROM post p
  JOIN users u ON p.user_id = u.id
  JOIN contents c ON p.content_id = c.id
ORDER BY views DESC;

/*получить список постов для конкретного пользователя, в данном случае это пользователь user_2*/
SELECT p.id, login, name, creation, title, content, author, picture, video, web, views FROM post p
  JOIN users u ON p.user_id = u.id
  JOIN contents c ON p.content_id = c.id
WHERE u.login = 'user_2'
ORDER BY views DESC;

/*получить список комментариев для одного поста, в комментариях должен быть логин пользователя, в данном
случае для поста с id = 5*/
SELECT c.id, u.login, c.creation, c.content FROM comments c
  JOIN users u ON c.user_id = u.id
  JOIN post p ON c.post_id = p.id
WHERE p.id = 5;

/*добавить лайк к посту*/
INSERT INTO likes (user_id, post_id) VALUES (3, 2);

/*подписаться на пользователя*/
INSERT INTO subscription (user_id, user_id_subscribed) VALUES (1, 3);
