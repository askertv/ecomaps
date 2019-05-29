<?php
require_once 'ii.php';

$errmsg = "";

//Кнопка "Удалить" нажата... 
if (isset($_POST['sent']) && $_POST['sent'] == 1) {
        
    //Удаление информации о регионе из базы данных
    $query_del_region = "DELETE FROM $datatable2 WHERE region_id = '".$_POST['region_id']."'";
              
    //Если возникли ошибки при удалении, зарегистрировать их
    if (!mysql_query($query_del_region, $link)) {
        $errmsg.="<BR />При удалении региона возникла ошибка, пожалуйста, повторите...";
    }
    
    //Выборка названий файлов для удаления
    $query_files_names = "SELECT icon_name, image_name FROM $datatable WHERE region_id = '".$_POST['region_id']."'";

    $result_files_names = @mysql_query ($query_files_names, $link);

    for ($i = 0; $i < mysql_num_rows ($result_files_names); $i++) {
        $files_names[$i] = mysql_fetch_array ($result_files_names);
    }
    
    //Удаление файлов
    for ($i = 0; $i < count ($files_names); $i++) {
        @unlink ($files_names[$i]['icon_name']);
        @unlink ($files_names[$i]['image_name']);
    }


    $query_del_region_info = "DELETE FROM $datatable WHERE region_id = '".$_POST['region_id']."'";
              
    //Если возникли ошибки при удалении, зарегистрировать их
    if (!mysql_query($query_del_region_info, $link)) {
        $errmsg.="<BR />При удалении инфрмации, связанной с регионом возникла ошибка, пожалуйста, повторите...";
    }
    

    //Вывести ошибки, если они есть, или сообщить об успешном удалении...
    if ($errmsg!="") {
        echo "<H2><FONT color=\"red\">".$errmsg."</FONT></H2>";
    } else {     
        echo "<H3><FONT color=\"green\">Информация о регионе успешно удалена</FONT></H3>";        
    }
    
    echo "<BR /><A href = 'eco_choice_region_sett.php' title = 'Вернуться к списку регионов'>Вернуться к списку регионов</A>";
}

?>