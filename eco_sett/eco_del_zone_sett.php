<HTML>
<HEAD>
<TITLE>�������� �������</TITLE>
<LINK rel = 'stylesheet' type = 'text/css' href= 'styles.css'>
</HEAD>
<BODY>

<?php
require_once 'ii.php';

$query_choose_region = "SELECT region FROM $datatable2 WHERE region_id = '".$_GET['zone']."'";

$result_choose_region = @mysql_query($query_choose_region, $link);

$current_region_name = @mysql_result($result_choose_region, 0, 0);

?>

<H3>�������� �������</H3>

<FORM action="eco_action_del_zone.php" method="post">
<INPUT type="hidden" name="sent" value="1">
<INPUT type="hidden" name="region_id" value="<?php echo $_GET['zone']; ?>">
������� <B><?php echo $current_region_name; ?></B> � ��� ����������, ��������� � ���?&nbsp;<INPUT type="submit" value="�������">
<BR /><BR /><FONT size="-1"><A href='eco_choice_region_sett.php'>��������� �����</A></FONT>
</FORM>
</BODY>
</HTML>