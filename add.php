<?php
    require_once('helpers.php');
    require_once('tools.php');
    require_once('models.php');
    require_once('config.php');

    $categories = getTypesContent($connect);
    $filterButtons = array();
    $forms = array();
    foreach ($categories as $key => $category) {
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
        $activeClass = $key === 0 ? 'filters__button--active tabs__item--active' : '';
        if (isset($_GET['categoryId'])) {
            $activeClass = $_GET['categoryId'] === $category['id'] ? 'filters__button--active tabs__item--active' : '';
        }
        $filterButton = include_template('adding-post__tabs-item.php', [
            'category' => $category['class'],
            'categoryName' => $category['name'],
            'width' => $width,
            'height' => $height,
            'activeClass' => $activeClass,
            'url' => $url
        ]);
        array_push($filterButtons, $filterButton);
    }
    $required_fields = [];
    $errors = [];
    $formTemplate = '';
    if (isset($_GET['categoryId'])) {
        $key = array_search($_GET['categoryId'], array_column($categories, 'id'));
        $category = $categories[$key]['class'];
        $categoryName = $categories[$key]['name'];
        $header = include_template('adding-post-form-header.php', ['category' => $category]);
        $tegs = include_template('adding-post-form-tegs.php', ['category' => $category]);
        $textInputs = [
            'header' => $header,
            'tegs' => $tegs,
            'linkPhoto' => '',
            'linkVideo' => '',
            'text' => '',
            'quote' => '',
            'author' => '',
            'link' => ''
        ];
        $formPhoto = '';
        if ($category === 'photo') {
            $linkPhoto = include_template('adding-post-form-link-photo.php');
            $formPhoto = include_template('adding-post-form-photo.php');
            $textInputs['linkPhoto'] = $linkPhoto;
        }
        elseif ($category === 'video') {
            $linkVideo = include_template('adding-post-form-link-video.php');
            $textInputs['linkVideo'] = $linkVideo;
        }
        elseif ($category === 'text') {
            $text = include_template('adding-post-form-text.php');
            $textInputs['text'] = $text;
            $required_fields = ['text-header', 'post-text', 'text-tags'];
        }
        elseif ($category === 'quote') {
            $quote = include_template('adding-post-form-quote.php');
            $author = include_template('adding-post-form-author.php');
            $textInputs['quote'] = $quote;
            $textInputs['author'] = $author;
        }
        else {
            $link = include_template('adding-post-form-link.php', ['category' => $category]);
            $textInputs['link'] = $link;
        }
        $formTemplate = include_template('adding-post-form.php', [
            'category' => $category,
            'categoryName' => $categoryName,
            'textInputs' => $textInputs,
            'formPhoto' => $formPhoto
        ]);
    }

    $page = include_template('adding-post.php', ['filterButtons' => $filterButtons, 'form' => $formTemplate]);

    print($page);

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = 'Поле не заполнено';
        }
    }
    echo(count($errors));
