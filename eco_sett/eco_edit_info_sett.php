<html>
<head>
<title>��������� ���������� ������</title>
</head>
<body>
<br /><br /><br /><br />
<?php
require_once 'ii.php';

$query_choose_info  = "SELECT name, komment, icon_name, image_name FROM $datatable WHERE id = '".$_GET['field_id']."'";

$result_choose_info = @mysql_query ($query_choose_info, $link);

$regions_info       = mysql_fetch_array ($result_choose_info);

?>

<h2>��������� ����������</h2>

<form action = "eco_action_edit_info.php" method = "post" enctype = "multipart/form-data">
<input type = "hidden" name = "sent" value = "1">
<input type = 'hidden' name = 'id' value = "<?php echo $_GET['field_id']; ?>">
<input type = 'hidden' name = 'zone_id' value = "<?php echo $_GET['field_id']; ?>">
<table width = "600" border = "0" cellspacing = "0" cellpading = "0">
<tr><td width = "280" valign = "top">������� �������� �����:</td>
    <td><textarea name = "iname" rows = "2" cols = "30" value = ""><?php echo $regions_info['name']; ?></textarea></td>
</tr>
<tr><td valign = "top">�������� �����:</td>
    <td width = "320"><textarea name = "komment" rows = "4" cols = "30" value = ""><?php echo $regions_info['komment']; ?></textarea></td>
</tr>
<tr><td valign = "top">�������� ����������� �����������, ������ (JPEG, �� ����� 50 ��)</td>
    <td valign = "top"><input type = "file" name = "icon" size="30"></td>
</tr>
<tr><td valign = "top">�������� ����������� � ������������ ������� (JPEG, �� ����� 300 ��)</td>
    <td valign = "top"><input type = "file" name = "image" size = "30"></td>
</tr>
<tr><td colspan = "2" align = "center"><input type = "submit" value = "���������">&nbsp;&nbsp;<input type = "reset" value = "��������"></td>   
</tr>
</table>
</form>

<FONT size="-1"><A href='eco_choice_region_sett.php'>��������� � ������ ��������</A></FONT>

</body>
</html>