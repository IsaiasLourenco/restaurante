<?php
require_once("conexao.php");

if (@$_GET['pagina'] != null) {
  $pag = $_GET['pagina'];
} else {
  $pag = 0;
}

$limite = $pag * @$itens_por_pagina_blog;
$pagina = $pag;
$nome_pag = 'blog.php';

//BUSCAR O TOTAL DE REGISTROS PARA PAGINAR
$query3 = $pdo->query("SELECT * FROM blog ");
$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
$num_total = @count($res3);
$num_paginas = ceil($num_total / $itens_por_pagina_blog);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $nome_site ?> | Blog</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="assets/imagens/ico.ico" type="image/x-icon">

  <!-- Font awesome -->
  <link href="assets/css/font-awesome.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <!-- Slick slider -->
  <link rel="stylesheet" type="text/css" href="assets/css/slick.css">
  <!-- Date Picker -->
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker.css">
  <!-- Fancybox slider -->
  <link rel="stylesheet" href="assets/css/jquery.fancybox.css" type="text/css" media="screen" />
  <!-- Theme color -->
  <link id="switcher" href="assets/css/theme-color/default-theme.css" rel="stylesheet">

  <!-- Main style sheet -->
  <link href="style.css" rel="stylesheet">


  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Prata' rel='stylesheet' type='text/css'>


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
    <nav class="navbar navbar-default mu-main-navbar" role="navigation">
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
            <li class="active"><a href="blog.php">BLOG</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
  </header>
  <!-- End header section -->

  <!-- Start Blog banner  -->
  <section id="mu-blog-banner">
    <div class="container">
      <div class="mu-blog-banner-area">
        <h2>Blog</h2>
        <ol class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li class="active">Blog</li>
        </ol>
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
                <div class="mu-blog-content">
                  <?php
                  $query = $pdo->query("SELECT * FROM blog order by id desc LIMIT $limite, $itens_por_pagina_blog");
                  $res = $query->fetchAll(PDO::FETCH_ASSOC);
                  for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $id_usuario = $res[$i]['autor'];
                    $data_post = implode('/', array_reverse(explode('-', $res[$i]['data_postagem'])));
                    $titulo = $res[$i]['titulo'];
                    $imagem = $res[$i]['imagem'];
                    $descricao = $res[$i]['descricao_1'];
                    $visitas = $res[$i]['visitas'];
                    $visitas = $visitas + 1;

                    $query2 = $pdo->query("SELECT * FROM funcionarios WHERE id = $id_usuario");
                    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                    $nome_usuario = $res2[0]['nome'];

                  ?>
                    <!-- Start Single blog item -->
                    <article class="mu-news-single">
                      <h3><a href="blog-post.php?titulo=<?php echo $res[$i]['url_titulo'] ?>"><?php echo $titulo ?></a></h3>
                      <figure class="mu-news-img">
                        <a href="blog-post.php?titulo=<?php echo $res[$i]['url_titulo'] ?>"><img src="assets/imagens/blog/<?php echo $imagem ?>" alt="img" width="700px" height="350px"></a>
                      </figure>
                      <div class="mu-news-single-content">
                        <ul class="mu-meta-nav">
                          <cite>Por: <?php echo $nome_usuario ?></cite>
                          <li>Data: <?php echo $data_post ?></li>
                          <li>Visitas: <?php echo $visitas ?></li>
                        </ul>
                        <p style="height: 80px; overflow:auto"><?php echo $descricao ?></p>
                        <div class="mu-news-single-bottom">
                          <a href="blog-post.php?titulo=<?php echo $res[$i]['url_titulo'] ?>" class="mu-readmore-btn">Leia Mais</a>
                        </div>
                      </div>
                    </article>
                    <!-- End Single blog item -->
                  <?php } ?>
                </div>
                <div class="row">
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
                </div>
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