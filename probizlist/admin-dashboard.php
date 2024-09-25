<?php require_once('inc/db_conn.php'); ?>
<?php require_once('inc/authorized_admin.php'); ?>

<?php
	$username = $_SESSION["USERNAME"];
    $sql_user = "SELECT * FROM users WHERE username='".$username."'";
	$user = $conn->query($sql_user);
	$row_user = $user->fetch_assoc();
	$user_cat = $row_user["user_cat"];
	
	if($user_cat == "admin_listing"){
		$sql_biz = "SELECT COUNT(bizlist.id_biz) AS Totalbiz FROM bizlist INNER JOIN users ON bizlist.id_user = users.id_user WHERE users.ref_by = '$username'";
	} else{
		$sql_biz = "SELECT COUNT(bizlist.id_biz) AS Totalbiz FROM bizlist";
	}
	$biz = $conn->query($sql_biz);
	$row_biz  = $biz ->fetch_assoc();
	
	if($user_cat == "admin_listing"){
		$sql_pro = "SELECT COUNT(id_pro) AS Totalpro FROM prolist INNER JOIN users ON prolist.id_user = users.id_user WHERE users.ref_by = '$username'";
	} else{
		$sql_pro = "SELECT COUNT(id_pro) AS Totalpro FROM prolist";
	}
	$pro = $conn->query($sql_pro);
	$row_pro  = $pro ->fetch_assoc();

	if($user_cat == "admin_listing"){
		$sql_users = "SELECT COUNT(id_user) AS Totalusers FROM users WHERE user_cat <> 'admin' AND users.ref_by = '$username'";
	} else{
		$sql_users = "SELECT COUNT(id_user) AS Totalusers FROM users WHERE user_cat <> 'admin'";
	}
	$users = $conn->query($sql_users);
	$row_users  = $users ->fetch_assoc();

	if($user_cat == "admin_listing"){
		$sql_ads = "SELECT COUNT(id_ad) AS Totalads FROM adverts INNER JOIN users ON adverts.id_user = users.id_user WHERE users.ref_by = '$username'";
	} else{
		$sql_ads = "SELECT COUNT(id_ad) AS Totalads FROM adverts";
	}
	$ads = $conn->query($sql_ads);
	$row_ads  = $ads ->fetch_assoc();	
?>

<?php require 'inc/top-header-home.php'; ?>
<script>
function alartMe(p,m,id) {
  if (id == "") {
	document.getElementById("alert_container").innerHTML = "";
	return false;
  } else {
  	if (p == "admin"){
  	var e = document.getElementById("action_"+id);
	var msg = e.options[e.selectedIndex].value;	
	} else {var msg = m;}
	
	if(msg != ""){
		
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		  if (this.readyState == 4 && this.status == 200) {
			document.getElementById("alert_container").innerHTML = this.responseText;
		  }
		};
		xmlhttp.open("POST","inc/alert_ajax.php?origin="+p+"&msg="+msg+"&id="+id,true);
		xmlhttp.send();
	} else {
	document.getElementById("alert_container").innerHTML = "";
	return false;
	}
  }
}

function processLive(str,token) {
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    var xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    var xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("pd_search").innerHTML=xmlhttp.responseText;
	}  
  };
  xmlhttp.open("POST","inc/admin_ajax.php?token="+token+"&q="+str,true);
  xmlhttp.send();
}

function showArea(str,id) {
  if (str == "") {
    document.getElementById("showArea").innerHTML = "";
    return false;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
	  if (xmlhttp.readyState == 1){
		document.getElementById("showArea").innerHTML = "<br /><img src='images/progress-bar.gif' style='width:95%; max-width:350px; border-radius:10px;' />";
	  }
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("showArea").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("POST","inc/admin_ajax.php?str="+str+"&id="+id,true);
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
<?php require 'inc/user-admin-side-menu.php'; ?>
<div class="msg-box row" style="background-color:rgba(0,153,0,0.1); padding:0;">
<div class="ad-msg-box-title" style="background-color:rgba(0,153,0,0.4); border-radius:10px 10px 0 0; color:#fff;"><h3><span style="text-transform:capitalize; padding:0 0 0 12px;"><img src="images/probiz-logo-fff.svg" height="20px"> Admin Dashboard</span></h3></div>

<div style="padding:10px;">
<div class="profile-btn">
<button class="call-seller-btn" onclick="showArea('users','none')"><i class="fa fa-user"></i> ProbizList Users Records</button>
<button class="call-seller-btn" onclick="showArea('bizlist','none')"><i class="fa fa-user"></i> Registered Businesses</button>

<?php if($_SESSION['USERGROUP'] == 'admin'){ ?>
<button class="call-seller-btn" onclick="showArea('admin','none')"><i class="fa fa-key"></i> Admin Users Records</button>
<?php } ?>

<a href="admin-dashboard.php?status=signup&p=<?php echo $_SERVER['PHP_SELF']; ?>"><button class="call-seller-btn"><i class="fa fa-user"></i> New User Registration</button></a>
<a href="admin-dashboard.php?status=addlocation&p=<?php echo $_SERVER['PHP_SELF']; ?>"><button class="call-seller-btn"><i class="fa fa-pencil"></i> Add/Edit Location</button></a>
</div>

<div id="showArea"></div>
<div id="alert_container"></div>

<div class="row" style="text-align:center;">
<div class="admin-item" style="width:200px; height:200px; border-radius:100px; margin:20px; padding:80px 10px; font-size:25px; font-weight:bold; line-height:0.7em;"><?php echo $row_ads["Totalads"];?><br /><br /><span style="font-size:20px;">Adverts</span></div>
<div class="admin-item" style="width:200px; height:200px; border-radius:100px; margin:20px; padding:80px 10px; font-size:25px; font-weight:bold; line-height:0.7em;"><?php echo $row_users["Totalusers"];?><br /><br /><span style="font-size:20px;">Users</span></div>
<div class="admin-item" style="width:200px; height:200px; border-radius:100px; margin:20px; padding:80px 10px; font-size:25px; font-weight:bold; line-height:0.7em;"><?php echo $row_pro["Totalpro"];?><br /><br /><span style="font-size:20px;">Professionals</span></div>
<div class="admin-item" style="width:200px; height:200px; border-radius:100px; margin:20px; padding:80px 10px; font-size:25px; font-weight:bold; line-height:0.7em;"><?php echo $row_biz["Totalbiz"];?><br /><br /><span style="font-size:20px;">Businesses</span></div>
</div>
</div>
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
function showForm(a){
document.getElementById(a).style.display = "block";
}
</script>
</body>
</html>