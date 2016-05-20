<?php
session_start();
$sessionId = $_SESSION['flag'];
if($sessionId==""){
	header('Location:homeView.php');
}
    $movieId=$_GET['movieId'];
	$userId=$_GET['userId'];
	$con = mysql_connect("localhost", "817046_dost01", "moviepass");
	mysql_select_db("mhub_zymichost_moviedb", $con);
	$query = "UPDATE download SET approvedBy=3 WHERE movieId='$movieId' and userId='$userId'";
	$result = mysql_query($query);
	header('Location:movieUpdateView.php');
?>