<?php require_once('inc/db_conn.php'); ?>
<?php	
	if (isset($_GET["q"]) && !empty($_GET["q"])){
	$query = $_GET["q"];
	$sql_result = "SELECT * FROM search_engine WHERE entry_title LIKE '%". $query ."%' OR entry_desc LIKE '%". $query ."%' ORDER BY entry_type DESC";
	$result = $conn->query($sql_result);
	} else {
			header("Location: index.php?status=No search query was entered!");
	}
?>

<?php require 'inc/top-header-home.php'; ?>
<script>
function getAd(c) {
  if (c == "") {
    return false;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("d_ad").innerHTML = this.responseText;
		document.getElementById("d_ad").focus();
      }
    };
    xmlhttp.open("GET","inc/ajax_processor.php?c="+c+"&origin=home_ad_by_cat",true);
    xmlhttp.send();
  }
}
</script>
<?php require 'inc/home-top-banner.php'; ?>
<?php require 'inc/main-side-menu.php'; ?>

<div class="main-body">
<div class="navbar">
  <a href="<?php echo $site_domain ?>businesses"><i class="fa fa-fw fa-briefcase"></i> Biz-List</a> 
  <a href="<?php echo $site_domain ?>index.php"><i class="fa fa-adn"></i> Ads</a> 
  <!-- <a href="<?php echo $site_domain ?>professionals"><i class="fa fa-fw fa-building"></i> Pro-List</a> -->
 <!-- <a href="user-status.php"><i class="fa fa-fw fa-user"></i> Status</a> -->
</div>

<div id="Ads" class="tabcontent">
<!-- trending ads row //-->
<div class="row">
<span id="d_ad">
<div style="font-size:36px; padding:0 10px;">Search Result</div><div style="font-size:18px; color:rgba(0,153,0); padding:0 10px 10px;">for <strong>"<?php echo $_GET["q"]; ?>"</strong></div>

