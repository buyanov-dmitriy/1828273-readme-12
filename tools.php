<?php
/**
 * Обрезает строку, длина которой превышает заданное количество символов (300 - по умолчанию)
 * Если длина строки меньше заданного количества символов, возвращает оригинальный текст
 * В противном случа происходит обрезание таким образом, чтобы строка не оканчиавалась частью слова
 * При обрезании, в конце строки добавляется троеточие
 *
 * @param string $str Строка, которую необходимо обрезать
 * @param $length Максимальная длина строки
 * @return string Обрезанная, при необходимости, строка
 */
function cut_text (string $str, $length = 300) {
    if (iconv_strlen($str) <= $length) {
        return $str;
    }
    $str_new = mb_substr($str, 0, $length);
    $last_whitespace = mb_strripos($str_new, ' ', 0);
    return mb_substr($str_new, 0, $last_whitespace) . '...';
};

/**
 * Преобразаует дату в оригинальном формате в относительный формат
 * Ориентируясь на текущую дату
 *
 * Примеры до/после
 * Предположим, что текущее время: 12 ноября 2019 года, 04:20. Тогда для следующих дат публикации формат будет таким:
 * 2019-11-12 04:05 > 15 минут назад;
 * 2019-11-12 02:10 > 2 часа назад;
 * 2019-11-10 09:45 > 2 дня назад;
 * и т. д.
 *
 * @param string $post_date Строка, содержащая дату
 * @return string Строка, содержащая дату в относительном формате
 */
function show_relative_format($post_date) {
    $cur_date = strtotime(date('Y-m-d H:i:s'));
    $diff = $cur_date - strtotime($post_date);
    switch(true) {
        case ($diff < 3600):
            return(ceil($diff / 60) . ' ' . get_noun_plural_form(ceil($diff / 60), 'минута', 'минуты', 'минут') . ' назад');
        case ($diff < 86400):
            return(ceil($diff / 3600) . ' ' . get_noun_plural_form(ceil($diff / 3600), 'час', 'часа', 'часов') . ' назад');
        case ($diff < 604800):
            return(ceil($diff / 86400) . ' ' . get_noun_plural_form(ceil($diff / 86400), 'день', 'дня', 'дней') . ' назад');
        case ($diff < 3024000):
            return(ceil($diff / 604800) . ' ' . get_noun_plural_form(ceil($diff / 604800), 'неделя', 'недели', 'недель') . ' назад');
        default:
            return(ceil($diff / 3024000) . ' ' . get_noun_plural_form(ceil($diff / 3024000), 'месяц', 'месяца', 'месяцев') . ' назад');
    }
};
?>
