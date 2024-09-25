<?php require_once('../inc/db_conn.php'); ?>
<?php	
	$sql_ad_home = "SELECT * FROM adverts WHERE id_user=".$id_user." ORDER BY id_ad DESC LIMIT 10";
	$ad_home = $conn->query($sql_ad_home);
	
	$sql_bizData = "SELECT * FROM bizlist WHERE id_biz='".$id_biz."'";
	$bizData = $conn->query($sql_bizData);
	$row_bizData = $bizData->fetch_assoc();
	
	$sql_bizRev ="SELECT COUNT(id_review) AS total_reviews, SUM(star_rating) FROM biz_review WHERE id_biz ='".$row_bizData["id_biz"]."' Group By id_biz";
  	$bizRev = $conn->query($sql_bizRev);
  	$row_bizRev = $bizRev->fetch_assoc();
	
	$sql_bizRevFull = "SELECT * FROM biz_review WHERE id_biz='".$id_biz."' ORDER BY id_review DESC";
	$bizRevFull = $conn->query($sql_bizRevFull);

?>
<?php require '../inc/top-header-probiz.php'; ?>
<script>
function addCount(a,b,c){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
	  if (xmlhttp.readyState == 1){
		document.getElementById(a+"_rev_react"+c).innerHTML = "<br /><img src='../images/progress-bar.gif' style='width:10px; max-width:10px; border-radius:10px;' />";
	  }
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById(a+"_rev_react"+c).innerHTML = this.responseText;
	  if (a == "useful" && b == "plus"){
		document.getElementById(a+"_"+c).innerHTML = "<i class='fa fa-thumbs-o-up' style='cursor:pointer;' onclick='addCount(&quot;"+a+"&quot;,&quot;minus&quot;,"+c+")'> USEFUL </i>";}
	  if (a == "wrong" && b == "plus"){
		document.getElementById(a+"_"+c).innerHTML = "<i class='fa fa-smile-o' style='cursor:pointer;' onclick='addCount(&quot;"+a+"&quot;,&quot;minus&quot;,"+c+")'> WRONG </i>";}
	  if (a == "useful" && b == "minus"){
		document.getElementById(a+"_"+c).innerHTML = "<i class='fa fa-thumbs-o-up' style='cursor:pointer;' onclick='addCount(&quot;"+a+"&quot;,&quot;plus&quot;,"+c+")'> USEFUL </i>";}
	  if (a == "wrong" && b == "minus"){
		document.getElementById(a+"_"+c).innerHTML = "<i class='fa fa-smile-o' style='cursor:pointer;' onclick='addCount(&quot;"+a+"&quot;,&quot;plus&quot;,"+c+")'> WRONG </i>";}
		document.getElementById(a+"_rev_react"+c).focus();
      }
    };
    xmlhttp.open("GET","../inc/ajax_general_processor.php?a="+a+"&opr="+b+"&mod=biz_rev_reaction&origin=reaction&id_rev="+c,true);
    xmlhttp.send();
}
</script>
<div class="row">
<div class="pro_banner_mob"><div class="col" id="top_banner_pro" style="background-position:left top; background-repeat:no-repeat; background-image: url('../images/biz/<?php echo $row_bizData["biz_banner_mob"]; ?>');"><h1 class="top_banner"></h1></div></div>
<div class="pro_banner_992"><div class="col" id="top_banner_pro" style="background-position:left top; background-repeat:no-repeat; background-image: url('../images/biz/<?php echo $row_bizData["biz_banner_desk"]; ?>');"><h1 class="top_banner"></h1></div></div>
</div>
<?php require '../inc/main-side-menu.php'; ?>

<div class="main-body">
<div class="navbar">
  <a class="active" href="<?php echo $site_domain ?>businesses"><i class="fa fa-fw fa-briefcase"></i> Biz-List</a> 
  <a href="<?php echo $site_domain ?>index.php"><i class="fa fa-adn"></i> Ads</a> 
  <!-- <a href="<?php echo $site_domain ?>professionals"><i class="fa fa-fw fa-building"></i> Pro-List</a> -->
  <!-- <a href="<?php// echo $site_domain ?>status"><i class="fa fa-fw fa-user"></i> Status</a> -->
</div>

<div id="Pro-List" class="tabcontent">
<div class="pro-box row">

