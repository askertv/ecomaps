<?php
require_once 'ii.php';

$errmsg = "";

//������ "�������" ������... 
if (isset($_POST['sent']) && $_POST['sent'] == 1) {
        
    //�������� ���������� � ������� �� ���� ������
    $query_del_region = "DELETE FROM $datatable2 WHERE region_id = '".$_POST['region_id']."'";
              
    //���� �������� ������ ��� ��������, ���������������� ��
    if (!mysql_query($query_del_region, $link)) {
        $errmsg.="<BR />��� �������� ������� �������� ������, ����������, ���������...";
    }
    
    //������� �������� ������ ��� ��������
    $query_files_names = "SELECT icon_name, image_name FROM $datatable WHERE region_id = '".$_POST['region_id']."'";

    $result_files_names = @mysql_query ($query_files_names, $link);

    for ($i = 0; $i < mysql_num_rows ($result_files_names); $i++) {
        $files_names[$i] = mysql_fetch_array ($result_files_names);
    }
    
    //�������� ������
    for ($i = 0; $i < count ($files_names); $i++) {
        @unlink ($files_names[$i]['icon_name']);
        @unlink ($files_names[$i]['image_name']);
    }


    $query_del_region_info = "DELETE FROM $datatable WHERE region_id = '".$_POST['region_id']."'";
              
    //���� �������� ������ ��� ��������, ���������������� ��
    if (!mysql_query($query_del_region_info, $link)) {
        $errmsg.="<BR />��� �������� ���������, ��������� � �������� �������� ������, ����������, ���������...";
    }
    

    //������� ������, ���� ��� ����, ��� �������� �� �������� ��������...
    if ($errmsg!="") {
        echo "<H2><FONT color=\"red\">".$errmsg."</FONT></H2>";
    } else {     
        echo "<H3><FONT color=\"green\">���������� � ������� ������� �������</FONT></H3>";        
    }
    
    echo "<BR /><A href = 'eco_choice_region_sett.php' title = '��������� � ������ ��������'>��������� � ������ ��������</A>";
}

?>