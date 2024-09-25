<?php require_once('db_conn.php'); ?>
<?php if (!isset($_SESSION['USERNAME'])) { ?>

	<div id="offer-box" class="row alert-box-container">
		<div class="offer-box">
			<div class="offer-box-title">Session has ended!<br />Please <a style='color:green'
					href='index.php?access=denied'>Re-Login</a></div>
			<span class="pop-closer" onclick="show_modal('none','offer')">[ X ]</span>
		</div>
	</div>

<?php } ?>

<?php
//Post New Advert
if (isset($_GET['origin']) && $_GET['origin'] == "postdata") {
	if (isset($_GET['q']) && $_GET['q'] != "") {
		$q = $_GET['q'];
		$a = $_GET['a'];
		if ($a == "CAT") {
			$table = "ad_category";
			$col = "cat_name";
			$order_col = "cat_sub";
		}
		if ($a == "LOC") {
			$table = "ad_location";
			$col = "loc_state";
			$order_col = "loc_city";
		}

		$sql_adCat = "SELECT * FROM " . $table . " WHERE " . $col . " ='" . $q . "' ORDER BY " . $order_col . " ASC";
		$adCat = $conn->query($sql_adCat);
		$row_adCat = $adCat->fetch_assoc();

		if ($a == "CAT") {
			$subcat = explode(",", $row_adCat['cat_sub']);
			$x = 0;
			echo "<select name='item_subcat' id='item_subcat' onchange='adDetail_show(this.value)'><option value='' selected>Sub Category</option>";
			while ($x < sizeof($subcat)) {
				$subcat_item = htmlspecialchars($subcat[$x]);
				echo "<option value='" . $subcat_item . "'>" . $subcat_item . "</option>";
				$x += 1;
			}
			echo "</select>";
		}

		if ($a == "LOC") {
			$subcat = explode(",", $row_adCat['loc_city']);
			$x = 0;
			echo "<select name='item_city' id='item_city'><option value='' selected>City</option>";
			while ($x < sizeof($subcat)) {
				echo "<option value='" . $subcat[$x] . "'>" . $subcat[$x] . "</option>";
				$x += 1;
			}
			echo "</select>";
		}

	}
} //Ends PostData Advert

//Edit Advert
if (isset($_GET['origin']) && $_GET['origin'] == "editdata") {
	if (isset($_GET['q']) && $_GET['q'] != "") {
		$q = $_GET['q'];
		$a = $_GET['a'];

		$aid = $_GET['aid'];
		$table = $_GET['t'];


		if ($a == "CAT") {
			$adtable = "ad_category";
			$col = "cat_name";
			$order_col = "cat_sub";
		}
		if ($a == "LOC") {
			$adtable = "ad_location";
			$col = "loc_state";
			$order_col = "loc_city";
		}

		$sql_adCat = "SELECT * FROM " . $adtable . " WHERE " . $col . " ='" . $q . "' ORDER BY " . $order_col . " ASC";
		$adCat = $conn->query($sql_adCat);
		$row_adCat = $adCat->fetch_assoc();

		if ($table == "adverts") {
			$sql_ad_page = "SELECT item_subcat, item_city FROM adverts WHERE id_ad=" . $aid;
			$ad_page = $conn->query($sql_ad_page);
			$row_ad_page = $ad_page->fetch_assoc();

			if ($ad_page->num_rows > 0) {

				if ($a == "CAT") {
					$subcat = explode(",", $row_adCat['cat_sub']);
					$x = 0;
					echo "<select name='item_subcat' id='item_subcat' onchange='adDetail_show(this.value)' onfocus='adDetail_show(this.value)'><option value='' selected>Sub Category</option>";
					while ($x < sizeof($subcat)) {
						$subcat_item = htmlspecialchars($subcat[$x]);
						echo "<option value='" . $subcat_item . "' ";

						if (!(strcmp($subcat_item, $row_ad_page['item_subcat']))) {
							echo "selected=\"selected\"";
						}

						echo ">" . $subcat_item . "</option>";
						$x += 1;
					}
					echo "</select>";
				}

				if ($a == "LOC") {
					$subcat = explode(",", $row_adCat['loc_city']);
					$x = 0;
					echo "<select name='item_city' id='item_city'><option value='' selected>City</option>";
					while ($x < sizeof($subcat)) {
						$city_item = htmlspecialchars($subcat[$x]);
						echo "<option value='" . $city_item . "' ";

						if (!(strcmp($city_item, $row_ad_page['item_city']))) {
							echo "selected=\"selected\"";
						}

						echo ">" . $city_item . "</option>";
						$x += 1;
					}
					echo "</select>";
				}
			}
		}

		if ($table == "users") {
			$sql_user = "SELECT user_city FROM users WHERE id_user=" . $aid;
			$user = $conn->query($sql_user);
			$row_user = $user->fetch_assoc();

			if ($user->num_rows > 0) {

				if ($a == "LOC") {
					$subcat = explode(",", $row_adCat['loc_city']);
					$x = 0;
					echo "<p>Your City</p> <select name='user_city' id='user_city'><option value='' selected>Your City</option>";
					while ($x < sizeof($subcat)) {
						$city_item = htmlspecialchars($subcat[$x]);
						echo "<option value='" . $city_item . "' ";

						if (!(strcmp($city_item, $row_user['user_city']))) {
							echo "selected=\"selected\"";
						}

						echo ">" . $city_item . "</option>";
						$x += 1;
					}
					echo "</select>";
				}
			}
		}

		if ($table == "bizlist") {
			$sql_bizData = "SELECT biz_city FROM bizlist WHERE id_user=" . $aid;
			$bizData = $conn->query($sql_bizData);
			$row_bizData = $bizData->fetch_assoc();

			if ($bizData->num_rows > 0) {

				if ($a == "LOC") {
					$subcat = explode(",", $row_adCat['loc_city']);
					$x = 0;
					echo "<select name='item_city' id='item_city'><option value='' selected>Your City</option>";
					while ($x < sizeof($subcat)) {
						$city_item = htmlspecialchars($subcat[$x]);
						echo "<option value='" . $city_item . "' ";

						if (!(strcmp($city_item, $row_bizData['biz_city']))) {
							echo "selected=\"selected\"";
						}

						echo ">" . $city_item . "</option>";
						$x += 1;
					}
					echo "</select>";
				}
			}
		}

		if ($table == "prolist") {
			$sql_proData = "SELECT pro_city FROM prolist WHERE id_user=" . $aid;
			$proData = $conn->query($sql_proData);
			$row_proData = $proData->fetch_assoc();

			if ($proData->num_rows > 0) {

				if ($a == "LOC") {
					$subcat = explode(",", $row_adCat['loc_city']);
					$x = 0;
					echo "<select name='item_city' id='item_city'><option value='' selected>Your City</option>";
					while ($x < sizeof($subcat)) {
						$city_item = htmlspecialchars($subcat[$x]);
						echo "<option value='" . $city_item . "' ";

						if (!(strcmp($city_item, $row_proData['pro_city']))) {
							echo "selected=\"selected\"";
						}

						echo ">" . $city_item . "</option>";
						$x += 1;
					}
					echo "</select>";
				}
			}
		}

	}
}

