<?php

@session_start();
require_once("../../conexao.php");
require_once("verificar.php");

//MENUS PARA O PAINEL
$menu1 = 'home';
$menu3 = 'clientes';

if (@$_GET['pag'] == 'reservas' || @$_GET['pag'] == 'pedidos') {
  $classeMenu = 'text-dark';
}


//recuperar os dados do usuário
$id_usuario = $_SESSION['id'];
$query = $pdo->query("SELECT * FROM funcionarios WHERE id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg > 0) {
  $nome = $res[0]['nome'];
  $email_usu = $res[0]['email'];
  $cpf_usu = $res[0]['cpf'];
  $telefone_usu = $res[0]['telefone'];
  $cep_usu = $res[0]['cep'];
  $rua_usu = $res[0]['rua'];
  $numero_usu = $res[0]['numero'];
  $bairro_usu = $res[0]['bairro'];
  $cidade_usu = $res[0]['cidade'];
  $estado_usu = $res[0]['estado'];
  $datanasc = $res[0]['datanasc'];
  $datacad_usu = $res[0]['datacad'];
  $senha_usu = $res[0]['senha'];
  $nivel_usu = $res[0]['cargo'];
}

if ($total_reg > 0) {
  $imagem_perfil = $res[0]['imagem'];

  if ($imagem_perfil == "") {
    $imagem_perfil = 'sem-foto.jpg';
  }
}


?>

<!DOCTYPE html>
<html>

<head>
  <title>PAINEL ADMINISTRATIVO</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <link rel="shortcut icon" href="../../assets/imagens/ico.ico" type="image/x-icon">

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
  </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" type="text/css" href="../../sistema/vendor/DataTables/datatables.min.css" />
  <script type="text/javascript" src="../../sistema/vendor/DataTables/datatables.min.js"></script>
  <!--<script src="../../assets/js/buscaCep.js" type="module" defer></script>-->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../assets/css/index_p_adm.css">
  <script src="../../assets/js/buscaCep.js" type="module" defer></script>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">

      <a class="navbar-brand" href="index.php"><img src="../../assets/imagens/logo1.png" width="150"></a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

        <span class="navbar-toggler-icon"></span>

      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link text-light" aria-current="page" href="index.php?pag=<?php echo $menu1 ?>">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-light" aria-current="page" href="index.php?pag=<?php echo $menu2 ?>">Reservas</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-light" aria-current="page" href="index.php?pag=<?php echo $menu3 ?>">Clientes</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Financeiro
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

              <li><a class="dropdown-item" href="index.php?pag=<?php echo $menu4 ?>">Contas a Pagar</a></li>
              <li><a class="dropdown-item" href="index.php?pag=<?php echo $menu5 ?>">Contas a Receber</a></li>

              <li>
                <hr class="dropdown-divider">
              </li>

              <li><a class="dropdown-item" href="index.php?pag=<?php echo $menu6 ?>">Compras</a></li>
              <li><a class="dropdown-item" href="index.php?pag=<?php echo $menu7 ?>">Movimentações</a></li>

            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Relatórios
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" target="_blank" href="../rel/rel_produtos_class.php">Produtos</a></li>

              <li><a target="_blank" class="dropdown-item" href="../rel/rel_pratos_class.php">Pratos</a></li>

              <li><a target="_blank" class="dropdown-item" href="../rel/rel_cardapio_class.php">Cardápio</a></li>

              <li><a target="_blank" class="dropdown-item" href="../rel/rel_estoque_class.php">Estoque Baixo</a></li>

              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalRelCompras">Compras</a>
              </li>

            </ul>

          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Telas
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" target="_blank" href="../painel-tela/tela.php">Tela de Pedidos</a></li>

              <li><a target="_blank" class="dropdown-item" href="../painel-tela/tela-chamada.php">Tela de Chamadas</a></li>
            </ul>
          </li>

        </ul>

        <div class="d-flex mr-4">

          <img class="img-profile rounded-circle mt-4" src="../../assets/imagens/funcionarios/<?php echo $imagem_perfil ?>" width="40px" height="40px">

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $nome ?>
            </a>

            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">


          </li>
          <li><a class="dropdown-item <?php echo $classeMenu ?>" href="../logout.php">Sair</a></li>

          </ul>
          </li>

        </div>

      </div>

    </div>

  </nav>

  <div class="container mt-4">
    <?php
    if (@$_GET['pag'] == $menu1) {
      require_once($menu1 . '.php');
    } else if (@$_GET['pag'] == $menu2) {
      require_once($menu2 . '.php');
    } else if (@$_GET['pag'] == $menu3) {
      require_once($menu3 . '.php');
    } else if (@$_GET['pag'] == $menu4) {
      require_once($menu4 . '.php');
    } else if (@$_GET['pag'] == $menu5) {
      require_once($menu5 . '.php');
    } else if (@$_GET['pag'] == $menu6) {
      require_once($menu6 . '.php');
    } else if (@$_GET['pag'] == $menu7) {
      require_once($menu7 . '.php');
    }  else {
      require_once($menu1 . '.php');
    }
    ?>
  </div>

