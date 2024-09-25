<?php require_once('db_conn.php'); ?>

<?php
function prep_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = str_replace("'", "\'", $data);
  return $data;
}
function RemoveSpecialChar($str)
{
    $res = preg_replace('/[0-9\@\&\.\;]+/', '', $str);
    return $res;
}

if (isset($_POST["form_type"])){

$item_imgs = "";

if($_POST["form_type"] === "user_signup"){
				$Err = "";
				//Register new user
				$email = $phone = $username = $password = $full_name = "";
				
				if (empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
					$Err .= "Invalid Email Format |";
				 } else {
				  	$email = prep_input($_POST["email"]);
				 		}
				 
				 $regex = preg_match('/[\'^�$%&* ()}{#~?><>,|=+�]/', $email);
                 if($regex) $Err .= " Special Characters not allowed |";
				 
				 //Check for email existence
						$sql_email = "SELECT email FROM users WHERE email='".$email."'";
						$mail = $conn->query($sql_email);
						$row_mail = $mail->fetch_assoc();
					
						if ($mail->num_rows > 0) {// If email already exists
							  $Err .= " Email Exists! |";
						} 
			
				 if (empty($_POST["phone"])) {
						$Err .= " Phone is required |";
				 } else {
					$phone = prep_input($_POST["phone"]);
				 }
				 
				 $regex = preg_match('/[\'^�$%&* ()}{@#~?><>,|=+�\-_]/', $phone);
                 if($regex) $Err .= " Special Characters not allowed |";
				 
				 if (empty($_POST["username"])) {
						$Err .= " Username is required |";
				 } else {
						$username = prep_input($_POST["username"]);
				 }
				 
				 $regex = preg_match('/[\'^�$%&* ()}{@#~?><>,|=+�\-]/', $username);
                 if($regex) $Err .= " Special Characters not allowed |";
				 
				 //Check for username existence
					$sql_uname = "SELECT username FROM users WHERE username='".$username."'";
					$uname = $conn->query($sql_uname);
					$row_uname = $uname->fetch_assoc();
				
					if ($uname->num_rows > 0) {// If username already exists
						 $Err .= " Username Exists! |";
					} 	
						
				 if (empty($_POST["password"])) {
						$Err .= " Password is required |";
				 } else {
					$pass = prep_input($_POST["password"]);
					$password = password_hash($pass, PASSWORD_DEFAULT);
				 }
				 
				if ($full_name == ""){$full_name = $username;}
				$hash = md5( rand(0,1000) );

				if (isset($_SESSION["USERNAME"]) && !empty($_SESSION["USERNAME"])){
					$ref_by = $_SESSION["USERNAME"];
				} else {
					$ref_by = "";
				}

				$reg_date = date("Y-m-d h:i:s");
				
				if (empty($Err)){ 
					$sql = "INSERT INTO users (email, phone, full_name, username, password, hash, ref_by, reg_date)
					VALUES ('$email', '$phone', '$full_name', '$username', '$password', '$hash', '$ref_by', '$reg_date')";
					
					if ($conn->query($sql) === TRUE) {
					
					$to      = $email; // Send email to our user
					$subject = 'Probizlist Signup | Verification'; // Give the email a subject 
$message = '
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by click the url below.

---------------------------
Username: '.$username.'
Password: '.$pass.'
---------------------------

Please click this link to activate your account:
https://www.probizlist.com/verify.php?em='.$email.'&hash='.$hash.'

Thank you for using ProbizList
	
Admin
ProbizList.com
 
'; // Our message above including the link
										 
					$headers = 'From: ProbizList <noreply@probizlist.com>' . "\r\n"; // Set from headers
					mail($to, $subject, $message, $headers); // Send our email
		  			  if(isset($_POST['origin_page']) && $_POST['origin_page']!= ""){
					  		header("Location: ".$_POST['origin_page']."?status=Successfully Registered.<br />Check your email for validation message. Thanks!");
					  } else {
					 	 	header("Location: ../index.php?status=Successfully Registered.<br />Check your email for validation message. Thanks!");
					  }
					  
					} else {
					  die($conn->error);
					  if(isset($_POST['origin_page']) && $_POST['origin_page']!= ""){
					  		header("Location: ".$_POST['origin_page']."?status=Database Error. Contact The Admin Please!");
							 } else {
					 			 header("Location: ../index.php?status=Database Error. Contact The Admin Please!");
					  		 }
					}
				} else {
						$Err = substr_replace($Err, "", (strlen($Err)-1), strlen($Err));
						if(isset($_POST['origin_page']) && $_POST['origin_page']!= ""){
					  		header("Location: ".$_POST['origin_page']."?status=signup&err=".$Err);
							} else {
						header("Location: ../index.php?status=signup&err=".$Err);
						}
				}	
	}

// Add/Edit Location //
if($_POST["form_type"] === "addlocation"){
$loc_state = $_POST["loc_state"];
$loc_city = $_POST["loc_city"];
$id_loc = $_POST["id_loc"];
if(!empty($id_loc)){
		$sql_upadloc = "UPDATE ad_location SET loc_state = '".$loc_state."', loc_city = '".$loc_city."' WHERE loc_state = '".$loc_state."' AND id_loc = ".$id_loc;
				
				if ($conn->query($sql_upadloc) === TRUE) {
				  header("Location: ".$_POST['origin_page']."?status=Location Updated!");
				}else{
				  header("Location: ".$_POST['origin_page']."?status=adlocation&err=".$conn->error);
				}
}else{
 //Check for state existence
		$sql_state = "SELECT id_loc, loc_state FROM ad_location WHERE loc_state='".$loc_state."'";
		$state = $conn->query($sql_state);
		$row_state = $state->fetch_assoc();
				
				if ($state->num_rows > 0) {// If state already exists
					 header("Location: ".$_POST['origin_page']."?status=addlocation&p=".$_POST['origin_page']."&id_loc=".$row_state['id_loc']);
				} else {

$sql_adloc = "INSERT INTO ad_location (loc_state, loc_city)
				VALUES ('$loc_state', '$loc_city')";
				
					if ($conn->query($sql_adloc) === TRUE) {
					  header("Location: ".$_POST['origin_page']."?status=Location Added!");
					}else{
					  header("Location: ".$_POST['origin_page']."?status=adlocation&err=".$conn->error);
					}
				}
	}
}

// Forgot Pass Box //
if($_POST["form_type"] === "forgot_pass"){
$email = $_POST["fpass_email"];

//Check for email existence
						$sql_email = "SELECT email, hash FROM users WHERE email='".$email."'";
						$mail = $conn->query($sql_email);
						$row_mail = $mail->fetch_assoc();
					
						if ($mail->num_rows > 0) {// If email exists, then send mail
						$hash = $row_mail['hash'];				
						$to      = $email; // Send email to our user
						$subject = 'Probizlist Forgot Password'; // Give the email a subject 
$message = '
Use this link to create new password: 
https://www.probizlist.com/index.php?em='.$email.'&hash='.$hash.'&cpass=1

Thank you for using ProbizList

Admin
ProbizList.com
 
'; // Our message above including the link
					 
$headers = 'From: ProbizList <noreply@probizlist.com>' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email

						header("Location: ../index.php?status=Success!<br />Check your email for steps to follow.");
						} else {header("Location: ../index.php?status=Error!<br />User not found.");}
}

// Create Pass Box //
if($_POST["form_type"] === "create_pass"){
$email = $_POST["email"];
$hash = $_POST["hash"];
$new_pass = $_POST["new_pass"];

		 $sql_userPass = "SELECT id_user FROM users WHERE hash='$hash'";
		 $userPass = $conn->query($sql_userPass) or die($conn->error);
		 $row_userPass  = $userPass ->fetch_assoc();
		 
		 if ($userPass->num_rows > 0) {// If user exists
				$pass = password_hash($new_pass, PASSWORD_DEFAULT);
				$sql_passUpdate = "UPDATE users SET password = '".$pass."' WHERE id_user = ".$row_userPass['id_user'];
				if ($conn->query($sql_passUpdate) === TRUE) {
					header("Location: ../index.php?status=Password Changed! <br ><a style='color:green' href='index.php?access=denied'>LOGIN HERE!</a>");
				} else {
				 //die($conn->error);
				  header("Location: ../index.php?status=Database Error!");
				}
		 } else {header("Location: ../index.php?status=No User Found!<br />Follow the link emailed to you.");}
		 		 
	

}

//Add Advert Item	
if($_POST["form_type"] === "item_insert"){
	if (isset($_FILES['files']) && $_FILES['files'] !== "") {
        $errors = [];
        $path = '../images/ads/';
        $extensions = ['jpg', 'jpeg', 'png', 'gif'];
		
        $all_files = count($_FILES['files']['tmp_name']);
		
        for ($i = 0; $i < $all_files; $i++) {
            $file_name = $_FILES['files']['name'][$i];
            $file_tmp = $_FILES['files']['tmp_name'][$i];
            $file_type = $_FILES['files']['type'][$i];
            $file_size = $_FILES['files']['size'][$i];
			$file_name = strtolower($file_name);
			$file_exp = explode('.', $file_name);
            $file_ext = end($file_exp);
            $file_name = str_replace(".".$file_ext, "", $file_name);
			
			$file_name = str_replace(" ", "-", $file_name);
			$file_name = str_replace("|", "-", $file_name);
			$file_name = $file_name ."-". time()."." . $file_ext;

            $file = $path . $file_name;

             if (!in_array($file_ext, $extensions)) {
                $errors[] = 'Empty Image or Image extension not allowed';
            }
			
            // if ($file_size > 20097152) {
            //     $errors[] = 'Image size exceeds limit';
            // } 

            if (empty($errors)) {
				$item_imgs .= $file_name ."|";
                move_uploaded_file($file_tmp, $file);
			}
		}
		
		if (empty($errors)){
			
			//Prepare for Database insertion
			$username = $_SESSION["USERNAME"];
			$sql_user = "SELECT username, full_name, id_user FROM users WHERE username='".$username."'";
			$user = $conn->query($sql_user);
			$row_user = $user->fetch_assoc();

			$id_user = $item_cat = $item_subcat = $item_state = $item_city = $item_title = "";
			$item_condition = $item_desc = $item_price = $item_nego = $author_name = "";
			
			
			$id_user = $row_user["id_user"];
			$author_name = $row_user["full_name"];
			
				if (empty($_POST["item_cat"])) {
					$errors[] = "Advert Category is required";
				} else {
				$cat = prep_input($_POST["item_cat"]);
				$cat = explode("_", $cat);
				$item_cat = $cat[0];
				}
				// if (empty($_POST["item_subcat"])) {
				// 	$errors[] = "Advert Sub-category is required";
				// } else {
				// $item_subcat = prep_input($_POST["item_subcat"]);
				// }
				if (empty($_POST["item_state"])) {
					$errors[] = "Select your State location";
				} else {
				$state = prep_input($_POST["item_state"]);
				$state = explode("_", $state);
				$item_state = $state[0];					
				}
				if (empty($_POST["item_city"])) {
					$errors[] = "Select your City location";
				} else {
				$item_city = prep_input($_POST["item_city"]);
				}
				if (empty($_POST["item_title"])) {
					$errors[] = "Advert Title is required";
				} else {
				$item_title = prep_input($_POST["item_title"]);
				}
				
				//$item_color = prep_input($_POST["item_color"]);
				//$item_gender = prep_input($_POST["item_gender"]);
				
				if (empty($_POST["item_condition"])) {
					$errors[] = "Item condition is required";
				} else {
				$item_condition = prep_input($_POST["item_condition"]);
				}
				if (empty($_POST["item_desc"])) {
					$errors[] = "Item description is required";
				} else {
				$item_desc = prep_input($_POST["item_desc"]);
				}
				
				$item_keywords = prep_input($_POST["item_keywords"]);

				$item_price = prep_input($_POST["item_price"]);
				if (isset($_POST["item_nego"])) {
					$item_nego = prep_input($_POST["item_nego"]);
				} else {
					$item_nego = "0";
				}
				$item_url = str_replace(" ", "-", $item_title);
				
				if(!empty($item_imgs)){
				$item_imgs = substr_replace($item_imgs, "", (strlen($item_imgs)-1), strlen($item_imgs));
				}
				
		if (empty($errors)){
			$sql_aditem = "INSERT INTO adverts (id_user, author_name, item_cat, item_state, item_city, item_title, item_condition, item_desc, item_price, item_nego, item_keywords, item_imgs, item_url) VALUES ($id_user, '$author_name', '$item_cat', '$item_state', '$item_city', '$item_title', '$item_condition', '$item_desc', '$item_price', '$item_nego', '$item_keywords', '$item_imgs', '$item_url')";
			
			if ($conn->query($sql_aditem) === TRUE) {
			
				$last_id = $conn->insert_id;
				$entry_title = $item_title." - ".$item_city." ".$item_state;
				$entry_desc = $item_cat." ".$item_city." ".$item_state." ".$item_title." ".$item_desc." ".$item_keywords;
				$entry_type = "ads";
				
				$sql_lastAd = "INSERT INTO search_engine (id_entry, entry_title, entry_desc, entry_type) VALUES ($last_id, '$entry_title', '$entry_desc', '$entry_type')";
				$conn->query($sql_lastAd) or die($conn->error());
				
				header("Location: ../myads.php?status=Item posted successfully!");
			} else {
				//echo ($conn->error());
				header("Location: ../post-ad.php?status=Something went wrong, contact the Admin!");
			}
		}
		//var_dump($errors);

		
		} else {
			//print_r($errors);
			$err = "";
			for ($x = 0; $x <= count($errors); $x++){
				$err .= $errors[$x]."! ";
				}
			header("Location: ../post-ad.php?err=".$err);			
		}

    }				 
}


if($_POST["form_type"] === "item_update"){

if (!empty($_FILES['files']) && $_FILES['files'] !== "") {

			$aid = $_POST["aid"];
    		$sql_upad = "SELECT item_imgs FROM adverts WHERE id_ad=".$aid;
			$upad = $conn->query($sql_upad);
			$row_upad = $upad->fetch_assoc();
			
			if (count($_FILES['files']['tmp_name']) > 1){
			if ($upad->num_rows > 0) {	
  			$ad_imgs = explode("|", $row_upad["item_imgs"]);
				for ($x = 0; $x < count($ad_imgs); $x++) {
					if(file_exists("../images/ads/".$ad_imgs[$x])){
					unlink("../images/ads/".$ad_imgs[$x]);
					clearstatcache();
					}
				}	
			}
		}
        $errors = [];
        $path = '../images/ads/';
        $extensions = ['jpg', 'jpeg', 'png', 'gif'];
		
        $all_files = count($_FILES['files']['tmp_name']);
		
        for ($i = 0; $i < $all_files; $i++) {
            $file_name = $_FILES['files']['name'][$i];
            $file_tmp = $_FILES['files']['tmp_name'][$i];
            $file_type = $_FILES['files']['type'][$i];
            $file_size = $_FILES['files']['size'][$i];
			$file_name = strtolower($file_name);
			$file_exp = explode('.', $file_name);
            $file_ext = end($file_exp);
			
			$file_name = str_replace(" ", "-", $file_name);
			$file_name = str_replace("|", "-", $file_name);

            $file = $path . $file_name;

            if (!in_array($file_ext, $extensions)) {
                $errors[] = 'Empty Image or Image extension not allowed';
            }

            if ($file_size > 20097152) {
                $errors[] = 'Image size exceeds limit';
            } 

            if (empty($errors)) {
				$item_imgs .= $file_name ."|";
                move_uploaded_file($file_tmp, $file);
			}
		}
	}


$errors = [];
if (empty($errors)){
				//Prepare for Database insertion
				$id_user = $item_cat = $item_subcat = $item_state = $item_city = $item_title = "";
				$item_condition = $item_desc = $item_price = $item_nego = "";
				
				
				$aid = $_POST["aid"];
				
				 if (empty($_POST["item_cat"])) {
						$errors[] = "Advert Category is required";
				 } else {
					$cat = prep_input($_POST["item_cat"]);
					$cat = explode("_", $cat);
					$item_cat = $cat[0];
				 }
				 if (empty($_POST["item_subcat"])) {
						$errors[] = "Advert Sub-category is required";
				 } else {
					$item_subcat = prep_input($_POST["item_subcat"]);
				 }
				 if (empty($_POST["item_state"])) {
						$errors[] = "Select your State location";
				 } else {
					$state = prep_input($_POST["item_state"]);
					$state = explode("_", $state);
					$item_state = $state[0];					
				 }
				 if (empty($_POST["item_city"])) {
						$errors[] = "Select your City location";
				 } else {
					$item_city = prep_input($_POST["item_city"]);
				 }
				 if (empty($_POST["item_title"])) {
						$errors[] = "Advert Title is required";
				 } else {
					$item_title = prep_input($_POST["item_title"]);
				 }
				 
				 //$item_color = prep_input($_POST["item_color"]);
				 //$item_gender = prep_input($_POST["item_gender"]);
				 
				 if (empty($_POST["item_condition"])) {
						$errors[] = "Item condition is required";
				 } else {
					$item_condition = prep_input($_POST["item_condition"]);
				 }
				 if (empty($_POST["item_desc"])) {
						$errors[] = "Item description is required";
				 } else {
					$item_desc = prep_input($_POST["item_desc"]);
				 }
				 $item_keywords = prep_input($_POST["item_keywords"]);
				 
				 $item_price = prep_input($_POST["item_price"]);
				 $item_nego = prep_input($_POST["item_nego"]);
				 $item_url = str_replace(" ", "-", $item_title);
				 
				 				 
			if (empty($errors)){
			
				if(!empty($item_imgs)){
				 $item_imgs = substr_replace($item_imgs, "", (strlen($item_imgs)-1), strlen($item_imgs));
				 $sql_updateitem = "UPDATE adverts SET item_cat='$item_cat', item_subcat='$item_subcat', item_state='$item_state', item_city='$item_city', item_title='$item_title', item_condition='$item_condition', item_desc='$item_desc', item_price='$item_price', item_nego='$item_nego', item_keywords='$item_keywords', item_imgs='$item_imgs', item_url='$item_url' WHERE id_ad = $aid";
				 	} else {
				 $sql_updateitem = "UPDATE adverts SET item_cat='$item_cat', item_subcat='$item_subcat', item_state='$item_state', item_city='$item_city', item_title='$item_title', item_condition='$item_condition', item_desc='$item_desc', item_price='$item_price', item_nego='$item_nego', item_keywords='$item_keywords', item_url='$item_url' WHERE id_ad = $aid";
					}
				
				if ($conn->query($sql_updateitem) === TRUE) {
				
				$entry_title = $item_title." - ".$item_city." ".$item_state;
				$entry_desc = $item_cat." ".$item_subcat." ".$item_city." ".$item_state." ".$item_title." ".$item_desc." ".$item_keywords;
				
				$sql_entryUpdate = "UPDATE search_engine SET entry_title='$entry_title', entry_desc='$entry_desc' WHERE id_entry =".$aid." AND entry_type = 'ads'";
				$conn->query($sql_entryUpdate) or die($conn->error);
				
				  header("Location: ../myads.php?status=Item was successfully updated!");
				} else {
				  //die($conn->error);
				  header("Location: ../edit-ad.php?aid=".$aid."&status=Something went wrong, contact the Admin!");
				}
			}

			
		} else {
					//print_r($errors);
					$err = "";
					for ($x = 0; $x <= count($errors); $x++){
						$err .= $errors[$x]."! ";
						}
					header("Location: ../edit-ad.php?aid=".$aid."&status=".$err);			
				}

	}
	
if($_POST["form_type"] === "user_update"){
		$id_user = $_POST["id_user"];
		$full_name = "";
		if (empty($_POST["fname"])) {
						$errors[] = "Your first name is required";
				 } else {
					$fname = prep_input($_POST["fname"]);
					$full_name = $fname;
				 }
		if (empty($_POST["lname"])) {
						$errors[] = "Your last name is required";
				 } else {
					$lname = prep_input($_POST["lname"]);
					$full_name = $full_name." ".$lname;
				 }
		if (empty($_POST["user_state"])) {
						$errors[] = "Your State is required";
				 } else {
					$state = prep_input($_POST["user_state"]);
					$state = explode("_", $state);
					$user_state = $state[0];	
				 }
		if (empty($_POST["user_city"])) {
						$errors[] = "Your City is required";
				 } else {
					$user_city = prep_input($_POST["user_city"]);
				 }
		if (empty($_POST["user_DOB"])) {
						$errors[] = "Your Birthday is required";
				 } else {
					$user_DOB = prep_input($_POST["user_DOB"]);
				 }
		if (empty($_POST["user_sex"])) {
						$errors[] = "Your gender is required";
				 } else {
					$user_sex = prep_input($_POST["user_sex"]);
				 }
		
		if (empty($errors)){	 
		$sql_updateUser = "UPDATE users SET full_name='$full_name', fname='$fname', lname='$lname', user_state='$user_state', user_city='$user_city', user_DOB='$user_DOB', user_sex='$user_sex' WHERE id_user = $id_user";
		if ($conn->query($sql_updateUser) === TRUE){
				  header("Location: ../dashboard.php?status=User info updated successfully!");
				} else {
				  //die($conn->error);
				  header("Location: ../dashboard.php?status=Something went wrong, contact the Admin!");
				}
		}else{
		header("Location: ../dashboard.php?status=Data entry error. Check all fields!");}
	}
	
	
	if($_POST["form_type"] === "pro_data"){
		
		$pro_cat = $pro_name = $pro_address = $pro_state = $pro_city = $pro_email = $pro_office_phone = $pro_mobile_phone = $pro_website = $pro_desc = "";
		$pro_service = $pro_est_yr = $no_of_employee = $pro_manager_name = $id_user = "";
		
		 $pro_cat = prep_input($_POST["pro_cat"]);
		 $pro_name = prep_input($_POST["pro_name"]);
		 $id_user = prep_input($_POST["id_user"]);
		 	 
		 $pro_address = prep_input($_POST["pro_address"]);
		 $state = prep_input($_POST["pro_state"]);
		 $state = explode("_", $state);
		 $pro_state = $state[0];	
		 $pro_city = prep_input($_POST["item_city"]);
		 $pro_email = prep_input($_POST["pro_email"]);
		 $pro_office_phone = prep_input($_POST["pro_office_phone"]);
		 $pro_mobile_phone = prep_input($_POST["pro_mobile_phone"]);
		 $pro_website = prep_input($_POST["pro_website"]);
		 $pro_desc = prep_input($_POST["pro_desc"]);
		 $pro_service = prep_input($_POST["pro_service"]);
		 $pro_est_yr = prep_input($_POST["pro_est_yr"]);
		 $no_of_employee = prep_input($_POST["no_of_employee"]);
		 $pro_manager_name = prep_input($_POST["pro_manager_name"]);
		
		if(isset($_POST["id_pro"]) && $_POST["id_pro"] != ""){
		$id_pro = prep_input($_POST["id_pro"]);
		$pro_name_b = RemoveSpecialChar($_POST["pro_name"]);
		$b_title = str_replace(" ", "-", $pro_name_b);
		$b_title = str_replace("--", "-", $b_title);
		$pro_title = $b_title."-".$id_pro;
		if(!file_exists($root_dir."professionals/".$pro_title)){
			mkdir($root_dir."professionals/".$pro_title);
		}
		$pro_url = $pro_title.".php";
		$old_title = prep_input($_POST["old_title"]);
		$old_url = $old_title.".php";
		$local_path = $root_dir."professionals";
		
		if(file_exists("../professionals/".$old_url)){
					unlink("../professionals/".$old_url);
					clearstatcache();
					}
					
		 $var = "id_pro";
		 $var2 = "id_user";
		 $profile = fopen($local_path."/".$pro_url, "w") or die("Unable to open file!");
		 $txt = "<?php $".$var." = ".$id_pro."; $".$var2." = ".$id_user."; require 'pro_data.php'; ?>";
		 fwrite($profile, $txt);
		 fclose($profile);
		
		$sql_updatePro_data = "UPDATE prolist SET pro_cat ='$pro_cat', pro_name='$pro_name', pro_title='$pro_title', pro_address='$pro_address', pro_state='$pro_state', pro_city='$pro_city', pro_email='$pro_email', pro_office_phone='$pro_office_phone', pro_mobile_phone='$pro_mobile_phone', pro_website='$pro_website', pro_desc='$pro_desc', pro_sub_status=1, pro_service='$pro_service', pro_est_yr='$pro_est_yr', no_of_employee='$no_of_employee', pro_manager_name='$pro_manager_name' WHERE id_pro = $id_pro";
			if ($conn->query($sql_updatePro_data) === TRUE){
			
				$entry_title = $pro_name." - ".$pro_city." ".$pro_state;
				$entry_desc = $pro_cat." ".$pro_address." ".$pro_city." ".$pro_state." ".$pro_name." ".$pro_desc." ".$pro_service;
				
				$sql_entryUpdate = "UPDATE search_engine SET entry_title='$entry_title', entry_desc='$entry_desc' WHERE id_entry = $id_pro AND entry_type = 'pro'";
				$conn->query($sql_entryUpdate) or die($conn->error);
			
			  header("Location: ../dashboard.php?status=Professional Information Successfully Added!");
			} else {
			  //die($conn->error);
			  header("Location: ../dashboard.php?status=Something went wrong, contact the Admin!");
			}
		
		} else {
		 $sql_proData = "SELECT id_pro FROM prolist ORDER BY id_pro DESC LIMIT 1";
		 $proData = $conn->query($sql_proData);
		 $row_proData  = $proData ->fetch_assoc();

		 $pro_name_b = RemoveSpecialChar($_POST["pro_name"]);
		 $b_title = str_replace(" ", "-", $pro_name_b);
		 $b_title = str_replace("--", "-", $b_title);

		 $last_ID = $row_proData['id_pro'];
		 $new_ID = ($last_ID+1);
		 $pro_title = $b_title."-".$new_ID;
		 
		 mkdir($root_dir."professionals/".$pro_title);
		 $pro_url = $pro_title.".php";
		 $local_path = $root_dir."professionals";
		 $var = "id_pro";
		 $var2 = "id_user";
		 $profile = fopen($local_path."/".$pro_url, "w") or die("Unable to open file!");
		 $txt = "<?php $".$var." = ".$new_ID."; $".$var2." = ".$id_user."; require 'pro_data.php'; ?>";
		 fwrite($profile, $txt);
		 fclose($profile);
		
		$sql_updatePro_data = "INSERT INTO prolist (id_pro, id_user, pro_cat, pro_name, pro_title, pro_address, pro_state, pro_city, pro_email, pro_office_phone, pro_mobile_phone, pro_website, pro_desc,  pro_sub_status, pro_service, pro_est_yr, no_of_employee, pro_manager_name)
		VALUES ($new_ID, $id_user, '$pro_cat', '$pro_name', '$pro_title', '$pro_address', '$pro_state', '$pro_city', '$pro_email', '$pro_office_phone', '$pro_mobile_phone', '$pro_website', '$pro_desc', 1, '$pro_service', '$pro_est_yr', '$no_of_employee', '$pro_manager_name')";
			
			if ($conn->query($sql_updatePro_data) === TRUE){
		
				$last_id = $conn->insert_id;
				$entry_title = $pro_name." - ".$pro_city." ".$pro_state;
				$entry_desc = $pro_cat." ".$pro_address." ".$pro_city." ".$pro_state." ".$pro_name." ".$pro_desc." ".$pro_service;
				$entry_type = "pro";
				
				$sql_lastAd = "INSERT INTO search_engine (id_entry, entry_title, entry_desc, entry_type) VALUES ($last_id, '$entry_title', '$entry_desc', '$entry_type')";
				$conn->query($sql_lastAd) or die($conn->error);
				
			  header("Location: ../dashboard.php?status=Professional Information Successfully Added!");
			} else {
			  //die($conn->error);
			  header("Location: ../dashboard.php?status=Something went wrong, contact the Admin!");
			}
		}
		
		
	}
	
	if($_POST["form_type"] === "biz_data"){
		
		$biz_cat = $biz_name = $biz_address = $biz_state = $biz_city = $biz_email = $biz_office_phone = $biz_mobile_phone = $biz_website = $biz_desc = "";
		$biz_service = $biz_est_yr = $no_of_employee = $biz_manager_name = $id_user = $biz_vision = $biz_mission = $biz_expr = $biz_cvalue = $biz_event = $biz_reg = "";
		
		 $biz_cat = prep_input($_POST["biz_cat"]);
		 $biz_name = prep_input($_POST["biz_name"]);
		 $id_user = prep_input($_POST["id_user"]);
		 	 
		 $biz_address = prep_input($_POST["biz_address"]);
		 $state = prep_input($_POST["biz_state"]);
		 $state = explode("_", $state);
		 $biz_state = $state[0];	
		 $biz_city = prep_input($_POST["item_city"]);
		 $biz_email = prep_input($_POST["biz_email"]);
		 $biz_office_phone = prep_input($_POST["biz_office_phone"]);
		 $biz_mobile_phone = prep_input($_POST["biz_mobile_phone"]);
		 $biz_website = prep_input($_POST["biz_website"]);
		 $biz_desc = prep_input($_POST["biz_desc"]);
		 $biz_service = prep_input($_POST["biz_service"]);
		 $biz_est_yr = prep_input($_POST["biz_est_yr"]);
		 $no_of_employee = prep_input($_POST["no_of_employee"]);
		 $biz_manager_name = prep_input($_POST["biz_manager_name"]);
		 $biz_vision = prep_input($_POST["biz_vision"]);
		 $biz_mission = prep_input($_POST["biz_mission"]);
		 $biz_expr = prep_input($_POST["biz_expr"]);
		 $biz_cvalue = prep_input($_POST["biz_cvalue"]);
		 $biz_event = prep_input($_POST["biz_event"]);
		 $biz_reg = prep_input($_POST["biz_reg"]);
		 $biz_gallery = prep_input($_POST["biz_gallery"]);
		 $biz_keywords = prep_input($_POST["biz_keywords"]);
		 $biz_facebook = prep_input($_POST["biz_facebook"]);
		 $biz_twitter = prep_input($_POST["biz_twitter"]);
		 $biz_google = prep_input($_POST["biz_google"]);
		 $biz_youtube = prep_input($_POST["biz_youtube"]);
		 $biz_tiktok = prep_input($_POST["biz_tiktok"]);
		 $biz_instagram = prep_input($_POST["biz_instagram"]);
		 		
		if(isset($_POST["id_biz"]) && $_POST["id_biz"] != ""){
		$id_biz = prep_input($_POST["id_biz"]);
		$biz_name_b = RemoveSpecialChar($_POST["biz_name"]);
		$b_title = str_replace(" ", "-", $biz_name_b);
		$b_title = str_replace("--", "-", $b_title);
		$biz_title = $b_title."-".$id_biz;
		if(!file_exists($root_dir."businesses/".$biz_title)){
			mkdir($root_dir."businesses/".$biz_title);
		}
		$biz_url = $biz_title.".php";
		$old_title = prep_input($_POST["old_title"]);
		$old_url = $old_title.".php";
		$local_path = $root_dir."businesses";
		
		if(file_exists("../businesses/".$old_url)){
					unlink("../businesses/".$old_url);
					clearstatcache();
					}
					
		 $var = "id_biz";
		 $var2 = "id_user";
		 $bizfile = fopen($local_path."/".$biz_url, "w") or die("Unable to open file!");
		 $txt = "<?php $".$var." = ".$id_biz."; $".$var2." = ".$id_user."; require 'biz_data.php'; ?>";
		 fwrite($bizfile, $txt);
		 fclose($bizfile);
		
		$sql_updatePro_data = "UPDATE bizlist SET biz_cat ='$biz_cat', biz_name='$biz_name', biz_title='$biz_title', biz_address='$biz_address', biz_state='$biz_state', biz_city='$biz_city', biz_email='$biz_email', biz_office_phone='$biz_office_phone', biz_mobile_phone='$biz_mobile_phone', biz_website='$biz_website', biz_desc='$biz_desc',  biz_sub_status=1, biz_service='$biz_service', biz_est_yr='$biz_est_yr', no_of_employee='$no_of_employee', biz_manager_name='$biz_manager_name', biz_vision='$biz_vision', biz_mission='$biz_mission', biz_expr='$biz_expr', biz_cvalue='$biz_cvalue', biz_event='$biz_event', biz_reg='$biz_reg', biz_gallery='$biz_gallery', biz_keywords='$biz_keywords', biz_facebook='$biz_facebook', biz_twitter='$biz_twitter', biz_google='$biz_google', biz_youtube='$biz_youtube', biz_tiktok='$biz_tiktok', biz_instagram='$biz_instagram' WHERE id_biz = $id_biz";
		
		if ($conn->query($sql_updatePro_data) === TRUE){
		
				$entry_title = $biz_name." - ".$biz_city." ".$biz_state;
				$entry_desc = $biz_cat." ".$biz_address." ".$biz_city." ".$biz_state." ".$biz_name." ".$biz_desc." ".$biz_service." ".$biz_keywords;
				
				$sql_search = "SELECT id_entry FROM search_engine WHERE id_entry = $id_biz AND entry_type = 'biz'";
				$search = $conn->query($sql_search);
				$row_search  = $search ->fetch_assoc();
				if($search->num_rows > 0){
				$sql_entryUpdate = "UPDATE search_engine SET entry_title='$entry_title', entry_desc='$entry_desc' WHERE id_entry = $id_biz AND entry_type = 'biz'";
				} else {
				
				$sql_entryUpdate = "INSERT INTO search_engine (id_entry, entry_title, entry_desc, entry_type) VALUES ($id_biz, '$entry_title', '$entry_desc', 'biz')";
				}
				if ($conn->query($sql_entryUpdate)){
				header("Location: ../dashboard.php?status=Business Information Successfully Added!");
				} else { echo $conn->error; }
				
			} else {
			  //echo $conn->error;
			  header("Location: ../dashboard.php?status=Something went wrong, contact the Admin!");
			}
			
		} else {
		 $sql_bizData = "SELECT id_biz FROM bizlist ORDER BY id_biz DESC LIMIT 1";
		 $bizData = $conn->query($sql_bizData);
		 $row_bizData  = $bizData ->fetch_assoc();
		 $biz_name_b = RemoveSpecialChar($_POST["biz_name"]);
		 $b_title = str_replace(" ", "-", $biz_name_b);
		 $b_title = str_replace("--", "-", $b_title);
		 $last_ID = $row_bizData['id_biz'];
		 $new_ID = ($last_ID+1);
		 $biz_title = $b_title."-".$new_ID;
		 
		 mkdir($root_dir."businesses/".$biz_title);
		 $biz_url = $biz_title.".php";
		 $local_path = $root_dir."businesses";
		 $var = "id_biz";
		 $var2 = "id_user";
		 $bizfile = fopen($local_path."/".$biz_url, "w") or die("Unable to open file!");
		 $txt = "<?php $".$var." = ".$new_ID."; $".$var2." = ".$id_user."; require 'biz_data.php'; ?>";
		 fwrite($bizfile, $txt);
		 fclose($bizfile);
		
		$sql_updatePro_data = "INSERT INTO bizlist (id_biz, id_user, biz_cat, biz_name, biz_title, biz_address, biz_state, biz_city, biz_email, biz_office_phone, biz_mobile_phone, biz_website, biz_desc, biz_sub_status, biz_service, biz_est_yr, no_of_employee, biz_manager_name, biz_vision, biz_mission, biz_expr, biz_cvalue, biz_event, biz_reg, biz_gallery, biz_keywords, biz_facebook, biz_twitter, biz_google, biz_youtube, biz_tiktok, biz_instagram)
		VALUES ($new_ID, $id_user, '$biz_cat', '$biz_name', '$biz_title', '$biz_address', '$biz_state', '$biz_city', '$biz_email', '$biz_office_phone', '$biz_mobile_phone', '$biz_website', '$biz_desc', 1, '$biz_service', '$biz_est_yr', '$no_of_employee', '$biz_manager_name', '$biz_vision', '$biz_mission', '$biz_expr', '$biz_cvalue', '$biz_event', '$biz_reg', '$biz_gallery', '$biz_keywords', '$biz_facebook', '$biz_twitter', '$biz_google', '$biz_youtube', '$biz_tiktok', '$biz_instagram')";
		
		if ($conn->query($sql_updatePro_data) === TRUE){
		
				$last_id = $conn->insert_id;
				$entry_title = $biz_name." - ".$biz_city." ".$biz_state;
				$entry_desc = $biz_cat." ".$biz_address." ".$biz_city." ".$biz_state." ".$biz_name." ".$biz_desc." ".$biz_service." ".$biz_keywords;
				$entry_type = "biz";
				
				$sql_lastAd = "INSERT INTO search_engine (id_entry, entry_title, entry_desc, entry_type) VALUES ($last_id, '$entry_title', '$entry_desc', '$entry_type')";
				$conn->query($sql_lastAd) or die($conn->error);
				
			  header("Location: ../dashboard.php?status=Business Information Successfully Added!");
			} else {
			  //die($conn->error);
			  header("Location: ../dashboard.php?status=Something went wrong, contact the Admin!");
			}
		}
		
	}
	
//Insert Biz Review
if($_POST["form_type"] === "biz_review"){
		 $star_rating = $review_writer_name = $review_writer_email = $review_writer_phone = $review_title = $review_msg = $id_biz = $biz_title = "";
		 
		 $biz_title = prep_input($_POST["biz_title"]);
		 $id_biz = prep_input($_POST["id_biz"]);
		 $star_rating = prep_input($_POST["star_rating"]);
		 $review_writer_name = prep_input($_POST["review_writer_name"]);
		 $review_writer_email = prep_input($_POST["review_writer_email"]);
		 $review_writer_phone = prep_input($_POST["review_writer_phone"]);
		 $review_title = prep_input($_POST["review_title"]);
		 $review_msg = prep_input($_POST["review_msg"]);
		 
		 $sql_postReview = "INSERT INTO biz_review (id_biz, star_rating, review_writer_name, review_writer_email, review_writer_phone, review_title, review_msg)
		VALUES ($id_biz, $star_rating, '$review_writer_name', '$review_writer_email', '$review_writer_phone', '$review_title', '$review_msg')";
		
		if ($conn->query($sql_postReview) === TRUE) {
		  header("Location: ../businesses/".$biz_title.".php?status=Review Added Successfully");
		} else {
		  //die($conn->error);
		  header("Location: ../businesses/".$biz_title.".php?status=Database Error!");
		}
	}
	
//Insert Pro Review
if($_POST["form_type"] === "pro_review"){
		 $star_rating = $review_writer_name = $review_writer_email = $review_writer_phone = $review_title = $review_msg = $id_pro = $pro_title = "";
		 
		 $pro_title = prep_input($_POST["pro_title"]);
		 $id_pro = prep_input($_POST["id_pro"]);
		 $star_rating = prep_input($_POST["star_rating"]);
		 $review_writer_name = prep_input($_POST["review_writer_name"]);
		 $review_writer_email = prep_input($_POST["review_writer_email"]);
		 $review_writer_phone = prep_input($_POST["review_writer_phone"]);
		 $review_title = prep_input($_POST["review_title"]);
		 $review_msg = prep_input($_POST["review_msg"]);
		 
		 $sql_postReview = "INSERT INTO pro_review (id_pro, star_rating, review_writer_name, review_writer_email, review_writer_phone, review_title, review_msg)
		VALUES ($id_pro, $star_rating, '$review_writer_name', '$review_writer_email', '$review_writer_phone', '$review_title', '$review_msg')";
		
		if ($conn->query($sql_postReview) === TRUE) {
		  header("Location: ../businesses/".$pro_title.".php?status=Review Added Successfully");
		} else {
		  //die($conn->error);
		  header("Location: ../businesses/".$pro_title.".php?status=Database Error!");
		}
	}

//UPDATE USER PASSWORD
if($_POST["form_type"] === "password_update"){
		 $current_pass = $new_pass = $conf_pass = $id_user = "";
		 
		 
		 $current_pass = $_POST["current_pass"];
		 $id_user = prep_input($_POST["id_user"]);
		 $new_pass = prep_input($_POST["new_pass"]);
		 $conf_pass = prep_input($_POST["conf_pass"]);
		 
		 $sql_userPass = "SELECT password FROM users WHERE id_user=$id_user";
		 $userPass = $conn->query($sql_userPass) or die($conn->error);
		 $row_userPass  = $userPass ->fetch_assoc();
		 
		 if ($userPass->num_rows > 0 && password_verify($current_pass, $row_userPass['password'])) {// If user exists
		 	if($new_pass != "" && $new_pass === $conf_pass){
				$pass = password_hash($new_pass, PASSWORD_DEFAULT);
				$sql_passUpdate = "UPDATE users SET password = '".$pass."' WHERE id_user = ".$id_user;
				if ($conn->query($sql_passUpdate) === TRUE) {
				
					if (!isset($_SESSION)) {
					  session_start();
					}
					$_SESSION['USERNAME'] = NULL;
					$_SESSION['USERGROUP'] = NULL;
					unset($_SESSION['USERNAME']);
					unset($_SESSION['USERGROUP']);
					header("Location: ../index.php?status=Password Updated! <br ><a style='color:green' href='index.php?access=denied'>RE-LOGIN!</a>");
					exit;
				
				} else {
				  die($conn->error);
				  //header("Location: ../dashboard.php?status=Database Error!");
				}
			} else {header("Location: ../dashboard.php?status=Mismatched Passwords!");}
		 } else {header("Location: ../dashboard.php?status=Wrong Current Password!");}
		 		 
	}
	
//SEND ENQUIRY
	if($_POST["form_type"] === "enquiry"){
		
$to      = $_POST["email"]; // Send email to our user
$name	 = $_POST["enq_name"];
$enq_email = $_POST["enq_email"];
$phone 	 = $_POST["enq_phone"];
$enq_msg = $_POST["enq_msg"];
$p = $_POST["p"];

$subject = 'Probizlist | Enquiry'; // Give the email a subject 
$message = '
Send Name: '.$name.'
Sender Email: '.$enq_email.'
Sender Phone: '.$phone.'

Message: '.$enq_msg.'


ProbizList.com'; 
					 
//$headers = 'From: ProbizList <noreply@probizlist.com>' . "\r\n"; // Set from headers

$headers = 'From: ProbizList <noreply@probizlist.com>' . "\r\n" .
			'Reply-To: ' . $email . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers); // Send out email
header("Location: ".$p."?status=Enquiry Sent Successfully!");
		
	}	
	

