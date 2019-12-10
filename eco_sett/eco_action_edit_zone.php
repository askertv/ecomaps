<?php
require_once 'ii.php';

$errmsg = "";

$query_choose_region = "SELECT region FROM $datatable2 WHERE region_id = '".$_POST['region_id']."'";

$result_choose_region = @mysql_query($query_choose_region, $link);

$current_region_name = @mysql_result($result_choose_region, 0, 0);

//Кнопка "Изменить" нажата... 
if (isset($_POST['sent']) && $_POST['sent'] == 1) {
        
        if (isset($_POST['zone_edit'])) {

            //Проверка содержания поля для изменения названия региона
            if ($_POST['zone_edit'] != "") {

                //Сохранение нового названия региона в базу данных
                $query_edit_region_name = "UPDATE $datatable2 SET region = '".$_POST['zone_edit']."'";
                $query_edit_region_name.= " WHERE region_id = '".$_POST['region_id']."'";             
              
                //Если возникли ошибки при изменении, зарегистрировать их
                if (!mysql_query($query_edit_region_name, $link)) {
                    $errmsg.="<BR />При изменении названия региона возникла ошибка, пожалуйста, повторите ввод...";
                }
            } else {
                //Если поле для изменения названия региона не заполнено, сообщить об этом
                $errmsg.="<BR /><H3>Поле для изменения названия региона не заполнено, пожалуйста, заполните и повторите ввод...</H3>";
            }
        }    

    //Вывести ошибки, если они есть, или сообщить об успешном изменении названия региона
    if ($errmsg!="") {
        echo "<H2><FONT color=\"red\">".$errmsg."</FONT></H2>";
    } else {     
        echo "<H3><FONT color=\"green\">Название региона успешно изменено</FONT></H3>";        
    }
    
    echo "<BR /><A href = 'eco_choice_region_sett.php' title = 'Вернуться к списку регионов'>Вернуться к списку регионов</A>";
}

?>