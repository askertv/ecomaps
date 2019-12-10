<?php

require_once 'ii.php';

$errmsg = "";

echo "1\n";

//Кнопка "Изменить" нажата... 
if (isset($_POST['sent']) {

   echo "2/n";

        //Проверка переданной информации
        if ($_POST['iname'] != "" && $_POST['komment'] != "") {echo "2/n";/*
/*
            if (!is_uploaded_file($_FILES['icon']['tmp_name']) && !is_uploaded_file($_FILES['image']['tmp_name'])) {
                $errmsg="<br />Загрузка файлов не выполнена";
            } else {
                if ($_FILES['icon']['size']>50000) {
                    $errmsg.="<br />Файл с уменьшенным изображением превышает допустимый размер в 50 кбайт";
                }
                if ($_FILES['image']['size']>300000) {
                    $errmsg.="<br />Файл с изображением превышает допустимый размер в 300 кбайт";
                }
                if (!$_FILES['icon']['type'] == 'image/pjpeg') {
                    $errmsg.="<br />Файл с уменьшенным изображением имеет неразрешенный тип.<br />Допускается только тип jpeg<br />";
                }
                if (!$_FILES['image']['type'] == 'image/pjpeg') {
                    $errmsg.="<br />Файл с изображением имеет неразрешенный тип.<br />Допускается только тип jpeg<br />";
                }
            }

            if (!isset($errmsg) OR $errmsg == "") {
            
            //Папка для хранения файлов с уменьшенными изображениями
            $folder_icon = "ecomaps/eco_map_icons";

            //Генерация уникального имени
            $file_map_icon = uniqid("");

            //Добавление рсширения к имени файла
            switch ($_FILES['icon']['type']) {
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
            copy($_FILES['icon']['tmp_name'], $file_map_icon);


            //Папка для хранения файлов с изображениями оригинального размера
            $folder_orig = "ecomaps/eco_map_images";

            //Генерация уникального имени
            $file_map_orig = uniqid("");

            //Добавление рсширения к имени файла
            switch ($_FILES['image']['type']) {
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
            copy($_FILES['image']['tmp_name'], $file_map_orig);

*/       
            //Сохранений изменений в базе данных 
/*       
            $query_edit_info = "UPDATE $datatable SET name = '".$_POST['iname']."', komment = '".$_POST['komment']."', ";
            $query_edit_info.= "icon_name = '".$file_map_icon."', image_name = '".$file_map_orig."', loaddate = now()) ";
            $query_edit_info.= "WHERE id = '".$_POST['id']."'";
*/

            $query_edit_info = "UPDATE $datatable SET name = '".$_POST['iname']."', komment = '".$_POST['komment']."', ";
            $query_edit_info.= "loaddate = now()) WHERE id = '".$_POST['id']."'";

            if (!mysql_query ($query_edit_info, $link)) {
                $errmsg.="<br />Попытка изменения записи в базе данных привела к ошибке. Пожалуйста, повторите...<br />";
            }
            echo "OK";
        }*/
        if (isset ($errmsg) && $errmsg != "") {
            echo "<h2><font color=\"red\">".$errmsg."</font></h2>";
        } else {
            echo "<h2><font color=\"blue\">Информация успешно изменена</font></h2>";
        
            unset($_POST['iname']);
            unset($_POST['komment']);
            unset($_POST['sent']);
        }
    
    echo "<BR /><A href = 'eco_choose_region_sett.php' title = 'Вернуться к списку регионов'>Вернуться к списку регионов</A>";
}

?>