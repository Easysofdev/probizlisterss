<?php require_once('inc/db_conn.php'); ?>
<?php require_once('inc/authorizedusers.php'); ?>
<?php
	$username = $_SESSION["USERNAME"];
  $sql_user = "SELECT * FROM users WHERE username='".$username."'";
	$user = $conn->query($sql_user);
	$row_user = $user->fetch_assoc();
	
	$sql_proStatus = "SELECT pro_sub_status, pro_start, pro_end FROM prolist WHERE id_user=".$row_user['id_user'];
	$proStatus = $conn->query($sql_proStatus);
	$row_proStatus = $proStatus->fetch_assoc();

    $sql_bizStatus = "SELECT biz_sub_status, verify_status, biz_start, biz_end FROM bizlist WHERE id_user=".$row_user['id_user'];
	$bizStatus = $conn->query($sql_bizStatus);
	$row_bizStatus = $bizStatus->fetch_assoc(); 
?>	

<?php require 'inc/top-header-home.php'; ?>

<script>
function showDataPro(str) {
  var dstr = str.split("_");
  	  str = dstr[0];
	  var a = dstr[1];
	  var p_aid = dstr[2];
  if (str == "") {
    document.getElementById("proSub"+a).innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {
        document.getElementById("proSub"+a).innerHTML = this.responseText;
      }
    };
if(p_aid == ""){ xmlhttp.open("GET","inc/ajax_processor.php?q="+str+"&a="+a+"&origin=postdata",true);
    xmlhttp.send();}
	
else { xmlhttp.open("GET","inc/ajax_processor.php?q="+str+"&a="+a+"&t=prolist&aid="+p_aid+"&origin=editdata",true);
    xmlhttp.send();}
  }
}

function showDataBiz(str) {
  var dstr = str.split("_");
  	  str = dstr[0];
	  var a = dstr[1];
	  var aid = dstr[2];
  if (str == "") {
    document.getElementById("bizSub"+a).innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {
        document.getElementById("bizSub"+a).innerHTML = this.responseText;
      }
    };
if(aid == ""){ xmlhttp.open("GET","inc/ajax_processor.php?q="+str+"&a="+a+"&origin=postdata",true);
    xmlhttp.send();}
	
else { xmlhttp.open("GET","inc/ajax_processor.php?q="+str+"&a="+a+"&t=bizlist&aid="+aid+"&origin=editdata",true);
    xmlhttp.send();}
  }
}

function showData(str) {
  var dstr = str.split("_");
  	  str = dstr[0];
	  var a = dstr[1];
	  var aid = dstr[2];
  if (str == "") {
    document.getElementById("sub"+a).innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {
        document.getElementById("sub"+a).innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","inc/ajax_processor.php?q="+str+"&a="+a+"&t=users&aid="+aid+"&origin=editdata",true);
    xmlhttp.send();
  }
}
function showMe(str,id) {
  if (str == "" || id == "") {
        document.getElementById("main_container").innerHTML = "";
		return false;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
	  if (xmlhttp.readyState == 1){
		document.getElementById("main_container").innerHTML = "<br /><img src='images/progress-bar.gif' style='width:95%; max-width:350px; border-radius:10px;' />";
	  }
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("main_container").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("POST","inc/ajax_processor.php?sect="+str+"&id="+id,true);
    xmlhttp.send();
  }
}
/*function showMe(str,txt,id) {
  if (txt == "Close Media Directory") {
    document.getElementById("mediaBtn").innerHTML = "<button class='call-seller-btn' onclick='showMe(&quot;My Media Directory&quot;,&quot;Open Media Directory&quot;,&quot;"+id+"&quot;)'><i class='fa fa-file-video-o'></i> Open Media Directory</button>";
        document.getElementById("main_container").innerHTML = "";
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
	  	document.getElementById("mediaBtn").innerHTML = "<button class='call-seller-btn' onclick='showMe(&quot;My Media Directory&quot;,&quot;Close Media Directory&quot;,&quot;"+id+"&quot;)'><span style='color:red;'><i class='fa fa-file-video-o'></i> Close Media Directory</span></button>";
        document.getElementById("main_container").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","inc/ajax_processor.php?q="+str+"&origin=media&id="+id,true);
    xmlhttp.send();
  }
}*/

function alartMe(p,m,id) {
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
		xmlhttp.open("POST","inc/alert_ajax.php?origin="+p+"&msg="+m+"&id="+id,true);
		xmlhttp.send();
  }
}

