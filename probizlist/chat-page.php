<?php require_once('inc/db_conn.php'); ?>
<?php require_once('inc/authorizedusers.php'); ?>
<?php
	$username = $_SESSION["USERNAME"];
    $sql_user = "SELECT username, user_cat, full_name, id_user FROM users WHERE username='".$username."'";
	$user = $conn->query($sql_user);
	$row_user = $user->fetch_assoc();
?>	
<?php	
	$id_ad = $_GET["ia"];
	$sql_ad = "SELECT * FROM adverts WHERE id_ad='".$id_ad."'";
	$ad = $conn->query($sql_ad);
	$row_ad = $ad->fetch_assoc();
?>
<?php	
	$id_sender = $_GET["is"];
	$sql_sender = "SELECT * FROM users WHERE id_user='".$id_sender."'";
	$sender = $conn->query($sql_sender);
	$row_sender = $sender->fetch_assoc();
?>
<?php
	$id_chat = $_GET["chat"];	
	$sql_chat = "SELECT * FROM user_message WHERE id_chat='".$id_chat."' ORDER BY id_msg ASC";
	$chat = $conn->query($sql_chat);

	$sql_msg = "SELECT * FROM user_message WHERE id_chat='".$id_chat."'";
	$msg = $conn->query($sql_msg);
	$row_msg = $msg->fetch_assoc();
?>
 <?php require 'inc/top-header-home.php'; ?>
<script>
function sendChat() {
  var u = document.getElementById("username").value;
  var c = document.getElementById("chat").value;
  var ia = document.getElementById("ia").value;
  var vm = document.getElementById("visitor_msg").value;
  if (vm == "") {
    return false;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
	  	document.getElementById("visitor_msg").value = "";
        document.getElementById("chat_msg").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","inc/ajax_processor.php?u="+u+"&c="+c+"&ia="+ia+"&vm="+vm+"&origin=chat",true);
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

<div class="notice-box row">
<?php
if ($row_user["full_name"] == $row_msg["receiver"]){
	$chatPartner = $row_msg["sender_name"];
	
	$sql_partnerPic = "SELECT user_pic FROM users WHERE full_name='".$chatPartner."'";
	$partnerPic = $conn->query($sql_partnerPic);
	$row_partnerPic = $partnerPic->fetch_assoc();

} else {
	$chatPartner = $row_msg["receiver"];
	
	$sql_partnerPic = "SELECT user_pic FROM users WHERE full_name='".$chatPartner."'";
	$partnerPic = $conn->query($sql_partnerPic);
	$row_partnerPic = $partnerPic->fetch_assoc();
}
?>

<div class="notice-img-box"><img src="images/users/<?php if($row_partnerPic['user_pic'] != ""){echo $row_partnerPic['user_pic'];} else {echo 'avatar.jpg';}?>" height="60px" width="60px" /></div>
<div><h1><?php echo substr($chatPartner, 0, 20); ?></h1></div>
<div><span id="ad">AD: <a href="adpage.php?aid=<?php echo $row_ad['id_ad']; ?>"><?php echo substr($row_ad["item_title"], 0, 30); ?></a></span></div>
<div><span id="msg"><?php echo substr($row_ad["item_date"], 0, 30); ?></span></div>
</div>

<span id="chat_msg">
<?php
if ($chat->num_rows > 0) {
  while($row_chat = $chat->fetch_assoc()) {
?>
<div class="chat-box row">
<div><span <?php if($row_chat['id_sender'] == $row_user['id_user']) { ?> id="chat_right_box" <?php } else { ?> id="chat_left_box" <?php } ?>><?php echo $row_chat["visitor_msg"]; ?></span></div>
</div>
<?php } }?>
</span>

<!--<form method="post" action="<?php// echo htmlspecialchars('inc/visitor_action_page.php');?>"> -->
<form method="post" action="false">
<textarea rows="2" cols="20" name="visitor_msg" id="visitor_msg" required></textarea><br />
<input type="hidden" name="username" id="username" value="<?php echo $_SESSION["USERNAME"] ?>" />
<input type="hidden" name="chat" id="chat" value="<?php echo $_GET["chat"] ?>" />
<input type="hidden" name="ia" id="ia" value="<?php echo $_GET["ia"] ?>" />
</form>
<button id="btn" onclick="sendChat()">Send</button>

</div>
</div>

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
<script>
document.getElementById("visitor_msg").focus();
</script>

</body>
</html>