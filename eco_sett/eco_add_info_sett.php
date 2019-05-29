<html>
<head>
<title>Добавление информации</title>
<LINK rel = 'stylesheet' type = 'text/css' href= 'styles_edit.css'>
</head>
<body>

<?php
require_once 'ii.php';
require_once 'func.php';

if (isset ($_GET['region'])) {

    $get_region = $_GET['region'];

    $query_choose_region = "SELECT region FROM $datatable2 WHERE region_id = '".$get_region."'";

    $result_choose_region = @mysql_query($query_choose_region, $link);

    $current_region_name = @mysql_result ($result_choose_region, 0, 0);

    $errmsg = "";

    unset ($_GET['region']);
}

if (isset($_POST['sent'])) {

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

        $ic = save_icon ($_FILES['icon']);
        $im = save_image ($_FILES['image']);
            
/*
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
        
        // Запись в базу данных 
        
        $sql="INSERT INTO $datatable (region_id, name, komment, icon_name, image_name, loaddate) VALUES ";
        $sql.="('".$_POST['zone_id']."', '".$_POST['iname']."', '".$_POST['komment']."', '".$ic."', '".$im."', now())";
        if (!mysql_query($sql, $link)) {
            $errmsg.="<br />Попытка зиписи в базу данных привела к ошибке. Повторите, пожалуйста, загрузку...<br />";
        }
        
    }
    if (isset($errmsg) && $errmsg!="") {
        echo "<h2><font color=\"red\">".$errmsg."</font></h2>";
    } else {
        echo "<h2><font color=\"blue\">Информация добавлена</font></h2>";

        $get_region = $_POST['zone_id'];
        $current_region_name = "Тот же регион";
        
        unset($_POST['iname']);
        unset($_POST['komment']);
        unset($_POST['sent']);
        
    }
}

?>

<h2>Добавление информации</h2>


<form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="sent" value="1">
<input type = 'hidden' name = 'zone_id' value = '<?php echo $get_region; ?>'>
<table width="600" border="0" cellspacing="0" cellpading="0">
<tr><td width="280" valign="top">Регион:</td>
    <td width="320"><?php echo $current_region_name; ?></td>
</tr>
<tr><td valign="top">Краткое название карты:</td>
    <td><textarea name="iname" rows=2 cols=30 value=""></textarea></td>
</tr>
<tr><td valign="top">Описание карты:</td>
    <td><textarea name="komment" rows=4 cols=30 value=""></textarea></td>
</tr>
<tr><td valign="top">Выберите уменьшенное изображение, иконку (JPEG, не более 50 Кб)</td>
    <td valign="top"><input type="file" name="icon" size="30"></td>
</tr>
<tr><td valign="top">Выберите изображение в оригинальном размере (JPEG, не более 300 Кб)</td>
    <td valign="top"><input type="file" name="image" size="30"></td>
</tr>
<tr><td colspan="2" align="center"><input type="submit" value="Добавить">&nbsp;&nbsp;<input type="reset" value="Сбросить"></td>   
</tr>
</table>
</form>

<FONT size="-1"><A href='eco_choice_region_sett.php'>Вернуться к списку регионов</A></FONT>

</body>
</html>