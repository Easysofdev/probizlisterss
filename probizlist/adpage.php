<?php require_once('inc/db_conn.php'); ?>
<?php
if(isset($_GET["aid"]))	{
	$sql_ad_page = "SELECT * FROM adverts WHERE id_ad=".$_GET["aid"];
	$ad_page = $conn->query($sql_ad_page);
	$row_ad_page = $ad_page->fetch_assoc();
	
	$sql_ad_auth = "SELECT id_user, phone FROM users WHERE id_user=".$row_ad_page["id_user"];
	$ad_auth = $conn->query($sql_ad_auth);
	$row_ad_auth = $ad_auth->fetch_assoc();
	}
else {header("location:".$site_domain);}
?>
 <?php require 'inc/top-header-home.php'; ?>
<?php require 'inc/main-side-menu.php'; ?>
<div class="main-body">
<div class="ad-main-body">
<!-- Ad Img Slideshow Starts //-->
<?php
if ($ad_page->num_rows > 0) {	
  	$item_imgs = explode("|", $row_ad_page["item_imgs"]);
	$item_imgs_2 = explode("|", $row_ad_page["item_imgs"]);
	$ad_img = $item_imgs[0];
?>

<div class="ad_img_container row">
<?php
for ($x = 1; $x <= count($item_imgs); $x++) {
?>
  <div class="ad_img_Slides" style="text-align:center;">
    <div class="ad_img_numbertext"><?php echo $x." / ".count($item_imgs);?></div>
    <img src="images/ads/<?php echo $item_imgs[$x-1];?>" class="responsiveImg" />
  </div>
<?php } ?>
    
  <a class="ad_img_prev" onclick="plusSlides(-1)"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
  <a class="ad_img_next" onclick="plusSlides(1)"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>

  <div class="ad_img_row">
<?php
for ($y = 1; $y <= count($item_imgs_2); $y++) {
?>
    <div class="ad_img_column" style="text-align:left;">
      <img class="ad_img_mini ad_img_cursor" src="images/ads/<?php echo $item_imgs[$y-1];?>" style="width:auto; max-width:100%; height:auto; max-height:50px;" onclick="currentSlide(<?php echo $y;?>)" alt="" />
    </div>
<?php } ?>
  </div>
</div>
<?php } ?>
<!-- Ad Img Slideshow Ends 
<div class="ad_img_sidebar">
<div class="sidebar-ad-box">
<div class="ad-desc">
Side Bar related ads here!
</div>
</div>
</div>//-->
<!-- Ad Img Sidebar Ends //-->
<!-- trending ads row //-->
<div class="row">
<div class="col ad-title"><h1><?php echo $row_ad_page["item_title"] ?></h1></div>
<div class="col ad-price">&#x20A6;<?php echo number_format($row_ad_page["item_price"]) ?></div>
<div class="col ad-mini-text"><span class="ad-promo-type">Promoted</span> Location: <?php echo $row_ad_page["item_state"]. " " .$row_ad_page["item_city"]  ?> </div>
</div>

<div class="row">
<div class="ad-contact-btn"><a href="tel:<?php echo $row_ad_auth["phone"] ?>"><button class="call-seller-btn">Call the seller</button></a> 
<?php if (isset($_SESSION['USERNAME']) && $_SESSION['USERNAME'] != "") { ?>
<button class="offer-btn" onclick="show_modal('block','offer')">Make an offer</button>
<?php } else { ?>
<a href="adpage.php?aid=<?php echo $_GET['aid']; ?>&access=denied&p=<?php echo $_SERVER['PHP_SELF']; ?>?aid=<?php echo $_GET['aid']; ?>"><button class="offer-btn">Login to message seller</button></a>
<?php } ?>
</div></div>


