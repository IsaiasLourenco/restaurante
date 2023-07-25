<?php 
require_once("conexao.php");

//RECEBER OW DADOS
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$retorna = ['status'=>true, 'nome'=>$dados['nome']];
	
echo json_encode($retorna)
?>