//Chat Message
if (isset($_GET['origin']) && $_GET['origin'] == "chat") {

	$username = $_GET["u"];
	$sql_user = "SELECT username, user_cat, full_name, id_user FROM users WHERE username='" . $username . "'";
	$user = $conn->query($sql_user);
	$row_user = $user->fetch_assoc();

	$id_chat = $_GET["c"];
	$sql_msg = "SELECT * FROM user_message WHERE id_chat='" . $id_chat . "'";
	$msg = $conn->query($sql_msg);
	$row_msg = $msg->fetch_assoc();

	$b_chat = explode("_", $id_chat);
	$id_buyer = $b_chat[1];
	$sql_buyer = "SELECT full_name FROM users WHERE id_user='" . $id_buyer . "'";
	$buyer = $conn->query($sql_buyer);
	$row_buyer = $buyer->fetch_assoc();

	$id_ad = $_GET["ia"];
	$sql_ad = "SELECT * FROM adverts WHERE id_ad='" . $id_ad . "'";
	$ad = $conn->query($sql_ad);
	$row_ad = $ad->fetch_assoc();


	function prep_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = str_replace("'", "\'", $data);
		return $data;
	}



	$Err = "";
	$id_chat = $visitor_msg = $id_ad = $id_sender = $status = $author_name = $sender_name = $ad_title = $receiver = "";
	$id_ad = prep_input($_GET["ia"]);
	$visitor_msg = prep_input($_GET["vm"]);


	if ($visitor_msg == NULL || $visitor_msg == " ") {
		$Err .= "Message is required!";
		header("Location: ../chat-page.php?aid=" . $id_ad . "&err=" . $Err);
	}

	if (empty($Err)) {

		$id_author = $row_ad["id_user"];
		$id_sender = $row_user["id_user"];
		$author_name = $row_ad["author_name"];
		$sender_name = $row_user["full_name"];
		if ($row_user["full_name"] == $row_ad["author_name"]) {
			$receiver = $row_buyer["full_name"];
		} else {
			$receiver = $row_ad["author_name"];
		}

		$ad_title = $row_ad["item_title"];
		$id_chat = $row_msg["id_chat"];

		$sql_user_msg = "INSERT INTO user_message (id_chat, id_ad, id_author, id_sender, author_name, sender_name, receiver, ad_title, visitor_msg)
					VALUES ('$id_chat', '$id_ad', '$id_author', '$id_sender', '$author_name', '$sender_name', '$receiver', '$ad_title', '$visitor_msg')";

		if ($conn->query($sql_user_msg) === TRUE) {
			$sql_chat = "SELECT * FROM user_message WHERE id_chat='" . $id_chat . "' ORDER BY id_msg ASC";
			$chat = $conn->query($sql_chat);
			if ($chat->num_rows > 0) {
				while ($row_chat = $chat->fetch_assoc()) {
					echo "<div class='chat-box row'><div><span ";
					if ($row_chat['id_sender'] == $row_user['id_user']) {
						echo "id='chat_right_box'";
					} else {
						echo "id='chat_left_box'";
					}
					echo ">" . $row_chat['visitor_msg'] . "</span></div></div>";
				}
			}

		} else {
			die($conn->error);
			//header("Location: ../adpage.php?aid=".$id_ad."&err=".$Err);
		}
	}

}
?>
<?php
//Personal, Professional, Business and Media Profiles settings display
if (isset($_REQUEST['sect'])) {

	if ($_REQUEST['sect'] == "biz_portfolio" || $_REQUEST['sect'] == "pro_portfolio") {

		$profile_title = $_REQUEST['id'];

		if ($_REQUEST['sect'] == "biz_portfolio") { ?>

			<div class="msg-box row" style="text-align:center;">
				<div style="font-size:14px; font-weight:bold; color:#999; padding:0 0 10px;">Business Portfolio</div>
				<div style="font-size:10px; color:#555; padding:0 0 10px;">Allowed Formats: jpg, jpeg, png, gif and mp4 only!</div>

				<form method="post" name="bizportImgForm" id="biz_portImgForm" enctype="multipart/form-data"
					action="<?php echo htmlspecialchars('inc/image_upload.php'); ?>">
					<input type="file" id="biz_portImg" name="files[]" onclick="showImageb()" onchange="showImage()" multiple
						hidden />

					<label for="biz_portImg" class="ad_img_label"><i class="fa fa-plus"></i><br /><span
							style="font-size:12px; font-weight:bold;">MEDIA</span>
					</label><span class="images" id="showImage"></span>
					<br /><br />
					<span for="profileImage"
						style="font-size:12px; color:#999; font-weight:bold; cursor:pointer; display:inline-block; padding:5px; margin:5px; border-radius:10px; border:1px solid #999;"
						onclick="biz_portImgForm()">Save Image/Video</span>
					<br /><br />
					<span class="images">
						<?php
						$imgspath = $root_dir . "businesses/" . $profile_title;
						$files = scandir($imgspath);
						$total = count($files);
						$images = array();
						for ($x = 0; $x < $total; $x++) {
							if ($files[$x] != '.' && $files[$x] != '..') {
								//$images[] = $files[$x]; ?>
								<div id="portimg_biz_<?php echo $x; ?>" style="display:inline-block; position:relative; text-align:center;">

									<?php
									$file_exp = explode('.', $files[$x]);
									$file_ext = end($file_exp);
									if ($file_ext == "mp4") { ?>
										<video width="90" height="60" src="<?php echo "businesses/" . $profile_title . "/" . $files[$x]; ?>"
											type="video/mp4"></video>
									<?php } else { ?>
										<img class='img' src='<?php echo "businesses/" . $profile_title . "/" . $files[$x]; ?>' height='60px'
											width='60px' />
									<?php } ?>

									<span
										onclick="delImg('<?php echo "businesses/" . $profile_title . "/" . $files[$x]; ?>', '<?php echo $x; ?>')"
										style="position:absolute; top:3px; left:3px; font-size:14px; color:#ff0000; font-weight:bold; cursor:pointer;">x</span>
								</div>
							<?php }
						} ?>
					</span>

					<input type="hidden" name="port_upload" value="bizImage" />
					<input type="hidden" name="biz_title" value="<?php echo $profile_title; ?>" />
				</form>
			</div>

		<?php }
		if ($_REQUEST['sect'] == "pro_portfolio") {
		}

	} else {

		$id_user = $_REQUEST['id'];
		$sql_user = "SELECT * FROM users WHERE id_user=" . $id_user;
		$user = $conn->query($sql_user);
		$row_user = $user->fetch_assoc();
	}
	//Media Directory Display	
	if ($_REQUEST['sect'] == "media") {

		$sql_pro = "SELECT pro_banner_desk, pro_banner_mob, pro_logo, id_user FROM prolist WHERE id_user=" . $id_user;
		$pro = $conn->query($sql_pro);
		$row_pro = $pro->fetch_assoc();

		$sql_biz = "SELECT biz_banner_desk, biz_banner_mob, biz_logo, id_user FROM bizlist WHERE id_user=" . $id_user;
		$biz = $conn->query($sql_biz);
		$row_biz = $biz->fetch_assoc();

		?>
		<div class="msg-box row" style="text-align:center;">
			<div style="font-size:14px; font-weight:bold; color:#999; padding:0 0 10px;">Profile Picture</div>
			<div style="font-size:10px; color:#555; padding:0 0 10px;">(400px by 400px, 500kb max size)</div>

			<form method="post" name="UserPic" id="UserPic" enctype="multipart/form-data"
				action="<?php echo htmlspecialchars('inc/image_upload.php'); ?>">
				<input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control"
					style="display: none;">
				<div onclick="triggerClick()"
					style="position:relative; margin:auto; border-radius:70px; border-bottom:1px solid rgba(0, 0, 0, 1); height:110px; width:110px;">
					<img src="images/users/<?php echo $row_user["user_pic"]; ?>" height="100px" width="100px"
						style="border-radius:70px; cursor:pointer;" id="profileDisplay" />
					<div id="p_img_update_link"
						style="position:absolute; bottom:15px; left:20px; margin:auto; padding:2px 5px; border-radius:10px; font-size:8px; color:#fff; background-color:#555; cursor:pointer;">
						Click To Update</div>
				</div>
				<input type="hidden" name="id_user" value="<?php echo $row_user["id_user"]; ?>" />
				<input type="hidden" name="username" value="<?php echo $row_user["username"]; ?>" />
				<input type="hidden" name="image_upload" value="profileImage" />
				<span for="profileImage"
					style="font-size:12px; color:#999; font-weight:bold; cursor:pointer; display:inline-block; padding:5px; margin:5px; border-radius:10px; border:1px solid #999;"
					onclick="User_Pic()">Save Image</span>
			</form>
		</div>

		<?php if ($pro->num_rows > 0) { ?>
			<div class="msg-box row" style="text-align:center;">
				<div style="font-size:16px; font-weight:bold; color:#999; padding:0 0 10px;">Professional Profile Images</div>

				<div style="font-size:10px; color:#555; padding:0 0 10px;"><strong>LOGO</strong> (400px by 400px, 500kb max size)
				</div>
				<form method="post" name="prologoPic" id="prologoPic" enctype="multipart/form-data"
					action="<?php echo htmlspecialchars('inc/image_upload.php'); ?>">
					<input type="file" name="prologoImage" onChange="displayImage_logo(this)" id="prologoImage" class="form-control"
						style="display: none;">
					<div onclick="triggerClick_logo()" style="position:relative; margin:auto; height:100px; width:100px;">
						<img src="images/pro/<?php echo $row_pro["pro_logo"]; ?>" height="100px" width="100px"
							style="cursor:pointer;" id="prologoDisplay" />
						<div id="p_img_update_link"
							style="position:absolute; bottom:5px; left:14px; margin:auto; padding:2px 5px; border-radius:10px; font-size:8px; color:#fff; background-color:#555; cursor:pointer;">
							Click To Update</div>
					</div>
					<input type="hidden" name="id_user" value="<?php echo $row_user["id_user"]; ?>" />
					<input type="hidden" name="username" value="<?php echo $row_user["username"]; ?>" />
					<input type="hidden" name="image_upload" value="prologoImage" />
					<span for="prologoImage"
						style="font-size:12px; color:#999; font-weight:bold; cursor:pointer; display:inline-block; padding:5px; margin:5px; border-radius:10px; border:1px solid #999;"
						onclick="pro_logoPic()">Save Image</span>
				</form>

				<div style="font-size:10px; color:#555; padding:10px;"><strong>Desktop Banner</strong> (1920px by 260px, 2mb max
					size)</div>
				<form method="post" name="prodeskPic" id="prodeskPic" enctype="multipart/form-data"
					action="<?php echo htmlspecialchars('inc/image_upload.php'); ?>">
					<input type="file" name="prodeskImage" onChange="displayImage_desk(this)" id="prodeskImage" class="form-control"
						style="display: none;">
					<div onclick="triggerClick_desk()" style="position:relative; margin:auto; height:43px; width:320px;">
						<img src="images/pro/<?php echo $row_pro["pro_banner_desk"]; ?>" height="43px" width="320px"
							style="cursor:pointer;" id="prodeskDisplay" />
						<div id="p_img_update_link"
							style="position:absolute; bottom:5px; left:125px; margin:auto; padding:2px 5px; border-radius:10px; font-size:8px; color:#fff; background-color:#555; cursor:pointer;">
							Click To Update</div>
					</div>
					<input type="hidden" name="id_user" value="<?php echo $row_user["id_user"]; ?>" />
					<input type="hidden" name="username" value="<?php echo $row_user["username"]; ?>" />
					<input type="hidden" name="image_upload" value="prodeskImage" />
					<span for="prologoImage"
						style="font-size:12px; color:#999; font-weight:bold; cursor:pointer; display:inline-block; padding:5px; margin:5px; border-radius:10px; border:1px solid #999;"
						onclick="pro_deskPic()">Save Image</span>
				</form>

				<div style="font-size:10px; color:#555; padding:10px;"><strong>Mobile Banner</strong> (600px by 320px, 1mb max size)
				</div>
				<form method="post" name="promobPic" id="promobPic" enctype="multipart/form-data"
					action="<?php echo htmlspecialchars('inc/image_upload.php'); ?>">
					<input type="file" name="promobImage" onChange="displayImage_mob(this)" id="promobImage" class="form-control"
						style="display: none;">
					<div onclick="triggerClick_mob()" style="position:relative; margin:auto; height:160px; width:300px;">
						<img src="images/pro/<?php echo $row_pro["pro_banner_mob"]; ?>" height="160px" width="300px"
							style="cursor:pointer;" id="promobDisplay" />
						<div id="p_img_update_link"
							style="position:absolute; bottom:5px; left:113px; margin:auto; padding:2px 5px; border-radius:10px; font-size:8px; color:#fff; background-color:#555; cursor:pointer;">
							Click To Update</div>
					</div>
					<input type="hidden" name="id_user" value="<?php echo $row_user["id_user"]; ?>" />
					<input type="hidden" name="username" value="<?php echo $row_user["username"]; ?>" />
					<input type="hidden" name="image_upload" value="promobImage" />
					<span for="prologoImage"
						style="font-size:12px; color:#999; font-weight:bold; cursor:pointer; display:inline-block; padding:5px; margin:5px; border-radius:10px; border:1px solid #999;"
						onclick="pro_mobPic()">Save Image</span>
				</form>

			</div>
		<?php } ?>

		<?php if ($biz->num_rows > 0) { ?>
			<div class="msg-box row" style="text-align:center;">
				<div style="font-size:16px; font-weight:bold; color:#999; padding:0 0 10px;">Business Profile Images</div>

				<div style="font-size:10px; color:#555; padding:0 0 10px;"><strong>LOGO</strong> (400px by 400px, 500kb max size)
				</div>
				<form method="post" name="bizlogoPic" id="bizlogoPic" enctype="multipart/form-data"
					action="<?php echo htmlspecialchars('inc/image_upload.php'); ?>">
					<input type="file" name="bizlogoImage" onChange="displayImage_logo_biz(this)" id="bizlogoImage"
						class="form-control" style="display: none;">
					<div onclick="triggerClick_logo_biz()" style="position:relative; margin:auto; height:100px; width:100px;">
						<img src="images/biz/<?php echo $row_biz["biz_logo"]; ?>" height="100px" width="100px"
							style="cursor:pointer;" id="bizlogoDisplay" />
						<div id="p_img_update_link"
							style="position:absolute; bottom:5px; left:14px; margin:auto; padding:2px 5px; border-radius:10px; font-size:8px; color:#fff; background-color:#555; cursor:pointer;">
							Click To Update</div>
					</div>
					<input type="hidden" name="id_user" value="<?php echo $row_user["id_user"]; ?>" />
					<input type="hidden" name="username" value="<?php echo $row_user["username"]; ?>" />
					<input type="hidden" name="image_upload" value="bizlogoImage" />
					<span for="bizlogoImage"
						style="font-size:12px; color:#999; font-weight:bold; cursor:pointer; display:inline-block; padding:5px; margin:5px; border-radius:10px; border:1px solid #999;"
						onclick="biz_logoPic()">Save Image</span>
				</form>

				<div style="font-size:10px; color:#555; padding:10px;"><strong>Desktop Banner</strong> (1920px by 260px, 2mb max
					size)</div>
				<form method="post" name="bizdeskPic" id="bizdeskPic" enctype="multipart/form-data"
					action="<?php echo htmlspecialchars('inc/image_upload.php'); ?>">
					<input type="file" name="bizdeskImage" onChange="displayImage_desk_biz(this)" id="bizdeskImage"
						class="form-control" style="display: none;">
					<div onclick="triggerClick_desk_biz()" style="position:relative; margin:auto; height:43px; width:320px;">
						<img src="images/biz/<?php echo $row_biz["biz_banner_desk"]; ?>" height="43px" width="320px"
							style="cursor:pointer;" id="bizdeskDisplay" />
						<div id="p_img_update_link"
							style="position:absolute; bottom:5px; left:125px; margin:auto; padding:2px 5px; border-radius:10px; font-size:8px; color:#fff; background-color:#555; cursor:pointer;">
							Click To Update</div>
					</div>
					<input type="hidden" name="id_user" value="<?php echo $row_user["id_user"]; ?>" />
					<input type="hidden" name="username" value="<?php echo $row_user["username"]; ?>" />
					<input type="hidden" name="image_upload" value="bizdeskImage" />
					<span for="bizlogoImage"
						style="font-size:12px; color:#999; font-weight:bold; cursor:pointer; display:inline-block; padding:5px; margin:5px; border-radius:10px; border:1px solid #999;"
						onclick="biz_deskPic()">Save Image</span>
				</form>

				<div style="font-size:10px; color:#555; padding:10px;"><strong>Mobile Banner</strong> (600px by 320px, 1mb max size)
				</div>
				<form method="post" name="bizmobPic" id="bizmobPic" enctype="multipart/form-data"
					action="<?php echo htmlspecialchars('inc/image_upload.php'); ?>">
					<input type="file" name="bizmobImage" onChange="displayImage_mob_biz(this)" id="bizmobImage"
						class="form-control" style="display: none;">
					<div onclick="triggerClick_mob_biz()" style="position:relative; margin:auto; height:160px; width:300px;">
						<img src="images/biz/<?php echo $row_biz["biz_banner_mob"]; ?>" height="160px" width="300px"
							style="cursor:pointer;" id="bizmobDisplay" />
						<div id="p_img_update_link"
							style="position:absolute; bottom:5px; left:113px; margin:auto; padding:2px 5px; border-radius:10px; font-size:8px; color:#fff; background-color:#555; cursor:pointer;">
							Click To Update</div>
					</div>
					<input type="hidden" name="id_user" value="<?php echo $row_user["id_user"]; ?>" />
					<input type="hidden" name="username" value="<?php echo $row_user["username"]; ?>" />
					<input type="hidden" name="image_upload" value="bizmobImage" />
					<span for="bizlogoImage"
						style="font-size:12px; color:#999; font-weight:bold; cursor:pointer; display:inline-block; padding:5px; margin:5px; border-radius:10px; border:1px solid #999;"
						onclick="biz_mobPic()">Save Image</span>
				</form>
			</div>
		<?php } ?>
	<?php } // Ends Media ?>

	<?php //Personal Profile Settings Display	
		if ($_REQUEST['sect'] == "personal") {

			$sql_userLoc = "SELECT * FROM ad_location ORDER BY loc_state ASC";
			$userLoc = $conn->query($sql_userLoc);

			$sql_cityLOCuser = "SELECT loc_city FROM ad_location ORDER BY loc_city ASC";
			$cityLOCuser = $conn->query($sql_cityLOCuser);
			$row_cityLOCuser = $cityLOCuser->fetch_assoc();
			?>
		<!-- Personal Details -->
		<div class="msg-box row">
			<div class="ad-msg-box-title">
				<h3><span style="text-transform:capitalize; padding:0 0 0 12px;"><i class="fa fa-user"></i> Personal
						Details</span></h3>
			</div>
			<form method="post" name="user_update" id="user_update"
				action="<?php echo htmlspecialchars('inc/action_page.php'); ?>" enctype="multipart/form-data">
				<div class="mini">
					<input type="text" name="fname" placeholder="First Name" value="<?php echo $row_user["fname"]; ?>"
						required />
					<input type="text" name="lname" placeholder="Last Name" value="<?php echo $row_user["lname"]; ?>"
						required />
				</div>
				<div class="mini">
					<?php if ($userLoc->num_rows > 0) { ?>
						<p>Your State</p> <select name="user_state" id="user_state" onchange="showData(this.value)"
							onfocus="showData(this.value)" required>
							<option value="" selected="selected">Your State</option>
							<?php while ($row_userLoc = $userLoc->fetch_assoc()) { ?>
								<option value="<?php echo $row_userLoc['loc_state'] . "_LOC_" . $row_user["id_user"]; ?>" <?php if (!(strcmp($row_user['user_state'], $row_userLoc['loc_state']))) {
									   echo "selected=\"selected\"";
								   } ?>>
									<span style="text-transform:uppercase;">
										<?php echo $row_userLoc['loc_state']; ?>
									</span></option>
							<?php }
					} ?>
					</select>

					<div id="subLOC">
						<?php if ($cityLOCuser->num_rows > 0) {
							$userCity = explode(",", $row_cityLOCuser["loc_city"]); ?>
							<p>Your City</p> <select name="user_city" id="user_city" required>
								<?php for ($x = 0; $x < count($userCity); $x++) { ?>
									<option value="<?php echo $userCity[$x]; ?>" <?php if (!(strcmp($userCity[$x], $row_user['user_city']))) {
										   echo "selected=\"selected\"";
									   } ?>><?php echo $userCity[$x]; ?>
									</option>
								<?php } ?>
							</select>
						<?php } ?>
					</div>

					<p>Your Birthday </p> <input type="date" name="user_DOB" value="<?php echo $row_user['user_DOB']; ?>"
						placeholder="Birthday" required />
					<p>Your Gender</p> <select name="user_sex">
						<option value="">Gender</option>
						<option value="Male" <?php if (!(strcmp('Male', $row_user['user_sex']))) {
							echo "selected=\"selected\"";
						} ?>>Male</option>
						<option value="Female" <?php if (!(strcmp('Female', $row_user['user_sex']))) {
							echo "selected=\"selected\"";
						} ?>>Female</option>
						<option value="Unspecified">Do not specify</option>
					</select>
					<input type="hidden" name="form_type" value="user_update" />
					<input type="hidden" name="id_user" value="<?php echo $row_user["id_user"]; ?>" />
				</div><input type="submit" name="user_update" value="Update Personal Details" style="margin-top:30px;" />
			</form>
		</div>
	<?php } //Ends Personal Profile Settings Display ?>

	<?php //Password Settings Display	
		if ($_REQUEST['sect'] == "password") {
			?>
		<!-- Change Password -->
		<div class="msg-box row">
			<div class="ad-msg-box-title">
				<h3><span style="text-transform:capitalize; padding:0 0 0 12px;"><i class="fa fa-key"></i> Update
						Password</span></h3>
			</div>
			<form method="post" name="password_update" id="password_update"
				action="<?php echo htmlspecialchars('inc/action_page.php'); ?>">

				<span style="position:relative;">
					<span id="eye3" style="position:absolute; top:70%; right:20px; color:#000;"><label for="showMe3"
							style="cursor:pointer;"><i class="fa fa-eye"></i></label></span>
					<input type="password" name="current_pass" id="password3" placeholder="Enter Current Password" required />
				</span>


				<span style="position:relative;">
					<span id="eye4" style="position:absolute; top:70%; right:20px; color:#000;"><label for="showMe4"
							style="cursor:pointer;"><i class="fa fa-eye"></i></label></span>
					<input type="password" name="new_pass" id="password4" placeholder="Enter New Password" required />
				</span>


				<span style="position:relative;">
					<span id="eye5" style="position:absolute; top:70%; right:20px; color:#000;"><label for="showMe5"
							style="cursor:pointer;"><i class="fa fa-eye"></i></label></span>
					<input type="password" name="conf_pass" id="password5" placeholder="Confirm New Password" required />
				</span>

				<input type="hidden" name="form_type" value="password_update" />
				<input type="hidden" name="id_user" value="<?php echo $row_user["id_user"]; ?>" />
				<input type="checkbox" id="showMe3" onClick="show_Pass('3')" style="visibility:hidden;" />
				<input type="checkbox" id="showMe4" onClick="show_Pass('4')" style="visibility:hidden;" />
				<input type="checkbox" id="showMe5" onClick="show_Pass('5')" style="visibility:hidden;" />
				<input type="submit" name="password_update" value="Update Password" style="margin-top:20px;" />
			</form>
		</div>
	<?php } //Ends Password Settings Display	?>

	<?php //Professional Profile Settings Display	
		if ($_REQUEST['sect'] == "pro") {
			$sql_proData = "SELECT * FROM prolist WHERE id_user='" . $row_user['id_user'] . "'";
			$proData = $conn->query($sql_proData);
			$row_proData = $proData->fetch_assoc();

			$p_aid = $row_proData['id_user'];

			$sql_proCat = "SELECT * FROM ad_category WHERE cat_list = 'pro' ORDER BY cat_name ASC";
			$proCat = $conn->query($sql_proCat);

			$sql_proLOC = "SELECT * FROM ad_location ORDER BY loc_state ASC";
			$proLOC = $conn->query($sql_proLOC);

			$sql_cityLOCpro = "SELECT loc_city FROM ad_location ORDER BY loc_city ASC";
			$cityLOCpro = $conn->query($sql_cityLOCpro);
			$row_cityLOCpro = $cityLOCpro->fetch_assoc();

			?>
		<!-- Professional Details -->
		<div class="msg-box row">
			<div class="ad-msg-box-title">
				<h3><span style="text-transform:capitalize; padding:0 0 0 12px;"><i class="fa fa-briefcase"></i> Professional
						Details</span></h3>
			</div>
			<form method="post" name="pro_data" id="pro_data" action="<?php echo htmlspecialchars('inc/action_page.php'); ?>"
				enctype="multipart/form-data">

				<?php if ($proCat->num_rows > 0) { ?>
					<select name="pro_cat" id="pro_cat" required required>
						<option value="" selected="selected">Service Category</option>
						<?php while ($row_proCat = $proCat->fetch_assoc()) { ?>
							<option value="<?php echo $row_proCat['cat_name']; ?>" <?php if (!(strcmp($row_proCat['cat_name'], $row_proData['pro_cat']))) {
								   echo "selected=\"selected\"";
							   } ?>><span style="text-transform:uppercase;">
									<?php echo $row_proCat['cat_name']; ?>
								</span></option>
						<?php } ?>
					</select>
				<?php } ?>


				<input type="text" name="pro_name" placeholder="Business Name" value="<?php echo $row_proData['pro_name']; ?>"
					required />
				<input type="text" name="pro_address" placeholder="Address" value="<?php echo $row_proData['pro_address']; ?>"
					required />

				<?php if ($proLOC->num_rows > 0) { ?>
					<div class="mini">
						<select name="pro_state" id="pro_state" onchange="showDataPro(this.value)" onfocus="showDataPro(this.value)"
							required>
							<option value="" selected="selected">State</option>
							<?php while ($row_proLOC = $proLOC->fetch_assoc()) { ?>
								<option value="<?php echo $row_proLOC['loc_state'] . "_LOC_" . $p_aid; ?>" <?php if (!(strcmp($row_proLOC['loc_state'], $row_proData['pro_state']))) {
									   echo "selected=\"selected\"";
								   } ?>>
									<span style="text-transform:uppercase;">
										<?php echo $row_proLOC['loc_state']; ?>
									</span></option>
							<?php }
				} ?>
					</select>
					<div id="proSubLOC">
						<?php if ($cityLOCpro->num_rows > 0) {
							$proCity = explode(",", $row_cityLOCpro["loc_city"]); ?>
							<select name="item_city" id="item_city" required>
								<?php for ($x = 0; $x < count($proCity); $x++) { ?>
									<option value="<?php echo $proCity[$x]; ?>" <?php if (!(strcmp($proCity[$x], $row_proData['pro_city']))) {
										   echo "selected=\"selected\"";
									   } ?>><?php echo $proCity[$x]; ?>
									</option>
								<?php } ?>
							</select>
						<?php } ?>
					</div>
				</div>

				<div class="mini">
					<input type="email" id="pro_email" name="pro_email"
						pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$"
						value="<?php echo $row_proData['pro_email']; ?>" placeholder="Professional Email" required>
					<input type="tel" id="pro_office_phone" name="pro_office_phone" pattern="[0-9]{11}"
						value="<?php echo $row_proData['pro_office_phone']; ?>" placeholder="Phone e.g. 08012345678" required />
					<input type="tel" id="pro_mobile_phone" name="pro_mobile_phone" pattern="[0-9]{11}"
						value="<?php echo $row_proData['pro_mobile_phone']; ?>" placeholder="Mobile e.g. 08012345678" />
					<input type="url" name="pro_website" value="<?php echo $row_proData['pro_website']; ?>"
						placeholder="Website e.g. http://probizlist.com" />
					<input type="hidden" name="form_type" value="pro_data" />
					<input type="hidden" name="id_user" value="<?php echo $row_user["id_user"]; ?>" />
					<input type="hidden" name="id_pro" value="<?php echo $row_proData["id_pro"]; ?>" />
					<input type="hidden" name="old_title" value="<?php echo $row_proData["pro_title"]; ?>" />
				</div>
				<textarea rows="7" name="pro_desc" placeholder="Enter Professional Services Description"
					required><?php echo $row_proData['pro_desc']; ?></textarea>
				<textarea rows="2" name="pro_service" placeholder="List of services, separated by comma..."
					required><?php echo $row_proData['pro_service']; ?></textarea>
				<div class="mini">
					<p>Year Established</p> <input type="number" name="pro_est_yr"
						value="<?php echo $row_proData['pro_est_yr']; ?>" required />
					<select name="no_of_employee" required>
						<option value="">No of Employee</option>
						<option value="1-10" <?php if (!(strcmp("1-10", $row_proData['no_of_employee']))) {
							echo "selected=\"selected\"";
						} ?>>1-10</option>
						<option value="11-50" <?php if (!(strcmp("11-50", $row_proData['no_of_employee']))) {
							echo "selected=\"selected\"";
						} ?>>11-50</option>
						<option value="51-200" <?php if (!(strcmp("51-200", $row_proData['no_of_employee']))) {
							echo "selected=\"selected\"";
						} ?>>51-200</option>
						<option value="Above 200" <?php if (!(strcmp("Above 200", $row_proData['no_of_employee']))) {
							echo "selected=\"selected\"";
						} ?>>Above 200</option>
					</select>
					<input type="text" name="pro_manager_name" value="<?php echo $row_proData['pro_manager_name']; ?>"
						placeholder="Manager Name" required />
				</div>
				<input type="submit" name="pro_data" value="Save Professional Details" style="margin-top:30px;" />
			</form>
		</div>

	<?php } //Ends Professional Profile Settings Display	?>

	<?php //Business Profile Settings Display	
		if ($_REQUEST['sect'] == "biz") {
			$sql_bizData = "SELECT * FROM bizlist WHERE id_user='" . $row_user['id_user'] . "'";
			$bizData = $conn->query($sql_bizData);
			$row_bizData = $bizData->fetch_assoc();

			$aid = $row_bizData['id_user'];
			$sql_bizCat = "SELECT * FROM ad_category WHERE cat_list = 'biz' ORDER BY cat_name ASC";
			$bizCat = $conn->query($sql_bizCat);

			$sql_bizLOC = "SELECT * FROM ad_location ORDER BY loc_state ASC";
			$bizLOC = $conn->query($sql_bizLOC);

			$sql_cityLOCbiz = "SELECT loc_city FROM ad_location ORDER BY loc_city ASC";
			$cityLOCbiz = $conn->query($sql_cityLOCbiz);
			$row_cityLOCbiz = $cityLOCbiz->fetch_assoc();
			?>
		<!-- Business Details -->
		<div class="msg-box row">
			<div class="ad-msg-box-title">
				<h3><span style="text-transform:capitalize; padding:0 0 0 12px;"><i class="fa fa-building"></i> Business
						Details</span></h3>
			</div>

			<div class="profile-btn">
				<button class="call-seller-btn" onclick="showMe('biz_portfolio','<?php echo $row_bizData['biz_title']; ?>')"><i
						class="fa fa-file-video-o"></i> Portfolio Media</button>
			</div>

			<form method="post" name="biz_data" id="biz_data" action="<?php echo htmlspecialchars('inc/action_page.php'); ?>"
				enctype="multipart/form-data">

				<?php if ($bizCat->num_rows > 0) { ?>
					<select name="biz_cat" id="biz_cat" required>
						<option value="" selected="selected">Service Category</option>
						<?php while ($row_bizCat = $bizCat->fetch_assoc()) { ?>
							<option value="<?php echo $row_bizCat['cat_name']; ?>" <?php if (!(strcmp($row_bizCat['cat_name'], $row_bizData['biz_cat']))) {
								   echo "selected=\"selected\"";
							   } ?>><span style="text-transform:uppercase;">
									<?php echo $row_bizCat['cat_name']; ?>
								</span></option>
						<?php }
				} ?>
				</select>

				<input type="text" name="biz_name" placeholder="Business Name" value="<?php echo $row_bizData['biz_name']; ?>"
					required />
				<input type="text" name="biz_address" placeholder="Full Address"
					value="<?php echo $row_bizData['biz_address']; ?>" required />

				<div class="mini">
					<input type="text" name="item_city" id="item_city" value="<?php echo $row_bizData['biz_city']; ?>"
						placeholder="Business City" required>
					<input type="text" name="biz_state" id="biz_state" value="<?php echo $row_bizData['biz_state']; ?>"
						placeholder="Business State" required>
					<input type="email" id="biz_email" name="biz_email"
						pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$"
						value="<?php echo $row_bizData['biz_email']; ?>" placeholder="Business Email" required>
					<input type="tel" id="biz_office_phone" name="biz_office_phone" pattern="[0-9]{11}"
						value="<?php echo $row_bizData['biz_office_phone']; ?>" placeholder="Phone e.g. 08012345678" required />
					<input type="tel" id="biz_mobile_phone" name="biz_mobile_phone" pattern="[0-9]{11}"
						value="<?php echo $row_bizData['biz_mobile_phone']; ?>" placeholder="Mobile e.g. 08012345678" />
					<input type="url" name="biz_website" value="<?php echo $row_bizData['biz_website']; ?>"
						placeholder="Website e.g. http://probizlist.com" />
					<input type="hidden" name="id_user" value="<?php echo $row_user["id_user"]; ?>" />
					<input type="hidden" name="id_biz" value="<?php echo $row_bizData["id_biz"]; ?>" />
					<input type="hidden" name="old_title" value="<?php echo $row_bizData["biz_title"]; ?>" />
				</div>

				<div style="position:relative;">
					<span class="fd_tt">Business Description</span><br />
					<textarea rows="7" name="biz_desc" placeholder="Enter Business Description"
						required><?php echo $row_bizData['biz_desc']; ?></textarea>
				</div>
				<div style="position:relative;">
					<span class="fd_tt">List of Services</span><br />
					<textarea rows="2" name="biz_service" placeholder="List of services, separated by comma..."
						required><?php echo $row_bizData['biz_service']; ?></textarea>
				</div>
				<div style="position:relative;">
					<span class="fd_tt">Search Keywords</span><br />
					<textarea rows="2" name="biz_keywords" placeholder="List of keywords, separated by comma..."
						required><?php echo $row_bizData['biz_keywords']; ?></textarea>
				</div>
				<div class="mini">
					<p>Business Reg. Type</p>
					<select name="biz_reg" required>
						<option value="">Select</option>
						<option value="registered" <?php if (!(strcmp("registered", $row_bizData['biz_reg']))) {
							echo "selected=\"selected\"";
						} ?>>Registered</option>
						<option value="unregistered" <?php if (!(strcmp("unregistered", $row_bizData['biz_reg']))) {
							echo "selected=\"selected\"";
						} ?>>Unregistered</option>
					</select>
				</div>
				<div class="mini">
					<p>Year Established</p> <input type="number" name="biz_est_yr"
						value="<?php echo $row_bizData['biz_est_yr']; ?>" required />
					<select name="no_of_employee" required>
						<option value="">No of Employee</option>
						<option value="1-10" <?php if (!(strcmp("1-10", $row_bizData['no_of_employee']))) {
							echo "selected=\"selected\"";
						} ?>>1-10</option>
						<option value="11-50" <?php if (!(strcmp("11-50", $row_bizData['no_of_employee']))) {
							echo "selected=\"selected\"";
						} ?>>11-50</option>
						<option value="51-200" <?php if (!(strcmp("51-200", $row_bizData['no_of_employee']))) {
							echo "selected=\"selected\"";
						} ?>>51-200</option>
						<option value="Above 200" <?php if (!(strcmp("Above 200", $row_bizData['no_of_employee']))) {
							echo "selected=\"selected\"";
						} ?>>Above 200</option>
					</select>
					<input type="text" name="biz_manager_name" value="<?php echo $row_bizData['biz_manager_name']; ?>"
						placeholder="Manager Name" required />
				</div>

				<div class="mini row">
					<div style="position:relative;">
						<span class="fd_tt_mini">Business Vision</span><br />
						<textarea rows="4" name="biz_vision"
							placeholder="Enter Business Vision"><?php echo $row_bizData['biz_vision']; ?></textarea>
					</div>
					<div style="position:relative;">
						<span class="fd_tt_mini_2">Business Mission</span>
						<textarea rows="4" name="biz_mission"
							placeholder="Enter Business Mission"><?php echo $row_bizData['biz_mission']; ?></textarea>
					</div>
				</div>

				<div class="mini row">
					<div style="position:relative;">
						<span class="fd_tt_mini">Experience</span><br />
						<textarea rows="4" name="biz_expr"
							placeholder="Enter Experience"><?php echo $row_bizData['biz_expr']; ?></textarea>
					</div>
					<div style="position:relative;">
						<span class="fd_tt_mini_2">Core Values</span>
						<textarea rows="4" name="biz_cvalue"
							placeholder="Enter Your Core Values"><?php echo $row_bizData['biz_cvalue']; ?></textarea>
					</div>
				</div>

				<div style="position:relative;">
					<span class="fd_tt">Events</span><br />
					<textarea rows="4" name="biz_event"
						placeholder="Enter Your Event"><?php echo $row_bizData['biz_event']; ?></textarea>
				</div>
				<div class="mini row">

					<span style="position:relative;">
						<span class="fd_tt_b">Social Media Pages</span><br />
						<input type="url" name="biz_facebook" value="<?php echo $row_bizData['biz_facebook']; ?>"
							value="https://facebook.com/" placeholder="https://facebook.com/"
							pattern="[Hh][Tt][Tt][Pp][Ss]?:\/\/(?:(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)(?:\.(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)*(?:\.(?:[a-zA-Z\u00a1-\uffff]{2,}))(?::\d{2,5})?(?:\/[^\s]*)?" />
					</span>
					<input type="url" name="biz_twitter" value="<?php echo $row_bizData['biz_twitter']; ?>"
						value="https://twitter.com/" placeholder="https://twitter.com/"
						pattern="[Hh][Tt][Tt][Pp][Ss]?:\/\/(?:(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)(?:\.(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)*(?:\.(?:[a-zA-Z\u00a1-\uffff]{2,}))(?::\d{2,5})?(?:\/[^\s]*)?" />
					<input type="url" name="biz_google" value="<?php echo $row_bizData['biz_google']; ?>"
						value="https://snapchat.com/" placeholder="https://snapchat.com/"
						pattern="[Hh][Tt][Tt][Pp][Ss]?:\/\/(?:(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)(?:\.(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)*(?:\.(?:[a-zA-Z\u00a1-\uffff]{2,}))(?::\d{2,5})?(?:\/[^\s]*)?" />
					<input type="url" name="biz_youtube" value="<?php echo $row_bizData['biz_youtube']; ?>"
						value="https://youtube.com/" placeholder="https://youtube.com/"
						pattern="[Hh][Tt][Tt][Pp][Ss]?:\/\/(?:(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)(?:\.(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)*(?:\.(?:[a-zA-Z\u00a1-\uffff]{2,}))(?::\d{2,5})?(?:\/[^\s]*)?" />
					<input type="url" name="biz_tiktok" value="<?php echo $row_bizData['biz_tiktok']; ?>"
						value="https://whatsapp.com/" placeholder="https://whatsapp.com/"
						pattern="[Hh][Tt][Tt][Pp][Ss]?:\/\/(?:(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)(?:\.(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)*(?:\.(?:[a-zA-Z\u00a1-\uffff]{2,}))(?::\d{2,5})?(?:\/[^\s]*)?" />
					<input type="url" name="biz_instagram" value="<?php echo $row_bizData['biz_instagram']; ?>"
						value="https://instagram.com/" placeholder="https://instagram.com/"
						pattern="[Hh][Tt][Tt][Pp][Ss]?:\/\/(?:(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)(?:\.(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)*(?:\.(?:[a-zA-Z\u00a1-\uffff]{2,}))(?::\d{2,5})?(?:\/[^\s]*)?" />
				</div>
				<input type="hidden" name="form_type" value="biz_data" />
				<input type="hidden" name="biz_gallery" value="" />

				<input type="submit" name="biz_data" value="Save Business Details" style="margin-top:30px;" />
			</form>
		</div>
	<?php } //Ends Business Profile Settings Display	?>

<?php } // Ends //Personal, Professional, Business and Media Profiles settings display  ?>