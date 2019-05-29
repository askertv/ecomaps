<?php

require_once 'ii.php';

$errmsg = "";

//Удаление информации... 
if (isset($_GET['id'])) {



    //Выборка названий файлов для удаления
    $query_files_names = "SELECT icon_name, image_name FROM $datatable WHERE id = '".$_GET['id']."'";

    $result_files_names = @mysql_query ($query_files_names, $link);

    for ($i = 0; $i < mysql_num_rows ($result_files_names); $i++) {
        $files_names[$i] = mysql_fetch_array ($result_files_names);
    }
    
    //Удаление файлов
    for ($i = 0; $i < count ($files_names); $i++) {
        @unlink ($files_names[$i]['icon_name']);
        @unlink ($files_names[$i]['image_name']);
    }



    //Удаление записи из базы данных        
    $query_del_info = "DELETE FROM $datatable WHERE id = '".$_GET['id']."'";

    if (!mysql_query ($query_del_info, $link)) {
        $errmsg.="<br />Попытка удаления записи из базе данных привела к ошибке. Пожалуйста, повторите...<br />";
    }
            
        
    if ($errmsg != "") {
        echo "<h2><font color=\"red\">".$errmsg."</font></h2>";
    } else {
        echo "<h2><font color=\"blue\">Информация успешно удалена</font></h2>";
        unset($_GET['id']);
    }
    
    echo "<BR /><A href = 'eco_choice_region_sett.php' title = 'Вернуться к списку регионов'>Вернуться к списку регионов</A>";
}

?>