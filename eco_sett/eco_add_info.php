<html>
<head>
<title>���������� ����������</title>
<LINK rel = 'stylesheet' type = 'text/css' href= 'styles_edit.css'>
</head>
<body>

<?php
require_once 'ii.php';
require_once 'func.php';

$query_choose_region = "SELECT region, region_id FROM $datatable2 ORDER BY region";

$result_choose_region = @mysql_query($query_choose_region, $link);

for ($i=0; $i<mysql_num_rows($result_choose_region); $i++) {
    $list_regions[$i]=mysql_fetch_array($result_choose_region);
}

$errmsg="";

if (isset($_POST['sent'])) {
    if (!is_uploaded_file($_FILES['icon']['tmp_name']) && !is_uploaded_file($_FILES['image']['tmp_name'])) {
        $errmsg="<br />�������� ������ �� ���������";
    } else {
        if ($_FILES['icon']['size']>50000) {
            $errmsg.="<br />���� � ����������� ������������ ��������� ���������� ������ � 50 �����";
        }
        if ($_FILES['image']['size']>300000) {
            $errmsg.="<br />���� � ������������ ��������� ���������� ������ � 300 �����";
        }
        if (!$_FILES['icon']['type'] == 'image/pjpeg') {
            $errmsg.="<br />���� � ����������� ������������ ����� ������������� ���.<br />����������� ������ ��� jpeg<br />";
        }
        if (!$_FILES['image']['type'] == 'image/pjpeg') {
            $errmsg.="<br />���� � ������������ ����� ������������� ���.<br />����������� ������ ��� jpeg<br />";
        }
    }
    if (!isset($errmsg) OR $errmsg == "") {
        
        $ic = save_icon ($_FILES['icon']);

        $im = save_image ($_FILES['image']);
        
        // ������ � ���� ������ 
        if (isset($_POST['zone_add'])) {
            if ($_POST['zone_add'] != "") {
                $query_add_region = "INSERT INTO $datatable2 (region, loaddate) VALUES ('".$_POST['zone_add']."', now())";
                if (!mysql_query($query_add_region, $link)) {
                    $errmsg .= "<br />����� ������ �� ���������, ����������, ��������� ����...<br />";
                }
            }
        }
        
        $sql="INSERT INTO $datatable (region_id, name, komment, icon_name, image_name, loaddate) VALUES ";
        $sql.="('".$_POST['zone_id']."', '".$_POST['iname']."', '".$_POST['komment']."', '".$ic."', '".$im."', now())";
        if (!mysql_query($sql, $link)) {
            $errmsg.="<br />������� ������ � ���� ������ ������� � ������. ���������, ����������, ��������...<br />";
        }
        
    }
    if (isset($errmsg) && $errmsg!="") {
        echo "<h2><font color=\"red\">".$errmsg."</font></h2>";
    } else {
        echo "<h2><font color=\"blue\">���������� ���������</font></h2>";
        unset($_POST['region']);
        unset($_POST['iname']);
        unset($_POST['komment']);
        unset($_POST['sent']);
        unset($_POST['zone_add']);
    }
}

?>

<h2>���������� ����������</h2>

<form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="sent" value="1">
<table width="600" border="0" cellspacing="0" cellpading="0">
<tr><td width="280" valign="top">������� ������:</td>
    <td width="320"><select size="1" name="zone_id">   
                    <?php    
                        for ($i = 0; $i<count($list_regions); $i++) {
                            echo "<option value = ".$list_regions[$i]['region_id'].">".$list_regions[$i]['region']."</option>";
                        }   
                    ?>
                    </select>
    </td>
</tr>
<tr>
    <td><font size="-1">&nbsp;&nbsp;&nbsp;<a href=eco_add_zone.php title="�������� ������">��� �������� ������...</a></font></td>
    <td>&nbsp;</td>
</tr>
<tr><td valign="top">������� �������� �����:</td>
    <td><textarea name="iname" rows=2 cols=30 value=""></textarea></td>
</tr>
<tr><td valign="top">�������� �����:</td>
    <td><textarea name="komment" rows=4 cols=30 value=""></textarea></td>
</tr>
<tr><td valign="top">�������� ����������� �����������, ������ (JPEG, �� ����� 50 ��)</td>
    <td valign="top"><input type="file" name="icon" size="30"></td>
</tr>
<tr><td valign="top">�������� ����������� � ������������ ������� (JPEG, �� ����� 300 ��)</td>
    <td valign="top"><input type="file" name="image" size="30"></td>
</tr>
<tr><td colspan="2" align="center"><input type="submit" value="��������">&nbsp;&nbsp;<input type="reset" value="��������"></td>   
</tr>
</table>
</form>

<FONT size="-1"><A href='eco_choice_region_sett.php'>��������� � ������ ��������</A></FONT>

</body>
</html>