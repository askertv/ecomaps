<?php

require 'ii.php';
$regions='';
$content='';
$title='Выбор региона для отображения экологической карты';

$query="SELECT region, region_id FROM $datatable2 ORDER BY region";

$result=@mysql_query($query, $link);

for($i=0; $i<mysql_num_rows($result); $i++) {
    $res[$i]=mysql_fetch_array($result);
}

for($i=0; $i<count($res); $i++) {
    $regions.="<a href='eco_region_maps.php?zone=".$res[$i]['region_id']."' taget='_blank'>";
    $regions.=$res[$i]['region'];    
    $regions.="</a><br />";
}

$content="<html><head><title>".$title."</title></head><body>";
$content.="<table border='1' width='400'><tr><td><b>Выберите регион:</b></td></tr><tr><td>";
$content.=$regions;
$content.="</td></tr></table></body></html>";

echo $content;

?>
