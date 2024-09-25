<?php require_once('db_conn.php'); ?>
<?php require_once('authorizedusers.php'); ?>
<?php
	$username = $_SESSION["USERNAME"];
    $sql_user = "SELECT username, user_cat, id_user FROM users WHERE username='".$username."'";
	$user = $conn->query($sql_user);
	$row_user = $user->fetch_assoc();
?>	
<?php
function prep_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = str_replace("'", "\'", $data);
  return $data;
}

if (isset($_POST['status']) && $_POST['status'] === "visitor_msg"){

$Err = "";
$id_chat = $visitor_msg = $id_ad = $id_sender = $status = $author_name = $sender_name = $ad_title = "";
$id_ad = prep_input($_POST["id_ad"]);
$visitor_msg = prep_input($_POST["visitor_msg"]);

				
				if ($visitor_msg == NULL || $visitor_msg == " ") {
					$Err .= "Message is required!";
					header("Location: ../chat-page.php?aid=".$id_ad."&err=".$Err);
				 } 
						
				if (empty($Err)){
					$id_author = prep_input($_POST["id_author"]);
					$id_sender = prep_input($_POST["id_sender"]);
					$author_name = prep_input($_POST["author_name"]);
					$sender_name = prep_input($_POST["sender_name"]);
					$receiver = prep_input($_POST["receiver"]);
					$ad_title = prep_input($_POST["ad_title"]);
					$id_chat = prep_input($_POST["id_chat"]);
					
					$sql_user_msg = "INSERT INTO user_message (id_chat, id_ad, id_author, id_sender, author_name, sender_name, receiver, ad_title, visitor_msg)
					VALUES ('$id_chat', '$id_ad', '$id_author', '$id_sender', '$author_name', '$sender_name', '$receiver', '$ad_title', '$visitor_msg')";
					
					if ($conn->query($sql_user_msg) === TRUE) {
					  header("Location: ../chat-page.php?ia=".$id_ad."&is=".$id_sender."&chat=".$id_chat);
					} else {
					  die($conn->error);
					  //header("Location: ../adpage.php?aid=".$id_ad."&err=".$Err);
					}
				} 
	}
?>






<?php $conn->close(); ?>