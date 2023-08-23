  <?php require_once("config.php") ?>
  <!-- Start Footer -->
  <footer id="mu-footer">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <div class="mu-footer-area">
                      <div class="mu-footer-social">
                          <?php
                            if ($facebook != "") {
                                echo '<a href="' . $facebook . '" target="_blank"><i class="fa-brands fa-facebook"></i></a>';
                            }

                            if ($twitter != "") {
                                echo '<a href="' . $twitter . '" target="_blank"><i class="fa-brands fa-twitter"></i></a>';
                            }

                            if ($twitter != "") {
                                echo '<a href="' . $google_plus . '" target="_blank"><i class="fa-brands fa-square-google-plus"></i></a>';
                            }

                            if ($linkedin != "") {
                                echo '<a href="' . $linkedin . '" target="_blank"><i class="fa-brands fa-linkedin"></i></a>';
                            }

                            if ($youtube != "") {
                                echo '<a href="' . $youtube . '" target="_blank"><i class="fa-brands fa-youtube"></i></a>';
                            }

                            if ($instagram != "") {
                                echo '<a href="' . $instagram . '" target="_blank"><i class="fa-brands fa-instagram"></i></a>';
                            }
                            ?>

                      </div>
                      <div class="mu-footer-copyright">
                          <p><abbr title="Desenvolvido por →"><i class="fa-solid fa-code"></i></abbr> <a rel="nofollow" href="<?php echo $site_desenvolvedor ?>" target="_blank">®Vetor256.®</a></p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </footer>
  <!-- End Footer -->