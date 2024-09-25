<?php require_once('../inc/db_conn.php'); ?>
<?php
$sql_biz_cat = "SELECT * FROM ad_category WHERE cat_list = 'biz' ORDER BY cat_name";
$biz_cat = $conn->query($sql_biz_cat);

$sql_bizData = "SELECT * FROM bizlist ORDER BY id_biz DESC";
$bizData = $conn->query($sql_bizData);
?>
<?php require '../inc/top-header-probiz.php'; ?>
<script>
  function getAd(c) {
    if (c == "") {
      return false;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 1) {
          document.getElementById('d_biz').innerHTML = "<br /><img src='../images/progress-bar.gif' style='width:95%; max-width:350px; border-radius:10px;' />";
        }
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("d_biz").innerHTML = this.responseText;
          document.getElementById("d_biz").focus();
        }
      };
      xmlhttp.open("GET", "../inc/ajax_general_processor.php?c=" + c + "&origin=biz_by_cat", true);
      xmlhttp.send();
    }
  }
</script>
<?php require '../inc/home-top-banner.php'; ?>
<?php require '../inc/main-side-menu.php'; ?>

<div class="main-body">
  <div class="navbar">
    <a class="active" href="<?php echo $site_domain ?>businesses"><i class="fa fa-fw fa-briefcase"></i> Biz-List</a>
    <a href="<?php echo $site_domain ?>index.php"><i class="fa fa-adn"></i> Ads</a>
    <!-- <a href="<?php echo $site_domain ?>professionals"><i class="fa fa-fw fa-building"></i> Pro-List</a> -->
    <!-- <a href="<?php //echo $site_domain ?>status"><i class="fa fa-fw fa-user"></i> Status</a> -->
  </div>

  <div id="Pro-List" class="tabcontent">
    <!-- trending service row //-->
    <div class="pro-box row">
      <div class="row bz-ad-bz">
        <h3>

          <?php if (isset($_SESSION['USERNAME']) && $_SESSION['USERNAME'] != "") { ?>
            <a href="<?php echo $site_domain ?>dashboard.php">
            <?php } else { ?><a href="<?php echo $_SERVER['PHP_SELF']; ?>?access=denied">
              <?php } ?>

              List Your Business</a>
        </h3>
      </div>

      <div class="bz-cat-btn">
        <div style="font-size:20px; padding:10px 0 5px; text-shadow:3px 3px 4px rgba(0, 0, 0, 0.7);">Browse Businesses
          by Name</div>
        <a onclick="getAd('a-d')">A-D</a>
        <a onclick="getAd('e-h')">E-H</a>
        <a onclick="getAd('i-l')">I-L</a>
        <a onclick="getAd('m-p')">M-P</a>
        <a onclick="getAd('q-t')">Q-T</a>
        <a onclick="getAd('u-z')">U-Z</a>
      </div>

      <span id="d_biz"></span>
      <div class="col-cat" style="text-transform:uppercase; text-align:left;">
        <h2>Trending Businesses</h2>
      </div>
      <?php
      if ($bizData->num_rows > 0) {
        while ($row_bizData = $bizData->fetch_assoc()) {

          // $date1=date_create($row_bizData['biz_start']);
          // $date2=date_create($row_bizData['biz_end']);
          // $diff=date_diff($date1,$date2);
          // if  ($diff->format("%R%a") > 0){
      
          $sql_bizRev = "SELECT COUNT(id_review) AS total_reviews, SUM(star_rating) FROM biz_review WHERE id_biz ='" . $row_bizData["id_biz"] . "' Group By id_biz";
          $bizRev = $conn->query($sql_bizRev);
          $row_bizRev = $bizRev->fetch_assoc();
          ?>
          <div class="bz-box">
            <div class="bz-hd"><a href="<?php echo $row_bizData["biz_title"]; ?>.php"><?php echo $row_bizData["biz_name"]; ?></a></div>
            <div class="bz-loc">
              <?php echo $row_bizData["biz_address"]; ?>,
              <?php echo $row_bizData["biz_city"]; ?>
              <?php echo $row_bizData["biz_state"]; ?> State, Nigeria.
            </div>
            <div class="row">
              <div class="bz-img"><a href="<?php echo $row_bizData["biz_title"]; ?>.php"><img
                    src="../images/biz/<?php echo $row_bizData["biz_logo"]; ?>" align="right" /></a></div>
              <div class="bz-desc">
                <?php echo $row_bizData["biz_desc"]; ?>
              </div>
              <div class="bz-box-ft">
                <?php if ($row_bizData["verify_status"] == "1") { ?>
                    <div class="bz-veri-box">
                      <div class="bz-veri"><i class="fa fa-check"></i> Verified Business</div>
                    
                  <?php } else { ?>
                    <div class="bz-veri-box">
                      <div class="bz-unveri"><i class="fa fa-check"></i> Un-Verified</div>
                    
                    <?php } ?>
                    <?php
                    $date1 = date_create($row_bizData['biz_reg_date']);
                    $date2 = date_create(date("Y-m-d h:i:s"));
                    $diff = date_diff($date1, $date2);
                    $yr = $diff->y;

                    if ($yr >= 1) {
                      echo "<div class='bz-yr'>+" . $yr . " years with us</div>";
                    }
                    ?>
                  </div>
              </div>
            </div>
            <div>
              <a href="<?php echo $row_bizData["biz_title"]; ?>.php">
                <div class="bz-contact"><i class="fa fa-phone"></i><br />Phone</div>
                <div class="bz-contact"><i class="fa fa-envelope"></i><br />Email</div>
                <div class="bz-contact"><i class="fa fa-map-marker"></i><br />Map</div>
                <div class="bz-contact"><i class="fa fa-globe"></i><br />Website</div>
                <div class="bz-contact"><i class="fa fa-picture-o"></i><br />Photos</div>
                <div class="bz-contact"><i class="fa fa-product-hunt"></i><br />Products</div>
              </a>
            </div>
            <div class="bz-star">

              <?php
              if (isset($row_bizRev['total_reviews']) && $row_bizRev['total_reviews'] > 0) {
                $a = round(($row_bizRev['SUM(star_rating)'] / $row_bizRev['total_reviews']), 0);
              } else {
                $a = 0;
              }
              $b = 5 - $a;

              for ($x = 1; $x <= $a; $x++) {
                echo "<i class='fa fa-star'></i> ";
              }
              for ($i = 1; $i <= $b; $i++) {
                echo "<i class='fa fa-star-o'></i> ";
              }
              ?>

            </div>
              <div class="bz-rev-pt">
                <?php if (isset($row_bizRev['total_reviews']) && $row_bizRev['total_reviews'] > 0) {
                  echo number_format(round(($row_bizRev['SUM(star_rating)'] / $row_bizRev['total_reviews']), 1), 1);  $totalrev = $row_bizRev['total_reviews'];
                } else {
                  echo 0; $totalrev = 0;
                } ?>
              </div>
              <?php echo $totalrev; ?> Reviews
              <input type="hidden" name="avg_rating" id="avg_rating"
                value="<?php if (isset($row_bizRev['total_reviews']) && $row_bizRev['total_reviews'] > 0) {
                  echo round(($row_bizRev['SUM(star_rating)'] / $row_bizRev['total_reviews']), 0);
                } else {
                  echo 0;
                } ?>" />

              <?php if (!empty($row_bizData["biz_facebook"]) || !empty($row_bizData["biz_twitter"]) || !empty($row_bizData["biz_google"]) || !empty($row_bizData["biz_youtube"]) || !empty($row_bizData["biz_tiktok"]) || !empty($row_bizData["biz_instagram"])) { ?>
                <div style="font-size:25px;"><span style="font-size:12px;">Follow US on Social Media</span><br />
                  <?php if (!empty($row_bizData["biz_facebook"])) { ?><a href="<?php echo $row_bizData["biz_facebook"]; ?>"
                      target="_blank" class="fb" title="Facebook"><i class="fab fa-facebook-square"></i> </a>
                  <?php } ?>
                  <?php if (!empty($row_bizData["biz_twitter"])) { ?><a href="<?php echo $row_bizData["biz_twitter"]; ?>"
                      target="_blank" class="tw" title="Twitter"><i class="fab fa-twitter-square"></i> </a>
                  <?php } ?>
                  <?php if (!empty($row_bizData["biz_google"])) { ?><a href="<?php echo $row_bizData["biz_google"]; ?>"
                      target="_blank" class="sp" title="Snapchat"><i class="fab fa-snapchat-square"></i> </a>
                  <?php } ?>
                  <?php if (!empty($row_bizData["biz_youtube"])) { ?><a href="<?php echo $row_bizData["biz_youtube"]; ?>"
                      target="_blank" class="yt" title="Youtube"><i class="fab fa-youtube-square"></i> </a>
                  <?php } ?>
                  <?php if (!empty($row_bizData["biz_tiktok"])) { ?><a href="<?php echo $row_bizData["biz_tiktok"]; ?>"
                      target="_blank" class="wp" title="WhatsApp"><i class="fab fa-whatsapp-square"></i> </a>
                  <?php } ?>
                  <?php if (!empty($row_bizData["biz_instagram"])) { ?><a href="<?php echo $row_bizData["biz_instagram"]; ?>"
                      target="_blank" class="ig" title="Instagram"><i class="fab fa-instagram-square"></i></a>
                  <?php } ?>
                </div>
              <?php } ?>

            </div>

            <?php //} ?>
          <?php }} ?>

      </div>
    </div>
  </div><!-- Mainbody end DIV -->

  <?php require '../inc/footer.php'; ?>
  <script>
    function starAvgRate() {
      var a = document.getElementById("avg_rating").value;
      for (i = 1; i <= a; i++) {
        document.getElementById(i + "star").className = "fa fa-star";
      }
    }
  </script>
  </body>

  </html>