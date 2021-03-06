<?php
ob_start();
session_start();
error_reporting(0);
include("../../includes/config.php");
$db = new mysqli($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
$db->set_charset("utf8");
$settingsQuery = $db->query("SELECT * FROM ec_settings ORDER BY id DESC LIMIT 1");
$settings = $settingsQuery->fetch_assoc();
include("../../includes/functions.php");
$from = protect($_GET['from']);
$to = protect($_GET['to']);
$query = $db->query("SELECT * FROM ec_currencies WHERE currency_from='$from' and currency_to='$to'");
if($query->num_rows>0) {
	$row = $query->fetch_assoc();
	echo $row['rate_from']." ".$row['currency_from']." = ".$row['rate_to']." ".$row['currency_to'];
} else {
	echo 'Undefined';
}
?>