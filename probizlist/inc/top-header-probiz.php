<!DOCTYPE html>
<html lang="en">
<head>
<!-- Chrome, Firefox OS and Opera -->
<meta name="theme-color" content="#009900">
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#009900">
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-status-bar-style" content="#009900">
<link rel="icon" href="../images/favicon.ico" type="image/x-icon">
<title>ProBiz List</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<script src="../inc/jquery.js"></script>
<script src="../inc/fontawesome.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../inc/style.css">
<meta charset="UTF-8">
<meta name="description" content="ProBizList is a business and professional listing and classified ads website to make it easy for
people to project themselves and get whatever things they want easily anywhere. We are ready to let your business and profession look professional online.">
<meta name="keywords" content="classified ads site in nigeria, buy and sell, professional services, business listing">
<meta name="author" content="REECHO WORLD BIZ">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8997008602380734" crossorigin="anonymous"></script>
</head>
<body>
<!-- header row //-->
<div class="header col">
<div class="row" style="padding:0 20px;"><a href="<?php echo $site_domain ?>"><img src="../images/probiz-logo-fff.svg" height="25px"></a>
<span class="post-ad-btn"><a href="<?php echo $site_domain ?>post-ad.php">Post Ad</a></span>
<span class="mob-menu" onClick="openNav()" style="font-size:20px; float:right;"><i class="fas fa-bars" title="M"></i></span>
<!--<span style="font-size:20px; float:right; cursor:pointer;"><i class="fas fa-search"></i></span>-->
<span style="font-size:20px; float:right; cursor:pointer; padding:0 20px;">
<?php if (isset($_SESSION["USERNAME"]) && $_SESSION["USERNAME"] != NULL){ 
	$username = $_SESSION["USERNAME"];
    $sql_user_pic = "SELECT user_pic FROM users WHERE username='".$username."'";
	$user_pic = $conn->query($sql_user_pic);
	$row_user_pic = $user_pic->fetch_assoc();

?>
<a href="<?php echo $site_domain ?>dashboard.php"><img src="<?php echo $site_domain ?>images/users/<?php echo $row_user_pic['user_pic']; ?>" width="35px" height="35px" style="border-radius:45px;" /></a> <?php } else{ ?> <a onClick="show_modal('block','login')"><i class="fas fa-user" title="dp"></i></a><?php } ?></span>

<!--// Signup Box //-->
<div id="signup-box" class="row login-box-container">
 <div class="login-box">
 		<form method="post" name="signup" id="signup" action="<?php echo htmlspecialchars('../inc/action_page.php');?>">
		<input type="checkbox" id="showMe1" onClick="show_Pass('1')" style="visibility:hidden;" />
        <p>Sign Up <span style="float:right; cursor:pointer;" onClick="show_modal('none','signup')">X</span></p>
		<input type="email" id="email" name="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" placeholder="Email Address*" required>
		<?php if (isset($_GET["signup"]) && $_GET["signup"] == "email-exists"){ ?> <p class="error-msg">Email already used! <?php }?></p>
		<input type="tel" name="phone" placeholder="Phone Number*" required>
        <input type="text" name="username" placeholder="Username*" required>
		<?php if (isset($_GET["signup"]) && $_GET["signup"] == "user-exists"){ ?> <p class="error-msg">Username already taken! <?php }?></p>
		
		<span style="position:relative;">
		<span id="eye1" style="position:absolute; top:20%; right:20px; color:#000;"><label for="showMe1" style="cursor:pointer;"><i class="fa fa-eye"></i></label></span>
        <input type="password" name="password" id="password1" placeholder="Password*" required>
		</span>
		<input type="hidden" name="form_type" value="user_signup" />
		<input type="hidden" name="origin_page" value="<?php if(isset($_GET['p']) && $_GET['p']!= ""){echo $_GET['p'];} ?>" />
        <input type="submit" value="Sign Up">
		<p>Already have an account? <span style="cursor:pointer;" onClick="show_modal('block','login')">Login here!</span></p>
        </form>
 </div>
</div>
<!--// Login Box //-->
<div id="login-box" class="row login-box-container <?php if (isset($_GET["access"]) && $_GET["access"] == "denied"){ ?> login-show <?php }?>">
 <div class="login-box">
 		<form method="post" name="login" id="login" action="<?php echo htmlspecialchars('../login.php');?>">
		<input type="checkbox" id="showMe" onClick="show_Pass('')" style="visibility:hidden;" />
        <p>Login <span style="float:right; cursor:pointer;" onClick="show_modal('none','login')">X</span></p>
        <input type="text" name="username" placeholder="Username" required>
		
		<span style="position:relative;">
		<span id="eye" style="position:absolute; top:20%; right:20px; color:#000;"><label for="showMe" style="cursor:pointer;"><i class="fa fa-eye"></i></label></span>
        <input type="password" name="password" id="password" placeholder="Password" required>
		</span>
		<?php if (isset($_GET["access"]) && $_GET["access"] == "denied"){ ?> <p class="error-msg">Access Denied: Check Username & Password! <?php }?></p>
		<input type="hidden" name="form_type" value="login" />
		<input type="hidden" name="origin_page" value="<?php if(isset($_GET['p']) && $_GET['p']!= ""){echo $_GET['p'];} ?>" />
        <input type="submit" value="Login">
		<p><span style="cursor:pointer;" onClick="show_modal('block','signup')">Sign up</span> <span  onClick="show_modal('block','forgot')" style="float:right; cursor:pointer">Forgot Password?</span></p>
        </form>
 </div>
