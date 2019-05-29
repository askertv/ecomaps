<html>
<head>
<title>Добавление информации</title>
<LINK rel = 'stylesheet' type = 'text/css' href= 'styles_edit.css'>
</head>
<body>

<?php
require_once 'ii.php';
require_once 'func.php';

$query_choose_region = "SELECT region, region_id FROM $datatable2 ORDER BY region";

$result_choose_region = @mysql_query($query_choose_region, $link);

for ($i=0; $i<mysql_num_rows($result_choose_region); $i++) {
    $list_regions[$i]=mysql_fetch_array($result_choose_region);
}

$errmsg="";

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
        
        // Запись в базу данных 
        if (isset($_POST['zone_add'])) {
            if ($_POST['zone_add'] != "") {
                $query_add_region = "INSERT INTO $datatable2 (region, loaddate) VALUES ('".$_POST['zone_add']."', now())";
                if (!mysql_query($query_add_region, $link)) {
                    $errmsg .= "<br />Новый регион не добавился, пожалуйста, повторите ввод...<br />";
                }
            }
        }
        
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
        unset($_POST['region']);
        unset($_POST['iname']);
        unset($_POST['komment']);
        unset($_POST['sent']);
        unset($_POST['zone_add']);
    }
}

?>

<h2>Добавление информации</h2>

<form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="sent" value="1">
<table width="600" border="0" cellspacing="0" cellpading="0">
<tr><td width="280" valign="top">Выбрать регион:</td>
    <td width="320"><select size="1" name="zone_id">   
                    <?php    
                        for ($i = 0; $i<count($list_regions); $i++) {
                            echo "<option value = ".$list_regions[$i]['region_id'].">".$list_regions[$i]['region']."</option>";
                        }   
                    ?>
                    </select>
    </td>
</tr>
<tr>
    <td><font size="-1">&nbsp;&nbsp;&nbsp;<a href=eco_add_zone.php title="Добавить регион">или добавить другой...</a></font></td>
    <td>&nbsp;</td>
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