//PRO SUBSCRIPTION SCRIPT
	if($_POST["form_type"] === "prosub"){
	//Action on User Account by Admin
	$id_pro = $_POST["id"];
	$id_user = $_POST["id_user"];
	$pro_start = $_POST["pro_start"];
	$pro_end = $_POST["pro_end"];
	
	if($id_pro == "" || empty($id_pro)){
	$sql_proData = "SELECT id_pro FROM prolist ORDER BY id_pro DESC";
	
	$proData = $conn->query($sql_proData);
	$row_proData  = $proData ->fetch_assoc();
	$last_ID = $row_proData['id_pro'];
	$new_ID = ($last_ID+1);
		 
	$sql_updateSub = "INSERT INTO prolist (id_pro, id_user, pro_start, pro_end) VALUES ($new_ID, $id_user, '$pro_start', '$pro_end')";
	
	} else {
	$sql_updateSub = "UPDATE prolist SET pro_start ='$pro_start', pro_end ='$pro_end' WHERE id_pro=".$id_pro;
	}
	
	if($conn->query($sql_updateSub) === TRUE){
				header("Location: ../admin-dashboard.php?status=Pro Subscription Activated!");
			} else { 
				//die($conn->error);
				header("Location: ../admin-dashboard.php?status=Something went wrong, contact the Admin!");
			}
	}
		
