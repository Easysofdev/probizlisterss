<?php require_once('db_conn.php'); ?>
<?php if(!isset($_SESSION['USERNAME'])){ ?>
<div id="offer-box" class="row alert-box-container">
<div class="offer-box">
<div class="offer-box-title">Session has ended!<br />Please <a style='color:green' href='index.php?access=denied'>Re-Login</a></div>
<span class="pop-closer"  onclick="show_modal('none','offer')">[ X ]</span>
</div>
</div>
<?php } ?><?php 

if(isset($_REQUEST["path"]) && !empty($_REQUEST["path"])){ 
	$filePath = $_REQUEST["path"];

	if(file_exists("../".$filePath)){
		unlink("../".$filePath);
		clearstatcache();
	}
}
?>

