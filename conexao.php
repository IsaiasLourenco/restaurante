<?php 
require_once("config.php");
date_default_timezone_set('America/Sao_Paulo');
try{
    // $pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");
    $pdo = new PDO("mysql:host=$servidor;dbname=$banco;port=3306;charset=utf8", "$usuario", "$senha");
    
}catch(Exception $e){
    echo 'Conexão não estabelecida!! <br><br>' .$e;
}

?>