<?php
require_once("conexao.php");

//TOTAIS
$query_prat = $pdo->query("SELECT * FROM pratos ");
$res_prat = $query_prat->fetchAll(PDO::FETCH_ASSOC);
$total_pratos = @count($res_prat);

$query_cli = $pdo->query("SELECT * FROM clientes ");
$res_cli = $query_cli->fetchAll(PDO::FETCH_ASSOC);
$total_cli = @count($res_cli);

$query_prod = $pdo->query("SELECT * FROM produtos ");
$res_prod = $query_prod->fetchAll(PDO::FETCH_ASSOC);
$total_prod = @count($res_prod);

$query_cat = $pdo->query("SELECT * FROM categorias ");
$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
$total_cat = @count($res_cat);

$query_beb = $pdo->query("SELECT * FROM categorias WHERE nome = 'Bebidas' ");
$res_beb = $query_beb->fetchAll(PDO::FETCH_ASSOC);
$total_bebidas = @count($res_beb);
if ($total_bebidas > 0) {
  $id_cat_beb = $res_beb[0]['id'];
  $query_beb = $pdo->query("SELECT * FROM produtos WHERE categoria = '$id_cat_beb'");
  $res_beb = $query_beb->fetchAll(PDO::FETCH_ASSOC);
  $total_bebidas = @count($res_beb);
}

$query_assa = $pdo->query("SELECT * FROM categorias WHERE nome = 'Assados' ");
$res_assa = $query_assa->fetchAll(PDO::FETCH_ASSOC);
$total_assados = @count($res_assa);
if ($total_assados > 0) {
  $id_cat_assa = $res_assa[0]['id'];
  $query_assa = $pdo->query("SELECT * FROM pratos WHERE categoria = '$id_cat_assa'");
  $res_assa = $query_assa->fetchAll(PDO::FETCH_ASSOC);
  $total_assados = @count($res_assa);
}

$query_px = $pdo->query("SELECT * FROM categorias WHERE nome = 'Peixes' ");
$res_px = $query_px->fetchAll(PDO::FETCH_ASSOC);
$total_peixes = @count($res_px);
if ($total_peixes > 0) {
  $id_cat_px = $res_px[0]['id'];
  $query_px = $pdo->query("SELECT * FROM pratos WHERE categoria = '$id_cat_px'");
  $res_px = $query_px->fetchAll(PDO::FETCH_ASSOC);
  $total_peixes = @count($res_px);
}

