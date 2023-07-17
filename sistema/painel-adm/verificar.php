<?php 
@session_start();

if(@$_SESSION['cargo'] != '1'){
    echo "<script language='javascript'>window.location='../'</script>";
    exit();
}

?>