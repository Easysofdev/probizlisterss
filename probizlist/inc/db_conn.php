<?php

$servername = "localhost";
$username = "wechujfx_probizlist_user";
$password = "hZ2Fxm#1]a{r";
$dbname = "wechujfx_probizlist";

/*
$servername = "localhost";
$username = "wechujfx_probizlist_user";
$password = "hZ2Fxm#1]a{r";
$dbname = "wechujfx_probizlist";
*/
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > 1800) {
    // session started more than 30 minutes ago
    session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
    $_SESSION['CREATED'] = time();  // update creation time
}

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

//$site_domain = "https://probizlist.com/";
//$root_dir = "/home/wechujfx/probizlist.com/";

$site_domain = "http://localhost/probizlist/";
$root_dir = "C:\wamp64\www\probizlist\/";
?>
