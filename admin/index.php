<?php
session_start();
if (isset ($_POST['submit'])) {
    if ($_POST['user'] == 'php5' && $_POST['pass'] == 'iscool') {
        $_SESSION['username'] = $_POST['user'];
        if (isset ($_GET['url'])) {
            $url = $_GET['url'];
        } else {
            $url = '../eco_sett/eco_choice_region_sett.php';
        }
        if (!isset ($_COOKIE [session_name()])) {
            if (strstr ($url, "?")) {
                header ("Location: ".$url."&".session_name()."=".session_id());
            } else {
                header ("Location: ".$url."?".session_name()."=".session_id());
            }
        } else {
            header ("Location: ".$url);
        }
    }
}
?>
<HTML>
<HEAD>
<TITLE>�������������� �������������</TITLE>
</HEAD>
<BODY>
<BR />
<FORM method = 'post'>
<INPUT type = 'text' name = 'user' /><BR />
<INPUT type = 'password' name = 'pass' /><BR />
<INPUT type = 'submit' name = 'submit' value = '����' /><BR />
</FORM>
</BODY>
</HTML>