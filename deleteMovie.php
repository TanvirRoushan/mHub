<?php
session_start();
	$sessionFlag = $_SESSION['flag'];
if($sessionFlag == ""){
	header('Location:index.php');
}
    $con = mysql_connect("localhost", "817046_dost01", "moviepass");
	mysql_select_db("mhub_zymichost_moviedb", $con);
	$entryId = $_GET['entryId'];
	$id = $_SESSION['id'];
	$query = "UPDATE entry SET deletedBy=$id WHERE entryId=$entryId";
	mysql_query($query);
	header('Location:manageMoviesView.php');
?>