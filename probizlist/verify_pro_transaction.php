<?php require_once('inc/db_conn.php'); ?>
<?php require_once('inc/authorizedusers.php'); ?>

<?php
  $ref = $_GET["reference"];
  if ($ref == ""){
  	header("Location:javascript://history.go(-1)");
  }
  
  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/". rawurlencode($ref),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer sk_live_0000000000000000000",
      "Cache-Control: no-cache",
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    //echo $response;
	$result = json_decode($response);
  }
  if($result->data->status == "success"){
  
    $ref_explode = explode("_", $ref);
	$id_user = $ref_explode[1];

	//database conn and insertion
    $sql_user = "SELECT * FROM users WHERE id_user=".$id_user;
	$user = $conn->query($sql_user);
	$row_user = $user->fetch_assoc();

	$id_user = $row_user["id_user"];
	$sql_pro = "SELECT id_pro FROM prolist WHERE id_user=".$row_user['id_user'];
	$pro = $conn->query($sql_pro);
	$row_pro = $pro->fetch_assoc();

	
	$pro_start =  date("Y-m-d");
	$pro_end = date("Y")+1 ."-". date("m-d");
	
	if ($pro->num_rows > 0) {
	$id_pro = $row_pro["id_pro"];
	$sql_updateSub = "UPDATE prolist SET pro_start ='$pro_start', pro_end ='$pro_end' WHERE id_pro=".$id_pro;
	
	} else {
	$sql_proData = "SELECT COUNT(id_pro) AS LastID FROM prolist";
	
	$proData = $conn->query($sql_proData);
	$row_proData  = $proData ->fetch_assoc();
	$last_ID = $row_proData['LastID'];
	$new_ID = ($last_ID+1);
		 
	$sql_updateSub = "INSERT INTO prolist (id_pro, id_user, pro_start, pro_end) VALUES ($new_ID, $id_user, '$pro_start', '$pro_end')";
	}
	
	if($conn->query($sql_updateSub) === TRUE){
				header("Location: dashboard.php?status=Successful Payment <br>Pro Subscription Activated!");
			} else { 
				//die($conn->error);
				header("Location: dashboard.php?status=Something went wrong, contact the Admin!");
			}
	
  //header("location: dashboard.php?status=Your Professional Subscription was Successful!");

  } else {
  header("location: subscriptions.php?status=Payment was not successful!");
  }
?>