<div class="bz-details-box">
<span style="display:inline-block; color:#666666; margin-bottom:20px;">Nigeria <i class="fa fa-angle-double-right"></i> <?php echo $row_bizData["biz_state"]; ?> <i class="fa fa-angle-double-right"></i> <?php echo $row_bizData["biz_city"]; ?> <i class="fa fa-angle-double-right"></i> <?php echo $row_bizData["biz_cat"]; ?> <i class="fa fa-angle-double-right"></i> <?php echo $row_bizData["biz_name"]; ?></span>

<div class="bz-hd"><?php echo $row_bizData["biz_name"]; ?>
<?php if (!empty ($row_bizData["biz_facebook"]) || !empty ($row_bizData["biz_twitter"]) || !empty ($row_bizData["biz_google"]) || !empty ($row_bizData["biz_youtube"]) || !empty ($row_bizData["biz_tiktok"]) || !empty ($row_bizData["biz_instagram"])){ ?>
<div style="font-size:25px;"><span style="font-size:12px;">Follow US on Social Media</span><br />
<?php if (!empty ($row_bizData["biz_facebook"])){ ?><a href="<?php echo $row_bizData["biz_facebook"]; ?>" target="_blank" class="fb" title="Facebook"><i class="fab fa-facebook-square"></i> </a><?php } ?>
<?php if (!empty ($row_bizData["biz_twitter"])){ ?><a href="<?php echo $row_bizData["biz_twitter"]; ?>" target="_blank" class="tw" title="Twitter"><i class="fab fa-twitter-square"></i> </a><?php } ?>
<?php if (!empty ($row_bizData["biz_google"])){ ?><a href="<?php echo $row_bizData["biz_google"]; ?>" target="_blank" class="sp" title="Snapchat"><i class="fab fa-snapchat-square"></i> </a><?php } ?>
<?php if (!empty ($row_bizData["biz_youtube"])){ ?><a href="<?php echo $row_bizData["biz_youtube"]; ?>" target="_blank" class="yt" title="Youtube"><i class="fab fa-youtube-square"></i> </a><?php } ?>
<?php if (!empty ($row_bizData["biz_tiktok"])){ ?><a href="<?php echo $row_bizData["biz_tiktok"]; ?>" target="_blank" class="wp" title="WhatsApp"><i class="fab fa-whatsapp-square"></i> </a><?php } ?>
<?php if (!empty ($row_bizData["biz_instagram"])){ ?><a href="<?php echo $row_bizData["biz_instagram"]; ?>" target="_blank" class="ig" title="Instagram"><i class="fab fa-instagram-square"></i></a><?php } ?>
</div>
<?php } ?>

</div>
<div style="display:inline-block; margin:10px 0;">
<div class="bz-star" style="font-size:11px;">

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
<div class="bz-rev-pt"><?php if (isset($row_bizRev['total_reviews']) && $row_bizRev['total_reviews'] > 0){ echo number_format(round(($row_bizRev['SUM(star_rating)']/$row_bizRev['total_reviews']), 1), 1); $totalrev = $row_bizRev['total_reviews'];}else{echo 0; $totalrev = 0;} ?></div> <?php echo $totalrev; ?>&nbsp;Reviews
<div class="bz-yr" style="float:right; margin-left:20px; text-align:right; cursor:pointer;" id="review_btnwrt"><span onclick="formShow('review','CANCEL REVIEW','WRITE A REVIEW','wrt')">WRITE A REVIEW</span></div>
</div>
<?php if(isset($_GET['addreview']) && $_GET['addreview'] == "success" ){?>
<div style="font-weight:bold; margin:10px 0; color:#f73;">Your review has been added successfully. Thank You!</div>
<?php } ?>
<div style="max-width:600px; margin:10px 0; display:none;" id="review_formwrt">
<h2>Write a Review</h2>
<div>
Your overall rating
<div class="review-star" style="font-size:24px;"><i style="cursor:pointer" onmouseover="starRate('1')" id="1star" class="fa fa-star"></i> <i style="cursor:pointer" onmouseover="starRate('2')" id="2star" class="fa fa-star-o"></i> <i style="cursor:pointer" onmouseover="starRate('3')" id="3star" class="fa fa-star-o"></i> <i style="cursor:pointer" onmouseover="starRate('4')" id="4star" class="fa fa-star-o"></i> <i style="cursor:pointer" onmouseover="starRate('5')" id="5star" class="fa fa-star-o"></i></div>
</div>
<form method="post" name="biz_review" id="biz_review" action="<?php echo htmlspecialchars('../inc/action_page.php');?>">
<input type="hidden" name="star_rating" id="star_rating" value="1" />
<input type="text" name="review_writer_name" placeholder="Your Name" required />
<span class="row">
<span style="width:49%; float:left; margin:0 5px 0 0;"><input type="email" name="review_writer_email" placeholder="Your Email" required /></span>
<span style="width:49%; float:left;"><input type="tel" name="review_writer_phone" pattern="[0-9]{11}" placeholder="Mobile e.g. 08012345678" /></span>
</span>
<input type="text" name="review_title" placeholder="Review Title" required />
<textarea name="review_msg" rows="7" placeholder="Your Review" required></textarea>
<input type="hidden" name="id_biz" value="<?php echo $row_bizData["id_biz"]; ?>" />
<input type="hidden" name="biz_title" value="<?php echo $row_bizData["biz_title"]; ?>" />
<input type="hidden" name="form_type" value="biz_review" />
<input type="submit" name="com_review" value="SUBMIT REVIEW" style="margin-top:20px;" />
</form>
</div>

