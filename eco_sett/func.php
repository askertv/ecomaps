<?php

function save_icon ($file_load) {

    //Папка для хранения файлов с уменьшенными изображениями
    $folder_icon = "ecomaps/eco_map_icons";

    //Генерация уникального имени
    $file_map_icon = uniqid("");

    //Добавление расширения к имени файла
    switch ($file_load['type']) {
    case 'image/pjpeg':
        $file_map_icon .= ".jpg";
        break;
    case 'image/gif';
        $file_map_icon .= ".gif";
        break;
    }

    //Добавление имени папки к имени файла
    $file_map_icon = $folder_icon."/".$file_map_icon;

    //Копирование загруженого файла в папку для хранения
    copy ($file_load['tmp_name'], $file_map_icon);

    return $file_map_icon;
}


function save_image ($file_image) {

    //Папка для хранения файлов с уменьшенными изображениями
    $folder_orig = "ecomaps/eco_map_images";

    //Генерация уникального имени
    $file_map_orig = uniqid("");

    //Добавление расширения к имени файла
    switch ($file_image['type']) {
    case 'image/pjpeg':
        $file_map_orig .= ".jpg";
        break;
    case 'image/gif';
        $file_map_orig .= ".gif";
        break;
    }

    //Добавление имени папки к имени файла
    $file_map_orig = $folder_orig."/".$file_map_orig;

    //Копирование загруженого файла в папку для хранения
    copy ($file_image['tmp_name'], $file_map_orig);

    return $file_map_orig;
}

?>
