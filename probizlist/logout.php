<?php
// *** Logout the current user.
$logoutGoTo = "index.php";
if (!isset($_SESSION)) {
  session_start();
}
$_SESSION['USERNAME'] = NULL;
$_SESSION['USERGROUP'] = NULL;
unset($_SESSION['USERNAME']);
unset($_SESSION['USERGROUP']);
if ($logoutGoTo != "") {header("Location: $logoutGoTo");
exit;
}
?>