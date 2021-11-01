<?php
    $width;
    $height;
    switch($category) {
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
    };
    $currentUrl = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $currentUrl = explode('?', $currentUrl);
    $currentUrl = $currentUrl[0];
    $url = $currentUrl . "?categoryId=" . $id;
    if (isset($_GET['categoryId'])) {
        $activeClass = $_GET['categoryId'] === $id ? 'filters__button--active' : '';
    }
?>
<li class="popular__filters-item filters__item">
    <a class="filters__button filters__button--photo button <?=$activeClass?>" href="<?=$url;?>">
        <span class="visually-hidden"><?=$category;?></span>
        <svg class="filters__icon" width="<?=$width;?>" height="<?=$height;?>">
            <use xlink:href="#icon-filter-<?=$class;?>"></use>
        </svg>
    </a>
</li>
