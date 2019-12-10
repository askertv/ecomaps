<HTML>
<HEAD>
<TITLE>Добавление нового региона</TITLE>
<LINK rel = 'stylesheet' type = 'text/css' href= 'styles_edit.css'>
</HEAD>
<BODY>

<?php
require_once 'ii.php';

$errmsg = "";

$query_choose_region = "SELECT region FROM $datatable2 ORDER BY region";

$result_choose_region = @mysql_query($query_choose_region, $link);

for ($i = 0; $i < mysql_num_rows($result_choose_region); $i++) {
    $list_regions[$i] = mysql_fetch_array($result_choose_region);
}

//Кнопка "Добавить" нажата... 
if (isset($_POST['sent'])) {
             
        
        if (isset($_POST['zone_add'])) {

            //Проверка содержания поля для добавления нового региона
            if ($_POST['zone_add'] != "") {

                // Добавление нового региона в базу данных
                $query_add_region = "INSERT INTO $datatable2 (region, loaddate) VALUES ('".$_POST['zone_add']."', now())";             
              
                //Если возникли ошибки при добавлении, зарегистрировать их
                if (!mysql_query($query_add_region, $link)) {
                    $errmsg.="<BR />При добавлении записи о новым регионе возникла ошибка, пожалуйста, повторите ввод...";
                }
            } else {
                //Если поле для нового региона не заполнено, сообщить об этом
                $errmsg.="<BR /><H3>Поле для добавления нового региона не заполнено, пожалуйста, заполните и повторите ввод...</H3>";
            }
        }    

    //Вывести ошибки, если они есть, или сообщить об успешном добавлении новой записи
    if ($errmsg!="") {
        echo "<H2><FONT color=\"red\">".$errmsg."</FONT></H2>";
    } else {     
        echo "<H3><FONT color=\"green\">Новый регион добавлен</FONT></H3>";
        
        //Уничтожить post-переменные
        unset($_POST['sent']);
        unset($_POST['zone_add']);
    }
}

?>

<H3>Добавление нового региона</H3>

<FORM action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
<INPUT type="hidden" name="sent" value="1">
<TABLE width="600" border="0" cellspacing="5" cellpading="0">
<TR><TD width="280" valign="top"><FONT size="-1">Список регионов:</FONT></TD>
    <TD width="320"><SELECT size="1">   
                    <?php    
                        for ($i = 0; $i<count($list_regions); $i++) {
                            echo "<OPTION>".$list_regions[$i]['region']."</OPTION>";
                        }   
                    ?>
                    </SELECT>
    </TD>
</TR>
<TR>
    <TD><B><FONT size="-1" color="blue">Если нет в списке,&nbsp;&mdash; добавить новый:</FONT></B></TD>
    <TD><INPUT type="text" name="zone_add" size="40" value=""></TD>
</TR>
<TR><TD>&nbsp;</TD><TD><BR /><INPUT type="submit" value="Добавить"></TD>   
</TR>
<TR><TD colspan=2 align='center'><BR /><BR /><FONT size="-1"><A href='eco_choice_region_sett.php'>Вернуться назад</A></FONT></TD></TR>
</TABLE>
</FORM>
</BODY>
</HTML>