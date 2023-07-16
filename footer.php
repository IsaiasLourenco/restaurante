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
                                echo '<a href="' . $facebook . '" target="_blank"><span class="fa fa-facebook"></span></a>';
                            }

                            if ($twitter != "") {
                                echo '<a href="' . $twitter . '" target="_blank"><span class="fa fa-twitter"></span></a>';
                            }

                            if ($twitter != "") {
                                echo '<a href="' . $google_plus . '" target="_blank"><span class="fa fa-google-plus"></span></a>';
                            }

                            if ($linkedin != "") {
                                echo '<a href="' . $linkedin . '" target="_blank"><span class="fa fa-linkedin"></span></a>';
                            }

                            if ($youtube != "") {
                                echo '<a href="' . $youtube . '" target="_blank"><span class="fa fa-youtube"></span></a>';
                            }

                            if ($instagram != "") {
                                echo '<a href="' . $instagram . '" target="_blank"><span class="fa fa-instagram"></span></a>';
                            }
                            ?>

                      </div>
                      <div class="mu-footer-copyright">
                          <p><abbr title="Legal Copyright Owner →"><span class="fa fa-code"></span></abbr> <a rel="nofollow" href="<?php echo $site_desenvolvedor ?>" target="_blank">®Vetor256.®</a></p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </footer>
  <!-- End Footer -->