</div>


<!--// Forgot Pass Box //-->
<div id="forgot-box" class="row login-box-container <?php if (isset($_GET["fpass"]) && $_GET["fpass"] == "yes"){ ?> login-show <?php }?>">
 <div class="login-box">
 <form method="post" name="forgot_pass" id="forgot_pass" action="<?php echo htmlspecialchars('inc/action_page.php');?>">
 <p>Forgot Password Form<span style="float:right; cursor:pointer;" onClick="show_modal('none','forgot')">X</span></p>
 <input type="email" id="fpass_email" name="fpass_email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" placeholder="Email Address*" required>
 <input type="hidden" name="form_type" value="forgot_pass" />
 <input type="submit" value="Submit">
 <p><span style="cursor:pointer;" onClick="show_modal('block','login')">Login here!</span></p>	
 </form>
 </div>
</div>

<!--// Process Result Status Box //-->
<div id="response-box" class="row login-box-container <?php if (isset($_GET["status"]) && $_GET["status"] != ""){ ?> login-show <?php }?>">
 <div class="login-box">
 		
        <p><span style="float:right; cursor:pointer;" onClick="show_modal('none','response')">X</span></p>
        <p style="width:100%; text-align:center; padding:15px; margin-top:50px; background-color:#FFFFFF; color:#000000; border-radius:10px; line-height:2em;">
		<?php echo $_GET["status"]; ?>
		</p>
 </div>
</div>

<!--// Signup Result Status Box //-->
<div id="signup2-box" class="row login-box-container <?php if (isset($_GET["status"]) && $_GET["status"] == "signup"){ ?> login-show <?php }?>">
 <div class="login-box">
 		<form method="post" name="signup" id="signup" action="<?php echo htmlspecialchars('../inc/action_page.php');?>">
		<input type="checkbox" id="showMe2" onClick="show_Pass('2')" style="visibility:hidden;" />
        <p>Sign Up <span style="float:right; cursor:pointer;" onClick="show_modal('none','signup')">X</span></p>
		<?php if (isset($_GET["err"]) && $_GET["err"] != ""){ ?> <p class="error-msg"><?php echo $_GET["err"]; ?> <?php }?></p>
		<input type="email" id="email" name="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" placeholder="Email Address*" required>
		<input type="tel" name="phone" placeholder="Phone Number*" required>
        <input type="text" name="username" placeholder="Username*" required>
		
		<span style="position:relative;">
		<span id="eye2" style="position:absolute; top:20%; right:20px; color:#000;"><label for="showMe2" style="cursor:pointer;"><i class="fa fa-eye"></i></label></span>
		<input type="password" name="password" id="password2" placeholder="Password*" required>
		</span>
		<input type="hidden" name="form_type" value="user_signup" />
		<input type="hidden" name="origin_page" value="<?php if(isset($_GET['p']) && $_GET['p']!= ""){echo $_GET['p'];} ?>" />
        <input type="submit" value="Sign Up">
		<p>Already have an account? <span style="cursor:pointer;" onClick="show_modal('block','login')">Login here!</span></p>
        </form>
 </div>
</div>

</div>

<div id="myNav" class="overlay">
  <a href="javascript:void(0)" class=
  "closebtn"

  onclick="closeNav()">&times;</a>
  <div class="overlay-content">
    <a href="<?php echo $site_domain ?>"><i class="fa fa-home"></i> Probizlist Home</a>
    <a href="<?php echo $site_domain ?>"><i class="fa fa-adn"></i> Classified Adverts</a>
    <!-- <a href="<?php echo $site_domain ?>professionals"><i class="fa fa-briefcase"></i> Verified Professionals</a> -->
    <a href="<?php echo $site_domain ?>businesses"><i class="fa fa-building"></i> Verified Businesses</a>
  </div>
</div>
</div>

<div class="row" id="top_search">
<div class="col top_search_box">
	<form name="searchform" id="searchform" action='<?php echo $site_domain; ?>search_result.php' method='get' onsubmit="return validateForm()">
		<input class="top_search" type="search" name='query' id="search" pattern="[0-9,aA-zZ, ,/-,_]{3,}" value="<?php if (isset($_GET["query"]) && !empty($_GET["query"])){echo $_GET["query"]; } ?>" placeholder="Search here..." autocomplete="on" required />
		<input type='hidden' name='search' value='1'>
		<input type='hidden' name='s' value='1'>
		<button class="top_search_button" type="submit"><i class="fas fa-search" title="Search"></i></button>
	</form>
	<!--			
	<form method="get" action="<?php echo htmlspecialchars('../search.php');?>">
		<div id="search-label">To find anything on ProBizlist</div>
		<input class="top_search" type="text" name="q" placeholder="Search here..">
		<button class="top_search_button" type="submit"><i class="fas fa-search" title="Search"></i></button>
	</form>
	-->
</div>
</div>
<!-- header row end //-->