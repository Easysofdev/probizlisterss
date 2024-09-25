<?php require_once('db_conn.php'); ?>
<?php if ($_SESSION["USERGROUP"] != 'admin' AND $_SESSION["USERGROUP"] != 'admin_listing') { ?>

	<div id="offer-box" class="row alert-box-container">
		<div class="offer-box">
			<div class="offer-box-title">Session has ended!<br />Please <a style='color:green'
					href='index.php?access=denied'>Re-Login</a></div>
			<span class="pop-closer" onclick="show_modal('none','offer')">[ X ]</span>
		</div>
	</div>

<?php } ?>

<?php
if (isset($_REQUEST["token"]) && $_REQUEST["token"] == "u_search") {
	if (isset($_REQUEST['q']) && (strlen($_REQUEST['q']) > 1) && $_REQUEST['q'] != "") {
		$rsParam = $conn->real_escape_string($_REQUEST['q']);

		$sql_userResult = "SELECT id_user, full_name, username FROM users WHERE username LIKE '%" . $rsParam . "%' OR full_name LIKE '%" . $rsParam . "%'";
		$userResult = $conn->query($sql_userResult);

		?>
		<?php if ($userResult->num_rows > 0) { ?>
			<?php while ($row_userResult = $userResult->fetch_assoc()) { ?>

				<div class="searchR" onclick="showArea('users','<?php echo $row_userResult["id_user"]; ?>')">
					<span style="font-size:1.7vh; font-style:italic; color:#999;">NAME: </span>
					<?php echo $row_userResult["full_name"]; ?> <span style="font-size:1.7vh; font-style:italic; color:#999;">ID:
					</span>
					<?php echo $row_userResult["username"]; ?>
				</div>

			<?php } ?>
		<?php } else { ?>

			<div class="searchR">
				<span style="font-size:1.7vh; font-style:italic; color:#999;">No record for the name!</span>
			</div>

		<?php }
	}
} ?>


