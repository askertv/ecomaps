<html>
<head>
<title>���������� ����������</title>
<LINK rel = 'stylesheet' type = 'text/css' href= 'styles_edit.css'>
</head>
<body>

<?php
require_once 'ii.php';
require_once 'func.php';

if (isset ($_GET['region'])) {

    $get_region = $_GET['region'];

    $query_choose_region = "SELECT region FROM $datatable2 WHERE region_id = '".$get_region."'";

    $result_choose_region = @mysql_query($query_choose_region, $link);

    $current_region_name = @mysql_result ($result_choose_region, 0, 0);

    $errmsg = "";

    unset ($_GET['region']);
}

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
            
/*
        //����� ��� �������� ������ � ������������ �������������
        $folder_icon = "ecomaps/eco_map_icons";

        //��������� ����������� �����
        $file_map_icon = uniqid("");

        //���������� ��������� � ����� �����
        switch ($_FILES['icon']['type']) {
        case 'image/pjpeg':
            $file_map_icon .= ".jpg";
            break;
        case 'image/gif';
            $file_map_icon .= ".gif";
            break;
        }

        //���������� ����� ����� � ����� �����
        $file_map_icon = $folder_icon."/".$file_map_icon;

        //����������� ����������� ����� � ����� ��� ��������
        copy($_FILES['icon']['tmp_name'], $file_map_icon);


        //����� ��� �������� ������ � ������������� ������������� �������
        $folder_orig = "ecomaps/eco_map_images";

        //��������� ����������� �����
        $file_map_orig = uniqid("");

        //���������� ��������� � ����� �����
        switch ($_FILES['image']['type']) {
        case 'image/pjpeg':
            $file_map_orig .= ".jpg";
            break;
        case 'image/gif';
            $file_map_orig .= ".gif";
            break;
        }

        //���������� ����� ����� � ����� �����
        $file_map_orig = $folder_orig."/".$file_map_orig;

        //����������� ����������� ����� � ����� ��� ��������
        copy($_FILES['image']['tmp_name'], $file_map_orig);
*/
        
        // ������ � ���� ������ 
        
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

        $get_region = $_POST['zone_id'];
        $current_region_name = "��� �� ������";
        
        unset($_POST['iname']);
        unset($_POST['komment']);
        unset($_POST['sent']);
        
    }
}

?>

<h2>���������� ����������</h2>


<form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="sent" value="1">
<input type = 'hidden' name = 'zone_id' value = '<?php echo $get_region; ?>'>
<table width="600" border="0" cellspacing="0" cellpading="0">
<tr><td width="280" valign="top">������:</td>
    <td width="320"><?php echo $current_region_name; ?></td>
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