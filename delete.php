<?php
session_start();
	$sessionFlag = $_SESSION['flag'];
if($sessionFlag == ""){
	header('Location:index.php');
}
$sessionFlag = $_SESSION['flag'];;
if($sessionFlag!=1){
	session_destroy();
	header('Location:index.php');
}

$entryId = $_GET['entryId'];
$con = mysql_connect("localhost", "817046_dost01", "moviepass");
$selecteddatabase = mysql_select_db("mhub_zymichost_moviedb", $con);
$id = $_SESSION['id'];
$query = "UPDATE entry SET deletedBy='$id' WHERE entryId='$entryId'";
$result = mysql_query($query);
if($result){
	//echo $entryId."</br>".$id;
	header('Location:dashboardView.php');
}else{
	echo "not done";
}
?>