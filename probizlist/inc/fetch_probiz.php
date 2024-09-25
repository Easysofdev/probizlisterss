<?php /*
if(isset($_POST["limit"], $_POST["start"]))
{
 $connect = mysqli_connect("localhost", wechujfx_probizlist, "", "scroll2load");
 $query = "SELECT * FROM blogs ORDER BY id DESC LIMIT ".$_POST["start"].", ".$_POST["limit"]."";
 $result = mysqli_query($connect, $query);
 while($row = mysqli_fetch_array($result))
 {
  echo '
  <h3>'.$row["title"].'</h3>
  <p>'.$row["description"].'</p>
  <p class="text-muted" align="right">By - '.$row["id"].'</p>
  <hr />
  ';
 }
}

*/?>


<?php require_once('db_conn.php'); ?>
<?php
	if(isset($_POST["limit"], $_POST["start"])){
	//$conn = mysqli_connect("localhost","wechujfx_probizlist_user", "hZ2Fxm#1]a{r","wechujfx_probizlist");
	$conn = mysqli_connect("localhost", "wechujfx_probizlist_user", "hZ2Fxm#1]a{r", "wechujfx_probizlist");
	$sql_ad_load = "SELECT * FROM adverts WHERE id_user=".$_POST["id"]." ORDER BY id_ad DESC LIMIT ".$_POST["start"].", ".$_POST["limit"]."";
	$ad_load = $conn->query($sql_ad_load);

?>


<?php
    while($row_ad_load = $ad_load->fetch_assoc()) {
  	$item_imgs = explode("|", $row_ad_load["item_imgs"]);
	$ad_img = $item_imgs[0];
?>
<a href="<?php echo $site_domain ?>adpage.php?aid=<?php echo $row_ad_load["id_ad"];?>"><div class="ad-item"><img src="../images/ads/<?php echo $ad_img;?>" alt="">
<div class="on-img-text-left"><?php echo count($item_imgs);?></div><div class="on-img-text-right"><i class="fa fa-star"></i></div><div class="ad-text"><p><?php echo substr($row_ad_load["item_title"], 0, 30);?></p><span style="color:rgb(0,153,0)">&#x20A6;<?php echo number_format($row_ad_load["item_price"]) ?></span></div></div></a>
<?php } }?>