$query_pizz = $pdo->query("SELECT * FROM categorias WHERE nome = 'Pizzas' ");
$res_pizz = $query_pizz->fetchAll(PDO::FETCH_ASSOC);
$total_pizza = @count($res_pizz);
if ($total_pizza > 0) {
  $id_cat_pizza = $res_pizz[0]['id'];
  $query_pizz = $pdo->query("SELECT * FROM pratos WHERE categoria = '$id_cat_pizza'");
  $res_pizz = $query_pizz->fetchAll(PDO::FETCH_ASSOC);
  $total_pizza = @count($res_pizz);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $nome_site ?></title>

  <meta name="description" content="Site administrável com sistema de gerenciamento de estoque para Restaurantes, lanchonetes e afins, feito pela Vetor256.">
  <meta name="author" content="Vetor256.">

  <!-- Favicon -->
  <link rel="shortcut icon" href="assets/imagens/ico.ico" type="image/x-icon">
  
  <!-- Bootstrap -->
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <!-- Slick slider -->
  <link href="assets/css/slick.css" rel="stylesheet" type="text/css">
  <!-- Date Picker -->
  <link href="assets/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css">

  <!-- Fancybox slider -->
  <link rel="stylesheet" href="assets/css/jquery.fancybox.css" type="text/css" media="screen" />
  <!-- Theme color -->
  <link id="switcher" href="assets/css/theme-color/default-theme.css" rel="stylesheet">

  <!-- Main style sheet
       Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Prata' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="assets/css/style.css">  
  <link rel="stylesheet" href="assets/css/meucss.css">
  <link rel="stylesheet" href="assets/css/fontawesome.css">
</head>

<body>
  <!------ LEI DE ACEITAÇÃO DE COOKIES -->
  <div class="alerta hide">
    Guardamos estatísticas de visitas para melhorar sua experiência de navegação, saiba mais em nossa <a class="link-politica" title="Saiba mais sobre..." href="politica.php"><strong>política de privacidade.</strong></a>
    <a class="botao-aceitar" href="#"><strong>Aceitar</strong></a>
  </div>

  <script>
    if (!localStorage.loreCookie) {
      document.querySelector(".alerta").classList.remove('hide');
    }

    const acceptCookies = () => {
      document.querySelector(".alerta").classList.add('hide');
      localStorage.setItem("loreCookie", "accept");
    };

    const btnCookies = document.querySelector(".botao-aceitar");

    btnCookies.addEventListener('click', acceptCookies);
  </script>
  <!-- FIM LEI DE ACEITAÇÃO DE COOKIES -->

  <!-- Pre Loader -->
  <div id="aa-preloader-area">
    <div class="mu-preloader">
      <img src="assets/imagens/preloader1.gif" alt=" loader img">
    </div>
  </div>
  <!--START SCROLL TOP BUTTON -->
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
        <div id="navbar" class="navbar-collapse collapse index-navbar-padrao">
          <ul id="top-menu" class="nav navbar-nav navbar-right mu-main-nav">
            <li><a href="#mu-slider"><i class="fa-solid fa-house-chimney"></i> HOME</a></li>
            <li><a href="#mu-about-us"><i class="fa-solid fa-address-card"></i> SOBRE</a></li>
            <li><a href="#mu-restaurant-menu"><i class="fa-solid fa-book-open-reader"></i> CARDÁPIO</a></li>
            <li><a href="#mu-reservation"><i class="fa fa-pizza-slice"></i> RESERVAS</a></li>
            <li><a href="#mu-gallery"><i class="fa fa-image"></i> FOTOS</a></li>
            <li><a href="#mu-client-testimonial"><i class="fa-solid fa-user-plus"></i> ÁREA DOS CLIENTES</a></li>
            <li><a href="#mu-chef"><i class="fa-solid fa-people-group"></i> NOSSA EQUIPE</a></li>
            <li><a href="#mu-contact"><i class="fa-solid fa-address-book"></i> CONTATO</a></li>
            <li><a href="#mu-latest-news"><i class="fa-solid fa-blog"></i> BLOG</a></li>
            <li><a href="sistema" target="_blank"><i class="fa-solid fa-unlock-keyhole"></i> LOGIN</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
  </header>
  <!-- End header section -->

  <!-- Start slider  -->
  <section id="mu-slider">
    <div class="mu-slider-area">

      <div class="mu-top-slider">

        <?php
        $query = $pdo->query("SELECT * FROM banners ORDER BY id ASC");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < @count($res); $i++) {
          foreach ($res[$i] as $key => $value) {
          }
          $id_reg = $res[$i]['id'];

        ?>
          <div class="mu-top-slider-single">
            <img src="assets/imagens/banners/<?php echo $res[$i]['imagem'] ?>" alt="img">

            <!-- Top slider content -->
            <div class="mu-top-slider-content">

              <span class="mu-slider-small-title"><?php echo $res[$i]['titulo'] ?></span>
              <h2 class="mu-slider-title"><?php echo $res[$i]['subtitulo'] ?></h2>
              <p><?php echo $res[$i]['descricao'] ?></p>
              <?php if ($res[$i]['link'] != "") { ?>
                <a href="<?php echo $res[$i]['link'] ?>" target="_blank" class="mu-readmore-btn">SAIBA MAIS</a>
              <?php } ?>
            </div>
            <!-- / Top slider content -->
          </div>
        <?php } ?>
      </div>

    </div>

  </section>
  <!-- End slider  -->

  <!-- Start About us -->
  <section id="mu-about-us">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-about-us-area">
            <div class="mu-title">
              <span class="mu-subtitle">Descubra mais</span>
              <h2>SOBRE NÓS</h2>
              <i class="fa-solid fa-spoon"></i>
              <span class="mu-title-bar"></span>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mu-about-us-left">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam minus aliquid, itaque illum assumenda repellendus dolorem, dolore numquam totam saepe, porro delectus, libero enim odio quo. Explicabo ex sapiente sit eligendi, facere voluptatum! Quia vero rerum sunt porro architecto corrupti eaque corporis eum, enim soluta, perferendis dignissimos, repellendus, beatae laboriosam.</p>
                  <ul>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia.</li>
                  </ul>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque similique molestias est quod reprehenderit, quibusdam nam qui, quam magnam. Ex.</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mu-about-us-right">
                  <ul class="mu-abtus-slider">
                    <li><img src="assets/imagens/about-us/1.png" alt="img"></li>
                    <li><img src="assets/imagens/about-us/2.png" alt="img"></li>
                    <li><img src="assets/imagens/about-us/3.jpg" alt="img"></li>
                    <li><img src="assets/imagens/about-us/4.png" alt="img"></li>
                    <li><img src="assets/imagens/about-us/5.png" alt="img"></li>
                    <li><img src="assets/imagens/about-us/6.png" alt="img"></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End About us -->

  <!-- Start Counter Section -->
  <section id="mu-counter">
    <div class="mu-counter-overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="mu-counter-area">

              <ul class="mu-counter-nav">
                <li class="col-md-3 col-sm-3 col-xs-12">
                  <div class="mu-single-counter">
                    <span>Pratos</span>
                    <h3><span class="counter"><?php echo $total_pratos ?></span><sup>+</sup></h3>
                    <p>Especiais</p>
                  </div>
                </li>
                <li class="col-md-3 col-sm-3 col-xs-12">
                  <div class="mu-single-counter">
                    <span>Categprias</span>
                    <h3><span class="counter"><?php echo $total_cat ?></span><sup>+</sup></h3>
                    <p>Vasta Experiência</p>
                  </div>
                </li>
                <li class="col-md-3 col-sm-3 col-xs-12">
                  <div class="mu-single-counter">
                    <span>Produtos</span>
                    <h3><span class="counter"><?php echo $total_prod ?></span><sup>+</sup></h3>
                    <p>Muitas Opções</p>
                  </div>
                </li>
                <li class="col-md-3 col-sm-3 col-xs-12">
                  <div class="mu-single-counter">
                    <span>Clientela</span>
                    <h3><span class="counter"><?php echo $total_cli ?></span><sup>+</sup></h3>
                    <p>Sempre Satisfeita</p>
                  </div>
                </li>
              </ul>

              <ul class="mu-counter-nav">
                <li class="col-md-3 col-sm-3 col-xs-12">
                  <div class="mu-single-counter">
                    <span>Bebidas</span>
                    <h3><span class="counter"><?php echo $total_bebidas ?></span><sup>+</sup></h3>
                    <p>Refrescantes</p>
                  </div>
                </li>
                <li class="col-md-3 col-sm-3 col-xs-12">
                  <div class="mu-single-counter">
                    <span>Assados</span>
                    <h3><span class="counter"><?php echo $total_assados ?></span><sup>+</sup></h3>
                    <p>Crocantes e saborosos</p>
                  </div>
                </li>
                <li class="col-md-3 col-sm-3 col-xs-12">
                  <div class="mu-single-counter">
                    <span>Peixes</span>
                    <h3><span class="counter"><?php echo $total_peixes ?></span><sup>+</sup></h3>
                    <p>Especialidades</p>
                  </div>
                </li>
                <li class="col-md-3 col-sm-3 col-xs-12">
                  <div class="mu-single-counter">
                    <span>Pizzas</span>
                    <h3><span class="counter"><?php echo $total_pizza ?></span><sup>+</sup></h3>
                    <p>Sabor e Alegria</p>
                  </div>
                </li>
              </ul>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Counter Section -->

  <!-- Start Restaurant Menu -->
  <section id="mu-restaurant-menu">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-restaurant-menu-area">
            <div class="mu-title">
              <span class="mu-subtitle">Conheça</span>
              <h2>NOSSO CARPDÁPIO</h2>
              <i class="fa-solid fa-spoon"></i>
              <span class="mu-title-bar"></span>
            </div>
            <div class="mu-restaurant-menu-content">
              <ul class="nav nav-tabs mu-restaurant-menu">

                <?php
                $query = $pdo->query("SELECT * FROM categorias order by id asc");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                for ($i = 0; $i < @count($res); $i++) {
                  foreach ($res[$i] as $key => $value) {
                  }
                  $id_reg = $res[$i]['id'];
                  $nome_cat = $res[$i]['nome'];

                  if ($i == 0) {
                    $classe = 'active';
                  } else {
                    $classe = '';
                  }

                ?>

                  <li class="<?php echo $classe ?>" style="margin-bottom: 10px; "><a style="border-bottom: 1px solid #c1a35a;" href="#" onclick="mostrarProdutos(<?php echo $id_reg ?>)" data-toggle="tab"><?php echo $nome_cat ?></a></li>
                <?php } ?>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane fade in active" id="breakfast">
                  <div class="mu-tab-content-area">

                    <div class="row">

                      <ul class="mu-menu-item-nav">
                        <div id="listar-produtos">

                        </div>
                      </ul>

                    </div>

                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Restaurant Menu -->

  <!-- Start Reservation section -->
  <section id="mu-reservation">
    <div class="container">
      <div class="mu-reservation-overlay">

        <div class="row">
          <div class="col-md-12">
            <div class="mu-reservation-area">
              <div class="mu-title">
                <span class="mu-subtitle">Faça a sua</span>
                <h2>Reserva</h2>
                <i class="fa-solid fa-spoon"></i>
                <span class="mu-title-bar"></span>
              </div>
              <div class="mu-reservation-content">
                <p>Pedimos que as reservas sejam feitas com no mínimo três horas de antecedência. Para algo urgente, favor entrar em contato.</p>
                <form class="mu-reservation-form" method="POST" action="reservas.php">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control" name="nome" placeholder="Nome Completo" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <input type="text" class="form-control" name="telefone" id="telefone" placeholder="Telefone">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <input type="number" class="form-control" name="quantidade" placeholder="Quantos Virão" required></input>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <input type="date" class="form-control" name="dataReserva" required>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <textarea class="form-control" cols="30" rows="6" name="mensagem" placeholder="Sua mensagem"></textarea>
                      </div>
                    </div>
                    <button type="submit" class="mu-readmore-btn">Faça a Reserva</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Reservation section -->

  <!-- Start Gallery -->
  <section id="mu-gallery">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-gallery-area">
            <div class="mu-title">
              <span class="mu-subtitle">Aprecie</span>
              <h2>Nossas Fotos</h2>
              <i class="fa-solid fa-spoon"></i>
              <span class="mu-title-bar"></span>
            </div>
            <div class="mu-gallery-content">
              <div class="mu-gallery-top">
                <!-- Start gallery menu -->
                <ul>
                  <li class="filter active" data-filter="all">TODAS</li>

                  <?php
                  $query = $pdo->query("SELECT * FROM categorias_img order by id asc");
                  $res = $query->fetchAll(PDO::FETCH_ASSOC);
                  for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $id_reg = $res[$i]['id'];
                    $nome_cat = $res[$i]['nome'];

                  ?>

                    <li class="filter" data-filter=".<?php echo $nome_cat ?>"><?php echo $nome_cat ?></li> 

                  <?php } ?>

                </ul>
              </div>
              <!-- Start gallery image -->
              <div class="mu-gallery-body" id="mixit-container">


                <?php
                $query = $pdo->query("SELECT * FROM imagens ORDER BY id DESC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                for ($i = 0; $i < @count($res); $i++) {
                  foreach ($res[$i] as $key => $value) {
                  }
                  $id_reg = $res[$i]['id'];
                  $cat_img = $res[$i]['categorias_img'];

                  $query2 = $pdo->query("SELECT * FROM categorias_img where id = '$cat_img'");
                  $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                  $nome_cat_img = $res2[0]['nome'];

                ?>

                  <!-- start single gallery image -->
                  <div class="mu-single-gallery col-md-4 mix <?php echo $nome_cat_img ?>">
                    <div class="mu-single-gallery-item">
                      <figure class="mu-single-gallery-img">
                        <a href="#"><img alt="img" src="assets/imagens/gallery/<?php echo $res[$i]['imagem'] ?>"></a>
                      </figure>
                      <div class="mu-single-gallery-info">
                        <a href="assets/imagens/gallery/<?php echo $res[$i]['imagem'] ?>" data-fancybox-group="gallery" class="fancybox">
                          <img src="assets/imagens/plus.png" alt="plus icon img">
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- End single gallery image -->

                <?php } ?>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Gallery -->

  <!-- Start Client Testimonial section -->
  <section id="mu-client-testimonial">
    <div class="mu-overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="mu-client-testimonial-area">
              <div class="mu-title">
                <span class="mu-subtitle">Declaração de</span>
                <h2>Nossos Clientes</h2>
                <i class="fa-solid fa-spoon"></i>
                <span class="mu-title-bar"></span>
              </div>
              <!-- testimonial content -->
              <div class="mu-testimonial-content">
                <!-- testimonial slider -->
                <ul class="mu-testimonial-slider">

                  <?php
                  $query = $pdo->query("SELECT * FROM clientes ORDER BY id DESC LIMIT 6");
                  $res = $query->fetchAll(PDO::FETCH_ASSOC);
                  for ($i = 0; $i < @count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }
                    $id_cli = $res[$i]['id'];
                    $id_func = $res[$i]['funcionario'];
                    $comentario_cli = $res[$i]['comentario'];

                    $query1 = $pdo->query("SELECT * FROM funcionarios WHERE id = '$id_func' ORDER BY id ASC");
                    $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
                    $nome_cli = $res1[0]['nome'];
                  ?>

                    <li>
                      <div class="mu-testimonial-single">
                        <div class="mu-testimonial-info">
                          <p><?php echo $comentario_cli ?></p>
                        </div>
                        <div class="mu-testimonial-bio">
                          <p>- <?php echo $nome_cli ?></p>
                        </div>
                      </div>
                    </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Client Testimonial section -->

  <!-- Start Subscription section -->
  <section id="mu-subscription" style="background-color: black;">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-subscription-area">
            <form class="mu-subscription-form">
              <h4 style="color: white;">É nosso cliente? Cadastre-se para postar as fotos de sua visita e fazer seu comentário!</h4>
              <input type="text" style="background-color:black; width:300px" readonly>
              <a href="" data-toggle="modal" data-target="#modalCadastro" class="mu-readmore-btn botaoCadastro">CADASTRO</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Subscription section -->

  <!-- Start Chef Section -->
  <section id="mu-chef">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-chef-area">
            <div class="mu-title">
              <span class="mu-subtitle">Nossos Profissionais</span>
              <h2>MASTER CHEFS</h2>
              <i class="fa-solid fa-spoon"></i>
              <span class="mu-title-bar"></span>
            </div>
            <div class="mu-chef-content">

              <ul class="mu-chef-nav">
                <?php
                $query = $pdo->query("SELECT * FROM chef ORDER BY id DESC");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                for ($i = 0; $i < @count($res); $i++) {
                  foreach ($res[$i] as $key => $value) {
                  }
                  $id_chef = $res[$i]['id'];
                  $id_func = $res[$i]['funcionario'];
                  $especialidade = $res[$i]['especialidade'];

                  $query2 = $pdo->query("SELECT * FROM funcionarios WHERE id = '$id_func'");
                  $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                  @$nome_func = $res2[0]['nome'];
                  @$imagem_func = $res2[0]['imagem'];
                ?>

                  <li>

                    <div class="mu-single-chef">
                      <figure class="mu-single-chef-img">
                        <img src="assets/imagens/funcionarios/<?php echo $imagem_func ?>" alt="chef img">
                      </figure>
                      <div class="mu-single-chef-info">
                        <h4><?php echo $nome_func ?></h4>
                        <span><?php echo $especialidade ?></span>
                      </div>
                      <div class="mu-single-chef-social">
                        <?php if ($res[$i]['facebook']) { ?>
                          <a href="<?php echo $res[$i]['facebook'] ?>" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                        <?php } ?>
                        <?php if ($res[$i]['instagram']) { ?>
                          <a href="<?php echo $res[$i]['instagram'] ?>" target="_blank"><i class="fa-brands fa-square-instagram"></i></i></a>
                        <?php } ?>
                        <?php if ($res[$i]['youtube']) { ?>
                          <a href="<?php echo $res[$i]['youtube'] ?>" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                        <?php } ?>
                        <?php if ($res[$i]['linkedin']) { ?>
                          <a href="<?php echo $res[$i]['linkedin'] ?>" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
                        <?php } ?>
                      </div>
                    </div>
                  </li>
                <?php } ?>
              </ul>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Chef Section -->

  <!-- Start Latest News -->
  <section id="mu-latest-news">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-latest-news-area">
            <div class="mu-title">
              <span class="mu-subtitle">Últimas Notícias</span>
              <h2>DIRETO DO NOSSO BLOG</h2>
              <i class="fa-solid fa-spoon"></i>
              <span class="mu-title-bar"></span>
            </div>
            <div class="mu-latest-news-content">
              <div class="row">

                <?php
                $query = $pdo->query("SELECT * FROM blog ORDER BY id DESC LIMIT 2");
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
                  @$nome_usuario = $res2[0]['nome'];

                ?>
                  <!-- start single blog -->
                  <div class="col-md-6">
                    <article class="mu-news-single">
                      <h3><a href="blog-post.php?titulo=<?php echo $res[$i]['url_titulo'] ?>"><?php echo $titulo ?></a></h3>
                      <figure class="mu-news-img">
                        <a href="blog-post.php?titulo=<?php echo $res[$i]['url_titulo'] ?>"><img src="assets/imagens/blog/<?php echo $imagem ?>" alt="img" width="700px" height="350px"></a>
                      </figure>
                      <div class="mu-news-single-content">
                        <ul class="mu-meta-nav">
                          <li>Por: <?php echo $nome_usuario ?></li>
                          <li>Data: <?php echo $data_post ?></li>
                        </ul>
                        <p style="height: 80px; overflow:auto"><?php echo $descricao ?></p>
                        <div class="mu-news-single-bottom">
                          <a href="blog-post.php?titulo=<?php echo $res[$i]['url_titulo'] ?>" class="mu-readmore-btn">Leia Mais</a>
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
  </section>
  <!-- End Latest News -->

  <!-- Start Contact section -->
  <section id="mu-contact">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-contact-area">
            <div class="mu-title">
              <span class="mu-subtitle">Entre em contato</span>
              <h2>CONOSCO</h2>
              <i class="fa-solid fa-spoon"></i>
              <span class="mu-title-bar"></span>
            </div>
            <div class="mu-contact-content">
              <div class="row">
                <div class="col-md-6">
                  <div class="mu-contact-left">
                    <form class="mu-contact-form" action="mailto:isaiaslourenco2020@gmail.com" method="post" enctype="text/plain">
                      <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" id="name" name="nome_contato" placeholder="Nome" required>
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email_contato" placeholder="Email" required>
                      </div>

                      <div class="form-group">
                        <label for="message">Mensagem</label>
                        <textarea class="form-control" id="message" name="mensagem" cols="30" rows="10" placeholder="Digite sua Mensagem" required></textarea>
                      </div>
                      <button type="submit" value="enviar" class="mu-send-btn">Enviar Mensagem</button>
                      <button type="reset" value="limpar" class="mu-send-btn cores-button-recusar">Limpar</button>
                    </form>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mu-contact-right">
                    <div class="mu-contact-widget">
                      <h3>Dúvidas? <i class="fa-solid fa-clipboard-question"></i></h3>
                      <p>Mande e-mail, SMS ou Whats'app</p>
                      <address>
                        <p><i class="fa-solid fa-phone"></i> <?php echo $telefone ?></p>
                        <p><i class="fa-brands fa-whatsapp"></i><a href="http://api.whatsapp.com/send?1=pt_BR&phone=<?php echo $whatsapp_link_web ?>" target="_blank"><?php echo $whatsapp ?></a></p>
                        <p><i class="fa-solid fa-envelope-open-text"></i><?php echo $email_site ?></p>
                        <p><i class="fa-solid fa-location-dot"></i><?php echo $endereco ?></p>
                      </address>
                    </div>  
                    <div class="mu-contact-widget">
                      <h3>Funcionamento <i class="fa-solid fa-door-open"></i></h3>
                      <address>
                        <p><span>Segunda - Sexta</span> 11:30 - 00:00</p>
                        <p><span>Sábado</span> 11:30 - 01:00</p>
                        <p><span>Domingo</span> 11:30 - 22:00</p>
                      </address>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Contact section -->

  <!-- Start Map section -->
  <section id="mu-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1844.0234042383015!2d-46.96375773861792!3d-22.427263961086155!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c8f847a698783f%3A0x69598814300b2017!2sAv.%2022%20de%20Outubro%20-%20Mogi%20Mirim%2C%20SP!5e0!3m2!1spt-BR!2sbr!4v1689433802579!5m2!1spt-BR!2sbr" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
  </section>
  <!-- End Map section -->

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

  <!-- Add mascaras -->
  <script type="text/javascript" src="assets/js/mascaras.js"></script>

  <!-- Ajax para mascaras -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>

