<?php
require_once("conexao.php");

//BUSCAR O TOTAL DE REGISTROS PARA PAGINAR
$query3 = $pdo->query("SELECT * FROM blog ");
$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
$num_total = @count($res3);
$num_paginas = ceil($num_total / $itens_por_pagina_blog);

@session_start();
$id_usuario = @$_SESSION['id'];
$nivel_usuario = @$_SESSION['cargo'];
$titulo = $_GET['titulo'];

$query = $pdo->query("SELECT * FROM blog WHERE url_titulo = '$titulo'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = $res[0]['id'];
$usuario = $res[0]['autor'];
$data_post = implode('/', array_reverse(explode('-', $res[0]['data_postagem'])));
$imagem = $res[0]['imagem'];
$descricao_1 = $res[0]['descricao_1'];
$palavras = $res[0]['tag'];
$visitas = $res[0]['visitas'];
$visitas = $visitas + 1;

$pdo->query("UPDATE blog SET visitas = '$visitas' where url_titulo = '$titulo'");

$query2 = $pdo->query("SELECT * FROM funcionarios WHERE id = '$usuario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
@$nome_usuario = $res2[0]['nome'];

//TOTAL DE COMENTÁRIOS
$query3 = $pdo->query("SELECT * FROM comentarios WHERE post = '$id_reg'");
$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
$total_comentarios = @count($res3);

if (@$_GET['pagina'] != null) {
  $pag = $_GET['pagina'];
} else {
  $pag = 0;
}

$limite = $pag * @$itens_por_pagina_comentarios;
$pagina = $pag;
$nome_pag = 'blog-post.php';

//BUSCAR O TOTAL DE REGISTROS PARA PAGINAR
$query4 = $pdo->query("SELECT * FROM blog ");
$res4 = $query3->fetchAll(PDO::FETCH_ASSOC);
$num_total = @count($res4);
$num_paginas = ceil($num_total / $itens_por_pagina_comentarios);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?php echo $res[0]['tag'] ?>">
  <title><?php echo $nome_site ?> | Blog</title>

  <meta name="description" content="Site administrável com sistema de gerenciamento de estoque para Restaurantes, lanchonetes e afins, feito pela Vetor256.">
  <meta name="author" content="Vetor256.">

  <!-- Favicon -->
  <link rel="shortcut icon" href="assets/imagens/ico.ico" type="image/x-icon">

  <!-- Bootstrap -->
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <!-- Slick slider -->
  <link href="assets/css/slick.css" rel="stylesheet" type="text/css">

  <!-- Fancybox slider -->
  <link rel="stylesheet" href="assets/css/jquery.fancybox.css" type="text/css" media="screen" />
  <!-- Theme color -->
  <link id="switcher" href="assets/css/theme-color/default-theme.css" rel="stylesheet">



  <link rel="stylesheet" href="assets/css/meucss.css">

  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Prata' rel='stylesheet' type='text/css'>


  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/font-awesome.css">
  <!-- Main style sheet -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <!-- Pre Loader -->
  <div id="aa-preloader-area">
    <div class="mu-preloader">
      <img src="assets/imagens/preloader1.gif" alt=" loader img">
    </div>
  </div>
  <!-- SCROLL TOP BUTTON -->
  <a class="scrollToTop" href="#">
    <i class="fa fa-angle-up"></i>
    <span>Topo</span>
  </a>
  <!-- END SCROLL TOP BUTTON -->

  <!-- Start header section -->
  <header id="mu-header">

    <nav class="mu-main-navbar" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- LOGO -->
          <a class="navbar-brand" href="index.php"><img src="assets/imagens/logo1.png" alt="Logo img"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul id="top-menu" class="nav navbar-nav navbar-right mu-main-nav">
            <li><a href="index.php">HOME</a></li>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
  </header>
  <!-- End header section -->

  <!-- Start Blog banner  -->
  <section style="background-attachment: fixed; background-image:url(assets/imagens/blog-banner1.jpg);background-position: center center;background-size: cover;display: inline;float: left;width: 100%;position: relative;" id="mu-blog-banner">
    <div class="container">
      <div class="mu-blog-banner-area">
        <h2>BLOG</h2>

      </div>
    </div>
  </section>
  <!-- End Blog banner -->

  <!-- Start Blog -->
  <section id="mu-blog">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-blog-area">
            <div class="row">
              <div class="col-md-8 col-sm-8">
                <div class="mu-blog-content mu-blog-details">
                  <!-- Start Single blog item -->
                  <article class="mu-news-single">
                    <h2><?php echo $res[0]['titulo'] ?></h2>
                    <figure class="mu-news-img">
                      <img src="assets/imagens/blog/<?php echo $imagem ?>" alt="img">
                    </figure>
                    <div class="mu-news-single-content">
                      <ul class="mu-meta-nav">
                        <li>Por <?php echo $nome_usuario ?></li>
                        <li>Data: <?php echo $data_post ?></li>
                        <li>Visitas: <?php echo $visitas ?></li>
                      </ul>
                      <p><?php echo $descricao_1 ?></p>
                      <blockquote>
                        <p><?php echo $res[0]['descricao_2'] ?></p>
                      </blockquote>
                      <p><?php echo $res[0]['descricao_3'] ?></p>
                      <cite><?php echo $nome_usuario ?></cite>
                    </div>


                  </article>
                  <!-- End Single blog item -->
                </div>

                <!-- Start Blog comments thread -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="mu-comments-area">
                      <h3><?php echo $total_comentarios ?> Comentários</h3>
                      <div class="comments">

                        <ul class="commentlist">
                          <?php



                          $query = $pdo->query("SELECT * FROM comentarios WHERE post = '$id_reg'");;
                          $res = $query->fetchAll(PDO::FETCH_ASSOC);
                          for ($i = 0; $i < @count($res); $i++) {
                            foreach ($res[$i] as $key => $value) {
                            }
                            @$id_coment = $res[$i]['id'];
                            @$id_blog = $res[$i]['post'];
                            @$id_dono_comentario = $res[$i]['usuario'];
                            @$data_post = implode('/', array_reverse(explode('-', $res[$i]['data_post'])));
                          ?>
                            <li>
                              <div class="media">
                                <div class="media-left">
                                  <img class="media-object news-img" src="assets/imagens/testimonial-11.png" alt="img">
                                </div>
                                <div class="media-body">
                                  <h4 class="author-name"><?php echo $res[$i]['nome'] ?>

                                    <?php

                                    $queryCargo = $pdo->query("SELECT * FROM cargos WHERE id = '$nivel_usuario' ORDER BY id DESC ");
                                    $resCargo = $queryCargo->fetchAll(PDO::FETCH_ASSOC);
                                    @$nome_cargo = $resCargo[0]['nome'];

                                    if ($nome_cargo == 'Administrador' OR $id_usuario == $id_dono_comentario ) { ?>
                                      <a href="blog-post.php?titulo=<?php echo $titulo ?>&funcao=excluir&id=<?php echo $id_coment ?>" title="Excluir Comentário">

                                        <i class="fa fa-trash text-danger ml-4"></i></a>

                                    <?php } ?>
                                  </h4>
                                  <span class="comments-date"> Postado em <?php echo $data_post ?></span>
                                  <p><?php echo $res[$i]['comentario'] ?></p>
                                </div>
                              </div>
                            </li>

                          <?php } ?>
                        </ul>
                        <!-- comments pagination -->
                        <!-- <div class="row">
                          <div class="col-md-12">
                            <div class="mu-blog-pagination-area">
                              <nav>
                                <ul class="mu-blog-pagination">
                                  <li>
                                    <a href="<?php echo $nome_pag ?>?pagina=0" aria-label="Previous">
                                      <span class="fa fa-long-arrow-left"></span>
                                    </a>
                                  </li>

                                  <?php
                                  for ($i = 0; $i < @$num_paginas; $i++) {
                                    $estilo = '';
                                    if ($pagina == $i) {
                                      $estilo = 'text-danger';
                                    }

                                    if ($pagina >= ($i - 2) && $pagina <= ($i + 2)) { ?>
                                      <li><strong><a href="<?php echo $nome_pag ?>?pagina=<?php echo $i ?>" class="<?php echo $estilo ?>"><?php echo $i + 1 ?></a></strong></li>

                                  <?php }
                                  }
                                  ?>

                                  <li>
                                    <a href="<?php echo $nome_pag ?>?pagina=<?php echo $num_paginas - 1 ?>" aria-label="Next">
                                      <span class="fa fa-long-arrow-right"></span>
                                    </a>
                                  </li>
                                </ul>
                              </nav>
                            </div>
                          </div>
                        </div> -->
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Start Blog comments thread -->

              </div>
              <!-- Start Blog Sidebar -->
              <div class="col-md-4 col-sm-4">
                <aside class="mu-blog-sidebar">
                  <!-- Blog Sidebar Single -->
                  <div class="mu-blog-sidebar-single">
                    <h3>Categorias</h3>
                    <ul class="mu-catg-nav">
                      <?php
                      $query = $pdo->query("SELECT * FROM categorias ORDER BY nome ASC");
                      $res = $query->fetchAll(PDO::FETCH_ASSOC);
                      for ($i = 0; $i < @count($res); $i++) {
                        foreach ($res[$i] as $key => $value) {
                        }
                      ?>
                        <li><a href="index.php#mu-restaurant-menu"><?php echo $res[$i]['nome'] ?></a></li>
                      <?php } ?>

                    </ul>
                  </div>
                  <!-- End Blog Sidebar Single -->
                  <!-- Blog Sidebar Single -->
                  <div class="mu-blog-sidebar-single">
                    <h3>Últimas Notícias</h3>
                    <ul class="mu-recent-news-nav">
                      <?php
                      $query = $pdo->query("SELECT * FROM blog ORDER BY id DESC");
                      $res = $query->fetchAll(PDO::FETCH_ASSOC);
                      for ($i = 0; $i < @count($res); $i++) {
                        foreach ($res[$i] as $key => $value) {
                        }
                      ?>
                        <li><a href="blog-post.php?titulo=<?php echo $res[$i]['url_titulo'] ?>"><?php echo $res[$i]['titulo'] ?></a></li>
                      <?php } ?>
                    </ul>
                  </div>
                  <!-- End Blog Sidebar Single -->


                  <!-- Start comments box -->
                  <div class="col-md-12">
                    <div id="respond">
                      <h3 class="reply-title">Faça seu Comentário</h3>
                      <form id="commentform" method="post">

                        <p class="comment-form-author">
                          <label for="author">Nome <span class="required">*</span></label>
                          <input class="form-control" type="text" name="nome" value="" size="30" required="required">
                        </p>
                        <p class="comment-form-email">
                          <label for="email">Email <span class="required">*</span></label>
                          <input type="email" name="email" value="" aria-required="true" required="required">
                        </p>

                        <p class="comment-form-comment">
                          <label for="comment">Comentário</label>
                          <textarea maxlength="500" name="comentario" cols="45" rows="8" aria-required="true" required="required"></textarea>
                        </p>

                        <p class="form-submit">
                          <input type="submit" name="submit" class="mu-send-btn" value="Comentar">
                        </p>
                      </form>
                    </div>
                  </div>
              </div>
              <!-- End comments box -->
              </aside>
            </div>
            <!-- End Blog Sidebar -->
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- End Blog -->

  <!-- FOOTER SECTION -->
  <?php require_once("footer.php"); ?>

  <!-- jQuery library -->
  <script src="assets/js/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="assets/js/bootstrap.js"></script>
  <!-- Slick slider -->
  <script type="text/javascript" src="assets/js/slick.js"></script>
  <!-- Counter -->
  <script type="text/javascript" src="assets/js/waypoints.js"></script>
  <script type="text/javascript" src="assets/js/jquery.counterup.js"></script>
  <!-- Date Picker -->
  <script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>
  <!-- Mixit slider -->
  <script type="text/javascript" src="assets/js/jquery.mixitup.js"></script>
  <!-- Add fancyBox -->
  <script type="text/javascript" src="assets/js/jquery.fancybox.pack.js"></script>

  <!-- Custom js -->
  <script src="assets/js/custom.js"></script>

</body>

</html>

<?php
if (isset($_POST['submit'])) {

  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $comentario = $_POST['comentario'];
  $post = $id_reg;

  $query = $pdo->prepare("INSERT INTO comentarios SET nome = :nome, email = :email, comentario = :comentario, post = :post, data_post = curDate(), hora = curTime()");
  $query->bindValue(":nome", "$nome");
  $query->bindValue(":email", "$email");
  $query->bindValue(":comentario", "$comentario");
  $query->bindValue(":post", "$post");
  $query->execute();

  echo "<script language='javascript'>window.location='blog-post.php?titulo=$titulo'</script>";
}
?>

<?php if (@$_GET['funcao'] == 'excluir') {

  $id_com = @$_GET['id'];

  $pdo->query("DELETE from comentarios where id = '$id_com'");


  echo "<script language='javascript'>window.location='blog-post.php?titulo=$titulo'</script>";
}
?>