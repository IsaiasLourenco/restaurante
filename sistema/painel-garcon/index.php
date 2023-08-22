<?php

@session_start();
require_once("../../conexao.php");

//MENUS PARA O PAINEL
$menu1 = 'pedidos';
$menu2 = 'comissoes';

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
  <title>PAINEL DO GARÇOM</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
  

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../assets/css/index_p_adm.css">
  <script src="../../assets/js/buscaCep.js" type="module" defer></script>
  <link rel="stylesheet" href="../../assets/src/css/fontawesome.css">
  <link rel="stylesheet" href="../../assets/src/css/style.css">
  <link rel="stylesheet" href="../../assets/css/meucss.css">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">

      <a class="navbar-brand" href="index.php"><img src="../../assets/imagens/logo1.png" width="150"></a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

        <span class="navbar-toggler-icon"></span>

      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-index-recep">

          <li class="nav-item">
            <a class="nav-link text-light" aria-current="page" href="index.php?pag=<?php echo $menu1 ?>"><i class="fas fa-utensils"></i> Pedidos</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-light" aria-current="page" href="index.php?pag=<?php echo $menu2 ?>"><i class="fa-solid fa-dollar-sign"></i> Comissões</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-light" aria-current="page" href="" data-bs-toggle="modal" data-bs-target="#ModalRelComissoes"><i class="fa-solid fa-file-invoice-dollar"></i> Relatório de Comissões</a>
          </li>

        </ul>

        <div class="d-flex mr-4">

          <img class="img-profile rounded-circle mt-4" src="../../assets/imagens/funcionarios/<?php echo $imagem_perfil ?>" width="38px" height="38px">

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 12px;">
              <?php echo $nome ?>
            </a>

            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">


          </li>
          <li><a class="dropdown-item <?php echo $classeMenu ?>" href="../logout.php"><i class="bi bi-box-arrow-right"></i> Sair</a></li>

          </ul>
          </li>

        </div>

      </div>

    </div>

  </nav>

  <div class="container mt-4">
    <?php
    if (@$_GET['pag'] == $menu1) {
      $pag_painel = '../painel-recep/';
      require_once('../painel-recep/' . $menu1 . '.php');
    } else if (@$_GET['pag'] == $menu2) {
      require_once($menu2 . '.php');
    } else {
      $pag_painel = '../painel-recep/';
      require_once('../painel-recep/' . $menu1 . '.php');
    }
    ?>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>

<!--  Modal Rel Comissões-->
<div class="modal fade" tabindex="-1" id="ModalRelComissoes" data-bs-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Relatório de Comissões</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../rel/rel_comissoes_class.php" method="POST" target="_blank">

        <div class="modal-body">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label>Data Inicial</label>
                <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control mt-1" name="dataInicial">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label>Data Final</label>
                <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control mt-1" name="dataFinal">
              </div>

            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-faded cores-button-confirmar">Gerar Relatório</button>

        </div>
      </form>

    </div>
  </div>
</div>
<!-- Fim do  Modal Rel Comissões-->