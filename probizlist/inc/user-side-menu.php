<div class="col-menu">
<?php if ($_SESSION['USERGROUP'] == "admin" || $_SESSION['USERGROUP'] == "admin_listing") {?>
<div class="menu-box">
    <a href="<?php echo $site_domain ?>admin-dashboard.php"><img src="images/probiz-logo-fff.svg" height="15px"> Admin Dashboard</a>
</div>
<?php } ?>
<div class="menu-box">
    <a href="<?php echo $site_domain ?>dashboard.php"><i class="fa fa-cogs" aria-hidden="true"></i> Profile Settings</a>
    <a href="<?php echo $site_domain ?>myads.php"><i class="fa fa-adn" aria-hidden="true"></i> Posted Ads</a>
    <a href="<?php echo $site_domain ?>mynotice.php"><i class="fas fa-envelope"></i> Notifications</a>
    <a href="<?php echo $site_domain ?>post-ad.php"><i class="fas fa-edit"></i> Post New Ad Here</a>
	<a href="<?php echo $site_domain ?>logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>
</div>