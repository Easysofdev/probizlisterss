<?php require_once('db_conn.php'); ?>
<?php if(!isset($_SESSION['USERNAME'])){ ?>
<div id="offer-box" class="row alert-box-container">
<div class="offer-box">
<div class="offer-box-title">Session has ended!<br />Please <a style='color:green' href='index.php?access=denied'>Re-Login</a></div>
<span class="pop-closer"  onclick="show_modal('none','offer')">[ X ]</span>
</div>
</div>
<?php } ?>

<?php if(isset($_REQUEST["origin"]) && $_REQUEST["origin"] == "advert"){ ?>
<?php if(isset($_REQUEST["id"]) && !empty($_REQUEST["id"])){ ?>
<div id="offer-box" class="row alert-box-container">
<div class="offer-box">
<div class="offer-box-title">ALERT<br> <?php echo $_REQUEST["msg"]; ?> </div>
<span class="pop-closer"  onclick="show_modal('none','offer')">[ NO ]</span><a href="inc/action_page.php?id=<?php echo $_REQUEST["id"]; ?>&action=<?php echo $_REQUEST["origin"]; ?>" style="color:rgb(0,153,0)">[ YES ]</a>
</div>
</div>
<?php } ?>
<?php } ?>

<?php if(isset($_REQUEST["origin"]) && $_REQUEST["origin"] == "admin"){ ?>
<?php if(isset($_REQUEST["id"]) && !empty($_REQUEST["id"])){ ?>
<div id="offer-box" class="row alert-box-container">
<div class="offer-box">
<div class="offer-box-title">Do you want to<br /><?php echo $_REQUEST["msg"]; ?><br />this user's Account?</div>
<span class="pop-closer"  onclick="show_modal('none','offer')">[ NO ]</span><a href="inc/action_page.php?id=<?php echo $_REQUEST["id"]; ?>&action=<?php echo $_REQUEST["msg"]; ?>" style="color:rgb(0,153,0)">[ YES ]</a>
</div>
</div>
<?php } ?>
<?php } ?>

<?php if(isset($_REQUEST["origin"]) && $_REQUEST["origin"] == "pro-deactivation" || $_REQUEST["origin"] == "biz-deactivation"){ ?>
<?php if(isset($_REQUEST["id"]) && !empty($_REQUEST["id"])){ ?>
<div id="offer-box" class="row alert-box-container">
<div class="offer-box">
<div class="offer-box-title">ALERT<br> <?php echo $_REQUEST["msg"]; ?> </div>
<span class="pop-closer"  onclick="show_modal('none','offer')">[ NO ]</span><a href="inc/action_page.php?id=<?php echo $_REQUEST["id"]; ?>&action=<?php echo $_REQUEST["origin"]; ?>" style="color:rgb(0,153,0)">[ YES ]</a>
</div>
</div>
<?php } ?>
<?php } ?>

