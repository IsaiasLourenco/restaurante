<?php 
@session_start();

if(@$_SESSION['cargo'] != '3'){
    echo "<script language='javascript'>window.location='../'</script>";
    exit();
}

?>