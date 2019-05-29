<HTML>
<HEAD>
<TITLE>Список экологических карт региона</TITLE>
<LINK rel = 'stylesheet' type = 'text/css' href= 'styles.css'>
</HEAD>
<BODY>
<BR /><BR /><BR /><BR />
<?php 
require_once 'ii.php';

$query_selected_region  = "SELECT region FROM $datatable2 WHERE region_id='".$_GET['zone']."'";

$result_selected_region = mysql_query($query_selected_region, $link);

?>

<TABLE border='0' width='600'>
  <TR>
    <TD width='450' valign = 'top'><B><?php echo mysql_result($result_selected_region, 0); ?></B>&nbsp;
        <A href='eco_add_info_sett.php?region=<?php echo $_GET['zone']; ?>'><img src='ecoicons/eco_add_ipp.gif' border='0' title='Добавить информацию в текущий регион'></A>  
    </TD>
    <TD width='150'>
        &nbsp;    
    </TD>
  </TR>
    <?php 
    
     $query_list_maps  = "SELECT id, name, komment, icon_name, image_name FROM $datatable WHERE region_id='".$_GET['zone']."'";

     $result_list_maps = mysql_query($query_list_maps, $link);

     for($i=0; $i<mysql_num_rows($result_list_maps); $i++) {
         $list_maps[$i]=mysql_fetch_array($result_list_maps);
     }

    for($i=0; $i<count($list_maps); $i++) {
        echo "<tr><td valign='top'>";
        echo "<a href='eco_edit_info_self_sett.php?field_id=".$list_maps[$i]['id']."'><img src='ecoicons/eco_edit.gif' border='0' title='Редактировать запись'></a>&nbsp;";
        echo "<a href='eco_del_info_sett.php?field_id=".$list_maps[$i]['id']."'><img src='ecoicons/eco_del.gif' border='0' title='Удалить запись'></a>";     
        echo "<a href='".$list_maps[$i]['image_name']."' target='_blank'><br />";
        echo $list_maps[$i]['name'];
        echo "</a><br />";
        echo $list_maps[$i]['komment'];        
        echo "</td><td valign='top' align='right'>";
        echo "<a href='".$list_maps[$i]['image_name']."' target='_blank'><img src='".$list_maps[$i]['icon_name']."' border='0'></a>";
        echo "</td></tr>";      
    }
    ?>
</TABLE>
<BR />
<FONT size="-1"><A href='eco_choice_region_sett.php'>Вернуться к списку регионов</A></FONT>
</BODY>
</HTML>