<?php
if (isset($_REQUEST["str"])) {
	if ($_REQUEST["str"] == "users") {
		if (isset($_REQUEST["id"]) && $_REQUEST["id"] != "none") {
			$id_user = $_REQUEST["id"];
			$sql_users = "SELECT id_user, username, user_status, pro_status, biz_status, reg_date, email, phone FROM users WHERE id_user =" . $id_user . " AND username <> 'abicom'";
		} else {
			if($_SESSION['USERGROUP'] == "admin_listing"){
				$ref_by = $_SESSION["USERNAME"];
				$sql_users = "SELECT id_user, username, user_status, pro_status, biz_status, reg_date, email, phone FROM users WHERE ref_by = '$ref_by' AND user_cat <> 'admin' ORDER BY id_user DESC";
			} else {
				$sql_users = "SELECT id_user, username, user_status, pro_status, biz_status, reg_date, email, phone FROM users WHERE user_cat <> 'admin' ORDER BY id_user DESC";
			}
		}
		$users = $conn->query($sql_users);
		?>

		<div style="vertical-align:middle; text-align:center; margin:10px 0 0;">
			<input name="uname" type="text" id="uname" size="30" onkeyup="processLive(this.value,'u_search')" style="width:90%"
				placeholder="Search User By Name" required />
			<div id="pd_search" style="width:90%; margin:auto; text-align:left;"></div>
		</div>

		<table>
			<tr>
				<th>USERS</th>
				<th>REG.DATE</th>
				<th>STATUS</th>
				<th>ACTION</th>
			</tr>
			<?php
			if ($users->num_rows > 0) {
				$i = 1;
				while ($row_users = $users->fetch_assoc()) {

					$sql_proStatus = "SELECT pro_sub_status, pro_start, pro_end FROM prolist WHERE id_user=" . $row_users['id_user'];
					$proStatus = $conn->query($sql_proStatus);
					$row_proStatus = $proStatus->fetch_assoc();

					$sql_bizStatus = "SELECT biz_sub_status, biz_start, biz_end FROM bizlist WHERE id_user=" . $row_users['id_user'];
					$bizStatus = $conn->query($sql_bizStatus);
					$row_bizStatus = $bizStatus->fetch_assoc();
					?>


					<tr>
						<td><span class="no_break" style="font-weight:bold; text-transform:uppercase; cursor:pointer;"
								onclick="alartMe('user_profile','User Profile','<?php echo $row_users["id_user"]; ?>')"><?php echo $i . " " . $row_users['username']; ?></span></td>
						<td><span class="no_break">
								<?php $regD = explode(" ", $row_users['reg_date']);
								echo $regD[0]; ?>
							</span></td>
						<td>
							<?php echo $row_users['user_status']; ?>
						</td>
						<td><span style="display:inline-block;">
								<select id="action_<?php echo $row_users["id_user"]; ?>"
									onchange="alartMe('admin','','<?php echo $row_users['id_user']; ?>')" name="userAction">
									<option value="">SELECT</option>
									<option value="ACTIVATE">Activate</option>
									<?php if($_SESSION['USERGROUP'] == 'admin'){ ?>
										<option value="DEACTIVATE">Deactivate</option>
										<option value="UPGRADE To ADMIN">Make Admin</option>
										<option value="UPGRADE To ADMIN LISTING">Make Listing Manager</option>
										<?php if ($_SESSION["USERNAME"] == "abicom") { ?>
											<option value="DELETE">Delete</option>
										<?php } ?>
									<?php } ?>
								</select></span></td>
					</tr>
					<tr>
						<td colspan="2"><span style="display:inline-block; padding:10px 0;"><i class="fa fa-envelope"
									title="Email:"></i><br />
								<?php echo wordwrap($row_users['email'], 20, "<br />\n", true); ?>
							</span></td>
						<td><i class="fa fa-phone" title="Tel:"></i><br />
							<?php echo $row_users['phone']; ?>
						</td>
						<td>&nbsp;</td>
					</tr>
					<?php $i++;
				}
			} ?>
		</table>
	<?php }

if ($_REQUEST["str"] == "bizlist") {
	$id_user = $_REQUEST["id"];

	if($_SESSION['USERGROUP'] == "admin_listing"){
		$ref_by = $_SESSION["USERNAME"];
		$sql_biz = "SELECT bizlist.id_user, bizlist.id_biz, bizlist.biz_name, bizlist.biz_reg_date, bizlist.verify_status, bizlist.biz_office_phone, bizlist.biz_email FROM bizlist INNER JOIN users ON bizlist.id_user = users.id_user WHERE ref_by = '$ref_by' ORDER BY id_biz";
	} else {
		$sql_biz = "SELECT id_user, id_biz, biz_name, biz_reg_date, verify_status, biz_office_phone, biz_email FROM bizlist ORDER BY id_biz";
	}
	
	$biz = $conn->query($sql_biz);
	?>

	<div style="vertical-align:middle; text-align:center; margin:10px 0 0;">
		<input name="uname" type="text" id="uname" size="30" onkeyup="processLive(this.value,'u_search')" style="width:90%"
			placeholder="Search User By Name" required />
		<div id="pd_search" style="width:90%; margin:auto; text-align:left;"></div>
	</div>

	<table>
		<tr>
			<th>Business Name</th>
			<th>REG.DATE</th>
			<th>STATUS</th>
			<th>ACTION</th>
		</tr>
		<?php
		if ($biz->num_rows > 0) {
			$i = 1;
			while ($row_biz = $biz->fetch_assoc()) {

				$sql_bizStatus = "SELECT biz_sub_status, biz_start, biz_end FROM bizlist WHERE id_user=" . $row_biz['id_user'];
				$bizStatus = $conn->query($sql_bizStatus);
				$row_bizStatus = $bizStatus->fetch_assoc();
				?>


				<tr>
					<td><span class="no_break" style="font-weight:bold; text-transform:uppercase; cursor:pointer;"
							onclick="alartMe('user_profile','User Profile','<?php echo $row_biz["id_user"]; ?>')"><?php echo $i . " " . $row_biz['biz_name']; ?></span></td>
					<td><span class="no_break">
							<?php $regD = explode(" ", $row_biz['biz_reg_date']);
							echo $regD[0]; ?>
						</span></td>
					<td>
						<?php if($row_biz['verify_status'] == 1){echo "Verified";}else{echo "Unverified";} ?>
					</td>
					<td><span style="display:inline-block;">
							<select id="action_<?php echo $row_biz["id_user"]; ?>"
								onchange="alartMe('admin','','<?php echo $row_biz["id_user"]; ?>')" name="userAction">
								<option value="">SELECT</option>
								<option value="VERIFY">Verify Biz</option>
								<?php if ($_SESSION["USERNAME"] == "abicom") { ?>
									<!--<option value="DELETE">Delete</option>-->
								<?php } ?>
							</select></span></td>
				</tr>
				<tr>
					<td colspan="2"><span style="display:inline-block; padding:10px 0;"><i class="fa fa-envelope"
								title="Email:"></i><br />
							<?php echo wordwrap($row_biz['biz_email'], 20, "<br />\n", true); ?>
						</span></td>
					<td><i class="fa fa-phone" title="Tel:"></i><br />
						<?php echo $row_biz['biz_office_phone']; ?>
					</td>
					<td><!--Subscription:--><br />

						<?php
						$date1 = date_create($row_bizStatus['biz_start']);
						$date2 = date_create($row_bizStatus['biz_end']);
						$diff = date_diff($date1, $date2);
						if ($diff->format("%R%a") > 0) {
							?><!--<span class="spot_b">B</span>-->
						<?php } ?>
					</td>
				</tr>
				<?php $i++;
			}
		} ?>
	</table>
<?php }

if ($_REQUEST["str"] == "admin") {
		$sql_admin = "SELECT id_user, username, user_status, reg_date, email, phone FROM users WHERE user_cat = 'admin' AND username <> 'abicom' OR user_cat = 'admin_listing' AND username <> 'abicom' ORDER BY id_user DESC LIMIT 20";
		$admin = $conn->query($sql_admin);
		?>
		<table>
			<tr>
				<th>ADMIN</th>
				<th>REG.DATE</th>
				<th>STATUS</th>
				<th>ACTION</th>
			</tr>
			<?php
			if ($admin->num_rows > 0) {
				while ($row_admin = $admin->fetch_assoc()) {
					$sql_proStatus = "SELECT pro_sub_status FROM prolist WHERE id_user=" . $row_admin['id_user'];
					$proStatus = $conn->query($sql_proStatus);
					$row_proStatus = $proStatus->fetch_assoc();

					$sql_bizStatus = "SELECT biz_sub_status FROM bizlist WHERE id_user=" . $row_admin['id_user'];
					$bizStatus = $conn->query($sql_bizStatus);
					$row_bizStatus = $bizStatus->fetch_assoc(); ?>

					<tr>
						<td><span style="font-weight:bold; text-transform:uppercase; cursor:pointer;"
								onclick="alartMe('user_profile','User Profile','<?php echo $row_admin["id_user"]; ?>')"><?php echo $row_admin['username']; ?></span></td>
						<td><span class="no_break">
								<?php $regD = explode(" ", $row_admin['reg_date']);
								echo $regD[0]; ?>
							</span></td>
						<td>
							<?php echo $row_admin['user_status']; ?>
						</td>
						<td><span style="display:inline-block;">

								<select id="action_<?php echo $row_admin["id_user"]; ?>"
									onchange="alartMe('admin','','<?php echo $row_admin["id_user"]; ?>')" name="userAction">
									<option value="">SELECT</option>
									<option value="ACTIVATE">Activate</option>
									<option value="DEACTIVATE">Deactivate</option>
									<option value="DOWNGRADE">Remove Admin</option>
									<?php if ($_SESSION["USERNAME"] == "abicom") { ?>
										<option value="DELETE">Delete</option>
									<?php } ?>
								</select>

							</span></td>
					</tr>
					<tr>
						<td>Subscription:<br />
						</td>
						<td colspan="2"><span style="display:inline-block; padding:10px 0;"><i class="fa fa-envelope"
									title="Email:"></i><br />
								<?php echo wordwrap($row_admin['email'], 20, "<br />\n", true); ?>
							</span></td>
						<td><i class="fa fa-phone" title="Tel:"></i><br />
							<?php echo $row_admin['phone']; ?>
						</td>
					</tr>
				<?php }
			} ?>
		</table>
	<?php } ?>

<?php } ?>
<?php $conn->close(); ?>