//BIZ SUBSCRIPTION SCRIPT
	if($_POST["form_type"] === "bizsub"){
	//Action on User Account by Admin
	$id_biz = $_POST["id"];
	$id_user = $_POST["id_user"];
	$biz_start = $_POST["biz_start"];
	$biz_end = $_POST["biz_end"];
	
	if($id_biz == "" || empty($id_biz)){
	$sql_bizData = "SELECT id_biz FROM bizlist ORDER BY id_biz DESC";
	
	$bizData = $conn->query($sql_bizData);
	$row_bizData  = $bizData ->fetch_assoc();
	$last_ID = $row_bizData['id_biz'];
	$new_ID = ($last_ID+1);
		 
	$sql_updateSub = "INSERT INTO bizlist (id_biz, id_user, biz_start, biz_end) VALUES ($new_ID, $id_user, '$biz_start', '$biz_end')";
	
	} else {
	$sql_updateSub = "UPDATE bizlist SET biz_start ='$biz_start', biz_end ='$biz_end' WHERE id_biz=".$id_biz;
	}
	
	if($conn->query($sql_updateSub) === TRUE){
				header("Location: ../admin-dashboard.php?status=Biz Subscription Activated!");
			} else { 
				//echo $conn->error; 
				header("Location: ../admin-dashboard.php?status=Something went wrong, contact the Admin!");
			}
	}

}

