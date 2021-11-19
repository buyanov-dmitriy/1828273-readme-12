<li class="adding-post__tabs-item filters__item">
    <a class="adding-post__tabs-link filters__button filters__button--<?=$category;?> tabs__item  button <?=$activeClass;?>" href="<?=$url;?>">
        <svg class="filters__icon" width="<?=$width;?>" height="<?=$height;?>">
            <use xlink:href="#icon-filter-<?=$category;?>"></use>
        </svg>
        <span><?=$categoryName?></span>
    </a>
</li>
