<HTML>
<HEAD>
<TITLE>Изменение информации записи</TITLE>
<LINK rel = 'stylesheet' type = 'text/css' href= 'styles_edit.css'>
</HEAD>
<BODY>
<BR /><BR /><BR /><BR />

<?php

require_once 'ii.php';

require_once 'func.php';

//В самом начале, выбор исходных данных из полей текущей записи...

if (isset($_GET['field_id'])) {

    

    $query_choose_info  = "SELECT name, komment, icon_name, image_name, file_icon, file_image FROM $datatable WHERE id = '".$_GET['field_id']."'";
    $result_choose_info = @mysql_query ($query_choose_info, $link);
    $regions_info       = mysql_fetch_array ($result_choose_info);

    $current_name       = $regions_info['name'];
    $current_komment    = $regions_info['komment'];
    $current_icon       = $regions_info['icon_name'];
    $current_orig       = $regions_info['image_name'];
    $name_file_icon     = $regions_info['file_icon'];
    $name_file_orig     = $regions_info['file_image'];

    $file_info          = '';
    $errmsg             = '';
}


//После передачи данных по post-методу...
 
if (isset ($_POST['sent'])) {

    //--------------Обработка флажков--начало--------------//


    $current_icon = $_POST['name_icon'];
    $current_orig = $_POST['name_orig'];

    //Выбраны обе флажки для удаления файлов изображений...
    if (isset ($_POST['del_icon']) && isset ($_POST['del_orig'])) {

        if (($_POST['del_icon'] == 1) && ($_POST['del_orig'] == 1)) {

            //Удаление файла иконки и файла рисунка
            @unlink ($current_icon);
            @unlink ($current_orig);

            //Удаление имени файла иконки и рисунка из базы данных
            $query_del_filename = "UPDATE $datatable SET icon_name = 'ecomaps/eco_map_icons/empty.jpg', image_name = 'ecomaps/eco_map_images/empty.jpg', file_icon = 'empty.jpg', file_image = 'empty.jpg' WHERE id = '".$_POST['id']."'";
            $name_file_icon = 'empty';
            $name_file_orig = 'empty';
        }
        
    //Выбран только флаг на удаление файла иконки 
    } elseif (isset ($_POST['del_icon']) && !isset ($_POST['del_orig'])) {

        if ($_POST['del_icon'] == 1) {

            //Удаление файла иконки
            @unlink ($current_icon);

            //Удаление имени файла иконки из базы данных
            $query_del_filename = "UPDATE $datatable SET icon_name = 'ecomaps/eco_map_icons/empty.jpg', file_icon = 'empty.jpg' WHERE id = '".$_POST['id']."'";
            $name_file_icon = 'empty';

        }

    //Выбран только флаг на удаление файла рисунка
    } elseif (!isset ($_POST['del_icon']) && isset ($_POST['del_orig'])) {

        if ($_POST['del_orig'] == 1) {

            //Удаление файла рисунка
            @unlink ($current_orig);

            //Удаление имени файла рисунка из базы данных
            $query_del_filename = "UPDATE $datatable SET image_name = 'ecomaps/eco_map_images/empty.jpg', file_image = 'empty.jpg' WHERE id = '".$_POST['id']."'";
            $name_file_orig = 'empty';

        }
    }

    //Выполнение запроса в соответствии с выбранными флагами...
    if (isset($query_del_filename)) {
        if ($query_del_filename != '') {
            @mysql_query ($query_del_filename, $link);

            unset ($query_del_filename);
        }
    }

    //---------------Обработка флажков--конец-----------------//

                
    //---------------Обработка загруженных файлов--начало-----//

    //--------------Если выбраны файлы иконки и рисунка для загрузки--------//
    if (isset ($_POST['add_icon']) && isset ($_POST['add_orig'])) {

        if (($_POST['add_icon'] == 1) && ($_POST['add_orig'] == 1)) {

            if (!is_uploaded_file ($_FILES['icon']['tmp_name']) && !is_uploaded_file ($_FILES['image']['tmp_name'])) {
        
               $file_info.= "Ошибка при загрузке файлов иконки и рисунка на сервер...\n"; 
        
            } else {

                if ($_FILES['icon']['size']>50000) {
                    $errmsg.="<br />Файл с уменьшенным изображением превышает допустимый размер в 50 кбайт";
                }
                if ($_FILES['image']['size']>300000) {
                    $errmsg.="<br />Файл с изображением превышает допустимый размер в 300 кбайт";
                }
                if ($_FILES['icon']['type'] != 'image/pjpeg') {
                    $errmsg.="<br />Файл с уменьшенным изображением имеет неразрешенный тип.<br />Допускается только тип jpeg<br />";
                }
                if ($_FILES['image']['type'] != 'image/pjpeg') {
                    $errmsg.="<br />Файл с изображением имеет неразрешенный тип.<br />Допускается только тип jpeg<br />";
                }
        


                if (!isset ($errmsg) OR $errmsg == "") {

                    $ic = save_icon ($_FILES['icon']);
 
                    $im = save_image ($_FILES['image']);                   
                                      
                    //Сохранение имен файлов иконки и рисунка...
                    $query_edit_filename = "UPDATE $datatable SET icon_name = '".$ic."', file_icon = '".$_POST['name_icon']."', image_name = '".$im."', file_image = '".$_POST['name_orig']."' WHERE id = '".$_POST['id']."'";

                }
            }

        } 

    //--------------Если выбран только файл иконки для загрузки--------//    
    } elseif (isset ($_POST['add_icon']) && !isset ($_POST['add_orig'])) {

        if ($_POST['add_icon'] == 1) {
            
            if (!is_uploaded_file ($_FILES['icon']['tmp_name'])) {
        
                $file_info.= "Ошибка при загрузке файла иконки на сервер...\n"; 
        
            } else {

                if ($_FILES['icon']['size']>50000) {
                    $errmsg.="<br />Файл иконки превышает допустимый размер в 50 кбайт";
                }
            
                if ($_FILES['icon']['type'] != 'image/pjpeg') {
                    $errmsg.="<br />Файл иконки имеет неразрешенный тип.<br />Допускается только тип jpeg<br />";
                }
                    


                if (!isset ($errmsg) OR $errmsg == "") {

                    $ic = save_icon ($_FILES['icon']);
                    
                    //Сохранение имени файла иконки...
                    $query_edit_filename = "UPDATE $datatable SET icon_name = '".$ic."', file_icon = '".$_POST['name_icon']."' WHERE id = '".$_POST['id']."'";

                }
            }

        }

    //--------------Если выбран только файл рисукна для загрузки--------//    
    } elseif (!isset ($_POST['add_icon']) && isset ($_POST['add_orig'])) {

        if ($_POST['add_orig'] == 1) {
            
            if (!is_uploaded_file ($_FILES['image']['tmp_name'])) {
        
                $file_info.= "Ошибка при загрузке файла рисунка на сервер...\n"; 
        
            } else {

                if ($_FILES['image']['size']>3000000) {
                    $errmsg.="<br />Файл рисунка превышает допустимый размер в 300 кбайт";
                }
            
                if ($_FILES['image']['type'] != 'image/pjpeg') {
                    $errmsg.="<br />Файл рисунка имеет неразрешенный тип.<br />Допускается только тип jpeg<br />";
                }
            

                if (!isset ($errmsg) OR $errmsg == "") {

                    $im = save_image ($_FILES['image']);

                    //Сохранение имени файла рисунка...
                    $query_edit_filename = "UPDATE $datatable SET image_name = '".$im."', file_image = '".$_POST['name_orig']."' WHERE id = '".$_POST['id']."'";

                }

            }
 
        }

    }

    //---------Выполнение запроса в соответствии с выбранными файлами для загрузки---// 

    if (isset($query_edit_filename)) {
        if ($query_edit_filename != '') {
            @mysql_query ($query_edit_filename, $link);

            unset ($query_edit_filename);
        }
    }

    //---------------Обработка загруженных файлов--конец-----//


    //Сохранение названия карты и ее описания в базе данных 
    $query_edit_info = "UPDATE $datatable SET name = '".$_POST['iname']."', komment = '".$_POST['komment']."', loaddate = now() WHERE id = '".$_POST['id']."'";

    @mysql_query ($query_edit_info, $link);
        
    
    
    //Сообщить о результатах... 
    if (isset($errmsg) && $errmsg!="") {
        echo "<h2><font color=\"red\">".$errmsg."</font></h2>";
    } else {
        echo "<h2><font color=\"blue\">Информация успешно изменена</font></h2>";
        
    }

    $current_name    = $_POST['iname'];
    $current_komment = $_POST['komment'];

    //Удаление post-переменных...
    unset ($_POST['sent']);
    unset ($_POST['iname']);
    unset ($_POST['komment']);
    
    //Удаление file-переменных...
    unset ($_FILES['icon']);
    unset ($_FILES['image']);
   
}


