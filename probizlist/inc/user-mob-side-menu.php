<div class="msg-box mob-user-menu">
<div class="user-menu-icon-box">
<span class="user-menu-icon"><a href="<?php echo $site_domain ?>dashboard.php"><i class="fa fa-cogs" aria-hidden="true"></i><br /><span style="font-size:2vw;">Profile</span></a></span>
<span class="user-menu-icon"><a href="<?php echo $site_domain ?>myads.php"><i class="fa fa-adn" aria-hidden="true"></i><br /><span style="font-size:2vw;">My Ads</span></a></span>
<span class="user-menu-icon"><a href="<?php echo $site_domain ?>mynotice.php"><i class="fas fa-envelope"></i><br /><span style="font-size:2vw;">Message</span></a></span>
<span class="user-menu-icon"><a href="<?php echo $site_domain ?>post-ad.php"><i class="fas fa-edit"></i><br /><span style="font-size:2vw;">New Ad</span></a></span>
<span class="user-menu-icon no-border"><a href="<?php echo $site_domain ?>logout.php"><i class="fas fa-sign-out-alt"></i><br /><span style="font-size:2vw;">Logout</span></a></span>
</div>
</div>
<?php if ($_SESSION['USERGROUP'] == "admin" || $_SESSION['USERGROUP'] == "admin_listing") {?>
<div class="msg-box mob-user-menu" style="background-color:rgba(0,153,0,0.7); text-align:center;">
<a href="<?php echo $site_domain ?>admin-dashboard.php" style="font-size:16px; color:#fff;"><img src="images/probiz-logo-fff.svg" height="20px"> Admin Dashboard</a>
</div>
<?php } ?>