<div style="max-width:600px; border:1px solid white; margin:15px 0; border-radius:25px 25px 0 0;">
<span class="in_tab in_tab-about" onclick="showTabContent(event, 'about')">About</span>
<span class="in_tab" onclick="showTabContent(event, 'contact')">Contact</span>
<span class="in_tab" onclick="showTabContent(event, 'enquiry')">Enquiry</span>
<span class="in_tab" onclick="showTabContent(event, 'reviews')">Reviews</span>

<div id="about" class="inner_tab_main">
<span style="display:inline-block; border:1px solid #6d8; border-radius:5px;">

<?php if ($row_bizData["verify_status"] == "1"){?>
	<span style="display:inline-block; padding:9.5px 15px; vertical-align:top; background-color:#6d8; font-size:14px; font-weight:bold; color:#fff;"><i class="fa fa-check"></i></span><span style="display:inline-block; padding:5.5px 15px; font-size:10px; font-weight:bold; background-color:#fff; vertical-align:top; border-radius:0 5px 5px 0;">
	VERIFIED<br /><span style="font-size:8px;">LISTING</span>
	</span>
<?php } else {?>
	<span style="display:inline-block; padding:9.5px 15px; vertical-align:top; background-color:#444; font-size:14px; font-weight:bold; color:#fff;"><i class="fa fa-ban"></i></span><span style="display:inline-block; padding:5.5px 15px; font-size:10px; font-weight:bold; background-color:#fff; vertical-align:top; border-radius:0 5px 5px 0;">
	UN-VERIFIED<br /><span style="font-size:8px;">LISTING</span>
	</span>
<?php } ?>

</span>

<?php
$date1=date_create($row_bizData['biz_reg_date']);
$date2=date_create(date("Y-m-d h:i:s"));
$diff=date_diff($date1,$date2);
$yr = $diff->y;
if ($yr >= 1){ ?>
<span style="display:inline-block; border:1px solid #999; border-radius:5px;">
<span style="display:inline-block; padding:9.5px 15px; vertical-align:top; background-color:#999; font-size:14px; font-weight:bold; color:#fff;">+<?php echo $yr; ?></span><span style="display:inline-block; padding:5.5px 15px; font-size:10px; font-weight:bold; background-color:#fff; vertical-align:top; border-radius:0 5px 5px 0;">YEARS<br /><span style="font-size:8px;">WITH US</span></span>
</span>
<?php } ?>
<br />
<div class="bz-full-desc"><img src="../images/biz/<?php echo $row_bizData["biz_logo"]; ?>" height="100px" width="100px" align="left" vspace="5px" hspace="10px" /><?php echo str_replace("\r\n", "<br>", $row_bizData["biz_desc"]); ?></div>
<br />
<div class="bz-full-desc"><div class="bz_contact"><h3>OUR SERVICES</h3></div>
<?php echo $row_bizData["biz_service"]; ?>
</div>
<br />
<span style="display:inline-block; border:1px solid #4a3; border-radius:5px;">
<span style="display:inline-block; padding:8px 15px; vertical-align:top; background-color:rgba(0,153,0,0.5); font-size:10px; color:#fff;">ESTABLISHMENT YEAR</span>
<span style="display:inline-block; padding:8px 15px; font-size:10px; background-color:#fff; vertical-align:top; border-radius:0 5px 5px 0;"><?php echo $row_bizData["biz_est_yr"]; ?></span>
</span><br />