function delImg(p,x) {
  if (p == "") {
	return false;
  } else {
	
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		  if (this.readyState == 4 && this.status == 200) {
			document.getElementById("portimg_biz_"+x).innerHTML = this.responseText;
		  }
		};
		xmlhttp.open("POST","inc/del_ajax.php?path="+p,true);
		xmlhttp.send();
  }
}
</script>
<script>
function getfocus(a) {
  document.getElementById(a).focus();
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
<div class="msg-box row" style="background-color:rgba(0,153,0,0.1); padding:0;">
<div class="ad-msg-box-title" style="background-color:rgba(0,153,0,0.4); border-radius:10px 10px 0 0;"><h3><span style="text-transform:capitalize; padding:0 0 0 12px;"><i class="fa fa-th-large"></i> <?php echo $row_user["username"];?> Dashboard</span></h3></div>
<div style="padding:10px;">
<div class="row">
<div class="profile-btn">
<button class="call-seller-btn" onclick="showMe('personal',<?php echo $row_user["id_user"]; ?>)"><i class="fa fa-user"></i> Update Personal Info</button>
<button class="call-seller-btn" onclick="showMe('password',<?php echo $row_user["id_user"]; ?>)"><i class="fa fa-key"></i> Update Password</button>
<!--<button class="call-seller-btn" onclick="showMe('pro',<?php //echo $row_user["id_user"]; ?>)"><i class="fa fa-briefcase"></i> Edit Professional Profile</button> -->
<button class="call-seller-btn" onclick="showMe('biz',<?php echo $row_user["id_user"]; ?>)"><i class="fa fa-building"></i> Edit Business Profile</button>
<button class="call-seller-btn" onclick="showMe('media',<?php echo $row_user["id_user"]; ?>)"><i class="fa fa-file-video-o"></i> Open Media Directory</button>
</div>

</div>
</div>
</div>

<div id="main_container"></div>
<div id="alert_container"></div>

<div class="row">
<div class="msg-box">
<div class="ad-desc">
<div style="position:relative; margin:auto; border-radius:70px; height:110px; width:110px;">
<img src="images/users/<?php echo $row_user["user_pic"]; ?>" height="100px" width="100px" style="border-radius:70px;" />
</div>
<table class="t-size">
<tr><th colspan="2">PERSONAL INFO</th></tr>
<tr><td>FULL NAME:</td><td><?php echo $row_user["full_name"]; ?></td></tr>
<tr><td>E-MAIL:</td><td><?php echo $row_user["email"]; ?></td></tr>
<tr><td>PHONE:</td><td><?php echo $row_user["phone"]; ?></td></tr>
<tr><td>CITY/STATE:</td><td><?php echo $row_user["user_city"]; ?>, <?php echo $row_user["user_state"]; ?></td></tr>
<tr><th>BUSINESS VERIFICATION</th><th>
<?php if($row_bizStatus['verify_status'] == "1") { ?>
VERIFIED
<?php } else { ?>
UN-VERIFIED
<?php } ?>
</th></tr>
<!-- <?php
// $dateNow = date_create(date("Y-m-d")); 
// $date1=date_create($row_proStatus['pro_start']);
// $date2=date_create($row_proStatus['pro_end']);
// $diff=date_diff($dateNow,$date2);
// if  ($diff->format("%R%a") >= 0){
?>
<tr><td><strong><span style="color:green; display:inline;">Active</span> - Professional Profile</strong></td><td>End Date: <?php //echo $row_proStatus['pro_end']; ?></td></tr>
<?php //} else { ?>
<tr><td><strong><span style="color:red; display:inline;">Inactive</span> - Professional Profile</strong></td><td><a href="subscriptions.php?sub=biz&id=<?php //echo $row_user["id_user"]; ?>#pro"><button class="sub_btn" style="cursor:pointer;">Subscribe</button></a></td></tr>
<?php //} ?>
<?php 
// $dateNow = date_create(date("Y-m-d"));
// $date1=date_create($row_bizStatus['biz_start']);
// $date2=date_create($row_bizStatus['biz_end']);
// $diff=date_diff($dateNow,$date2);
// if  ($diff->format("%R%a") >= 0){
?>
<tr><td><strong><span style="color:green; display:inline;">Active</span> - Business Profile</strong></td><td>End Date: <?php //echo $row_bizStatus['biz_end']; ?></td></tr>
<?php //} else { ?>
<tr><td><strong><span style="color:red; display:inline;">Inactive</span> - Business Profile</strong></td><td><a href="subscriptions.php?sub=biz&id=<?php //echo $row_user["id_user"]; ?>#biz"><button class="sub_btn" style="cursor:pointer;">Subscribe</button></a></td></tr>
<?php //} ?> -->

</table>
</div>
</div>
</div>


</div>
<div class="row">
<div class="msg-box">
<div class="ad-desc">

<h3>Welcome to PROBIZLIST</h3><br>

<h3>To Update Your Business Details<br>Go to: Edit Business Profile</h3><br>
1. Click on Portfolio Media to post pictures and video about your brand<br>
2. Fill your business details, name, address, email, phone number, website if any, business description, list your services and separate with comma, and fill the rest available field.<br>
3. Take note of SEARCH KEYWORDS FIELD and give the site the chance to navigate and find your business by typing all necessary keywords to search your business e.g name, address, town or city, state, nearest bus stop, street, business category, services, list of services and all keywords you want people to search and get to see you online.<br>

<p>
<strong>To update your profile picture, business profile image, desktop and mobile banner<br>Go to: Open Media Directory</strong>
</p>

<div style="color: rgba(0,153,0,1);">
<p>
<h3>PAY AND VERIFY YOUR BUSINESS - COMPULSORY</h3> <br><em>(With annual verification fees of N3,000 only)</em> <br>
To verify your business as an active business people should patronize, business who fail to verify will be removed from the website, as to make make sure all listed business are active businesses. <br>
<div id="sd"></div>
<button class="offer-btn" style="width:50%; padding:8px; margin:20px 0; font-size:20px;" id="pay">Get Your Business Verified Now!</button>
</p>
</div>
<strong>PROBIZLIST</strong> - <em>Your trusted business website and directory you can trust.</em>

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

<script src="https://js.paystack.co/v1/inline.js"></script> 
    
<script>
  var paymentBtn = document.getElementById('pay');
  paymentBtn.addEventListener('click', payWithPaystack, false);
  function payWithPaystack() {
    var handler = PaystackPop.setup({
      key: 'pk_test_f871b42ea292691654874e76cec2cc4a30161d51', // Replace with your public key
      email: '<?php echo $row_user["email"]; ?>',
      amount: 5000 * 100, // the amount value is multiplied by 100 to convert to the lowest currency unit
      currency: 'NGN', // Use GHS for Ghana Cedis or USD for US Dollars
      ref: '<?php echo strtoupper(uniqid("bv_")); ?>', // Replace with a reference you generated
      callback: function(response) {
        //this happens after the payment is completed successfully
        var reference = response.reference;
        var username = '<?php echo $_SESSION["USERNAME"]; ?>';
        var business = '';

        $( "#sd" ).html("<br><span style='color:rgb(153,0,0);'><h3>Business verification payment was successful!</h3></span>");
        //alert('Payment complete! Reference: ' + reference);
        // Make an AJAX call to your server with the reference to verify the transaction

        // $( "#buydata_canc" ).attr("onClick", "");
        // $( "#buydata_cont" ).html("Processing...");
        // $( "#buydata_cont" ).attr("onClick", "");
        var url = "inc/payment_notification.php";
        var posting = $.post(url, {pay_ref:reference, email:email, amount:amount, username:username, business:business});
            posting.done(function(response){
                //$("#buydata").attr("onClick", "dashServe('vtu_portal.php', 'VTU Portal')");
                if(response == 200){
                    window.location = "logout.php";
                }else{
                  window.location = "http://localhost/probizlist/dashboard.php?msg=Success!";
                    //$( "#buydata_box" ).html(response);
                }
            });   


      },
      onClose: function() {
        alert('Transaction was not completed, window closed.');
      },
    });
    handler.openIframe();
  }        
</script>

<script>
//Form Submission Script
function biz_portImgForm(){
bizportImgForm.submit();
}
function User_Pic(){
UserPic.submit();
}
function pro_logoPic(){
prologoPic.submit();
}
function pro_deskPic(){
prodeskPic.submit();
}
function pro_mobPic(){
promobPic.submit();
}

function biz_logoPic(){
bizlogoPic.submit();
}
function biz_deskPic(){
bizdeskPic.submit();
}
function biz_mobPic(){
bizmobPic.submit();
}

//Image Upload Script
function triggerClick(e) {
  document.querySelector('#profileImage').click();
}
function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}