//DELETION Script
if (isset($_GET["action"]) && !(empty($_GET["action"]))){
	if ($_GET["action"] == "advert" && !(empty($_GET["id"]))){
		//Delete Advert details
		$id_ad = $_GET["id"];
		
		$sql_adImg = "SELECT item_imgs FROM adverts WHERE id_ad=$id_ad";
		$adImg = $conn->query($sql_adImg);
		$row_adImg  = $adImg ->fetch_assoc();
		
		$ad_img = explode("|",$row_adImg['item_imgs']);
		
			for ($i = 0; $i < count($ad_img); $i++){
			
			if(file_exists("../images/ads/".$ad_img[$i])){
						unlink("../images/ads/".$ad_img[$i]);
						clearstatcache();
						}
			}
		
		$sql_del = sprintf("DELETE FROM adverts WHERE id_ad=".$id_ad);
		$del = $conn->query($sql_del) or die($conn->error);
		
		$sql_del_search_entry = sprintf("DELETE FROM search_engine WHERE id_entry=".$id_ad." AND entry_type='ads'");
		$del_search_entry = $conn->query($sql_del_search_entry) or die($conn->error);

		header("Location: ../myads.php?status=The Advert was deleted successfully!");
	}
	
	if ($_GET["action"] == "ACTIVATE" && !(empty($_GET["id"]))){
		//Action on User Account by Admin
		$id_user = $_GET["id"];
		
		$sql_check = "SELECT id_user FROM users WHERE id_user=".$id_user." AND user_status = 'New' OR user_status = 'Deactivated'";
		$check = $conn->query($sql_check) or die($conn->error);
		
		if ($check->num_rows > 0) {
			$sql_action = "UPDATE users SET user_status = 'Active' WHERE id_user=".$id_user;
			if($conn->query($sql_action) === TRUE){
				header("Location: ../admin-dashboard.php?status=User Status Updated!");
			} else { 
				//die($conn->error);
				header("Location: ../admin-dashboard.php?status=Something went wrong, contact the Admin!");
			}
				
		} else {header("Location: ../admin-dashboard.php?status=User already activated or can not be found!");}//user does not exist
	}
	
	if ($_GET["action"] == "VERIFY" && !(empty($_GET["id"]))){
		//Action on User Account by Admin
		$id_user = $_GET["id"];
		
		$sql_check = "SELECT id_biz FROM bizlist WHERE id_user=".$id_user." AND verify_status is null";
		$check = $conn->query($sql_check) or die($conn->error);
		
		if ($check->num_rows > 0) {
			$sql_action = "UPDATE bizlist SET verify_status = 1 WHERE id_user=".$id_user;
			if($conn->query($sql_action) === TRUE){
				header("Location: ../admin-dashboard.php?status=Business Status Updated!");
			} else { 
				//die($conn->error);
				header("Location: ../admin-dashboard.php?status=Something went wrong, contact the Admin!");
			}
				
		} else {header("Location: ../admin-dashboard.php?status=Business already verified or does not exist!".$id_user);}//user does not exist
	}

	if ($_GET["action"] == "DEACTIVATE" && !(empty($_GET["id"]))){
		//Action on User Account by Admin
		$id_user = $_GET["id"];
		
		$sql_check = "SELECT id_user FROM users WHERE id_user=".$id_user." AND user_status = 'New' OR user_status = 'Active'";
		$check = $conn->query($sql_check) or die($conn->error);
		
		if ($check->num_rows > 0) {
			$sql_action = "UPDATE users SET user_status = 'Deactivated' WHERE id_user=".$id_user;
			if($conn->query($sql_action) === TRUE){
				header("Location: ../admin-dashboard.php?status=User Status Updated!");
			} else { 
				//die($conn->error);
				header("Location: ../admin-dashboard.php?status=Something went wrong, contact the Admin!");
			}
				
		} else {header("Location: ../admin-dashboard.php?status=User already Deactivated or can not be found!");}//user does not exist
	}

	if ($_GET["action"] == "UPGRADE To ADMIN" && !(empty($_GET["id"]))){
		//Action on User Account by Admin
		$id_user = $_GET["id"];
		
		$sql_check = "SELECT id_user FROM users WHERE id_user=".$id_user." AND user_cat = 'subscriber' OR id_user=".$id_user." AND user_cat = 'user'";
		$check = $conn->query($sql_check) or die($conn->error);
		
		if ($check->num_rows > 0) {
			$sql_action = "UPDATE users SET user_cat = 'admin' WHERE id_user=".$id_user;
			if($conn->query($sql_action) === TRUE){
				header("Location: ../admin-dashboard.php?status=User category Upgraded!");
			} else { 
				//die($conn->error);
				header("Location: ../admin-dashboard.php?status=Something went wrong, contact the Admin!");
			}
				
		} else {header("Location: ../admin-dashboard.php?status=User not Active or can not be found!");}//user does not exist
	}
	
	if ($_GET["action"] == "UPGRADE To ADMIN LISTING" && !(empty($_GET["id"]))){
		//Action on User Account by Admin
		$id_user = $_GET["id"];
		
		$sql_check = "SELECT id_user FROM users WHERE id_user=".$id_user." AND user_cat = 'subscriber' OR id_user=".$id_user." AND user_cat = 'user'";
		$check = $conn->query($sql_check) or die($conn->error);
		
		if ($check->num_rows > 0) {
			$sql_action = "UPDATE users SET user_cat = 'admin_listing' WHERE id_user=".$id_user;
			if($conn->query($sql_action) === TRUE){
				header("Location: ../admin-dashboard.php?status=User category Upgraded!");
			} else { 
				//die($conn->error);
				header("Location: ../admin-dashboard.php?status=Something went wrong, contact the Admin!");
			}
				
		} else {header("Location: ../admin-dashboard.php?status=User not Active or can not be found!");}//user does not exist
	}

	if ($_GET["action"] == "DOWNGRADE" && !(empty($_GET["id"]))){
		//Action on User Account by Admin
		$id_user = $_GET["id"];
		
		$sql_check = "SELECT id_user FROM users WHERE id_user=".$id_user." AND user_cat = 'admin' OR id_user=".$id_user." AND user_cat = 'admin_listing' ";
		$check = $conn->query($sql_check) or die($conn->error);
		
		if ($check->num_rows > 0) {
			$sql_action = "UPDATE users SET user_cat = 'subscriber' WHERE id_user=".$id_user;
			if($conn->query($sql_action) === TRUE){
				header("Location: ../admin-dashboard.php?status=User category Downgraded!");
			} else { 
				//die($conn->error);
				header("Location: ../admin-dashboard.php?status=Something went wrong, contact the Admin!");
			}
				
		} else {header("Location: ../admin-dashboard.php?status=User not Active or can not be found!");}//user does not exist
	}
		
	if ($_GET["action"] == "DELETE" && !(empty($_GET["id"]))){
		//Action on User Account by Admin
		$id_user = $_GET["id"];
		
		$sql_check = "SELECT id_user FROM users WHERE id_user=".$id_user;
		$check = $conn->query($sql_check) or die($conn->error);
		
		if ($check->num_rows > 0) {
			$sql_action = sprintf("DELETE FROM users WHERE id_user=".$id_user);
			if($conn->query($sql_action) === TRUE){
				header("Location: ../admin-dashboard.php?status=User Deleted Successfully!");
			} else { 
				//die($conn->error);
				header("Location: ../admin-dashboard.php?status=Something went wrong, contact the Admin!");
			}
				
		} else {header("Location: ../admin-dashboard.php?status=User already Deleted or can not be found!");}//user does not exist
	}
	
	if ($_GET["action"] == "pro-deactivation" || $_GET["action"] == "biz-deactivation" && !(empty($_GET["id"]))){
		//Action on User Account by Admin
		$sub = explode("-", $_GET["action"]);
		$id_sub = $_GET["id"];
		
		$sql_check = "SELECT id_".$sub[0]." FROM ".$sub[0]."list WHERE id_".$sub[0]."=".$id_sub;
		$check = $conn->query($sql_check) or die($conn->error);
		
		if ($check->num_rows > 0) {
			$sql_action = "UPDATE ".$sub[0]."list SET ".$sub[0]."_start='', ".$sub[0]."_end='' WHERE id_".$sub[0]."=".$id_sub;
			if($conn->query($sql_action) === TRUE){
				header("Location: ../admin-dashboard.php?status=Subscription Deactivated Successfully!");
			} else { 
				//die($conn->error);
				header("Location: ../admin-dashboard.php?status=Something went wrong, contact the Admin!");
			}
				
		} else {header("Location: ../admin-dashboard.php?status=No Active Subscription!");}//user does not exist
	}
}

?>
<?php $conn->close(); ?>