<span style="display:inline-block; border:1px solid #4a3; border-radius:5px; margin:10px 0;">
<span style="display:inline-block; padding:8px 15px; vertical-align:top; background-color:rgba(0,153,0,0.5); font-size:10px; color:#fff;">EMPLOYEES</span>
<span style="display:inline-block; padding:8px 15px; font-size:10px; background-color:#fff; vertical-align:top; border-radius:0 5px 5px 0;"><?php echo $row_bizData["no_of_employee"]; ?></span>
</span><br />

<span style="display:inline-block; border:1px solid #4a3; border-radius:5px;">
<span style="display:inline-block; padding:8px 15px; vertical-align:top; background-color:rgba(0,153,0,0.5); font-size:10px; color:#fff;">COMPANY MANAGER</span>
<span style="display:inline-block; padding:8px 15px; font-size:10px; background-color:#fff; vertical-align:top; border-radius:0 5px 5px 0;"><?php echo $row_bizData["biz_manager_name"]; ?></span>
</span><br />
<div style="margin:20px 0 0;">
SHARE THIS LISTING<br />
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<div class="addthis_inline_share_toolbox" style="margin:10px 0;"></div>
</div>
</div>

<div id="contact" class="inner_tab_main">
<div class="bz_contact">
<h2>COMPANY NAME</h2>
<span><?php echo $row_bizData["biz_name"]; ?></span>
<h2>ADDRESS</h2>
<span><?php echo $row_bizData["biz_address"]; ?>, <?php echo $row_bizData["biz_city"]; ?> <?php echo $row_bizData["biz_state"]; ?> State, Nigeria.</span>
<h2>VIEW ON MAP</h2>
<div style="width: 100%; border:3px solid #FFF;"><iframe width="100%" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=150&amp;hl=en&amp;q=<?php echo $row_bizData["biz_name"]; ?>,%20<?php echo $row_bizData["biz_address"]; ?>+(<?php echo $row_bizData["biz_name"]; ?>)&amp;t=&amp;z=17&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>

<h2>PHONE NUMBER</h2>
<span><a href="tel:08062649941"><?php echo $row_bizData["biz_office_phone"]; ?></a></span>
<h2>MOBILE PHONE</h2>
<span><a href="tel:08062649941"><?php echo $row_bizData["biz_mobile_phone"]; ?></a></span>
<h2>WEBSITE</h2>
<span><a href="http://thegrillcorner.com.ng/" target="_blank"><?php echo $row_bizData["biz_website"]; ?></a></span>
</div>
</div>

<div id="enquiry" class="inner_tab_main">
<div class="bz_contact row" id="enquiry_form">
<h2>Send in Your Comment/Question</h2>
<form method="post" name="enquiry" id="enquiry" action="<?php echo htmlspecialchars('../inc/action_page.php');?>">
<input type="text" name="enq_name" placeholder="Your Name" required />
<input type="email" name="enq_email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" placeholder="Your Email" required />
<input type="tel" name="enq_phone" pattern="[0-9]{11}" placeholder="Mobile e.g. 08012345678" required />
<textarea name="enq_msg" rows="7" placeholder="Your Message" required></textarea>
<input type="hidden" name="email" value="<?php echo $row_bizData["biz_email"]; ?>" />
<input type="hidden" name="form_type" value="enquiry" />
<input type="hidden" name="p" value="<?php echo $_SERVER['PHP_SELF']; ?>" />
<input type="submit" value="SEND ENQUIRY" style="margin-top:20px;" />
</form>
</div>
</div>

<div id="reviews" class="inner_tab_main" style="line-height:2em;">
<span style="color:#666; font-weight:bold;">All reviews are verified by our Administrator.</span>

