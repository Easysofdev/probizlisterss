<?php require_once('inc/db_conn.php'); ?>
<?php require_once('inc/authorizedusers.php'); ?>
<?php
	$username = $_SESSION["USERNAME"];
    $sql_user = "SELECT username, user_cat, id_user, full_name FROM users WHERE username='".$username."'";
	$user = $conn->query($sql_user);
	$row_user = $user->fetch_assoc();
?>	
<?php	
	$token = $row_user["id_user"];
	
	$sql_msg =	"select l.* 
	from user_message l 
	inner join (
	  select 
		id_chat, max(id_msg) as latest 
	  from user_message WHERE id_author='$token' OR id_sender='$token'
	  group by id_chat 
	) r
	  on l.id_msg = r.latest and l.id_chat = r.id_chat
	order by id_msg desc";
		
	//$sql_msg = "SELECT * FROM user_message WHERE id_author='".$token."' OR id_sender='".$token."' GROUP BY id_chat ORDER by id_msg DESC";
$msg = $conn->query($sql_msg);
?>
 <?php require 'inc/top-header-home.php'; ?>
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
<div class="ad-msg-box-title"><h3><span style="text-transform:capitalize;"><?php echo $row_user["username"];?></span> Notifications</h3></div>

<?php
if ($msg->num_rows > 0) {
  while($row_msg = $msg->fetch_assoc()) {
?>
<div class="notice-box row">
<a href="chat-page.php?ia=<?php echo $row_msg["id_ad"]; ?>&is=<?php echo $row_msg["id_sender"]; ?>&chat=<?php echo $row_msg["id_chat"]; ?>">
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

<div><span id="ad"><?php echo substr($row_msg["ad_title"], 0, 35); ?></span></div>

<div><span id="msg"><?php echo substr($row_msg["visitor_msg"], 0, 35); ?></span></div>
</a>
</div>
<?php } } else { ?>
<div style="border:2px solid rgba(0,153,0,0.1); padding:20px; margin-bottom:5px;" class="row">
You've got no message!
</div>
<?php } ?>
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
</body>
</html>