<!-- Modal Cadastro Cliente -->
<div class="modal fade" id="modalCadastro" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Cadastre-se no <?php echo $nome_site ?> </h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
        <div class="modal-body">

          <div class="form-group">
            <label for="nomeCad">Nome</label>
            <input type="text" class="form-control" id="nomeCad" name="nomeCad" aria-describedby="emailHelp" required>

          </div>

          <div class="form-group">
            <label for="emailCad">Email </label>
            <input type="email" class="form-control" id="emailCad" name="emailCad" aria-describedby="emailHelp" required>
          </div>

          <div class="form-group">
            <label for="senhaCad">Senha</label>
            <input type="password" class="form-control" name="senhaCad" id="senhaCad" required>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn cores-button-recusar" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn cores-button-confirmar" name="btn-cadastrar">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Fim Modal Cadastro Cliente -->

<!-- Ajax Cadastro Cliente -->
<?php

if (isset($_POST['btn-cadastrar'])) {
  $hoje = date('Y-m-d');
  $email_novo = $_POST['emailCad'];

  //BUSCAR O REGISTRO JÁ CADASTRADO NO BANCO
  $query = $pdo->query("SELECT * FROM funcionarios WHERE email = '$email_novo'");
  $res = $query->fetchAll(PDO::FETCH_ASSOC);
  $total_reg = @count($res);
  if ($total_reg > 0) {
    echo "<script language='javascript'>window.alert('E-mail já cadastrado!')</script>";
    echo "<script language='javascript'>window.location='index.php'</script>";
    exit();
  }

  $queryCargo = $pdo->query("SELECT * FROM cargos WHERE nome = 'Cliente' ");
  $resCargo = $queryCargo->fetchAll(PDO::FETCH_ASSOC);
  $total_reg_cli = @count($resCargo);
  if ($total_reg_cli == 0) {

    //INSERIR OS CARGOS NECESSÁRIOS PARA A VALIDAÇÃO NA TABELA CARGOS
    $pdo->query("INSERT INTO cargos SET nome = 'Cliente'");
    $id_cargoNovoCli = $pdo->lastInsertId();

    $query = $pdo->prepare("INSERT INTO funcionarios (nome, email, senha, cargo, datacad) VALUES (:nome, :email, :senha, :cargo, :datacad)");
    $query->bindValue(":nome", $_POST['nomeCad']);
    $query->bindValue(":email", $_POST['emailCad']);
    $query->bindValue(":senha", $_POST['senhaCad']);
    $query->bindValue(":cargo", $id_cargoNovoCli);
    $query->bindValue(":datacad", $hoje);
    $query->execute();
    $id_NovoFunc = $pdo->lastInsertId();
    $comentario = 'Alguma coisa a ser editada depois!!';

    $queryCli = $pdo->prepare("INSERT INTO clientes (funcionario, comentario) VALUES (:funcionario, :comentario)");
    $queryCli->bindValue(":funcionario", $id_NovoFunc);
    $queryCli->bindValue(":comentario", $comentario);
    $queryCli->execute();

    echo "<script language='javascript'>window.alert('Cadastrado com Sucess!!')</script>";
    echo "<script language='javascript'>window.location='index.php'</script>";
    exit();
  }
  $id_cargo = $resCargo[0]['id'];
  $query = $pdo->prepare("INSERT INTO funcionarios (nome, email, senha, cargo, datacad) VALUES (:nome, :email, :senha, :cargo, :datacad)");
  $query->bindValue(":nome", $_POST['nomeCad']);
  $query->bindValue(":email", $_POST['emailCad']);
  $query->bindValue(":senha", $_POST['senhaCad']);
  $query->bindValue(":datacad", $hoje);
  $query->bindValue(":cargo", $id_cargo);
  $query->execute();
  $id_NovoFunc = $pdo->lastInsertId();
  $comentario = 'Alguma coisa a ser editada depois!!';
  $queryCli = $pdo->prepare("INSERT INTO clientes (funcionario, comentario) VALUES (:funcionario, :comentario)");
  $queryCli->bindValue(":funcionario", $id_NovoFunc);
  $queryCli->bindValue(":comentario", $comentario);
  $queryCli->execute();

  echo "<script language='javascript'>window.alert('Cadastrado com Sucesso!!')</script>";
  exit();
}
?>
<!-- Fim Ajax Cadastro Cliente -->

<script type="text/javascript">
  $(document).ready(function() {
    mostrarProdutos(0);
  });
</script>


<script type="text/javascript">
  function mostrarProdutos(idcat) {
    $.ajax({
      url: "listar-produtos.php",
      method: 'POST',
      data: {
        idcat
      },
      dataType: "html",

      success: function(result) {
        $("#listar-produtos").html(result);
      }
    });
  }
</script>