<?php if ($bizRevFull->num_rows > 0) {
  while($row_bizRevFull = $bizRevFull->fetch_assoc()) { ?>
<div style="margin:20px 0; padding:0; border-top:1px dotted rgb(0,153,0);">
<div style="display:inline-block; margin:10px 0;">

<div class="bz-star" style="font-size:11px;">
<?php
$a = round($row_bizRevFull["star_rating"], 0);
$b = 5 - $a;
  
for ($x = 1; $x <= $a; $x++) {
  echo "<i class='fa fa-star'></i> ";
}
for ($i = 1; $i <= $b; $i++) {
  echo "<i class='fa fa-star-o'></i> ";
}
?>
</div>

<div class="bz-rev-rate-rpy"><?php echo number_format($row_bizRevFull["star_rating"], 1); ?></div></div>
<div class="row" style="height:60px; overflow:hidden; width:80%;">
<div style="display:inline-block; height:60px; width:30%; float:left;"><img src="../images/users/avatar.jpg" height="60px" width="60px" /></div>
<div style="display:inline-block; height:20px; width:70%; float:left; margin:10px 0 0 0; font-weight:bold;"><?php echo $row_bizRevFull["review_writer_name"]; ?></div><br />
<div style="display:inline-block; height:20px; width:70%; float:left; margin:0 0 10px 0; color:#666;"><?php echo $row_bizRevFull["review_date"]; ?></div>
</div>
<div class="row"><div><h2><?php echo $row_bizRevFull["review_title"]; ?></h2></div><div><?php echo $row_bizRevFull["review_msg"]; ?></div></div>

<div class="row" style="margin:20px 5px 0px;">

<span style="display:inline-block; float:left; border:1px solid #fff; padding:3px 7px; border-radius:10px; cursor:pointer;" id="reply_btn<?php echo $row_bizRevFull["id_review"]; ?>">
<!--<span onclick="formShow('reply','CANCEL','REPLY','<?php //echo $row_bizRevFull["id_review"]; ?>')">REPLY</span> //-->
</span>

<span style="display:inline-block; float:right; padding:5px;"><span id="wrong_<?php echo $row_bizRevFull["id_review"]; ?>"><i class="fa fa-smile-o" style="cursor:pointer;" onclick="addCount('wrong','plus','<?php echo $row_bizRevFull["id_review"]; ?>')"> WRONG </i></span> <span id="wrong_rev_react<?php echo $row_bizRevFull["id_review"]; ?>"><?php echo $row_bizRevFull["wrong_rev"]; ?></span></span>

<span style="display:inline-block; float:right; padding:5px;"><span id="useful_<?php echo $row_bizRevFull["id_review"]; ?>"><i class="fa fa-thumbs-o-up" style="cursor:pointer;" onclick="addCount('useful','plus','<?php echo $row_bizRevFull["id_review"]; ?>')"> USEFUL </i></span> <span id="useful_rev_react<?php echo $row_bizRevFull["id_review"]; ?>"><?php echo $row_bizRevFull["useful_rev"]; ?></span></span>

</div>

<div style="max-width:600px; margin:10px 0; display:none;" id="reply_form<?php echo $row_bizRevFull["id_review"]; ?>">
<h2>Reply To Review</h2>
<form method="post" name="review_reply" id="review_reply" action="<?php echo htmlspecialchars('inc/action_page.php');?>">
<input type="text" name="review_reply_name" placeholder="Your Name" required />
<span class="row">
<span style="width:49%; float:left; margin:0 5px 0 0;"><input type="text" name="review_reply_email" placeholder="Your Email" required /></span>
<span style="width:49%; float:left;"><input type="text" name="review_reply_phone" placeholder="Your Phone" /></span>
</span>
<textarea name="review_reply_msg" rows="7" placeholder="Your Reply" required></textarea>
<input type="hidden" name="id_review" value="<?php echo $row_bizRevFull["id_review"]; ?>" />
<input type="submit" name="com_review_reply" value="SUBMIT REPLY" style="margin-top:20px;" />
</form>
</div>
</div>
<?php } } ?>

</div>

</div>
<!-- trending ads row //-->
<div class="row">
<span id="d_ad"></span>
<input type="hidden" id="uid" value="<?php echo $id_user; ?>" />
<div class="bz-hd" style="margin:20px 0 10px; font-size:20px;">Our Products</div>
<div id="load_data"></div>
</div>
<div id="load_data_message"></div>

