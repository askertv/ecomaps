<?php
require_once 'ii.php';

$errmsg = "";

$query_choose_region = "SELECT region FROM $datatable2 WHERE region_id = '".$_POST['region_id']."'";

$result_choose_region = @mysql_query($query_choose_region, $link);

$current_region_name = @mysql_result($result_choose_region, 0, 0);

//������ "��������" ������... 
if (isset($_POST['sent']) && $_POST['sent'] == 1) {
        
        if (isset($_POST['zone_edit'])) {

            //�������� ���������� ���� ��� ��������� �������� �������
            if ($_POST['zone_edit'] != "") {

                //���������� ������ �������� ������� � ���� ������
                $query_edit_region_name = "UPDATE $datatable2 SET region = '".$_POST['zone_edit']."'";
                $query_edit_region_name.= " WHERE region_id = '".$_POST['region_id']."'";             
              
                //���� �������� ������ ��� ���������, ���������������� ��
                if (!mysql_query($query_edit_region_name, $link)) {
                    $errmsg.="<BR />��� ��������� �������� ������� �������� ������, ����������, ��������� ����...";
                }
            } else {
                //���� ���� ��� ��������� �������� ������� �� ���������, �������� �� ����
                $errmsg.="<BR /><H3>���� ��� ��������� �������� ������� �� ���������, ����������, ��������� � ��������� ����...</H3>";
            }
        }    

    //������� ������, ���� ��� ����, ��� �������� �� �������� ��������� �������� �������
    if ($errmsg!="") {
        echo "<H2><FONT color=\"red\">".$errmsg."</FONT></H2>";
    } else {     
        echo "<H3><FONT color=\"green\">�������� ������� ������� ��������</FONT></H3>";        
    }
    
    echo "<BR /><A href = 'eco_choice_region_sett.php' title = '��������� � ������ ��������'>��������� � ������ ��������</A>";
}

?>