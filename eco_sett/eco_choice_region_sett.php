<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: /admin/index.php?url=".urlencode($_SERVER['SCRIPT_NAME']));
}

require 'ii.php';
$regions='';
$content='';
$title='РЕДАКТИРОВАНИЕ -> РЕГИОНЫ';

$query="SELECT region, region_id FROM $datatable2 ORDER BY region";

$result=@mysql_query($query, $link);

for($i=0; $i<mysql_num_rows($result); $i++) {
    $res[$i]=mysql_fetch_array($result);
}

for($i=0; $i<count($res); $i++) {
    $regions.="<tr><td>";
    $regions.="<a href='eco_region_maps_sett.php?zone=".$res[$i]['region_id']."' taget='_blank'>";
    $regions.=$res[$i]['region'];    
    $regions.="</a></td><td>";
    $regions.="<a href='eco_edit_zone_sett.php?zone=".$res[$i]['region_id']."'><img src='ecoicons/eco_edit.gif' border='0' title='Редактировать название региона'></a>&nbsp;";
    $regions.="<a href='eco_del_zone_sett.php?zone=".$res[$i]['region_id']."'><img src='ecoicons/eco_del.gif' border='0' title='Удалить всю информацию о регионе'></a>";
    $regions.="</td></tr>";
}

$content="<html><head><title>".$title."</title><LINK rel=\"stylesheet\" type=\"text/css\" href=\"styles.css\"></head><body>";
$content.="<br><br><br><br><br><br><table border='0' width='600'><tr><td width='550'><b>Список регионов:</b></td>";
$content.="<td width='50'><a href='eco_add_zone_sett.php'>";
$content.="<img src='ecoicons/eco_add.gif' border='0' title='Добавить новый регион'></a>&nbsp;";
$content.="<a href='eco_add_info.php'>";
$content.="<img src='ecoicons/eco_add_ipp.gif' border='0' title='Добавить информацию в регион'></a>";
$content.="</td></tr>";
$content.=$regions;
$content.="</table><BR /><A href='../index.php'>Выход из админ режима</A></body></html>";

echo $content;

?>
