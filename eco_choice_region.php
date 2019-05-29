<?php

require 'eco_sett/ii.php';
$regions='';
$content='';
$title='Выбор региона для отображения экологической карты';

$query="SELECT region, region_id FROM $datatable2 ORDER BY region";

$result=mysql_query($query, $link);

for($i=0; $i<mysql_num_rows($result); $i++) {
    $res[$i]=mysql_fetch_array($result);
}

for($i=0; $i<count($res); $i++) {
    $regions.="<a href='eco_region_maps.php?zone=".$res[$i]['region_id']."' taget='_blank'>";
    $regions.=$res[$i]['region'];    
    $regions.="</a><br />";
}

$content="<html><head><title>".$title."</title><LINK rel = 'stylesheet' type = 'text/css' href= 'styles.css'></head><body><BR /><BR /><BR /><BR />";
$content.="<table border='1' width='600'><tr><td><b>Выберите регион:</b></td></tr><tr><td>";
$content.=$regions;
$content.="</td></tr></table><BR /><BR /><FONT size='-1'><A href='index.php'>Вернуться на главную страницу</A></FONT></body></html>";

echo $content;

?>
