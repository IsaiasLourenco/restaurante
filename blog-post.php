<?php require_once("config.php") ?>
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
            <li><a href="blog.php">BLOG</a></li>
            <li class="active"><a href="blog-post.php">DETALHES</a></li>
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
        <h2>Detalhes</h2>
        <ol class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li><a href="blog.php">Blog</a></li>
          <li class="active">Detalhes</li>
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
                    <h2><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, distinctio!</a></h2>
                    <figure class="mu-news-img">
                      <a href="#"><img src="assets/imagens/news/1.jpg" alt="img"></a>
                    </figure>
                    <div class="mu-news-single-content">
                      <ul class="mu-meta-nav">
                        <li>Por Admin</li>
                        <li>Data: 10 Maio 2016</li>
                      </ul>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio est quaerat magnam exercitationem voluptas, voluptatem sed quam ab laborum voluptatum tempore dolores itaque, molestias vitae.</p>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio est quaerat magnam exercitationem voluptas, voluptatem sed quam ab laborum voluptatum tempore dolores itaque, molestias vitae.</p>
                      <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore tempore ipsam, harum, quae amet fugiat nostrum quam error quis illum id ratione explicabo repellat laboriosam architecto, rerum vel velit necessitatibus?</p>
                        <cite> - Mr. Jhon</cite>
                      </blockquote>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia, itaque perspiciatis a fugiat cupiditate eveniet.</p>
                      <ul>
                        <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                        <li>Illum officiis porro earum dolor pariatur ipsum, nostrum!</li>
                        <li>Impedit molestiae esse repellat incidunt deserunt dolorem natus.</li>
                        <li>Sunt fuga repellendus inventore iste atque mollitia, nemo!</li>
                        <li>Alias quia et accusamus doloribus, repudiandae illo odio!</li>
                      </ul>
                      <h1>Receitas Online</h1>
                      <h2>Receitas Online</h2>
                      <h3>Receitas Online</h3>
                      <h4>Receitas Online</h4>
                      <h5>Receitas Online</h5>
                    </div>
                    <div class="mu-news-single-bottom">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mu-news-single-tag">
                            <ul class="mu-news-single-tagnav">
                              <li>TAGS :</li>
                              <li><a href="#">Cofee,</a></li>
                              <li><a href="#">Snacks,</a></li>
                              <li><a href="#">Drinks,</a></li>
                              <li><a href="#">Dessert</a></li>
                            </ul>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mu-news-single-social">
                            <ul class="mu-news-single-socialnav">
                              <li>SHARE :</li>
                              <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                              <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                              <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                              <li><a href="#"><span class="fa fa-youtube"></span></a></li>
                              <li><a href="#"><span class="fa fa-linkedin"></span></a></li>
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
                          <div class="col-md-6 col-sm-6">
                            <article class="mu-news-single">
                              <h3><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, distinctio!</a></h3>
                              <figure class="mu-news-img">
                                <a href="#"><img alt="img" src="assets/imagens/news/1.jpg"></a>
                              </figure>
                              <div class="mu-news-single-content">
                                <ul class="mu-meta-nav">
                                  <li>Por Admin</li>
                                  <li>10 Maio 2016</li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio est quaerat magnam exercitationem voluptas, voluptatem sed quam ab laborum voluptatum tempore dolores itaque, molestias vitae.</p>
                                <div class="mu-news-single-bottom">
                                  <a class="mu-readmore-btn" href="#">Saiba Mais</a>
                                </div>
                              </div>
                            </article>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <article class="mu-news-single">
                              <h3><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, distinctio!</a></h3>
                              <figure class="mu-news-img">
                                <a href="#"><img alt="img" src="assets/imagens/news/2.jpg"></a>
                              </figure>
                              <div class="mu-news-single-content">
                                <ul class="mu-meta-nav">
                                  <li>Por Admin</li>
                                  <li>10 Maio 2016</li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio est quaerat magnam exercitationem voluptas, voluptatem sed quam ab laborum voluptatum tempore dolores itaque, molestias vitae.</p>
                                <div class="mu-news-single-bottom">
                                  <a class="mu-readmore-btn" href="#">Saiba Mais</a>
                                </div>
                              </div>
                            </article>
                          </div>
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
                      <h3>5 Comentários</h3>
                      <div class="comments">
                        <ul class="commentlist">
                          <li>
                            <div class="media">
                              <div class="media-left">
                                <img class="media-object news-img" src="assets/imagens/testimonial-11.png" alt="img">
                              </div>
                              <div class="media-body">
                                <h4 class="author-name">David Muller</h4>
                                <span class="comments-date"> Postado em 12 de Maio de 2016</span>
                                <p>Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English</p>
                                <a href="#" class="reply-btn">Resposta</a>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="media">
                              <div class="media-left">
                                <img class="media-object news-img" src="assets/imagens/testimonial-11.png" alt="img">
                              </div>
                              <div class="media-body">
                                <h4 class="author-name">John Doe</h4>
                                <span class="comments-date"> Postado em 12 de Maio de 2016</span>
                                <p>Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English</p>
                                <a href="#" class="reply-btn">Resposta</a>
                              </div>
                            </div>
                          </li>
                          <ul class="children">
                            <li class="author-comments">
                              <div class="media">
                                <div class="media-left">
                                  <img class="media-object news-img" src="assets/imagens/testimonial-11.png" alt="img">
                                </div>
                                <div class="media-body">
                                  <h4 class="author-name">Admin</h4>
                                  <span class="comments-date"> Postado em 12 de Maio de 2016</span>
                                  <span class="author-tag">Author</span>
                                  <p>Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English</p>
                                  <a href="#" class="reply-btn">Resposta</a>
                                </div>
                              </div>
                            </li>
                            <ul class="children">
                              <li>
                                <div class="media">
                                  <div class="media-left">
                                    <img class="media-object news-img" src="assets/imagens/testimonial-11.png" alt="img">
                                  </div>
                                  <div class="media-body">
                                    <h4 class="author-name">David Muller</h4>
                                    <span class="comments-date"> Postado em 12 de Maio de 2016</span>
                                    <p>Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English</p>
                                    <a href="#" class="reply-btn">Resposta</a>
                                  </div>
                                </div>
                              </li>
                            </ul>
                          </ul>
                          <li>
                            <div class="media">
                              <div class="media-left">
                                <img class="media-object news-img" src="assets/imagens/testimonial-11.png" alt="img">
                              </div>
                              <div class="media-body">
                                <h4 class="author-name">Jhon Doe</h4>
                                <span class="comments-date"> Postado em 12 de Maio de 2016</span>
                                <p>Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English</p>
                                <a href="#" class="reply-btn">Resposta</a>
                              </div>
                            </div>
                          </li>
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
                <!-- Start comments box -->
                <div class="row">
                  <div class="col-md-12">
                    <div id="respond">
                      <h3 class="reply-title">Deixe o seu Comentário</h3>
                      <form id="commentform">
                        <p class="comment-notes">
                          Seu e-mail não será publicado. Campos requeridos estão identificados com <span class="required">*</span>
                        </p>
                        <p class="comment-form-author">
                          <label for="author">Nome <span class="required">*</span></label>
                          <input type="text" name="nome" value="" size="30" required="required">
                        </p>
                        <p class="comment-form-email">
                          <label for="email">Email <span class="required">*</span></label>
                          <input type="email" name="email" value="" aria-required="true" required="required">
                        </p>
                        <p class="comment-form-url">
                          <label for="url">Website</label>
                          <input type="url" name="url" value="">
                        </p>
                        <p class="comment-form-comment">
                          <label for="comment">Comentário</label>
                          <textarea name="comentario" cols="45" rows="8" aria-required="true" required="required"></textarea>
                        </p>
                        <!--<p class="form-allowed-tags">
                          You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:  <code>&lt;a href="" title=""&gt; &lt;abbr title=""&gt; &lt;acronym title=""&gt; &lt;b&gt; &lt;blockquote cite=""&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=""&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=""&gt; &lt;s&gt; &lt;strike&gt; &lt;strong&gt; </code>
                        </p>-->
                        <p class="form-submit">
                          <input type="submit" name="submit" class="mu-send-btn" value="Enviar">
                        </p>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- End comments box -->
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
                    <h3>Últimas Notícias</h3>
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