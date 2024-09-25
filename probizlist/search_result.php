<?php require_once('inc/db_conn.php'); ?>
<?php
// Define a list of stop words
$stop_words = array('in', 'of', 'with', 'at', 'the', 'and', 'or', 'items', 'products', 'state', 'cheap');

// Get the search query from the form
if(!isset($_GET['query']) || empty($_GET['query'])){
	header("location: index.php");
	exit;
}
$squery = $_GET['query'];
$search_query = mysqli_real_escape_string($conn, $squery);

// Remove stop words from the search query
$search_query = preg_replace('/\b('.implode('|', $stop_words).')\b/', '', $search_query);

// Break down the search query into individual keywords
$keywords_ad = preg_split("/[\s,]+/", $search_query);
$keywords_bz = preg_split("/[\s,]+/", $search_query);

// Build the SQL query
$sql_ad = "(SELECT * FROM adverts WHERE ";
foreach ($keywords_ad as $keyword_ad) {
  $sql_ad .= "(item_title LIKE '%$keyword_ad%' OR ";
  $sql_ad .= "itemaddr LIKE '%$keyword_ad%' OR ";
  $sql_ad .= "item_city LIKE '%$keyword_ad%' OR ";
  $sql_ad .= "item_state LIKE '%$keyword_ad%' OR ";
  $sql_ad .= "item_cat LIKE '%$keyword_ad%' OR ";
  $sql_ad .= "item_subcat LIKE '%$keyword_ad%' OR ";
  $sql_ad .= "item_sdesc LIKE '%$keyword_ad%' OR ";
  $sql_ad .= "item_desc LIKE '%$keyword_ad%' OR ";
  $sql_ad .= "item_keywords LIKE '%$keyword_ad%' OR ";
  $sql_ad .= "ad_status LIKE '%$keyword_ad%') AND ";
}
$sql_ad = substr($sql_ad, 0, -5) . ")"; // Remove the last " AND "

// Execute the SQL query
$result_ad = mysqli_query($conn, $sql_ad);

// Build the SQL query
$sql_bz = "(SELECT * FROM bizlist WHERE ";
foreach ($keywords_bz as $keyword_bz) {
  $sql_bz .= "(biz_name LIKE '%$keyword_bz%' OR ";
  $sql_bz .= "biz_cat LIKE '%$keyword_bz%' OR ";
  $sql_bz .= "biz_address LIKE '%$keyword_bz%' OR ";
  $sql_bz .= "biz_city LIKE '%$keyword_bz%' OR ";
  $sql_bz .= "biz_state LIKE '%$keyword_bz%' OR ";
  $sql_bz .= "biz_desc LIKE '%$keyword_bz%' OR ";
  $sql_bz .= "biz_service LIKE '%$keyword_bz%' OR ";
  $sql_bz .= "biz_keywords LIKE '%$keyword_bz%') AND ";
}
$sql_bz = substr($sql_bz, 0, -5) . ")"; // Remove the last " AND "
$sql_bz .= " ORDER BY id_biz DESC LIMIT 10";

// Execute the SQL query
$result_bz = mysqli_query($conn, $sql_bz);


?>
<?php require 'inc/top-header-home.php'; ?>
<script>
function getAd(c) {
  if (c == "") {
    return false;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
	  if (xmlhttp.readyState == 1){
		document.getElementById( 'd_biz' ).innerHTML = "<br /><img src='images/progress-bar.gif' style='width:95%; max-width:350px; border-radius:10px;' />";
	  }
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("d_biz").innerHTML = this.responseText;
		document.getElementById("d_biz").focus();
      }
    };
    xmlhttp.open("GET","inc/ajax_general_processor.php?c="+c+"&origin=biz_by_cat",true);
    xmlhttp.send();
  }
}
</script>
<?php require 'inc/home-top-banner.php'; ?>
<?php require 'inc/main-side-menu.php'; ?>

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
<div class="row bz-ad-bz"><h3>

<?php if (isset($_SESSION['USERNAME']) && $_SESSION['USERNAME'] != "") { ?>
<a href="<?php echo $site_domain ?>dashboard.php">
<?php } else { ?><a href="<?php echo $_SERVER['PHP_SELF']; ?>?access=denied">
<?php } ?>

List Your Business</a></h3></div>

<div class="bz-cat-btn">
<div style="font-size:20px; padding:10px 0 5px; text-shadow:3px 3px 4px rgba(0, 0, 0, 0.7);">Browse Businesses by Name</div>
<a onclick="getAd('a-d')">A-D</a>
<a onclick="getAd('e-h')">E-H</a>
<a onclick="getAd('i-l')">I-L</a>
<a onclick="getAd('m-p')">M-P</a>
<a onclick="getAd('q-t')">Q-T</a>
<a onclick="getAd('u-z')">U-Z</a>
</div>

