<?php 
require_once("conexao.php");

//RECEBER OW DADOS
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(empty($dados['nome'])){
    $retorna = ['status' => false, 'msg' => "<p style='color: #f00000;'>Erro: Favor preencher o nome!</p>"];    
}elseif(empty($dados['telefone'])){
    $retorna = ['status' => false, 'msg' => "<p style='color: #f00000;'>Erro: Favor preencher o telefone!</p>"];    
}elseif(empty($dados['email'])){
    $retorna = ['status' => false, 'msg' => "<p style='color: #f00000;'>Erro: Favor preencher o email!</p>"];    
}elseif(empty($dados['cep'])){
    $retorna = ['status' => false, 'msg' => "<p style='color: #f00000;'>Erro: Favor preencher o CEP!</p>"];    
}elseif(empty($dados['numero'])){
    $retorna = ['status' => false, 'msg' => "<p style='color: #f00000;'>Erro: Favor preencher o Nº!</p>"];    
}else{
    
    $query = "INSERT INTO funcionarios (nome, telefone, email, cep, rua, numero, bairro, cidade, estado ) VALUES(:nome, :email, :telefone, :cep, :rua, :numero, :bairro, :cidade, :estado)";

    $cad =  $conn->prepare($query);
    $cad->bindparam(':nome', $dados['nome']);
    $cad->bindparam(':email', $dados['email']);
    $cad->bindparam(':telefone', $dados['telefone']);
    $cad->bindparam(':cep', $dados['cep']);
    $cad->bindparam(':rua', $dados['rua']);
    $cad->bindparam(':numero', $dados['numero']);
    $cad->bindparam(':bairro', $dados['bairro']);
    $cad->bindparam(':cidade', $dados['cidade']);
    $cad->bindparam(':estado', $dados['estado']);
    $cad->execute();

    if($cad->rowcount()){
        $retorna = ['status' => true, 'msg' => "<p style='color: #90ee90;'>Cliente cadastrado!</p>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<p style='color: #f00000;'>Erro: Cliente NÃO cadastrado!</p>"];    
    }

    
}
	
echo json_encode($retorna);
