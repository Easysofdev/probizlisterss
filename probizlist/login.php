<?php require_once('inc/db_conn.php'); ?>
<?php
if (isset($_POST['username'])) {
	$username = $_POST["username"];
	$password = $_POST["password"];
	$sql_user = "SELECT username, password, user_cat, user_status FROM users WHERE username='".$username."'";
	$user = $conn->query($sql_user);
	$row_user = $user->fetch_assoc();

	if ($user->num_rows > 0 && password_verify($password, $row_user['password'])) {
	   if($row_user['user_status'] == "Active"){
		  $_SESSION["USERNAME"] = $row_user["username"];
		  $_SESSION["USERGROUP"] = $row_user["user_cat"];
		  if(isset($_POST['origin_page']) && $_POST['origin_page']!= ""){
		  	header("Location: ".$_POST['origin_page']);
			}
		  else { header("Location: dashboard.php");}
		  
		} else {
		
		  if(isset($_POST['origin_page']) && $_POST['origin_page']!= ""){
		  	header("Location: ".$_POST['origin_page']."&status=Your email has not been verified. Please use the link that has been sent to your email!");
			}
		  else {header("Location:".$site_domain."index.php?status=Your email has not been verified. Please use the link that has been sent to your email!");}
				}
   }else {
		
		  if(isset($_POST['origin_page']) && $_POST['origin_page']!= ""){
		  	header("Location: ".$_POST['origin_page']."&access=denied");
			}
		  else {header("Location:".$site_domain."index.php?access=denied");}
		 }
}
?>