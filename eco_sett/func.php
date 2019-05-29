<?php

function save_icon ($file_load) {

    //����� ��� �������� ������ � ������������ �������������
    $folder_icon = "ecomaps/eco_map_icons";

    //��������� ����������� �����
    $file_map_icon = uniqid("");

    //���������� ���������� � ����� �����
    switch ($file_load['type']) {
    case 'image/pjpeg':
        $file_map_icon .= ".jpg";
        break;
    case 'image/gif';
        $file_map_icon .= ".gif";
        break;
    }

    //���������� ����� ����� � ����� �����
    $file_map_icon = $folder_icon."/".$file_map_icon;

    //����������� ����������� ����� � ����� ��� ��������
    copy ($file_load['tmp_name'], $file_map_icon);

    return $file_map_icon;
}


function save_image ($file_image) {

    //����� ��� �������� ������ � ������������ �������������
    $folder_orig = "ecomaps/eco_map_images";

    //��������� ����������� �����
    $file_map_orig = uniqid("");

    //���������� ���������� � ����� �����
    switch ($file_image['type']) {
    case 'image/pjpeg':
        $file_map_orig .= ".jpg";
        break;
    case 'image/gif';
        $file_map_orig .= ".gif";
        break;
    }

    //���������� ����� ����� � ����� �����
    $file_map_orig = $folder_orig."/".$file_map_orig;

    //����������� ����������� ����� � ����� ��� ��������
    copy ($file_image['tmp_name'], $file_map_orig);

    return $file_map_orig;
}

?>
