<html>
<head>
<title>Список экологических карт региона</title>
<LINK rel = 'stylesheet' type = 'text/css' href= 'styles.css'>
</head>
<body>

<BR /><BR /><BR /><BR />

<?php 
require_once 'eco_sett/ii.php';

$query_selected_region  = "SELECT region FROM $datatable2 WHERE region_id='".$_GET['zone']."'";

$result_selected_region = mysql_query($query_selected_region, $link);

?>

<table border='1' width='600'>
  <tr>
    <td colspan='2'><b><?php echo mysql_result($result_selected_region, 0); ?></b></td>
  </tr>
    <?php 
    
     $query_list_maps  = "SELECT name, komment, icon_name, image_name FROM $datatable WHERE region_id='".$_GET['zone']."'";

     $result_list_maps = mysql_query($query_list_maps, $link);

     for($i=0; $i<mysql_num_rows($result_list_maps); $i++) {
         $list_maps[$i]=mysql_fetch_array($result_list_maps);
     }

    for($i=0; $i<count($list_maps); $i++) {
        echo "<tr><td width='450' valign='top'>";
        echo "<a href='eco_sett/".$list_maps[$i]['image_name']."' target='_blank'>";
        echo $list_maps[$i]['name'];
        echo "</a><br />";
        echo $list_maps[$i]['komment'];        
        echo "</td><td width='150' valign='top' align='right'>";
        echo "<a href='eco_sett/".$list_maps[$i]['image_name']."' target='_blank'><img src='eco_sett/".$list_maps[$i]['icon_name']."' border='0'></a>";
        echo "</td></tr>";      
    }
    ?>
</table>
<BR /><BR /><FONT size='-1'><A href='eco_choice_region.php'>Вернуться к списку регионов</A></FONT>
</body>
</html>