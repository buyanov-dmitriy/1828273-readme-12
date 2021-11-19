<section class="adding-post__<?=$category?> tabs__content tabs__content--active tabs__content--active">
  <h2 class="visually-hidden">Форма добавления <?=$categoryName?></h2>
  <form class="adding-post__form form" action="add.php?categoryId=1" method="post" enctype="multipart/form-data">
    <div class="form__text-inputs-wrapper">
      <div class="form__text-inputs">
        <?=$textInputs['header']?>
        <?=$textInputs['linkPhoto']?>
        <?=$textInputs['linkVideo']?>
        <?=$textInputs['text']?>
        <?=$textInputs['quote']?>
        <?=$textInputs['author']?>
        <?=$textInputs['tegs']?>
      </div>
      <div class="form__invalid-block">
        <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
        <ul class="form__invalid-list">
          <li class="form__invalid-item">Заголовок. Это поле должно быть заполнено.</li>
        </ul>
      </div>
    </div>
    <?=$formPhoto?>
    <div class="adding-post__buttons">
      <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
      <a class="adding-post__close" href="#">Закрыть</a>
    </div>
  </form>
</section>
