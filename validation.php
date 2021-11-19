<?php
/**
 * Сохраняет значение полей формы после валидации
 *
 * @param string $name атрибут "name" поля формы
 * @return string Строка - введенные данные в поле формы
 */
function getPostVal($name) {
    return $_POST[$name] ?? "";
}

/**
 * Сохраняет значение полей формы после валидации
 *
 * @param string $name атрибут "name" поля формы
 * @return string Строка - введенные данные в поле формы
 */
function validateTags($name) {

    return getPostVal($name);
}
?>
