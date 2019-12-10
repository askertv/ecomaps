<HTML>
<HEAD>
<TITLE>ИЗМЕНЕНИЕ названия региона</TITLE>
<LINK rel = 'stylesheet' type = 'text/css' href= 'styles_edit.css'>
</HEAD>
<BODY>

<?php
require_once 'ii.php';

$query_choose_region = "SELECT region FROM $datatable2 WHERE region_id = '".$_GET['zone']."'";

$result_choose_region = @mysql_query($query_choose_region, $link);

$current_region_name = @mysql_result($result_choose_region, 0, 0);

?>

<H3>Изменение названия региона</H3>

<FORM action="eco_action_edit_zone.php" method="post">
<INPUT type="hidden" name="sent" value="1">
<INPUT type="hidden" name="region_id" value="<?php echo $_GET['zone']; ?>">
<TABLE width="600" border="0" cellspacing="5" cellpading="0">
<TR><TD width="280" valign="top"><FONT size="-1">Текущее название:</FONT></TD>
    <TD width="320"><?php echo $current_region_name; ?></TD>
</TR>
<TR>
    <TD><B><FONT size="-1" color="blue">Новое название:</FONT></B></TD>
    <TD><INPUT type="text" name="zone_edit" size="40" value=""></TD>
</TR>
<TR><TD>&nbsp;</TD><TD><BR /><INPUT type="submit" value="Изменить"></TD>   
</TR>
<TR><TD>&nbsp;</TD><TD><BR /><FONT size="-1"><A href='eco_choice_region_sett.php'>Вернуться назад</A></FONT></TD></TR>
</TABLE>
</FORM>
</BODY>
</HTML>