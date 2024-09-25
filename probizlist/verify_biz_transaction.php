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
      "Authorization: Bearer sk_live_190530f4df1a34570a888387b581b4fedeb4e8da",
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
	$sql_biz = "SELECT id_biz FROM bizlist WHERE id_user=".$id_user;
	$biz = $conn->query($sql_biz);
	$row_biz = $biz->fetch_assoc();

	
	$biz_start = date("Y-m-d");
	$biz_end = date("Y")+1 ."-". date("m-d");
	
	if ($biz->num_rows > 0) {
	$id_biz = $row_biz["id_biz"];
	$sql_updateSub = "UPDATE bizlist SET biz_start ='$biz_start', biz_end ='$biz_end' WHERE id_biz=".$id_biz;
	
	} else {
	$sql_bizData = "SELECT COUNT(id_biz) AS LastID FROM bizlist";
	
	$bizData = $conn->query($sql_bizData);
	$row_bizData  = $bizData ->fetch_assoc();
	$last_ID = $row_bizData['LastID'];
	$new_ID = ($last_ID+1);
		 
	$sql_updateSub = "INSERT INTO bizlist (id_biz, id_user, biz_start, biz_end) VALUES ($new_ID, $id_user, '$biz_start', '$biz_end')";
	}
	
	if($conn->query($sql_updateSub) === TRUE){
				header("Location: dashboard.php?status=Successful Payment <br>Biz Subscription Activated!");
			} else { 
				//die($conn->error);
				header("Location: dashboard.php?status=Something went wrong, contact the Admin!");
			}
	//header("location: dashboard.php?status=Your Business Subscription was Successful!");
  } else {
  header("location: subscriptions.php?status=Payment was not successful!");
  }
?>