</body>

</html>

<!--  Modal Rel Compras-->
<div class="modal fade" tabindex="-1" id="ModalRelCompras" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Relatório de Compras</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../rel/rel_compras_class.php" method="POST" target="_blank">

        <div class="modal-body">

          <div class="row">
            <div class="col-md-4">
              <div class="form-group mb-3">
                <label>Data Inicial</label>
                <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control mt-1" name="dataInicial">
              </div>
            </div>
            <div class="col-md-4">

              <div class="form-group mb-3">
                <label>Data Final</label>
                <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control mt-1" name="dataFinal">
              </div>

            </div>

            <div class="col-md-4">

              <div class="form-group mb-3">
                <label>Pago</label>
                <select class="form-select mt-1" name="status">
                  <option value="">Todas</option>
                  <option value="Sim">Sim</option>
                  <option value="Não">Não</option>

                </select>
              </div>

            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-faded" style="background-color:#c1a35f; border-color:#f5f0f0; color:#f5f0f0">Gerar Relatório</button>

        </div>
      </form>

    </div>
  </div>
</div>
<!-- Fim do  Modal Rel Compras-->

<!-- Mascaras JS -->
<script type="text/javascript" src="../../assets/js/mascaras.js"></script>

<!-- Ajax para funcionar Mascaras JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<!-- Ajax para inserir ou editar dados -->
<script type="text/javascript">
  $("#form-perfil").submit(function() {
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
      url: "editar-perfil.php",
      type: 'POST',
      data: formData,

      success: function(mensagem) {

        $('#mensagem-perfil').removeClass()

        if (mensagem.trim() == "Salvo com Sucesso!") {

          //$('#nome').val('');
          //$('#cpf').val('');
          $('#btn-fechar-perfil').click();
          location.reload();

        } else {

          $('#mensagem-perfil').addClass('text-danger')
        }

        $('#mensagem-perfil').text(mensagem)

      },

      cache: false,
      contentType: false,
      processData: false,

    });

  });
</script>
<!-- Fim do Ajax para inserir ou editar dados -->

<!--SCRIPT PARA CARREGAR IMAGEM -->
<script type="text/javascript">
  function carregarImgPerfil() {

    var target = document.getElementById('target-perfil');
    var file = document.querySelector("#imagem-perfil").files[0];

    var arquivo = file['name'];
    resultado = arquivo.split(".", 2);
    //console.log(resultado[1]);

    if (resultado[1] === 'pdf') {
      $('#target-perfil').attr('src', "../img/pdf.png");
      return;
    }

    var reader = new FileReader();

    reader.onloadend = function() {
      target.src = reader.result;
    };

    if (file) {
      reader.readAsDataURL(file);


    } else {
      target.src = "";
    }
  }
</script>
<!-- FIM DO SCRIPT PARA CARREGAR IMAGEM -->