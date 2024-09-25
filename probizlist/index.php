<?php require_once('inc/db_conn.php'); ?>
<?php	
	$sql_ad_cat = "SELECT * FROM ad_category WHERE cat_list = 'ad' ORDER BY cat_name";
	$ad_cat = $conn->query($sql_ad_cat);
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
		document.getElementById("d_ad").innerHTML = "<br /><img src='images/progress-bar.gif' style='width:95%; max-width:350px; border-radius:10px;' />";
	  }
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("d_ad").innerHTML = this.responseText;
		document.getElementById("d_ad").focus();
      }
    };
    xmlhttp.open("GET","inc/ajax_general_processor.php?c="+c+"&origin=home_ad_by_cat",true);
    xmlhttp.send();
  }
}
</script>
<?php require 'inc/home-top-banner.php'; ?>
<?php require 'inc/main-side-menu.php'; ?>

<div class="main-body">
<div class="navbar">
  <a href="<?php echo $site_domain ?>businesses"><i class="fa fa-fw fa-bullhorn"></i> Biz-List</a> 
  <a class="active" href="<?php echo $site_domain ?>index.php"><i class="fa fa-adn"></i> Ads</a> 
  <!-- <a href="<?php echo $site_domain ?>professionals"><i class="fa fa-fw fa-building"></i> Pro-List</a> -->
 <!-- <a href="user-status.php"><i class="fa fa-fw fa-user"></i> Status</a> -->
</div>

<div id="Ads" class="tabcontent">
<!-- category row //-->
<div class="row">
<div class="row post-ad-box"><h3><a href="post-ad.php">Post Ad</a></h3></div>
<!-- <div class="cat-section">
<?php
if ($ad_cat->num_rows > 0) {
  while($row_ad_cat = $ad_cat->fetch_assoc()) {?>
<a onclick="getAd('<?php echo $row_ad_cat["cat_name"]; ?>')"><div class="cat-item"><img src="images/category/<?php echo $row_ad_cat["cat_img"]; ?>"><br /><?php echo str_replace(" and ", " & ", $row_ad_cat["cat_name"]); ?></div></a>
<?php } } ?>
<a href="post-ad.php"><div class="cat-item"><img src="images/category/post-ad.jpg"><br />Post New Advert</div></a>
</div> -->
</div>

<!-- trending ads row //-->
<div class="row">
<span id="d_ad"></span>
<div class="col col-cat" style="text-transform:uppercase; color:#666;"><h3>Trending Classified Adverts</h3></div>
<div id="load_data"></div>
</div>
<div id="load_data_message"></div>

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
<script src="inc/scroll2load_home.js"></script>
</body>
</html>