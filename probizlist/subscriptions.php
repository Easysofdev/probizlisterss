<?php require_once('inc/db_conn.php'); ?>
<?php require_once('inc/authorizedusers.php'); ?>

<?php
	$username = $_SESSION["USERNAME"];
    $sql_user = "SELECT id_user, email FROM users WHERE username='".$username."'";
	$user = $conn->query($sql_user);
	$row_user = $user->fetch_assoc();
	
	$sql_proStatus = "SELECT pro_sub_status, pro_start, pro_end FROM prolist WHERE id_user=".$row_user['id_user'];
	$proStatus = $conn->query($sql_proStatus);
	$row_proStatus = $proStatus->fetch_assoc();

    $sql_bizStatus = "SELECT biz_sub_status, biz_start, biz_end FROM bizlist WHERE id_user=".$row_user['id_user'];
	$bizStatus = $conn->query($sql_bizStatus);
	$row_bizStatus = $bizStatus->fetch_assoc(); 
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
<div id="biz"></div><div id="pro"></div>
<div class="main-body">
<div class="navbar">
  <a href="<?php echo $site_domain ?>businesses"><i class="fa fa-fw fa-briefcase"></i> Biz-List</a> 
  <a href="<?php echo $site_domain ?>index.php"><i class="fa fa-adn"></i> Ads</a> 
  <!-- <a href="<?php echo $site_domain ?>professionals"><i class="fa fa-fw fa-building"></i> Pro-List</a> -->
 <!-- <a href="user-status.php"><i class="fa fa-fw fa-user"></i> Status</a> -->
</div>

<div id="Ads" class="tabcontent" style="text-align:center;">
<div style="margin:auto;">
<div class="sub_hd">
Create Your Business/Professional Listing
<br /><span class="sub_txt">
You will find out that your business is growing as a direct result of your relationship with ProbizList.com. We offer an integrated approach to online marketing for businesses in Nigeria. The website allows visitors to review and recommend businesses and products that they have used.
</span>
</div>

<div class="msg-box row sub_box">
<div class="ad-msg-box-title" style="background-color:rgba(0,153,0,0.3); border-radius:10px 10px 0 0;"><h3><span style="text-transform:capitalize; padding:0 0 0 12px;"><i class="fa fa-building"></i> BUSINESS  LISTING</span></h3></div>
<div style="padding:10px;">
<div class="row">
<div style="font-size:30px; color:#000;"><del>N10,000</del><br />5,000 <span style="font-size:20px; color:#000;">NGN per year<hr style="width:80%;" />
<ul style="text-align:left; font-size:16px; color:#666; line-height:2.5em; list-style-type:none;">
<li><i class="fa fa-check-square"></i> Highlighted listing</li>
<li><i class="fa fa-check-square"></i> Top listing placement on:
	<ul style="list-style-type:none;">
		<li><i class="fa fa-check"></i> Search results</li>
		<li><i class="fa fa-check"></i> Selected categories</li>
		<li><i class="fa fa-check"></i> Added keywords</li>
	</ul>
</li>
<li><i class="fa fa-check-square"></i> Dedicated Business Page</li>
<li><i class="fa fa-check-square"></i> Unlimited Products</li>
<li><i class="fa fa-check-square"></i> Unlimited Photos</li>
<li><i class="fa fa-check-square"></i> Unlimited Keywords</li>
<li><i class="fa fa-check-square"></i> Categories Search Visibiity</li>
<li><i class="fa fa-check-square"></i> Unlimited Jobs</li>
<li><i class="fa fa-check-square"></i> Verify Badge</li>
<li><i class="fa fa-check-square"></i> Customers Reviews</li>
<li><i class="fa fa-check-square"></i> Customers Rating</li>
</ul>
<form id="bizsubForm">
<input type="hidden" id="email-address" value="<?php echo $row_user['email']; ?>" />
<input type="hidden" id="id_user" value="<?php echo $row_user['id_user']; ?>" />
<input type="hidden" id="amount" value="3500" />
<input type="hidden" id="sub_type" value="biz" />
<button type="submit" onclick="bizsubWithPaystack()" style="padding:10px; font-size:18px; margin:10px 0 20px; background-color:#CC3300; border-radius:20px; color:#fff; cursor:pointer;">GET LISTED</button>
</form>
</span></div>
</div>
</div>
</div>