<span id="d_biz"></span>

<?php
// Display the search results
if (mysqli_num_rows($result_bz) > 0) { // Result from business table
	while ($row_bizData = mysqli_fetch_assoc($result_bz)) {
		$sql_bizRev ="SELECT COUNT(id_review) AS total_reviews, SUM(star_rating) FROM biz_review WHERE id_biz ='".$row_bizData["id_biz"]."' Group By id_biz";
		$bizRev = $conn->query($sql_bizRev);
		$row_bizRev = $bizRev->fetch_assoc();

		/*
		$Total_sql = "SELECT SUM(likes) AS totalLikes, SUM(unlikes) AS totalunLikes FROM bizstats WHERE id_biz = ".$row_bizData["id_biz"];
		$Total = $conn->query($Total_sql);
		$row_Total = $Total->fetch_assoc();

		if ($row_Total["totalLikes"] > 1){
			$totalLikes = $row_Total["totalLikes"]." likes";
		} else {
			$totalLikes = ($row_Total["totalLikes"] + 0)." like";
		}

		if (strlen($row_bizData['bzdesc']) > 95){
			$biz_desc = substr($row_bizData['bzdesc'], 0, strrpos(substr($row_bizData['bzdesc'], 0, 95), ' '));
			$biz_desc .= "...";
		} else {
			$biz_desc = $row_bizData['bzdesc'];
		}
		*/

		$mpost = '
		<div class="bz-box">
			<div class="bz-hd">
				<a href="businesses/'.$row_bizData["biz_title"].'.php">'.$row_bizData["biz_name"].'</a>
			</div>
			<div class="bz-loc">
				'.$row_bizData["biz_address"].',
				'.$row_bizData["biz_city"].'
				'.$row_bizData["biz_state"].' State, Nigeria.
			</div>
			<div class="row">
				<div class="bz-img">
					<a href="businesses/'.$row_bizData["biz_title"].'.php"><img src="images/biz/'.$row_bizData["biz_logo"].'" align="right" /></a>
				</div>
				<div class="bz-desc">
				'.$row_bizData["biz_desc"].'
				</div>
				<div class="bz-box-ft">';

				if ($row_bizData["verify_status"] == "1") { 

				$mpost .= '
					<div class="bz-veri-box">
					<div class="bz-veri"><i class="fa fa-check"></i> Verified Business</div>';
				} else {

				$mpost .= '    
						<div class="bz-veri-box">
						<div class="bz-unveri"><i class="fa fa-check"></i> Un-Verified</div>';
				}

				$date1 = date_create($row_bizData["biz_reg_date"]);
				$date2 = date_create(date("Y-m-d h:i:s"));
				$diff = date_diff($date1, $date2);
				$yr = $diff->y;

				if ($yr >= 1) {
				$mpost .= ' <div class="bz-yr">+' . $yr . ' years with us</div>';
				}
				$mpost .= '
				</div>
			</div>

			</div>
			<div>
				<a href="businesses/'.$row_bizData["biz_title"].'.php">
				<div class="bz-contact"><i class="fa fa-phone"></i><br />Phone</div>
				<div class="bz-contact"><i class="fa fa-envelope"></i><br />Email</div>
				<div class="bz-contact"><i class="fa fa-map-marker"></i><br />Map</div>
				<div class="bz-contact"><i class="fa fa-globe"></i><br />Website</div>
				<div class="bz-contact"><i class="fa fa-picture-o"></i><br />Photos</div>
				<div class="bz-contact"><i class="fa fa-product-hunt"></i><br />Products</div>
				</a>
			</div>
			<div class="bz-star">';

				if (isset($row_bizRev["total_reviews"]) && $row_bizRev["total_reviews"] > 0) {
				$a = round(($row_bizRev["SUM(star_rating)"] / $row_bizRev["total_reviews"]), 0);
				} else {
				$a = 0;
				}
				$b = 5 - $a;

				for ($x = 1; $x <= $a; $x++) {
			$mpost .= '<i class="fa fa-star"></i> ';
				}
				for ($i = 1; $i <= $b; $i++) {
			$mpost .= '<i class="fa fa-star-o"></i> ';
				}
			
			$mpost .='
			</div>
			<div class="bz-rev-pt">';
			if (isset($row_bizRev["total_reviews"]) && $row_bizRev["total_reviews"] > 0) {
				$mpost .= number_format(round(($row_bizRev["SUM(star_rating)"] / $row_bizRev["total_reviews"]), 1), 1);
				$totalrev = $row_bizRev["total_reviews"];
				} else {
					$mpost .= 0;
					$totalrev = 0;
				} 
			$mpost .= '
			</div>
			'.$totalrev.' Reviews
			<input type="hidden" name="avg_rating" id="avg_rating"
				value="'; if (isset($row_bizRev["total_reviews"]) && $row_bizRev["total_reviews"] > 0) {
				$mpost .= round(($row_bizRev["SUM(star_rating)"] / $row_bizRev["total_reviews"]), 0);
				} else {
					$mpost .= 0;
				}
				$mpost .= '" />';

		

				if (!empty($row_bizData["biz_facebook"]) || !empty($row_bizData["biz_twitter"]) || !empty($row_bizData["biz_google"]) || !empty($row_bizData["biz_youtube"]) || !empty($row_bizData["biz_tiktok"]) || !empty($row_bizData["biz_instagram"])) {

					$mpost .= '<div style="font-size:25px;"><span style="font-size:12px;">Follow US on Social Media</span><br />';

					if (!empty($row_bizData["biz_facebook"])) { 

					$mpost .= '<a href="businesses/'.$row_bizData["biz_facebook"].'" target="_blank" class="fb" title="Facebook"><i class="fab fa-facebook-square"></i> </a>';

					}
					if (!empty($row_bizData["biz_twitter"])) {
						
					$mpost .= '<a href="businesses/'.$row_bizData["biz_twitter"].'" target="_blank" class="tw" title="Twitter"><i class="fab fa-twitter-square"></i> </a>';

					}
					if (!empty($row_bizData["biz_google"])) {

					$mpost .= '<a href="businesses/'.$row_bizData["biz_google"].'" target="_blank" class="sp" title="Snapchat"><i class="fab fa-snapchat-square"></i> </a>';

					}
					if (!empty($row_bizData["biz_youtube"])) {

					$mpost .= '<a href="businesses/'.$row_bizData["biz_youtube"].'" target="_blank" class="yt" title="Youtube"><i class="fab fa-youtube-square"></i> </a>';
					}
					if (!empty($row_bizData["biz_tiktok"])) {
					$mpost .= '<a href="'.$row_bizData["biz_tiktok"].'" target="_blank" class="wp" title="WhatsApp"><i class="fab fa-whatsapp-square"></i> </a>';

					}
					if (!empty($row_bizData["biz_instagram"])) {

					$mpost .= '<a href="businesses/'.$row_bizData["biz_instagram"].'"
							target="_blank" class="ig" title="Instagram"><i class="fab fa-instagram-square"></i></a>';
					}
					$mpost .= '</div>';
				}



				$mpost .= '
		</div>
		';

		echo $mpost;
	}
	$errbiz = "";
} else {
$errbiz = 'No result found for "'.$squery.'"';
}