<?php if ($result->num_rows > 0) { ?>
<div style="height:20px"></div>
<?php  while($row_result = $result->fetch_assoc()) {
?>
<!--// Professionals //-->
<?php if ($row_result['entry_type'] == 'pro'){
	$sql_pro_list = "SELECT * FROM prolist WHERE id_pro =".$row_result['id_entry']." ORDER BY pro_name ASC";
	$pro_list = $conn->query($sql_pro_list) or die($conn->error);
	$row_pro_list = $pro_list->fetch_assoc();
?>
<?php if ($pro_list->num_rows > 0) { 

	$sql_proRev ="SELECT COUNT(id_review) AS total_reviews, SUM(star_rating) FROM pro_review WHERE id_pro ='".$row_pro_list["id_pro"]."' Group By id_pro";
    $proRev = $conn->query($sql_proRev);
    $row_proRev = $proRev->fetch_assoc();
?>

<div class="pro-list-box row">
<div class="pro-img-box"><!--<div class="on-img-text-left-top"><i class="fa fa-heart"></i></div>--><a href="professionals/<?php echo $row_pro_list["pro_title"]; ?>.php"><img src="images/pro/<?php echo $row_pro_list["pro_banner_mob"]; ?>" /></a></div>
<div class="pro-title-box"><a href="professionals/<?php echo $row_pro_list["pro_title"]; ?>.php"><?php echo substr($row_pro_list["pro_name"], 0, 30);?></a><br /></div>
<div class="pro-title-cat"><i class="fa fa-building"></i> <?php echo substr($row_pro_list["pro_cat"], 0, 30);?></div>
<div class="pro-subtitle-box"><div class="pro-subtitle-inner"><?php echo $row_pro_list["pro_desc"];?></div></div>
<div class="pro-foot-box">

<span id="left">
<span  class="pro-star">
<?php
if ($row_proRev['total_reviews'] > 0){
$a = round(($row_proRev['SUM(star_rating)']/$row_proRev['total_reviews']), 0);
}else{$a = 0;}
$b = 5 - $a;
  
for ($x = 1; $x <= $a; $x++) {
  echo "<i class='fa fa-star'></i> ";
}
for ($i = 1; $i <= $b; $i++) {
  echo "<i class='fa fa-star-o'></i> ";
}
?>
</span>
<span style="color:#fff; background-color:#f73; padding:0 3px; border-radius:5px;"><?php if ($row_proRev['total_reviews'] > 0){echo number_format(round(($row_proRev['SUM(star_rating)']/$row_proRev['total_reviews']), 1), 1);} else {echo 0;} ?></span>
</span>
<span id="right"><i class="fa fa-arrow-circle-right"></i></span>
</div>
</div>
	
<?php }} ?>

<!--// Businesses //-->
<?php if ($row_result['entry_type'] == 'biz'){
	$sql_bizData = "SELECT * FROM bizlist WHERE id_biz =".$row_result['id_entry']." ORDER BY biz_name ASC";
	$bizData = $conn->query($sql_bizData) or die($conn->error);
	$row_bizData = $bizData->fetch_assoc();
?>
<?php if ($bizData->num_rows > 0) { 

	$sql_bizRev ="SELECT COUNT(id_review) AS total_reviews, SUM(star_rating) FROM biz_review WHERE id_biz ='".$row_bizData["id_biz"]."' Group By id_biz";
    $bizRev = $conn->query($sql_bizRev);
    $row_bizRev = $bizRev->fetch_assoc();
?>
<div class="bz-box">
<div class="bz-hd"><a href="businesses/<?php echo $row_bizData["biz_title"]; ?>.php"><?php echo $row_bizData["biz_name"]; ?></a></div>
<div class="bz-loc"><?php echo $row_bizData["biz_address"]; ?>, <?php echo $row_bizData["biz_city"]; ?> <?php echo $row_bizData["biz_state"]; ?> State, Nigeria.</div>
<div class="row">
<div class="bz-img"><a href="<?php echo $row_bizData["biz_title"]; ?>.php"><img src="images/biz/<?php echo $row_bizData["biz_logo"]; ?>" align="right" /></a></div>
<div class="bz-desc"><?php echo $row_bizData["biz_desc"]; ?></div>
<div class="bz-box-ft">
<div class="bz-veri-box"><div class="bz-veri"><i class="fa fa-check"></i> Verified Business</div>
<?php
$date1=date_create($row_bizData['biz_reg_date']);
$date2=date_create(date("Y-m-d h:i:s"));
$diff=date_diff($date1,$date2);
$yr = $diff->y;

if ($yr >= 1){
echo "<div class='bz-yr'>+".$yr." years with us</div>";
}
?>
</div>
</div>
</div>
<div class="bz-contact-btn">
<a href="businesses/<?php echo $row_bizData["biz_title"]; ?>.php">
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
if (isset($row_bizRev['total_reviews']) && $row_bizRev['total_reviews'] > 0){
$a = round(($row_bizRev['SUM(star_rating)']/$row_bizRev['total_reviews']), 0);
}else{$a = 0;}
$b = 5 - $a;
  
for ($x = 1; $x <= $a; $x++) {
  echo "<i class='fa fa-star'></i> ";
}
for ($i = 1; $i <= $b; $i++) {
  echo "<i class='fa fa-star-o'></i> ";
}
?>

</div>

<div class="bz-rev-pt"><?php if (isset($row_bizRev['total_reviews']) && $row_bizRev['total_reviews'] > 0){ echo number_format(round(($row_bizRev['SUM(star_rating)']/$row_bizRev['total_reviews']), 1), 1);}else{echo 0;} ?></div> <?php echo $row_bizRev['total_reviews']; ?> Reviews  
<input type="hidden" name="avg_rating" id="avg_rating" value="<?php if (isset($row_bizRev['total_reviews']) && $row_bizRev['total_reviews'] > 0){ echo round(($row_bizRev['SUM(star_rating)']/$row_bizRev['total_reviews']), 0);}else{echo 0;} ?>" />

<?php if (!empty ($row_bizData["biz_facebook"]) || !empty ($row_bizData["biz_twitter"]) || !empty ($row_bizData["biz_google"]) || !empty ($row_bizData["biz_youtube"]) || !empty ($row_bizData["biz_tiktok"]) || !empty ($row_bizData["biz_instagram"])){ ?>
<div style="font-size:25px;"><span style="font-size:12px;">Follow US on Social Media</span><br />
<?php if (!empty ($row_bizData["biz_facebook"])){ ?><a href="<?php echo $row_bizData["biz_facebook"]; ?>" target="_blank" class="fb" title="Facebook"><i class="fab fa-facebook-square"></i> </a><?php } ?>
<?php if (!empty ($row_bizData["biz_twitter"])){ ?><a href="<?php echo $row_bizData["biz_twitter"]; ?>" target="_blank" class="tw" title="Twitter"><i class="fab fa-twitter-square"></i> </a><?php } ?>
<?php if (!empty ($row_bizData["biz_google"])){ ?><a href="<?php echo $row_bizData["biz_google"]; ?>" target="_blank" class="sp" title="Snapchat"><i class="fab fa-snapchat-square"></i> </a><?php } ?>
<?php if (!empty ($row_bizData["biz_youtube"])){ ?><a href="<?php echo $row_bizData["biz_youtube"]; ?>" target="_blank" class="yt" title="Youtube"><i class="fab fa-youtube-square"></i> </a><?php } ?>
<?php if (!empty ($row_bizData["biz_tiktok"])){ ?><a href="<?php echo $row_bizData["biz_tiktok"]; ?>" target="_blank" class="wp" title="WhatsApp"><i class="fab fa-whatsapp-square"></i> </a><?php } ?>
<?php if (!empty ($row_bizData["biz_instagram"])){ ?><a href="<?php echo $row_bizData["biz_instagram"]; ?>" target="_blank" class="ig" title="Instagram"><i class="fab fa-instagram-square"></i></a><?php } ?>
</div>
<?php } ?>


</div>

<?php }} ?>
<!--// Classified Ads //-->
<?php if ($row_result['entry_type'] == 'ads'){
	$sql_ad_home = "SELECT * FROM adverts WHERE id_ad =".$row_result['id_entry']." ORDER BY item_title ASC";
	$ad_home = $conn->query($sql_ad_home);
	$row_ad_home = $ad_home->fetch_assoc();
	
	if ($ad_home->num_rows > 0) {
  	$item_imgs = explode("|", $row_ad_home["item_imgs"]);
	$ad_img = $item_imgs[0];
?>
<a href="adpage.php?aid=<?php echo $row_ad_home["id_ad"];?>"><div class="ad-item"><img src="images/ads/<?php echo $ad_img;?>" alt="">
<div class="on-img-text-left"><?php echo count($item_imgs);?></div><div class="on-img-text-right"><i class="fa fa-star"></i></div><div class="ad-text"><p><?php echo substr($row_ad_home["item_title"], 0, 30);?></p><span style="color:rgb(0,153,0)">&#x20A6;<?php echo number_format($row_ad_home["item_price"]) ?></span></div></div></a>
<?php }}?>

<?php }} else {?>
<div style="font-size:18px; color:rgb(0,153,0); padding:0 10px 20px;">Returns no result, rephrase your search terms!</div>
<?php }?>
</span>
</div>
</div>

</div><!-- Mainbody end DIV -->

<?php require 'inc/footer.php'; ?>
<script>
//TABS SCRIPT STARTS HERE
function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
//TABS SCRIPT ENDS HERE
</script>
</body>
</html>