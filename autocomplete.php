<?php
session_start();

	$sessionFlag = $_SESSION['flag'];
if($sessionFlag == ""){
	header('Location:index.php');
}
$con = mysql_connect("localhost", "817046_dost01", "moviepass");
mysql_select_db("mhub_zymichost_moviedb");
if (!$con) {
	die('Could not connect: ' . mysql_error());
}
$q = $_GET['q'];
$sql = "SELECT name FROM movie WHERE name LIKE '%$q%' ORDER BY name";
$result = mysql_query($sql);
if ($result) {
	while ($row = mysql_fetch_array($result)) {
		echo $row['name'] . "\n";
	}
}
mysql_close($con);
?>
