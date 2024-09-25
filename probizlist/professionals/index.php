<?php require_once('../inc/db_conn.php'); ?>

<?php	
	$sql_pro_cat = "SELECT * FROM ad_category WHERE cat_list = 'pro' ORDER BY cat_name";
	$pro_cat = $conn->query($sql_pro_cat);
	
	$sql_pro_list = "SELECT * FROM prolist WHERE pro_sub_status = 1 ORDER BY id_pro DESC";
	$pro_list = $conn->query($sql_pro_list);
?>
 <?php require '../inc/top-header-probiz.php'; ?>
<script>
function getAd(c) {
  if (c == "") {
    return false;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
	  if (xmlhttp.readyState == 1){
		document.getElementById("d_pro").innerHTML = "<br /><img src='../images/progress-bar.gif' style='width:95%; max-width:350px; border-radius:10px;' />";
	  }
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("d_pro").innerHTML = this.responseText;
		document.getElementById("d_pro").focus();
      }
    };
    xmlhttp.open("GET","../inc/ajax_general_processor.php?c="+c+"&origin=pro_by_cat",true);
    xmlhttp.send();
  }
}
</script>
<?php require '../inc/home-top-banner.php'; ?>
<?php require '../inc/main-side-menu.php'; ?>

<div class="main-body">
<div class="navbar">
  <a href="<?php echo $site_domain ?>businesses"><i class="fa fa-briefcase"></i> Biz-List</a> 
  <a href="<?php echo $site_domain ?>index.php"><i class="fa fa-adn"></i> Ads</a> 
  <!-- <a class="active" href="<?php echo $site_domain ?>professionals"><i class="fa fa-building"></i> Pro-List</a> -->
  <!-- <a href="<?php //echo $site_domain ?>status"><i class="fa fa-fw fa-user"></i> Status</a> -->
</div>

<div id="Pro-List" class="tabcontent">
<!-- category row //-->
<div class="row">
<div class="row post-ad-box"><h3>
<?php if (isset($_SESSION['USERNAME']) && $_SESSION['USERNAME'] != "") { ?>
<a href="<?php echo $site_domain ?>dashboard.php">
<?php } else { ?><a href="<?php echo $_SERVER['PHP_SELF']; ?>?access=denied">
<?php } ?>
List Your Pro Service</a></h3></div>

<div class="cat-section">
<?php
if ($pro_cat->num_rows > 0) {
  while($row_pro_cat = $pro_cat->fetch_assoc()) {?>
<a onclick="getAd('<?php echo $row_pro_cat["cat_name"]; ?>')"><div class="cat-item"><img src="../images/category/<?php echo $row_pro_cat["cat_img"]; ?>"><br /><?php echo str_replace(" and ", " & ", $row_pro_cat["cat_name"]); ?></div></a>
<?php } } ?>
<?php if (isset($_SESSION['USERNAME']) && $_SESSION['USERNAME'] != "") { ?>
<a href="<?php echo $site_domain ?>dashboard.php">
<?php } else { ?><a href="<?php echo $_SERVER['PHP_SELF']; ?>?access=denied">
<?php } ?>
<div class="cat-item"><img src="../images/category/post-service.jpg"><br />Add a Service</div></a>
</div>
</div>

<!-- trending service row //-->
<span id="d_pro"></span>
<div class="col-cat" style="text-transform:uppercase; padding-left:10px; color:#666;"><h3>Trending Professional Services</h3></div>
<div class="pro-box row">

<?php
if ($pro_list->num_rows > 0) {
  while($row_pro_list = $pro_list->fetch_assoc()) {
  
  $date1=date_create($row_pro_list['pro_start']);
  $date2=date_create($row_pro_list['pro_end']);
  $diff=date_diff($date1,$date2);
  if  ($diff->format("%R%a") > 0){
  
  $sql_proRev ="SELECT COUNT(id_review) AS total_reviews, SUM(star_rating) FROM pro_review WHERE id_pro ='".$row_pro_list["id_pro"]."' Group By id_pro";
  $proRev = $conn->query($sql_proRev);
  $row_proRev = $proRev->fetch_assoc();
?>
<div class="pro-list-box row">
<div class="pro-img-box"><!--<div class="on-img-text-left-top"><i class="fa fa-heart"></i></div>--><a href="<?php echo $row_pro_list["pro_title"]; ?>.php"><img src="../images/pro/<?php echo $row_pro_list["pro_banner_mob"]; ?>" /></a></div>
<div class="pro-title-box"><a href="<?php echo $row_pro_list["pro_title"]; ?>.php"><?php echo substr($row_pro_list["pro_name"], 0, 30);?></a><br /></div>
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
<?php } } }?>
</div>


</div>

</div><!-- Mainbody end DIV -->

<?php require '../inc/footer.php'; ?>

</body>
</html>