if (mysqli_num_rows($result_ad) > 0) { // Result from adverts table
  while ($row_ads = mysqli_fetch_assoc($result_ad)) {
	$item_imgs = explode("|", $row_ads["item_imgs"]);
	$ad_img = $item_imgs[0];

		$mpost = '
		<div class="bz-box">
			<div class="bz-hd">
				<a href="adpage.php?aid='.$row_ads["id_ad"].'">'.$row_ads["item_title"].'</a>
			</div>
			<div class="bz-loc">
				'.$row_ads["itemaddr"].',
				'.$row_ads["item_city"].'
				'.$row_ads["item_state"].' State, Nigeria.
			</div>
			<div class="row">
				<div class="bz-img">
					<a href="adpage.php?aid='.$row_ads["id_ad"].'"><img src="images/ads/'.$ad_img.'" align="right" /></a>
				</div>
				<div class="bz-desc">
				'.$row_ads["item_desc"].'
				</div>
				<h2 style="color:rgba(0,153,0,1);">
				NGN'.number_format($row_ads["item_price"],2,".",",").'
				</h2>
			</div>

		</div>';

		echo $mpost;
  }
  $errAd = "";
} else {
  $errAd = 'No result found for "'.$squery.'"';
}

if($errAd == $errbiz && !empty($errAd)){
	echo "<h2><br>".$errAd."</h2>";
}

?>


</div>


</div>
</div>
</div><!-- Mainbody end DIV -->

<?php require 'inc/footer.php'; ?>
<script>
function starAvgRate(){
var a = document.getElementById("avg_rating").value;
for (i = 1; i <= a; i++){
document.getElementById(i+"star").className = "fa fa-star";
}}
</script>