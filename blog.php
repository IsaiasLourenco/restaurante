<?php
require_once("conexao.php");

$titulo = $_GET['titulo'];

$query = $pdo->query("SELECT * FROM blog WHERE url_titulo = '$titulo'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = $res[0]['id'];
$autor = $res[0]['autor'];
$data_post = implode('/', array_reverse(explode('-', $res[0]['data_postagem'])));
$imagem = $res[0]['imagem'];
$descricao_1 = $res[0]['descricao_1'];

$query2 = $pdo->query("SELECT * FROM funcionarios WHERE id = '$autor'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$nome_usuario = $res2[0]['nome'];
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
                  <!-- Start Single blog item -->
                  <article class="mu-news-single">
                    <h3><a href="blog-post.php"><?php echo $res[0]['titulo'] ?></a></h3>
                    <figure class="mu-news-img">
                      <a href="blog-post.php"><img src="assets/imagens/blog/<?php echo $imagem ?>" alt="img"></a>
                    </figure>
                    <div class="mu-news-single-content">
                      <ul class="mu-meta-nav">
                        <li>Por <?php echo $nome_usuario ?></li>
                        <li>Data: <?php echo $data_post ?></li>
                      </ul>
                      <p><?php echo $descricao_1 ?></p>
                      <div class="mu-news-single-bottom">
                        <a href="blog-post.php" class="mu-readmore-btn">Saiba Mais</a>
                      </div>
                    </div>
                  </article>
                  <!-- End Single blog item -->
                  <!-- Start Single blog item -->
                  <article class="mu-news-single">
                    <h3><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, distinctio!</a></h3>
                    <figure class="mu-news-img">
                      <a href="#"><img src="assets/imagens/news/2.jpg" alt="img"></a>
                    </figure>
                    <div class="mu-news-single-content">
                      <ul class="mu-meta-nav">
                        <li>Por Admin</li>
                        <li>Data: 10 Maio 2016</li>
                      </ul>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio est quaerat magnam exercitationem voluptas, voluptatem sed quam ab laborum voluptatum tempore dolores itaque, molestias vitae.</p>
                      <div class="mu-news-single-bottom">
                        <a href="blog-post.php" class="mu-readmore-btn">Saiba Mais</a>
                      </div>
                    </div>
                  </article>
                  <!-- End Single blog item -->
                  <!-- Start Single blog item -->
                  <article class="mu-news-single">
                    <h3><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, distinctio!</a></h3>
                    <figure class="mu-news-img">
                      <a href="#"><img src="assets/imagens/news/3.jpg" alt="img"></a>
                    </figure>
                    <div class="mu-news-single-content">
                      <ul class="mu-meta-nav">
                        <li>Por Admin</li>
                        <li>Data: 10 Maio 2016</li>
                      </ul>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio est quaerat magnam exercitationem voluptas, voluptatem sed quam ab laborum voluptatum tempore dolores itaque, molestias vitae.</p>
                      <div class="mu-news-single-bottom">
                        <a href="blog-post.php" class="mu-readmore-btn">Saiba Mais</a>
                      </div>
                    </div>
                  </article>
                  <!-- End Single blog item -->
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="mu-blog-pagination-area">
                      <nav>
                        <ul class="mu-blog-pagination">
                          <li>
                            <a href="#" aria-label="Previous">
                              <span class="fa fa-long-arrow-left"></span>
                            </a>
                          </li>
                          <li><a href="#">1</a></li>
                          <li><a href="#">2</a></li>
                          <li class="active"><a href="#">3</a></li>
                          <li><a href="#">4</a></li>
                          <li><a href="#">5</a></li>
                          <li>
                            <a href="#" aria-label="Next">
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
                      <li><a href="#">Cake</a></li>
                      <li><a href="#">Pizza</a></li>
                      <li><a href="#">Drinks</a></li>
                      <li><a href="#">Dessert</a></li>
                      <li><a href="#">Chicken</a></li>
                      <li><a href="#">Beef</a></li>
                      <li><a href="#">Mutton</a></li>
                    </ul>
                  </div>
                  <!-- End Blog Sidebar Single -->
                  <!-- Blog Sidebar Single -->
                  <div class="mu-blog-sidebar-single">
                    <h3>Últimas Postagens</h3>
                    <ul class="mu-recent-news-nav">
                      <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, ipsum!</a></li>
                      <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, ipsum!</a></li>
                      <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, ipsum!</a></li>
                      <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, ipsum!</a></li>
                      <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, ipsum!</a></li>
                    </ul>
                  </div>
                  <!-- End Blog Sidebar Single -->
                  <!-- Blog Sidebar Single -->
                  <div class="mu-blog-sidebar-single">
                    <h3>Tags</h3>
                    <div class="tag-cloud">
                      <a href="#">Cake</a>
                      <a href="#">Pizza</a>
                      <a href="#">Drinks</a>
                      <a href="#">Dessert</a>
                      <a href="#">Chicken</a>
                      <a href="#">Beef</a>
                      <a href="#">Mutton</a>
                    </div>
                  </div>
                  <!-- End Blog Sidebar Single -->
                  <!-- Blog Sidebar Single -->
                  <div class="mu-blog-sidebar-single">
                    <a href="#" class="mu-sidebar-add">
                      <img src="assets/imagens/banner-ads1.jpg" alt="img">
                    </a>
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