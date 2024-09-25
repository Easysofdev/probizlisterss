<?php require_once('db_conn.php'); ?>
<?php

//Home Page Ad Display By Category

if (isset($_GET['origin']) && $_GET['origin'] == "home_ad_by_cat"){
$item_cat=$_GET["c"];

	$sql_cat_ad = "SELECT * FROM adverts WHERE item_cat ='$item_cat' ORDER BY id_ad DESC";
	$cat_ad = $conn->query($sql_cat_ad);
	
if ($cat_ad->num_rows > 0) {
echo "<div class='col col-cat' style='text-transform:uppercase; color:rgb(0,153,0);'><h3>".$item_cat."</h3></div>";
  while($row_cat_ad = $cat_ad->fetch_assoc()) {
  	$item_imgs = explode("|", $row_cat_ad["item_imgs"]);
	$ad_img = $item_imgs[0];
	$id_ad = $row_cat_ad["id_ad"];
	$item_title = substr($row_cat_ad['item_title'], 0, 30);
	$item_price = number_format($row_cat_ad['item_price']);

echo "<a href='adpage.php?aid=".$id_ad."'><div class='ad-item'><img src='images/ads/".$ad_img."' alt=''>";
echo "<div class='on-img-text-left'>".count($item_imgs)."</div><div class='on-img-text-right'><i class='fa fa-star'></i></div><div class='ad-text'><p>".$item_title."</p><span style='color:rgb(0,153,0)'>&#x20A6;".$item_price."</span></div></div></a>";
} 

}else{echo"<div class='col col-cat' style='text-transform:uppercase; color:rgb(0,153,0);'><h3>".$item_cat."</h3><br /><br /><span style='color:#666;'>No Ads in this category yet!</span><hr /></div>";}
}?>

<?php //Home Professionals By Category
if (isset($_GET['origin']) && $_GET['origin'] == "pro_by_cat"){
$item_cat=$_GET["c"];
	$sql_pro_list = "SELECT * FROM prolist WHERE pro_cat = '".$item_cat."' AND  pro_sub_status = 1 ORDER BY id_pro DESC";
	$pro_list = $conn->query($sql_pro_list);
?>

<?php
if ($pro_list->num_rows > 0) { ?>
<div class="col-cat" style="text-transform:uppercase; padding-left:10px; color:#666;"><h3><span style="color:rgb(0,153,0);">Professionals:</span><br /> <?php echo $item_cat; ?></h3></div>
<div class="pro-box row">
<?php  while($row_pro_list = $pro_list->fetch_assoc()) {

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
<?php }  else {?>
<div class="col-cat" style="text-transform:uppercase; padding-left:10px; color:rgb(0,153,0);"><br /><span style="color:#666;">No Registered Professional in this category yet!</span></div>
<?php }?>
</div>
<hr />

<?php }}} ?>

<?php //Home Businesses By Category
if (isset($_GET['origin']) && $_GET['origin'] == "biz_by_cat"){
$cp=$_GET["c"];

if ($cp == 'a-d'){ $query ="LIKE 'a%' OR biz_name LIKE 'b%' OR biz_name LIKE 'c%' OR biz_name LIKE 'd%'"; }
if ($cp == 'e-h'){ $query ="LIKE 'e%' OR biz_name LIKE 'f%' OR biz_name LIKE 'g%' OR biz_name LIKE 'h%'"; }
if ($cp == 'i-l'){ $query ="LIKE 'i%' OR biz_name LIKE 'j%' OR biz_name LIKE 'k%' OR biz_name LIKE 'l%'"; }
if ($cp == 'm-p'){ $query ="LIKE 'm%' OR biz_name LIKE 'n%' OR biz_name LIKE 'o%' OR biz_name LIKE 'p%'"; }
if ($cp == 'q-t'){ $query ="LIKE 'q%' OR biz_name LIKE 'r%' OR biz_name LIKE 's%' OR biz_name LIKE 't%'"; }
if ($cp == 'u-z'){ $query ="LIKE 'u%' OR biz_name LIKE 'v%' OR biz_name LIKE 'w%' OR biz_name LIKE 'x%' OR biz_name LIKE 'y%' OR biz_name LIKE 'z%'"; }

	$sql_bizData = "SELECT * FROM bizlist WHERE biz_name ".$query." AND  biz_sub_status = 1 ORDER BY biz_name ASC";
	$bizData = $conn->query($sql_bizData);
?>
<div class="col-cat" style="text-transform:uppercase; text-align:left;"><h2><span style="color:rgb(0,153,0)"><?php echo $cp; ?></span> Businesses</h2></div>
<?php
if ($bizData->num_rows > 0) {
  while($row_bizData = $bizData->fetch_assoc()) {
  
  $date1=date_create($row_bizData['biz_start']);
  $date2=date_create($row_bizData['biz_end']);
  $diff=date_diff($date1,$date2);
  if  ($diff->format("%R%a") > 0){
  
  $sql_bizRev ="SELECT COUNT(id_review) AS total_reviews, SUM(star_rating) FROM biz_review WHERE id_biz ='".$row_bizData["id_biz"]."' Group By id_biz";
  $bizRev = $conn->query($sql_bizRev);
  $row_bizRev = $bizRev->fetch_assoc();
?>
<div class="bz-box">
<div class="bz-hd"><a href="<?php echo $row_bizData["biz_title"]; ?>.php"><?php echo $row_bizData["biz_name"]; ?></a></div>
<div class="bz-loc"><?php echo $row_bizData["biz_address"]; ?>, <?php echo $row_bizData["biz_city"]; ?> <?php echo $row_bizData["biz_state"]; ?> State, Nigeria.</div>
<div class="row">
<div class="bz-img"><a href="<?php echo $row_bizData["biz_title"]; ?>.php"><img src="../images/biz/<?php echo $row_bizData["biz_logo"]; ?>" align="right" /></a></div>
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
<div>
<a href="<?php echo $row_bizData["biz_title"]; ?>.php">
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
</div>

<?php } else {?> No Result! <?php }?>
<?php }}}?>


<?php
//Review Reactions
if (isset($_GET['origin']) && $_GET['origin'] == "reaction"){
$opr = $_GET['opr'];
$react = $_GET['a'];
$mod = $_GET['mod'];

if ($mod=="biz_rev_reaction"){}
	$id_rev = $_GET['id_rev'];
	$sql_revReact = "SELECT wrong_rev, useful_rev FROM biz_review WHERE id_review='".$id_rev."'";
	$revReact = $conn->query($sql_revReact);
	$row_revReact = $revReact->fetch_assoc();
	
	if ($opr=="plus"){$newReact = ($row_revReact[$react.'_rev'] + 1);}
	if ($opr=="minus"){$newReact = ($row_revReact[$react.'_rev'] - 1);}

	$sql_reactUpdate = "UPDATE biz_review SET ".$react."_rev ='".$newReact."' WHERE id_review='".$id_rev."'";
	if ($conn->query($sql_reactUpdate) === TRUE){echo $newReact;} else {die($conn->error);}

}
?>