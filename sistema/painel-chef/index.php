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

// Usa o ID do funcionário em questão para buscar os dados na tabela do Chef
$query = $pdo->query("SELECT * FROM chef WHERE funcionario = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if ($total_reg > 0) {
  $especialidade = $res[0]['especialidade'];
  $facebook = $res[0]['facebook'];
  $youtube = $res[0]['youtube'];
  $linkedin = $res[0]['linkedin'];
  $instagram = $res[0]['instagram'];
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>PAINEL DO CHEFE</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

  <link rel="stylesheet" href="../../assets/css/fontawesome.css">
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="../../assets/css/meucss.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="font-size:12px">
    <div class="container-fluid">

      <a class="navbar-brand" href="index.php"><img class="img-index" src="../../assets/imagens/logo1.png" alt="Logo"></a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

        <span class="navbar-toggler-icon"></span>

      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-index-recep">

          <li class="nav-item">
            <a class="nav-link text-light" aria-current="page" href="index.php?pag=<?php echo $menu1 ?>"><i class="fa-solid fa-blog"></i> Blog</a>
          </li>

        </ul>
      </div>

      <img class="img-profile rounded-circle mt-1" src="../../assets/imagens/funcionarios/<?php echo $imagem_perfil ?>" width="40px" height="40px">

      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $nome ?>
          </a>

          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#"><i class="fa-solid fa-user-pen"></i> Editar Perfil</a>
            <a class="dropdown-item" href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i>Sair</a>

          </div>
        </li>
      </ul>

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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <?php

        $query = $pdo->query("SELECT * FROM chef WHERE funcionario = '$id_usuario'");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $facebook = @$res[0]['facebook'];
        $instagram = @$res[0]['instagram'];
        $youtube = @$res[0]['youtube'];
        $linkedin = @$res[0]['linkedin'];
        $especialidade = @$res[0]['especialidade'];

        $titulo_modal = 'Editar Registro';

        ?>

        <h5 class="modal-title"><?php echo $titulo_modal ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="form-chef">
        <div class="modal-body">

          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Facebook </label>
                <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Facebook" autofocus value="<?php echo @$facebook ?>" required>
              </div>
            </div>

            <div class="col-6">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Instagram </label>
                <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Instagram" value="<?php echo @$instagram ?>" required>
              </div>
            </div>

          </div>

          <div class="row">

            <div class="col-6">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Youtube </label>
                <input type="youtube" class="form-control" id="youtube" name="youtube" placeholder="Youtube" value="<?php echo @$youtube ?>" required>
              </div>
            </div>

            <div class="col-6">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Linkedin </label>
                <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="Linkedin" value="<?php echo @$linkedin ?>" required>
              </div>
            </div>

          </div>

          <div class="col-12">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Especialidade </label>
              <input type="text" class="form-control" id="especialidade" name="especialidade" placeholder="Especialidade" value="<?php echo @$especialidade ?>" required>
            </div>
          </div>

          <input type="hidden" name="id_perfil" value="<?php echo @$id_usuario ?>">

          <small>
            <div align="center" id="mensagem-perfil">
            </div>
          </small>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-faded cores-button-recusar" data-bs-dismiss="modal" id="btn-fechar-perfil">Fechar</button>
          <button type="submit" class="btn btn-faded cores-button-confirmar">Salvar</button>
        </div>
      </form>

    </div>
  </div>
</div>
<!-- Fim Modal Editar-->

<!-- Ajax para editar dados -->
<script type="text/javascript">
  $("#form-chef").submit(function() {
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
          //location.reload();

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
<!-- Fim Ajax para editar dados -->