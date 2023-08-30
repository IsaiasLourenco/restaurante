<?php

@session_start();
require_once("../../conexao.php");
require_once("verificar.php");

//MENUS PARA O PAINEL
$menu1 = 'blog';

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
  <title>PAINEL DO CLIENTE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <link rel="shortcut icon" href="../../assets/imagens/ico.ico" type="image/x-icon">

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
  </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" type="text/css" href="../../assets/DataTables/datatables.min.css" />
  <script type="text/javascript" src="../../assets/DataTables/datatables.min.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

  <script src="../../assets/js/buscaCep.js" type="module" defer></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  <link rel="stylesheet" href="../../assets/css/fontawesome.css">
  <link rel="stylesheet" href="../../assets/css/style.css">
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
            <a class="nav-link text-light" aria-current="page" href="index.php?pag=<?php echo $menu1 ?>"><i class="fa-solid fa-blog"></i> Blog</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-light" aria-current="page" href="" data-bs-toggle="modal" data-bs-target="#modalComentario"><i class="fa-solid fa-comments"></i> Comentário</a>
          </li>

        </ul>

        <div class="d-flex mr-4">

          <img class="img-profile rounded-circle mt-4" src="../../assets/imagens/funcionarios/<?php echo $imagem_perfil ?>" width="38px" height="38px">

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 12px;">
              <?php echo $nome ?>
            </a>

            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

              <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#ModalEditar"><i class="fa-solid fa-user-pen"></i> Editar Perfil</a>

              <li>
                <hr class="dropdown-divider">
              </li>

              <li><a class="dropdown-item" href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>

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
    } else {
      require_once($menu1 . '.php');
    }
    ?>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>

<!--  Modal Editar-->
<div class="modal fade" tabindex="-1" id="ModalEditar" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <?php

        $query = $pdo->query("SELECT * FROM funcionarios WHERE id = '$id_usuario'");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $nome_cli = $res[0]['nome'];
        $email = $res[0]['email'];
        $cpf = $res[0]['cpf'];
        $telefone = $res[0]['telefone'];
        $cep = $res[0]['cep'];
        $rua = $res[0]['rua'];
        $numero = $res[0]['numero'];
        $bairro = $res[0]['bairro'];
        $cidade = $res[0]['cidade'];
        $estado = $res[0]['estado'];
        $datanasc = $res[0]['datanasc'];
        $datacad = $res[0]['datacad'];
        $senha = $res[0]['senha'];
        $cargo = $res[0]['cargo'];

        $titulo_modal = 'Editar Registro';

        ?>

        <h5 class="modal-title"><?php echo $titulo_modal ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="form-cli">
        <div class="modal-body">

          <div class="row">
            <div class="col-4">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nome </label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" autofocus value="<?php echo @$nome_cli ?>" required>
              </div>
            </div>

            <div class="col-4">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">CPF </label>
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" value="<?php echo @$cpf ?>" required>
              </div>
            </div>

            <div class="col-4">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email </label>
                <input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com" value="<?php echo @$email ?>" required>
              </div>
            </div>

          </div>

          <div class="row">

            <div class="col-4">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Telefone </label>
                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(xx)xxxx-xxxx" value="<?php echo @$telefone ?>" required>
              </div>
            </div>

            <div class="col-4">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">CEP </label>
                <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP" value="<?php echo @$cep ?>">
              </div>
            </div>

            <div class="col-4">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Rua </label>
                <input type="text" class="form-control" id="rua" name="rua" placeholder="Rua" value="<?php echo @$rua ?>" readonly>
              </div>
            </div>

          </div>

          <div class="row">

            <div class="col-2">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Número </label>
                <input type="text" class="form-control" id="numero" name="numero" placeholder="Número" value="<?php echo @$numero ?>">
              </div>
            </div>

            <div class="col-3">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Bairro </label>
                <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="<?php echo @$bairro ?>" readonly>
              </div>
            </div>

            <div class="col-3">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Cidade </label>
                <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" value="<?php echo @$cidade ?>" readonly>
              </div>
            </div>

            <div class="col-2">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Estado </label>
                <input type="text" class="form-control" id="estado" name="estado" placeholder="UF" value="<?php echo @$estado ?>" readonly>
              </div>
            </div>

            <div class="col-2">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Senha </label>
                <input type="text" class="form-control" id="senha" name="senha" placeholder="Senha" value="<?php echo @$senha ?>" required>
              </div>
            </div>

          </div>

          <input type="hidden" name="id" value="<?php echo @$id_usuario ?>">

          <small>
            <div align="center" id="mensagem">
            </div>
          </small>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-faded cores-button-recusar" data-bs-dismiss="modal" id="btn-fechar">Fechar</button>
          <button type="submit" class="btn btn-faded cores-button-confirmar">Salvar</button>
        </div>
      </form>

    </div>
  </div>
