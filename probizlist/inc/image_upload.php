<?php
  $conn = mysqli_connect("localhost","wechujfx_probizlist_user", "hZ2Fxm#1]a{r","wechujfx_probizlist");
  //$conn = mysqli_connect("localhost","wechujfx_probizlist_user", "hZ2Fxm#1]a{r","wechujfx_probizlist");
  
  if (isset($_POST['port_upload'])) {
  
    $root_dir = "/home/probceff/public_html/";

  	//$root_dir = "C:\wamp64\www\probizlist\/";
	
	  if ($_POST['port_upload'] == "bizImage") {
	    
		$portFolder = $_POST["biz_title"];
		
		if(!file_exists($root_dir."businesses/".$portFolder)){
		mkdir($root_dir."businesses/".$portFolder);
	    }
		
		$path = '../businesses/'.$portFolder.'/';
        $extensions = ['jpg', 'jpeg', 'png', 'gif', 'mp4'];
		
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
			
			 if(empty($file_name)){ 
			   header("Location: ../dashboard.php?status=Please select image or video in any of these formats<br>jpg, jpeg, png, gif or mp4!");
			   return $error;
			}

             if (!in_array($file_ext, $extensions)) {
                 header("Location: ../dashboard.php?status=Empty media file or file extension not allowed!");
				 return $error;
            }

             if ($file_size > 20097152) {
                header("Location: ../dashboard.php?status=Media file size exceeds limit!");
			   return $error;
            } 

            if (empty($errors)) {
				$item_imgs .= $file_name ."|";
				
				if(move_uploaded_file($file_tmp, $file)) {
                //move_uploaded_file($file_tmp, $file);
				header("Location: ../dashboard.php?status=Media file uploaded Successfully!");
				} else {
					header("Location: ../dashboard.php?status=There was an error uploading the file, use another media file or contact admin!");
				}
			}
		}
	  
	  }
	  
	 if ($_POST['port_upload'] == "proImage") {
	 //Pro portfolio image upload script here
	 }

  }
  
  if (isset($_POST['image_upload'])) {
  
  if ($_POST['image_upload'] == "profileImage") {
  	$target_dir = "../images/users/";
	$table = "users";
	$col = "user_pic";
	$maxsize = 500000;
	$defaultImg = "avatar.jpg";
	}

//Professional
  if ($_POST['image_upload'] == "prologoImage") {
  	$target_dir = "../images/pro/";
	$table = "prolist";
	$col = "pro_logo";
	$maxsize = 500000;
	$defaultImg = "pro_logo.jpg";
	}
	
 if ($_POST['image_upload'] == "prodeskImage") {
  	$target_dir = "../images/pro/";
	$table = "prolist";
	$col = "pro_banner_desk";
	$maxsize = 2000000;
	$defaultImg = "pro_banner_desk.jpg";
	}
	
if ($_POST['image_upload'] == "promobImage") {
  	$target_dir = "../images/pro/";
	$table = "prolist";
	$col = "pro_banner_mob";
	$maxsize = 1000000;
	$defaultImg = "pro_banner_mob.jpg";
	}

//Business
  if ($_POST['image_upload'] == "bizlogoImage") {
  	$target_dir = "../images/biz/";
	$table = "bizlist";
	$col = "biz_logo";
	$maxsize = 500000;
	$defaultImg = "biz_logo.jpg";
	}
	
 if ($_POST['image_upload'] == "bizdeskImage") {
  	$target_dir = "../images/biz/";
	$table = "bizlist";
	$col = "biz_banner_desk";
	$maxsize = 2000000;
	$defaultImg = "biz_banner_desk.jpg";
	}
	
if ($_POST['image_upload'] == "bizmobImage") {
  	$target_dir = "../images/biz/";
	$table = "bizlist";
	$col = "biz_banner_mob";
	$maxsize = 1000000;
	$defaultImg = "biz_banner_mob.jpg";
	}
  
    // for the database
    $id_user = $_POST['id_user'];
	$username = $_POST['username'];
	$imageFile = $_POST['image_upload'];
	$file_size = $_FILES[$imageFile]["size"];
	$file_name = $_FILES[$imageFile]["name"];
	$file_name = strtolower($file_name);
	$file_exp = explode('.', $file_name);
    $file_ext = end($file_exp);
	
    //$profileImageName = $id_user . '_' . $_FILES["profileImage"]["name"];
  if ($_POST['image_upload'] == "profileImage") {
	$profileImageName = $id_user . '_' . $username . '.' . $file_ext;
	}
  if ($_POST['image_upload'] == "prologoImage") {
	$profileImageName = $id_user . '_' . $username . '_pro_logo.' . $file_ext;
	}
  if ($_POST['image_upload'] == "prodeskImage") {
	$profileImageName = $id_user . '_' . $username . '_pro_banner_desk.' . $file_ext;
	}
  if ($_POST['image_upload'] == "promobImage") {
	$profileImageName = $id_user . '_' . $username . '_pro_banner_mob.' . $file_ext;
	}
	
  if ($_POST['image_upload'] == "bizlogoImage") {
	$profileImageName = $id_user . '_' . $username . '_biz_logo.' . $file_ext;
	}
  if ($_POST['image_upload'] == "bizdeskImage") {
	$profileImageName = $id_user . '_' . $username . '_biz_banner_desk.' . $file_ext;
	}
  if ($_POST['image_upload'] == "bizmobImage") {
	$profileImageName = $id_user . '_' . $username . '_biz_banner_mob.' . $file_ext;
	}

    $allowImageExt = array('jpg','png','jpeg','gif');
    $target_file = $target_dir . basename($profileImageName);
	if(empty($file_name)){ 
       header("Location: ../dashboard.php?status=Please select an image!");
       return $error;}
	   
	if(!(in_array($file_ext, $allowImageExt))){ 
	   header("Location: ../dashboard.php?status=Image type not allowed use jpg, png, jpeg or gif!");
       return $error;}
	
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if($file_size  > $maxsize) {
      header("Location: ../dashboard.php?status=Image size can not be greater than ".($maxsize/1000)."Kb!");
	  exit;
      }
    // check if file exists
    /*if(file_exists($target_file)) {
      $msg = "File already exists";
      $msg_class = "alert-danger";
    }*/
    // Upload image only if no errors
    if (empty($error)) {
	  //Check if image exists
						$sql_imgExist = "SELECT $col FROM $table WHERE id_user=$id_user";
						$imgExist = $conn->query($sql_imgExist);
						$row_imgExist = $imgExist->fetch_assoc();
					
						if ($imgExist->num_rows > 0) {// If image already exists unlink it
							if($row_imgExist[$col] != $defaultImg){
								if(file_exists($target_dir.$row_imgExist[$col])){
									unlink($target_dir.$row_imgExist[$col]);
									clearstatcache();
								}
							}
						} 
					
      
	  if(move_uploaded_file($_FILES[$imageFile]["tmp_name"], $target_file)) {
        $sql = "UPDATE $table SET $col='$profileImageName' WHERE id_user=$id_user";
        if(mysqli_query($conn, $sql)){
          header("Location: ../dashboard.php?status=Image uploaded!");
        } else {
		  die($conn->error);
          //header("Location: ../dashboard.php?status=Something went wrong, contact the Admin!");
        }
      } else {
        header("Location: ../dashboard.php?status=There was an error uploading the file, use another image or contact admin!");
      }
    }
  }
?>