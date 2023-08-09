<?php
require_once("conexao.php");

@session_start();
$id_user = @$_SESSION['id'];
$cargo_user = @$_SESSION['cargo'];

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

//TOTAL DE COMENTÁRIOS
$query3 = $pdo->query("SELECT * FROM comentarios WHERE post = '$id_reg'");
$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
$total_comentarios = @count($res3);

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
            <li class="active"><a href="blog-post.php">BLOG</a></li>
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
        <h2>BLOG</h2>
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
                      </ul>
                      <p><?php echo $descricao_1 ?></p>
                      <blockquote>
                        <p><?php echo $res[0]['descricao_2'] ?></p>
                      </blockquote>
                      <p><?php echo $res[0]['descricao_3'] ?></p>
                      <cite><?php echo $nome_usuario ?></cite>
                    </div>

                    <div class="mu-news-single-bottom">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mu-news-single-tag">
                            <ul class="mu-news-single-tagnav">
                              <li>TAGS :</li>
                              <li><a href="#"><?php echo $res[0]['tag'] ?></a></li>
                            </ul>
                          </div>
                        </div>

                      </div>
                    </div>
                  </article>
                  <!-- End Single blog item -->
                </div>
                <!-- Start Blog navigation -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="mu-blog-single-navigation">
                      <a href="#" class="mu-blog-prev"><span class="fa fa-long-arrow-left"></span></a>
                      <a href="#" class="mu-blog-next"><span class="fa fa-long-arrow-right"></span></a>
                    </div>
                  </div>
                </div>
                <!-- End Blog navigation -->

                <!-- Start related news -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="mu-blog-related-post">
                      <div class="mu-title">
                        <h2>Últimas Notícias</h2>
                        <i class="fa fa-spoon"></i>
                        <span class="mu-title-bar"></span>
                      </div>

                      <div class="mu-blog-related-post-area">

                        <div class="row">

                          <?php
                          $query = $pdo->query("SELECT * FROM blog ORDER BY id ASC LIMIT 2");
                          $res = $query->fetchAll(PDO::FETCH_ASSOC);
                          for ($i = 0; $i < @count($res); $i++) {
                            foreach ($res[$i] as $key => $value) {
                            }
                            $id_usuario = $res[$i]['autor'];
                            $data_post = implode('/', array_reverse(explode('-', $res[$i]['data_postagem'])));
                            $titulo = $res[$i]['titulo'];
                            $imagem = $res[$i]['imagem'];
                            $descricao = $res[$i]['descricao_1'];

                            $query2 = $pdo->query("SELECT * FROM funcionarios WHERE id = $id_usuario");
                            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                            $nome_usuario = $res2[0]['nome'];

                          ?>

                            <div class="col-md-6 col-sm-6">
                              <article class="mu-news-single">
                                <h3><a href="blog-post.php?titulo=<?php echo $res[$i]['url_titulo'] ?>"><?php echo $res[$i]['titulo'] ?></a></h3>
                                <figure class="mu-news-img">
                                  <a href="blog-post.php?titulo=<?php echo $res[$i]['url_titulo'] ?>"><img alt="img" width="700px" height="250px" src="assets/imagens/blog/<?php echo $imagem ?>"></a>
                                </figure>
                                <div class="mu-news-single-content">
                                  <ul class="mu-meta-nav">
                                    <li>Por <?php echo $nome_usuario ?></li>
                                    <li><?php echo $data_post ?></li>
                                  </ul>
                                  <p style="height: 80px; overflow:auto"><?php echo $descricao ?></p>
                                  <div class="mu-news-single-bottom">
                                    <a class="mu-readmore-btn" href="blog-post.php?titulo=<?php echo $res[$i]['url_titulo'] ?>">Saiba Mais</a>
                                  </div>
                                </div>
                              </article>
                            </div>
                          <?php } ?>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <!-- End related news -->

                <!-- Start Blog comments thread -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="mu-comments-area">
                      <h3><?php echo $total_comentarios ?> Comentários</h3>
                      <div class="comments">

                        <ul class="commentlist">
                          <?php
                          $query = $pdo->query("SELECT * FROM comentarios WHERE post = '$id_reg' ORDER BY id DESC");
                          $res = $query->fetchAll(PDO::FETCH_ASSOC);
                          for ($i = 0; $i < @count($res); $i++) {
                            foreach ($res[$i] as $key => $value) {
                            }
                            $data_post = implode('/', array_reverse(explode('-', $res[$i]['data_post'])));
                            $id_comentario = $res[$i]['id'];

                          ?>
                            <li>
                              <div class="media">
                                <div class="media-left">
                                  <img class="media-object news-img" src="assets/imagens/testimonial-11.png" alt="img">
                                </div>
                                <div class="media-body">
                                  <h4 class="author-name"><?php echo $res[$i]['nome'] ?>
                                    <?php if ($cargo_user == '1' || $id_user = '$autor') { ?>
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
                        <nav>
                          <ul class="pagination comments-pagination">
                            <li>
                              <a href="#" aria-label="Previous">
                                <span aria-hidden="true">«</span>
                              </a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                              <a href="#" aria-label="Next">
                                <span aria-hidden="true">»</span>
                              </a>
                            </li>
                          </ul>
                        </nav>
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
                  <?php
                  $query = $pdo->query("SELECT * FROM blog ORDER BY id DESC LIMIT 4");
                  $res = $query->fetchAll(PDO::FETCH_ASSOC);
                  for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $imagem = $res[$i]['imagem'];

                  ?>
                    <div class="mu-blog-sidebar-single">
                      <a class="mu-sidebar-add">
                        <a href="blog-post.php?titulo=<?php echo $res[$i]['url_titulo'] ?>"><img src="assets/imagens/blog/<?php echo $imagem ?>" title="Visitar: <?php echo $res[$i]['titulo'] ?>" alt="img" width="350px" height="200px"></a>
                      </a>
                    </div>
                  <?php } ?>
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
                          <label for="comment">Comment</label>
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

  echo 'Salvo com Sucesso!';
  echo "<script language='javascript'> window.location='blog-post.php?titulo=<?php echo $res[0]['titulo'] ?>' </script>";
}
?>