</div>
<!-- Fim Modal Editar-->

<!--  Modal Comentário-->
<div class="modal fade" tabindex="-1" id="modalComentario" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <?php

        $query = $pdo->query("SELECT * FROM funcionarios WHERE id = '$id_usuario'");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $nome_cli = $res[0]['nome'];
        $cargo = $res[0]['cargo'];

        $titulo_modal = 'Editar/Inserir Comentário de ' . $nome_cli;

        $queryCli = $pdo->query("SELECT * FROM clientes WHERE funcionario = '$id_usuario'");
        $resCli = $queryCli->fetchAll(PDO::FETCH_ASSOC);
        $comentario = $resCli[0]['comentario'];

        ?>

        <h5 class="modal-title"><?php echo $titulo_modal ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="form-com-cli">
        <div class="modal-body">

          <div class="mb-3">
            <label for="comentario" class="form-label">Comentário </label>
            <input name="comentario" autofocus value="<?php echo $comentario ?>" class="form-control" required id="comentario" cols="60" rows="10"></input>

          </div>

          <input type="hidden" name="id" value="<?php echo @$id_usuario ?>">

          <small>
            <div align="center" id="mensagem-com">
            </div>
          </small>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-faded cores-button-recusar" data-bs-dismiss="modal" id="btn-fechar-com">Fechar</button>
          <button type="submit" class="btn btn-faded cores-button-confirmar">Salvar</button>
        </div>
      </form>

    </div>
  </div>
</div>
<!-- Fim Modal Comentário-->

<!-- Mascaras JS -->
<script type="text/javascript" src="../../assets/js/mascaras.js"></script>

<!-- Ajax para funcionar Mascaras JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<!-- Ajax para editar dados -->
<script type="text/javascript">
  $("#form-cli").submit(function() {
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
      url: "editar-perfil.php",
      type: 'POST',
      data: formData,

      success: function(mensagem) {

        $('#mensagem').removeClass()

        if (mensagem.trim() == "Salvo com Sucesso!") {

          //$('#nome').val('');
          //$('#cpf').val('');
          $('#btn-fechar').click();
          location.reload();

        } else {

          $('#mensagem').addClass('text-danger')
        }

        $('#mensagem').text(mensagem)

      },

      cache: false,
      contentType: false,
      processData: false,

    });

  });
</script>
<!-- Fim Ajax para editar dados -->

<!-- Ajax para inserir/editar comentário -->
<script type="text/javascript">
  $("#form-com-cli").submit(function() {
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
      url: "editar-comentario.php",
      type: 'POST',
      data: formData,

      success: function(mensagem) {

        $('#mensagem-com').removeClass()

        if (mensagem.trim() == "Salvo com Sucesso!") {

          //$('#nome').val('');
          //$('#cpf').val('');
          $('#btn-fechar-com').click();
          location.reload();

        } else {

          $('#mensagem-com').addClass('text-danger')
        }

        $('#mensagem-com').text(mensagem)

      },

      cache: false,
      contentType: false,
      processData: false,

    });

  });
</script>
<!-- Fim Ajax para inserir/editar comentário -->