<?php
    require_once('../conexao.php');
    $postjson = json_decode(file_get_contents('php://input'), true);

    $limite = intVal($postjson['limit']);
    $start = intVal($postjson['start']);

    $busca = '%'.$postjson['nome'].'%';
    $query = $pdo->query("SELECT * FROM usuarios where nome LIKE '$busca' or cpf LIKE '$busca' order by id desc limit $start, $limite");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){ 

        for($i=0; $i < $total_reg; $i++){
            foreach ($res[$i] as $key => $value){	}

            $dados[] = array(
                'id' => $res[$i]['id'],
                'nome' => $res[$i]['nome'],
                'email' => $res[$i]['email'],
                'cpf' => $res[$i]['cpf'],
                'senha' => $res[$i]['senha'],
                'nivel' => $res[$i]['nivel'],
                
            );
            
        }

        $result = json_encode(array('itens'=>$dados));
        echo $result;

    }else{
        $result = json_encode(array('itens'=>'0'));
        echo $result; 
    }

?>