<?php if(isset($_REQUEST["origin"]) && $_REQUEST["origin"] == "user_profile"){ ?>
<?php if(isset($_REQUEST["id"]) && !empty($_REQUEST["id"])){
$id_user = $_REQUEST["id"];
$sql_user = "SELECT * FROM users WHERE id_user=".$id_user;
$user = $conn->query($sql_user);
$row_user = $user->fetch_assoc();

$sql_proStatus = "SELECT pro_sub_status, pro_start, pro_end, id_pro FROM prolist WHERE id_user=".$row_user['id_user'];
$proStatus = $conn->query($sql_proStatus);
$row_proStatus = $proStatus->fetch_assoc();

$sql_bizStatus = "SELECT biz_sub_status, biz_start, biz_end, id_biz FROM bizlist WHERE id_user=".$row_user['id_user'];
$bizStatus = $conn->query($sql_bizStatus);
$row_bizStatus = $bizStatus->fetch_assoc(); 

$sql_advert ="SELECT COUNT(id_ad) AS total_ads FROM adverts WHERE id_user=".$row_user['id_user'];
$advert = $conn->query($sql_advert);
$row_advert = $advert->fetch_assoc();

?>
<div id="offer-box" class="row alert-box-container">
<div class="offer-box">
<div class="offer-box-title">
<div class="row">
<div class="msg-box">
<div class="ad-desc">
<div style="position:relative; margin:auto; border-radius:70px; height:110px; width:110px;">
<img src="images/users/<?php echo $row_user["user_pic"]; ?>" height="100px" width="100px" style="border-radius:70px;" />
</div>
<table style="width:100%;">
<tr><th colspan="2">PERSONAL INFO</th></tr>
<tr><td>FULL NAME:</td><td><?php echo $row_user["full_name"]; ?></td></tr>
<tr><td>E-MAIL:</td><td><?php echo $row_user["email"]; ?></td></tr>
<tr><td>PHONE:</td><td><?php echo $row_user["phone"]; ?></td></tr>
<tr><td>CITY/STATE:</td><td><?php echo $row_user["user_city"]; ?>, <?php echo $row_user["user_state"]; ?></td></tr>

<tr><td>ADVERTS:</td><td><?php echo $row_advert["total_ads"]; ?></td></tr>
<tr><th colspan="2">SUBSCRIPTIONS</th></tr>
<?php 
if(isset($row_proStatus['pro_start'])){
$date1=date_create($row_proStatus['pro_start']);
$date2=date_create($row_proStatus['pro_end']);
$diff=date_diff($date1,$date2);
if  ($diff->format("%R%a") > 0){
?>
<tr><td><strong><span style="color:green; display:inline;">Active</span> - Professional Profile</strong></td><td>End Date: <?php echo $row_proStatus['pro_end']; ?> <button class="sub_btn" onclick="alartMe('pro-deactivation','Are you sure about this DEACTIVATION?','<?php echo $row_proStatus['id_pro']; ?>')" style="cursor:pointer;">Deactivate</button></td></tr>
<?php } else { ?>
<tr><td><strong><span style="color:red; display:inline;">Inactive</span> - Professional Profile</strong></td><td><button class="sub_btn" onclick="showForm('prosub')" style="cursor:pointer;">Activate</button></td></tr>
<tr id="prosub" style="display:none;"><td colspan="2"><span class="subForm"> <form id="prosub" method="POST" action="<?php echo htmlspecialchars('inc/action_page.php');?>">Start Date: <input type="date" name="pro_start" id="pro_start" /> End Date:<input type="date" name="pro_end" id="pro_end" /> <input type="submit" value="Activate" /><input type="hidden" name="id" value="<?php echo $row_proStatus['id_pro'];?>"><input type="hidden" name="id_user" value="<?php echo $row_user['id_user'];?>"><input type="hidden" name="form_type" value="prosub"></form></span></td></tr>
<?php }} ?>
<?php 
if(isset($row_bizStatus['biz_start'])){
$date1=date_create($row_bizStatus['biz_start']);
$date2=date_create($row_bizStatus['biz_end']);
$diff=date_diff($date1,$date2);
if  ($diff->format("%R%a") > 0){
?>
<tr><td><strong><span style="color:green; display:inline;">Active</span> - Business Profile</strong></td><td>End Date: <?php echo $row_bizStatus['biz_end']; ?> <button class="sub_btn" onclick="alartMe('biz-deactivation','Are you sure about this DEACTIVATION?','<?php echo $row_bizStatus['id_biz']; ?>')" style="cursor:pointer;">Deactivate</button></td></tr>
<?php } else { ?>
<tr><td><strong><span style="color:red; display:inline;">Inactive</span> - Business Profile</strong></td><td><button class="sub_btn" onclick="showForm('bizsub')" style="cursor:pointer;">Activate</button></td></tr>
<tr id="bizsub" style="display:none;"><td colspan="2"><span class="subForm"> <form id="bizsub" method="POST" action="<?php echo htmlspecialchars('inc/action_page.php');?>">Start Date: <input type="date" name="biz_start" id="biz_start" /> End Date:<input type="date" name="biz_end" id="biz_end" /> <input type="submit" value="Activate" /><input type="hidden" name="id" value="<?php echo $row_bizStatus['id_biz'];?>"><input type="hidden" name="id_user" value="<?php echo $row_user['id_user'];?>"><input type="hidden" name="form_type" value="bizsub"></form></span></td></tr>
<?php }} ?>

</table>
</div>
</div>
</div>

</div>
<span class="pop-closer"  onclick="show_modal('none','offer')">[ CLOSE ]</span>
</div>
</div>
<?php } ?>
<?php } ?>