<?php if(!empty($row_bizData["biz_vision"])){ ?>
<div class="bbox">
<span class="bbox_hd">Our Vision</span>
<div class="bb_text"><?php echo $row_bizData["biz_vision"]; ?></div>
</div>
<?php } ?>
<?php if(!empty($row_bizData["biz_mission"])){ ?>
<div class="bbox">
<span class="bbox_hd">Our Mission</span>
<div class="bb_text"><?php echo $row_bizData["biz_mission"]; ?></div>
</div>
<?php } ?>
<?php if(!empty($row_bizData["biz_expr"])){ ?>
<div class="bbox">
<span class="bbox_hd">Our Experience</span>
<div class="bb_text"><?php echo $row_bizData["biz_expr"]; ?></div>
</div>
<?php } ?>
<?php if(!empty($row_bizData["biz_cvalue"])){ ?>
<div class="bbox">
<span class="bbox_hd">Core Values</span>
<div class="bb_text"><?php echo $row_bizData["biz_cvalue"]; ?></div>
</div>
<?php } ?>
<?php if(!empty($row_bizData["biz_event"])){ ?>
<div class="bbox">
<span class="bbox_hd">Events</span>
<div class="bb_text"><?php echo $row_bizData["biz_event"]; ?></div>
</div>
<?php } ?>

<!-- IMAGES/VIDEOS -->
		<?php 
		$imgspath = $root_dir."businesses/".$row_bizData["biz_title"];
		if(is_dir( $imgspath )){ ?>
		
<div class="bz-hd" style="margin:40px 0 10px; font-size:20px;">Our Portfolio</div>
<div class="images" style="text-align:left; border-radius:20px; margin:10px 0;">
		
		<?php 
		$files = scandir($imgspath);
		$total = count($files);
		$images = array();
		for($x = 0; $x < $total; $x++){
		if ($files[$x] != '.' && $files[$x] != '..') {
		//$images[] = $files[$x]; ?>
   		<div id="portimg_biz_<?php echo $x; ?>" class="MediaBox">
		
		<?php 
		$file_exp = explode('.', $files[$x]);
        $file_ext = end($file_exp);
		if($file_ext == "mp4"){ ?>
		<div style="border:4px solid rgba(0,153,0,0.1); display:inline-block; padding:15px; text-align:center; width:100%; max-height:300px; overflow:hidden;"><video src="<?php echo $row_bizData["biz_title"]."/".$files[$x]; ?>" type="video/mp4" width="100%" controls>
		</video></div>
		<?php } else { ?>
		<div style="border:4px solid rgba(0,153,0,0.1); margin:auto; display:inline-block; padding:15px; width:100%; max-height:300px; overflow:hidden;"><img class='img' src='<?php echo $row_bizData["biz_title"]."/".$files[$x]; ?>' width='100%' /></div>
		<?php } ?>
		 
		</div>
		<?php }}?>
</div>
		<?php }?>

<!-- IMAGES/VIDEOS -->
</div>

</div>
</div>
</div><!-- Mainbody end DIV -->

<?php require '../inc/footer.php'; ?>
<script>
document.getElementById("about").style.display = "block";

function starRate(a){
var i;
for (i = 1; i <= 5; i++){
document.getElementById(i+"star").className = "fa fa-star-o";
}
for (i = 1; i <= a; i++){
document.getElementById(i+"star").className = "fa fa-star";
document.getElementById("star_rating").value = i;
}}

function showTabContent(evt, tabName) {
  var i, inner_tab_main, in_tab;
  inner_tab_main = document.getElementsByClassName("inner_tab_main");
  for (i = 0; i < inner_tab_main.length; i++) {
    inner_tab_main[i].style.display = "none";
  }
  in_tab = document.getElementsByClassName("in_tab");
  for (i = 0; i < in_tab.length; i++) {
    in_tab[i].className = in_tab[i].className.replace(" in_tab_active_bg", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " in_tab_active_bg";
}

function formShow(a,b,c,d){
		document.getElementById(a+"_form"+d).style.display = "block";
		document.getElementById(a+"_btn"+d).innerHTML = "<span onclick='formClose(&quot;"+a+"&quot;,&quot;"+b+"&quot;,&quot;"+c+"&quot;,&quot;"+d+"&quot;)'>"+b+"</span>";
}
function formClose(a,b,c,d){
		document.getElementById(a+"_form"+d).style.display = "none";
		document.getElementById(a+"_btn"+d).innerHTML = "<span onclick='formShow(&quot;"+a+"&quot;,&quot;"+b+"&quot;,&quot;"+c+"&quot;,&quot;"+d+"&quot;)'>"+c+"</span>";
}
</script>
<script src="../inc/scroll2load_probiz.js"></script>
</body>
</html>