echo $file_info;

$file_info = '';


?>


<h2>Изменение информации</h2>

<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "post" enctype = "multipart/form-data">
<input type = "hidden" name = "sent" value = "1">
<input type = 'hidden' name = 'id' value = "<?php echo $_GET['field_id']; ?>">
<INPUT type = 'hidden' name = 'name_icon' value = "<?php echo $current_icon; ?>">
<INPUT type = 'hidden' name = 'name_orig' value = "<?php echo $current_orig; ?>">

<table width = "650" border = "0" cellspacing = "20" cellpading = "0">
<tr><td width = "280" valign = "top">Краткое название карты:</td>
    <td><textarea name = "iname" rows = "2" cols = "30" value = ""><?php echo $current_name; ?></textarea></td>
</tr>
<tr><td valign = "top">Описание карты:</td>
    <td width = "370"><textarea name = "komment" rows = "4" cols = "30" value = ""><?php echo $current_komment; ?></textarea></td>
</tr>
<tr><td valign = "top">Выберите иконку<BR />(JPEG, не более 50 Кб):</td>
    <td valign = "top">
        <FONT size = '-1'>Файл иконки на сервере: <?php echo $name_file_icon; ?>&nbsp;<INPUT type = 'checkbox' name = 'del_icon' value = '1'>&nbsp;Удалить</FONT>
        <BR /><BR /><input type = "file" name = "icon" size="30">&nbsp;<FONT size = '-1'><INPUT type = 'checkbox' name = 'add_icon' value = '1'>&nbsp;Загрузить</FONT>
    </td>
</tr>
<tr><td valign = "top">Выберите изображение<BR />(JPEG, не более 300 Кб):</td>
    <td valign = "top">
        <FONT size = '-1'>Файл изображения на сервере: <?php echo $name_file_orig; ?>&nbsp;<INPUT type = 'checkbox' name = 'del_orig' value = '1'>&nbsp;Удалить</FONT>
        <BR /><BR /><input type = "file" name = "image" size = "30">&nbsp;<FONT size = '-1'><INPUT type = 'checkbox' name = 'add_orig' value = '1'>&nbsp;Загрузить</FONT>
    </td>
</tr>
<tr><td colspan = "2" align = "center"><input type = "submit" value = "Сохранить">&nbsp;&nbsp;<input type = "reset" value = "Сбросить"></td>   
</tr>
</table>
</form>

<FONT size="-1"><A href='eco_choice_region_sett.php'>Вернуться к списку регионов</A></FONT>

</body>
</html>