<?php

require_once 'ii.php';

$errmsg = "";

echo "1\n";

//������ "��������" ������... 
if (isset($_POST['sent']) {

   echo "2/n";

        //�������� ���������� ����������
        if ($_POST['iname'] != "" && $_POST['komment'] != "") {echo "2/n";/*
/*
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
            //���������� ��������� � ���� ������ 
/*       
            $query_edit_info = "UPDATE $datatable SET name = '".$_POST['iname']."', komment = '".$_POST['komment']."', ";
            $query_edit_info.= "icon_name = '".$file_map_icon."', image_name = '".$file_map_orig."', loaddate = now()) ";
            $query_edit_info.= "WHERE id = '".$_POST['id']."'";
*/

            $query_edit_info = "UPDATE $datatable SET name = '".$_POST['iname']."', komment = '".$_POST['komment']."', ";
            $query_edit_info.= "loaddate = now()) WHERE id = '".$_POST['id']."'";

            if (!mysql_query ($query_edit_info, $link)) {
                $errmsg.="<br />������� ��������� ������ � ���� ������ ������� � ������. ����������, ���������...<br />";
            }
            echo "OK";
        }*/
        if (isset ($errmsg) && $errmsg != "") {
            echo "<h2><font color=\"red\">".$errmsg."</font></h2>";
        } else {
            echo "<h2><font color=\"blue\">���������� ������� ��������</font></h2>";
        
            unset($_POST['iname']);
            unset($_POST['komment']);
            unset($_POST['sent']);
        }
    
    echo "<BR /><A href = 'eco_choose_region_sett.php' title = '��������� � ������ ��������'>��������� � ������ ��������</A>";
}

?>