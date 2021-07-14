<?php
//функция обрезания строки, если ее длина больше 300 символов
function cut_text (string $str, $length = 300) {
    if (iconv_strlen($str) <= $length) {
        return $str;
    }
    $str_new = mb_substr($str, 0, $length);
    $last_whitespace = mb_strripos($str_new, ' ', 0);
    return mb_substr($str_new, 0, $last_whitespace) . '...';
};
?>
