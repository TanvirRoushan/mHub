<?php
session_start();

	$sessionFlag = $_SESSION['flag'];
if($sessionFlag == ""){
	header('Location:index.php');
}
$id = $_GET['userId'];
$con = mysql_connect("localhost", "817046_dost01", "moviepass");
$selecteddatabase = mysql_select_db("mhub_zymichost_moviedb", $con);
$query = "UPDATE user SET flag=0 WHERE userId=$id";
$result = mysql_query($query);
if ($result) {
	//echo $entryId."</br>".$id;
	header('Location:manageMembersView.php');
} else {
	echo "not done";
}
?>