<?php if (isset($_SESSION['USERNAME']) && $_SESSION['USERNAME'] != "") { ?>

<?php $username = $_SESSION["USERNAME"];
      $sql_current_user = "SELECT id_user, full_name FROM users WHERE username='".$username."'";
	  $current_user = $conn->query($sql_current_user);
	  $row_current_user = $current_user->fetch_assoc();
?>
<?php if ($row_ad_page["id_user"] != $row_current_user["id_user"]) { ?>

<div id="offer-box" class="row offer-box-container">
<div class="offer-box">
<div class="offer-box-title">MAKE AN OFFER</div>
<form method="post" action="<?php echo htmlspecialchars('inc/visitor_action_page.php');?>">
<input type="text" name="visitor_msg" required /> <br />
<input type="hidden" name="id_ad" value="<?php echo $row_ad_page["id_ad"] ?>" />
<input type="hidden" name="id_author" value="<?php echo $row_ad_page["id_user"] ?>" />
<input type="hidden" name="id_sender" value="<?php echo $row_current_user["id_user"] ?>" />
<input type="hidden" name="id_chat" value="<?php echo $row_ad_page["id_user"]. "_" .$row_current_user["id_user"]."_".$row_ad_page["id_ad"]; ?>" />
<input type="hidden" name="author_name" value="<?php echo $row_ad_page["author_name"] ?>" />
<input type="hidden" name="sender_name" value="<?php echo $row_current_user["full_name"] ?>" />
<input type="hidden" name="receiver" value="<?php echo $row_ad_page["author_name"] ?>" />
<input type="hidden" name="ad_title" value="<?php echo $row_ad_page["item_title"] ?>" />
<input type="hidden" name="status" value="visitor_msg" />

<input type="submit" value="Send" name="offerbox" /> <br /> <span class="pop-closer"  onclick="show_modal('none','offer')">[X Cancel]</span>
</form>
</div>
</div>


<div class="row">
<div class="msg-box">
<div class="ad-msg-box-title">Send message to seller</div>
<form method="post" action="<?php echo htmlspecialchars('inc/visitor_action_page.php');?>">
<textarea rows="5" cols="20" name="visitor_msg" required></textarea><br />
<input type="hidden" name="id_ad" value="<?php echo $row_ad_page["id_ad"] ?>" />
<input type="hidden" name="id_author" value="<?php echo $row_ad_page["id_user"] ?>" />
<input type="hidden" name="id_sender" value="<?php echo $row_current_user["id_user"] ?>" />
<input type="hidden" name="id_chat" value="<?php echo $row_ad_page["id_user"]. "_" .$row_current_user["id_user"]."_".$row_ad_page["id_ad"]; ?>" />
<input type="hidden" name="author_name" value="<?php echo $row_ad_page["author_name"] ?>" />
<input type="hidden" name="sender_name" value="<?php echo $row_current_user["full_name"] ?>" />
<input type="hidden" name="receiver" value="<?php echo $row_ad_page["author_name"] ?>" />
<input type="hidden" name="ad_title" value="<?php echo $row_ad_page["item_title"] ?>" />
<input type="hidden" name="status" value="visitor_msg" />

<input type="submit" value="Send" name="offerMessage" />
</form>
</div>
</div>
<?php } } ?>

<?php if (isset($_GET['send']) && $_GET['send'] == "success") { ?>
<div id="offer_status" style="position:absolute; top:10%; cursor:pointer; font-weight:bold;">
<div class="msg-box">
<div class="ad-desc">
<span style="display:block; text-align:center;" onclick="hideMe('offer_status')">x</span>
Message sent successfully!
</div>
</div>
</div>
<?php } ?>

<div class="row">
<div class="msg-box">
<div class="ad-feature">
<span>CONDITION</span>
<?php echo $row_ad_page["item_condition"] ?>
</div>

<div class="ad-feature">
<span>NEGOTIABLE</span>
<?php if ($row_ad_page["item_nego"] == 1){?>
Yes
<?php } else { ?>
No
<?php } ?>
</div>
</div>
</div>

<div class="row">
<div class="msg-box">
<div class="ad-desc">
<span>DESCRIPTION</span>
<?php
$desc = $row_ad_page["item_desc"];
$desc = str_replace("\r", "<br>", $desc);
$desc = str_replace("\r", "<br>", $desc);
echo $desc;
?>
</div>
</div>
</div>

<div class="row">
<div class="ad-contact-btn btm"><a href="tel:<?php echo $row_ad_auth["phone"] ?>"><button class="offer-btn">Call the seller</button></a></div>
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
<script>
var offerbox = document.getElementById("offer-box");
window.onclick = function(event) {

if (event.target == offerbox) {
	offerbox.style.display = "none";
	}
}
</script>
<script>
function hideMe(a) {
  var x = document.getElementById(a);
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
</body>
</html>