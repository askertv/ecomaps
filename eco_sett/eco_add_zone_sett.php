<HTML>
<HEAD>
<TITLE>���������� ������ �������</TITLE>
<LINK rel = 'stylesheet' type = 'text/css' href= 'styles_edit.css'>
</HEAD>
<BODY>

<?php
require_once 'ii.php';

$errmsg = "";

$query_choose_region = "SELECT region FROM $datatable2 ORDER BY region";

$result_choose_region = @mysql_query($query_choose_region, $link);

for ($i = 0; $i < mysql_num_rows($result_choose_region); $i++) {
    $list_regions[$i] = mysql_fetch_array($result_choose_region);
}

//������ "��������" ������... 
if (isset($_POST['sent'])) {
             
        
        if (isset($_POST['zone_add'])) {

            //�������� ���������� ���� ��� ���������� ������ �������
            if ($_POST['zone_add'] != "") {

                // ���������� ������ ������� � ���� ������
                $query_add_region = "INSERT INTO $datatable2 (region, loaddate) VALUES ('".$_POST['zone_add']."', now())";             
              
                //���� �������� ������ ��� ����������, ���������������� ��
                if (!mysql_query($query_add_region, $link)) {
                    $errmsg.="<BR />��� ���������� ������ � ����� ������� �������� ������, ����������, ��������� ����...";
                }
            } else {
                //���� ���� ��� ������ ������� �� ���������, �������� �� ����
                $errmsg.="<BR /><H3>���� ��� ���������� ������ ������� �� ���������, ����������, ��������� � ��������� ����...</H3>";
            }
        }    

    //������� ������, ���� ��� ����, ��� �������� �� �������� ���������� ����� ������
    if ($errmsg!="") {
        echo "<H2><FONT color=\"red\">".$errmsg."</FONT></H2>";
    } else {     
        echo "<H3><FONT color=\"green\">����� ������ ��������</FONT></H3>";
        
        //���������� post-����������
        unset($_POST['sent']);
        unset($_POST['zone_add']);
    }
}

?>

<H3>���������� ������ �������</H3>

<FORM action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
<INPUT type="hidden" name="sent" value="1">
<TABLE width="600" border="0" cellspacing="5" cellpading="0">
<TR><TD width="280" valign="top"><FONT size="-1">������ ��������:</FONT></TD>
    <TD width="320"><SELECT size="1">   
                    <?php    
                        for ($i = 0; $i<count($list_regions); $i++) {
                            echo "<OPTION>".$list_regions[$i]['region']."</OPTION>";
                        }   
                    ?>
                    </SELECT>
    </TD>
</TR>
<TR>
    <TD><B><FONT size="-1" color="blue">���� ��� � ������,&nbsp;&mdash; �������� �����:</FONT></B></TD>
    <TD><INPUT type="text" name="zone_add" size="40" value=""></TD>
</TR>
<TR><TD>&nbsp;</TD><TD><BR /><INPUT type="submit" value="��������"></TD>   
</TR>
<TR><TD colspan=2 align='center'><BR /><BR /><FONT size="-1"><A href='eco_choice_region_sett.php'>��������� �����</A></FONT></TD></TR>
</TABLE>
</FORM>
</BODY>
</HTML>