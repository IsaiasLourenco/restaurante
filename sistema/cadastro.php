<?php

require_once("../conexao.php");

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CADASTRO DE CLIENTES</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="../assets/imagens/ico.ico" type="image/x-icon">

  <!-- Bootstrap -->
  <link href="../assets/css/bootstrap.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
  </script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">



  <link rel="stylesheet" href="../assets/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/css/fontawesome.css">

  <link rel="stylesheet" href="../assets/css/meucss.css">
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="../index.php"><img src="../assets/imagens/logo1.png" alt="Logo img"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
    <ul class="navbar-nav mr-auto">

      <li class="nav-item">
        <a class="nav-link" href="../index.php#mu-client-testimonial" style="color: white;"><i class="fa-solid fa-right-from-bracket"></i> SAIR</a>
      </li>


    </ul>

  </div>
</nav>


<h2>Cadastro de Clientes</h2>

<body onload="document.frmEnviarDados.nome.focus()">

  <form method="post" action="." name="frmClientes" id="frmClientes" enctype="multipart/form-data">

    <div class="frm-cli">

      <div>
        <label>Nome</label><br>
        <input type="text" name="nome" id="nome" placeholder="Nome" required class="frm-cliente-nome">
      </div>

      <div>
        <label>Email </label><br>
        <input type="email" id="email" name="email" placeholder="nome@exemplo.com" required class="frm-cliente-email">
      </div>

      <div>
        <label>Telefone </label><br>
        <input type="text" id="telefone" name="telefone" placeholder="(xx) xxxxx-xxxx" required class="frm-cliente-telefone">
      </div>

      <div>
        <label>CEP</label><br>
        <input type="text" id="cep" name="cep" placeholder="CEP" required class="frm-cliente-cep">
      </div>

      <div>
        <label>Rua</label><br>
        <input type="text" name="rua" id="rua" placeholder="Rua" readonly class="frm-cliente-rua">
      </div>

    </div>

    <div class="frm-cli">

      <div>
        <label>Nº</label><br>
        <input type="text" name="numero" class="frm-cliente-numero" id="numero" placeholder="Nº" required>
      </div>

      <div>
        <label>Bairro</label><br>
        <input type="text" name="bairro" class="frm-cliente-bairro" id="bairro" placeholder="Bairro" readonly>
      </div>

      <div>
        <label>Cidade</label><br>
        <input type="text" name="cidade" class="frm-cliente-cidade" id="cidade" placeholder="Cidade" readonly>
      </div>

      <div>
        <label>Estado</label><br>
        <input type="text" name="estado" class="frm-cliente-estado" id="estado" placeholder="Estado" readonly>
      </div>

      <div>
        <label>Senha</label>
        <input type="password" name="senha" class="frm-cliente-senha" id="senha" placeholder="Senha ******" required>
      </div>

    </div>

    <small>
      <div align="center" id="mensagem">
      </div>
    </small>

    <div class="modal-footer">
      <button type="button" class="btn btn-faded cores-button-recusar frm-cliente-botao-fecha" id="btn-fechar">Fechar</button>
      <button type="submit" class="btn btn-faded cores-button-confirmar frm-cliente-botao-salva">Salvar</button>
    </div>
  </form>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- Mascaras JS -->
  <script type="text/javascript" src="../assets/js/mascaras.js"></script>

  <!-- Ajax para funcionar Mascaras JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

  <script src="../assets/js/buscaCep.js"></script>

</body>


</html>

<!-- Ajax para inserir ou editar dados -->
<script type="text/javascript">
  $("#frmClientes").submit(function() {
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
      url: "inserir-cliente.php",
      type: 'POST',
      data: formData,

      success: function(mensagem) {

        $('#mensagem').removeClass()

        if (mensagem.trim() == "Salvo com Sucesso!") {

          $('#btn-fechar').click();
          window.location = "../index.php#mu-client-testimonial";

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
<!--Fim Ajax para inserir ou editar dados -->