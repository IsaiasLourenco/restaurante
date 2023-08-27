<?php

@session_start();
require_once("../../conexao.php");
require_once("verificar.php");

//MENUS PARA O PAINEL
$menu1 = 'home';
$menu2 = 'funcionarios';
$menu3 = 'fornecedores';
$menu4 = 'cargos';
$menu5 = 'mesas';
$menu6 = 'categorias';
$menu7 = 'produtos';
$menu8 = 'pratos';
$menu9 = 'compras';
$menu10 = 'banners';
$menu11 = 'blog';
$menu12 = 'estoque';
$menu13 = 'reservas';
$menu14 = 'imagens';


//recuperar os dados do usuário
$id_usuario = $_SESSION['id'];
$query = $pdo->query("SELECT * FROM funcionarios WHERE id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg > 0) {
  $nome_usu = $res[0]['nome'];
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
  $foto_perfil = $res[0]['imagem'];
} else {
  $foto_perfil = 'sem-foto.jpg';
}


?>

<!DOCTYPE html>
<html>

<head>
  <title>PAINEL ADMINISTRATIVO</title>


  <link rel="shortcut icon" href="../../assets/imagens/ico.ico" type="image/x-icon">

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
  </script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" type="text/css" href="../../assets/DataTables/datatables.min.css" />
  <script type="text/javascript" src="../../assets//DataTables/datatables.min.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

  <script src="../../assets/js/buscaCep.js" type="module" defer></script>

  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="../../assets/css/fontawesome.css">

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
            <a class="nav-link text-light" aria-current="page" href="index.php?pag=<?php echo $menu1 ?>"><i class="fas fa-home"></i> Home</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-fill"></i>
              Pessoas
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

              <li><a class="dropdown-item" href="index.php?pag=<?php echo $menu2 ?>"><i class="fa-solid fa-image-portrait"></i> Funcionários</a></li>
              <li><a class="dropdown-item" href="index.php?pag=<?php echo $menu3 ?>"><i class="fa-solid fa-user-plus"></i> Fornecedores</a></li>

            </ul>
          </li>


          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-folder-plus"></i>
              Cadastros
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="index.php?pag=<?php echo $menu4 ?>"><i class="fa-solid fa-boxes-stacked"></i> Cargos</a></li>

              <li><a class="dropdown-item" href="index.php?pag=<?php echo $menu5 ?>"><i class="fa-solid fa-utensils"></i> Mesas</a></li>

              <li><a class="dropdown-item" href="index.php?pag=<?php echo $menu10 ?>"><i class="fa-regular fa-window-maximize"></i> Banners</a></li>

              <li><a class="dropdown-item" href="index.php?pag=<?php echo $menu14 ?>"><i class="bi bi-image"></i> Imagens</a></li>

            </ul>

          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-cubes-stacked"></i>
              Estoque
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="index.php?pag=<?php echo $menu7 ?>"><i class="fa-solid fa-cart-shopping"></i> Produtos</a></li>

              <li><a class="dropdown-item" href="index.php?pag=<?php echo $menu8 ?>"><i class="fa-solid fa-bowl-food"></i> Pratos</a></li>

              <li><a class="dropdown-item" href="index.php?pag=<?php echo $menu6 ?>"><i class="fa-solid fa-layer-group"></i> Categorias</a></li>

              <li>
                <hr class="dropdown-divider">
              </li>

              <li><a class="dropdown-item" href="index.php?pag=<?php echo $menu9 ?>"><i class="fa-solid fa-bag-shopping"></i> Compras</a></li>

              <li><a class="dropdown-item" href="index.php?pag=<?php echo $menu12 ?>"><i class="fa-solid fa-arrow-trend-down"></i> Estoque Baixo</a></li>

            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link text-light" aria-current="page" href="index.php?pag=<?php echo $menu11 ?>"><i class="fa-solid fa-blog"></i> Blog</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-light" aria-current="page" href="index.php?pag=<?php echo $menu13 ?>"><i class="fa fa-pizza-slice"></i> Reservas</a>
          </li>


          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-receipt"></i>
              Relatórios
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" target="_blank" href="../rel/rel_produtos_class.php"><i class="fa-solid fa-cart-shopping"></i> Produtos</a></li>

              <li><a target="_blank" class="dropdown-item" href="../rel/rel_pratos_class.php"><i class="fa-solid fa-bowl-food"></i> Pratos</a></li>

              <li><a target="_blank" class="dropdown-item" href="../rel/rel_cardapio_class.php"><i class="fa-solid fa-book-open-reader"></i> Cardápio</a></li>

              <li><a target="_blank" class="dropdown-item" href="../rel/rel_estoque_class.php"><i class="fa-solid fa-arrow-trend-down"></i> Estoque Baixo</a></li>

              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalRelCompras"><i class="fa-solid fa-bag-shopping"></i> Compras</a>
              </li>

            </ul>

          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-tv"></i>
              Telas
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" target="_blank" href="../painel-tela/tela.php"><i class="fa-solid fa-desktop"></i> Tela de Pedidos</a></li>

              <li><a target="_blank" class="dropdown-item" href="../painel-tela/tela-chamada.php"><i class="fa-solid fa-display"></i> Tela de Chamadas</a></li>
            </ul>
          </li>

        </ul>



        <div class="d-flex mr-4">

          <img class="img-profile rounded-circle mt-4" src="../../assets/imagens/funcionarios/<?php echo $foto_perfil ?>" width="40px" height="40px">

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $nome_usu ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          </li>

          <li><a class="dropdown-item" href="../logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Sair</a></li>

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
    } else if (@$_GET['pag'] == $menu8) {
      require_once($menu8 . '.php');
    } else if (@$_GET['pag'] == $menu9) {
      require_once($menu9 . '.php');
    } else if (@$_GET['pag'] == $menu10) {
      require_once($menu10 . '.php');
    } else if (@$_GET['pag'] == $menu11) {
      require_once($menu11 . '.php');
    } else if (@$_GET['pag'] == $menu12) {
      require_once($menu12 . '.php');
    } else if (@$_GET['pag'] == $menu13) {
      $pag_painel = '../painel-recep/';
      require_once('../painel-recep/' . $menu13 . '.php');
    } else if (@$_GET['pag'] == $menu14) {
      require_once($menu14 . '.php');
    } else {
      require_once($menu1 . '.php');
    }
    ?>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
          <button type="submit" class="btn btn-faded cores-button-confirmar">Gerar Relatório</button>

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