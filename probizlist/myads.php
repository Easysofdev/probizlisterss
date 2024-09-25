<?php require_once('inc/db_conn.php'); ?>
<?php require_once('inc/authorizedusers.php'); ?>
<?php
	$username = $_SESSION["USERNAME"];
    $sql_user = "SELECT username, user_cat, id_user FROM users WHERE username='".$username."'";
	$user = $conn->query($sql_user);
	$row_user = $user->fetch_assoc();
?>	
<?php	
	$id_user = $row_user["id_user"];
	$sql_ad = "SELECT id_ad, item_title, item_imgs FROM adverts WHERE id_user='".$id_user."' ORDER BY id_ad DESC";
	$ad = $conn->query($sql_ad);
?>
<?php require 'inc/top-header-home.php'; ?>
<script>
function alartMe(p,msg,id) {
  if (id == "") {
        document.getElementById("alert_container").innerHTML = "";
		return false;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("alert_container").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("POST","inc/alert_ajax.php?origin="+p+"&msg="+msg+"&id="+id,true);
    xmlhttp.send();
  }
}
</script>
<?php require 'inc/user-side-menu.php'; ?>
<div class="main-body">
<div class="ad-main-body">

<div class="ad_img_sidebar">
<div class="sidebar-ad-box">
<div class="ad-desc">
Side Bar related ads here!
</div>
</div>
</div>
<!-- Ad Img Sidebar Ends //-->

<div class="row">
<?php require 'inc/user-mob-side-menu.php'; ?>
<div class="msg-box row">
<div class="ad-msg-box-title"><h3><span style="text-transform:capitalize;"><?php echo $row_user["username"];?></span> Posted Adverts</h3></div>

<?php
if ($ad->num_rows > 0) {
  while($row_ad = $ad->fetch_assoc()) {
  	$item_imgs = explode("|", $row_ad["item_imgs"]);
	$ad_img = $item_imgs[0];
?>
<div class="user-ad-box">
<a href="adpage.php?aid=<?php echo $row_ad["id_ad"]; ?>">
<div class="user-ad-img-box"><img src="images/ads/<?php echo $ad_img;?>" height="90%" width="100%" /></div>
<div class="user-ad-title-box"><?php echo substr($row_ad["item_title"], 0, 30); ?></div>
</a>
<div class="user-ad-btn-box">
<a href="adpage.php?aid=<?php echo $row_ad["id_ad"]; ?>"><button>View Ad</button></a> <a href="edit-ad.php?aid=<?php echo $row_ad["id_ad"]; ?>"><button>Edit</button></a> <button onclick="alartMe('advert','Are you sure about this DELETION?','<?php echo $row_ad["id_ad"]; ?>')" style="border-radius:0 0 5px 0;">Delete</button></div>
</div>
<?php } } else { ?>
<div style="border:2px solid rgba(0,153,0,0.1); padding:20px; margin-bottom:5px;" class="row">
<a href="post-ad.php">POST YOUR FIRST ADVERT HERE!</a>
</div>
<?php } ?>
</div>
</div>

<div id="alert_container"></div>

<div class="row">
<div class="msg-box">
<div class="ad-desc">
Instructions for users could go here...
</div>
</div>
</div>

</div><!-- ad-Mainbody end DIV -->
<div class="ad-sidebar">
<div class="sidebar-ad-box">
<div class="ad-desc">
Side Bar related ads here!
</div>
</div>
</div><!-- ad-Sidebar end DIV -->

</div><!-- Mainbody end DIV -->

<?php require 'inc/footer.php'; ?>
</body>
</html>