<div class="msg-box row sub_box">
<div class="ad-msg-box-title" style="background-color:rgba(0,153,0,0.3); border-radius:10px 10px 0 0;"><h3><span style="text-transform:capitalize; padding:0 0 0 12px;"><i class="fa fa-briefcase"></i> PROFESSIONAL LISTING</span></h3></div>
<div style="padding:10px;">
<div class="row">
<div style="font-size:30px; color:#000;"><del>N10,000</del><br />5,000 <span style="font-size:20px; color:#000;">NGN per year<hr style="width:80%;" />
<ul style="text-align:left; font-size:16px; color:#666; line-height:2.5em; list-style-type:none;">
<li><i class="fa fa-check-square"></i> Highlighted listing</li>
<li><i class="fa fa-check-square"></i> Top listing placement on:
	<ul style="list-style-type:none;">
		<li><i class="fa fa-check"></i> Search results</li>
		<li><i class="fa fa-check"></i> Selected categories</li>
		<li><i class="fa fa-check"></i> Added keywords</li>
	</ul>
</li>
<li><i class="fa fa-check-square"></i> Dedicated Business Page</li>
<li><i class="fa fa-check-square"></i> Unlimited Products</li>
<li><i class="fa fa-check-square"></i> Unlimited Photos</li>
<li><i class="fa fa-check-square"></i> Unlimited Keywords</li>
<li><i class="fa fa-check-square"></i> Categories Search Visibiity</li>
<li><i class="fa fa-check-square"></i> Unlimited Jobs</li>
<li><i class="fa fa-check-square"></i> Verify Badge</li>
<li><i class="fa fa-check-square"></i> Customers Reviews</li>
<li><i class="fa fa-check-square"></i> Customers Rating</li>
</ul>
<form id="prosubForm">
<input type="hidden" id="email-address" value="<?php echo $row_user['email']; ?>" />
<input type="hidden" id="id_user" value="<?php echo $row_user['id_user']; ?>" />
<input type="hidden" id="amount" value="3500" />
<input type="hidden" id="sub_type" value="pro" />
<button type="submit" onclick="prosubWithPaystack()" style="padding:10px; font-size:18px; margin:10px 0 20px; background-color:#CC3300; border-radius:20px; color:#fff; cursor:pointer;">GET LISTED</button>
</form>
</span></div>
</div>
</div>
</div>



</div>
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

<script src="https://js.paystack.co/v1/inline.js"></script> 
<script>
const prosubForm = document.getElementById('prosubForm');
const id_user = document.getElementById("id_user").value;
prosubForm.addEventListener("submit", prosubWithPaystack, false);
function prosubWithPaystack(e) {
  e.preventDefault();
  let handler = PaystackPop.setup({
    key: 'pk_live_0000000000000000000', // Replace with your public key
    email: document.getElementById("email-address").value,
    amount: document.getElementById("amount").value * 100,
    ref: ''+Math.floor((Math.random() * 1000000000) + 1)+'_'+id_user, // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
	  window.location = "<?php echo $site_domain; ?>subscriptions.php?status=transaction Cancelled!";
    },
    callback: function(response){
      let message = 'Payment complete! Reference: ' + response.reference;
      //alert(message);
	  window.location = "<?php echo $site_domain; ?>verify_pro_transaction.php?reference=" + response.reference;
    }
  });
  handler.openIframe();
}

const bizsubForm = document.getElementById('bizsubForm');
bizsubForm.addEventListener("submit", bizsubWithPaystack, false);
function bizsubWithPaystack(e) {
  e.preventDefault();
  let handler = PaystackPop.setup({
    key: 'pk_live_0000000000000000000', // Replace with your public key
    email: document.getElementById("email-address").value,
    amount: document.getElementById("amount").value * 100,
	cart_id: document.getElementById("id_user").value,
    ref: ''+Math.floor((Math.random() * 1000000000) + 1)+'_'+id_user, // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
	  window.location = "<?php echo $site_domain; ?>subscriptions.php?status=transaction Cancelled!";
    },
    callback: function(response){
      let message = 'Payment complete! Reference: ' + response.reference;
      //alert(message);
	  window.location = "<?php echo $site_domain; ?>verify_biz_transaction.php?reference=" + response.reference;
    }
  });
  handler.openIframe();
}
</script>
</body>
</html>