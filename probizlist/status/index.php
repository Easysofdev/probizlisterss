<?php require_once('../inc/db_conn.php'); ?>
<?php	
	$sql_ad_home = "SELECT * FROM adverts ORDER BY id_ad DESC LIMIT 10";
	$ad_home = $conn->query($sql_ad_home);
?>
<?php	
	$sql_ad_cat = "SELECT * FROM ad_category WHERE cat_list = 'ad' ORDER BY cat_name";
	$ad_cat = $conn->query($sql_ad_cat);
?>
<?php	
	$sql_pro_cat = "SELECT * FROM ad_category WHERE cat_list = 'pro' ORDER BY cat_name";
	$pro_cat = $conn->query($sql_pro_cat);
	
	$sql_pro_list = "SELECT id_pro, pro_job_name, pro_job_desc, pro_header_img, pro_view, pro_like, pro_shared, pro_cat, id_user FROM prolist ORDER BY id_pro DESC";
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
        document.getElementById("d_ad").innerHTML = this.responseText;
		document.getElementById("d_ad").focus();
      }
    };
    xmlhttp.open("GET","inc/ajax_processor.php?c="+c+"&origin=home_ad_by_cat",true);
    xmlhttp.send();
  }
}
</script>
<?php require '../inc/home-top-banner.php'; ?>
<?php require '../inc/main-side-menu.php'; ?>

<div class="main-body">
<div class="navbar">
  <a href="<?php echo $site_domain ?>businesses"><i class="fa fa-fw fa-briefcase"></i> Biz-List</a> 
  <a href="<?php echo $site_domain ?>index.php"><i class="fa fa-adn"></i> Ads</a> 
  <!-- <a href="<?php echo $site_domain ?>professionals"><i class="fa fa-fw fa-building"></i> Pro-List</a> -->
  <!-- <a class="active" href="<?php //echo $site_domain ?>status"><i class="fa fa-fw fa-user"></i> Status</a> -->
</div>

<div id="Pro-List" class="tabcontent">
<!-- category row //-->
<div class="row">
<div class="row post-ad-box"><h3><a href="post-ad.php">List Your Pro Service</a></h3></div>
<div class="cat-section">
<?php
if ($pro_cat->num_rows > 0) {
  while($row_pro_cat = $pro_cat->fetch_assoc()) {?>
<a onclick="getAd('<?php echo $row_pro_cat["cat_name"]; ?>')"><div class="cat-item"><img src="../images/category/<?php echo $row_pro_cat["cat_img"]; ?>"><br /><?php echo str_replace(" and ", " & ", $row_pro_cat["cat_name"]); ?></div></a>
<?php } } ?>
<a href="post-ad.php"><div class="cat-item"><img src="../images/category/post-service.jpg"><br />Add a Service</div></a>
</div>
</div>

<!-- trending service row //-->
<div class="col-cat" style="text-transform:uppercase;"><h3>Trending Pro Services</h3></div>
<div class="pro-box row">

<?php
if ($ad_home->num_rows > 0) {
  while($row_pro_list = $pro_list->fetch_assoc()) {
?>
<div class="pro-list-box row">
<div class="pro-img-box"><div class="on-img-text-left-top"><i class="fa fa-heart"></i></div><a href="<?php echo $site_domain ?>propage.php?id_pro=<?php echo $row_pro_list["id_pro"]; ?>&au=<?php echo $row_pro_list["id_user"]; ?>"><img src="../images/pro/<?php echo $row_pro_list["pro_header_img"]; ?>" /></a></div>
<div class="pro-title-box"><a href="<?php echo $site_domain ?>propage.php?id_pro=<?php echo $row_pro_list["id_pro"]; ?>&au=<?php echo $row_pro_list["id_user"]; ?>"><?php echo substr($row_pro_list["pro_job_name"], 0, 30);?></a><br /></div>
<div class="pro-title-cat"><i class="fa fa-building"></i> <?php echo substr($row_pro_list["pro_cat"], 0, 30);?></div>
<div class="pro-subtitle-box"><div class="pro-subtitle-inner"><?php echo $row_pro_list["pro_job_desc"];?></div></div>
<div class="pro-foot-box"><span id="left"><?php echo $row_pro_list["pro_view"]; ?> <i class="fa fa-eye" aria-hidden="true"></i></span> <span id="right"><?php echo $row_pro_list["pro_like"]; ?> <i class="fa fa-heart" aria-hidden="true"></i></span></div>
</div>
<?php } }?>
</div>

</div>

</div><!-- Mainbody end DIV -->

<?php require '../inc/footer.php'; ?>

</body>
</html>