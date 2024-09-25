<?php require_once('inc/db_conn.php'); ?>
<?php
function prep_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = str_replace("'", "\'", $data);
  return $data;
}

if(isset($_GET['em']) && !empty($_GET['em']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    // Verify data
    $email = prep_input($_GET['em']); // Set email variable
    $hash = prep_input($_GET['hash']); // Set hash variable
	
	$sql_search = "SELECT email, hash, user_status FROM users WHERE email='".$email."' AND hash='".$hash."' AND user_status='New'";
    $search = $conn->query($sql_search);
	$row_search = $search->fetch_assoc();
                 
    if($search > 0){
        // We have a match, activate the account
    $sql_statusUpdate = "UPDATE users SET user_status='Active' WHERE email='".$email."' AND hash='".$hash."' AND user_status='New'";
		if ($conn->query($sql_statusUpdate) === TRUE) {
			header("Location: index.php?status=Your account has been activated, you can now <a style='color:green' href='index.php?access=denied'>LOGIN!</a>");
			}else{
				 die($conn->error);
				 //header("Location: index.php?status=Something went wrong, contact the Admin!");
		} 
	} else {// No match -> invalid url or account has already been activated.
        header("Location: index.php?status=The url is either invalid or you already have activated your account!");
    }           
}else{
    // Invalid approach
   header("Location: index.php?status=Invalid approach, please use the link that has been sent to your email.");
}

//http://localhost/probizlist/verify.php?email=sayidris@gmail.com&hash=8e296a067a37563370ded05f5a3bf3ec
?>