//Professional Images
function triggerClick_logo(e) {
  document.querySelector('#prologoImage').click();
}
function displayImage_logo(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#prologoDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}

function triggerClick_desk(e) {
  document.querySelector('#prodeskImage').click();
}
function displayImage_desk(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#prodeskDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}

function triggerClick_mob(e) {
  document.querySelector('#promobImage').click();
}
function displayImage_mob(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#promobDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}

//Business Images
function triggerClick_logo_biz(e) {
  document.querySelector('#bizlogoImage').click();
}
function displayImage_logo_biz(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#bizlogoDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}

function triggerClick_desk_biz(e) {
  document.querySelector('#bizdeskImage').click();
}
function displayImage_desk_biz(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#bizdeskDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}

function triggerClick_mob_biz(e) {
  document.querySelector('#bizmobImage').click();
}
function displayImage_mob_biz(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#bizmobDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}
//getfocus("user_state");

/*function formShow(a){
	var personal = document.getElementById("personal");
	var password = document.getElementById("password");
	var pro = document.getElementById("pro");
	var biz = document.getElementById("biz");
	if (a == "personal"){
		personal.style.display = "block";
		pro.style.display = "none";
		password.style.display = "none";
		biz.style.display = "none";
	}
	if (a == "password"){
		personal.style.display = "none";
		pro.style.display = "none";
		password.style.display = "block";
		biz.style.display = "none";
	}
	if (a == "pro"){
		personal.style.display = "none";
		pro.style.display = "block";
		password.style.display = "none";
		biz.style.display = "none";
	}
	if (a == "biz"){
		personal.style.display = "none";
		pro.style.display = "none";
		password.style.display = "none";
		biz.style.display = "block";
	}
}*/


function showImageb(){
  var showImage = document.getElementById('showImage');
  showImage.innerHTML = "";
}

function showImage() {
  var ad_img_label = $('.ad_img_label');
  var images = $('.images');
  var total_img= document.querySelector('[type=file]').files.length;
  for(var i=0;i<total_img;i++) {
  
  var newfile = URL.createObjectURL(event.target.files[i]);

    $('#showImage').append("<img class='img' src='"+newfile+"' height='60px' width='60px' alt='&nbsp;VIDEO' />");
	//$('#showImage').append("<span>"+newfile+"</span>");
  }
}

</script>

<script>
  function showData(str) {
    // var dstr = str.split("_");
    // str = dstr[0];
    // var a = dstr[1];
    if (str.length < 3) {
      document.getElementById("i_category").innerHTML = "";
      return false;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("i_category").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "inc/ajax_processor.php?q=" + str + "&a=CAT&origin=postdata&c=biz", true);
      xmlhttp.send();
    }
  }

  function makeCat(catName) {
    document.getElementById("biz_cat").value=catName;
    document.getElementById("i_category").innerHTML = "";
  }
  </script>
</body>
</html>