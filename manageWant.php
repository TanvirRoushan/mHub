<?php
    session_start();
	$sessionFlag = $_SESSION['flag'];
if($sessionFlag == ""){
	header('Location:index.php');
}
	$movieId = $_GET['movieId'];
	$userId = $_GET['userId'];
	$con = mysql_connect("localhost", "817046_dost01", "moviepass");
	mysql_select_db("mhub_zymichost_moviedb", $con);
	$query = "UPDATE want SET approvedBy=2 WHERE movieId='$movieId' and userId='$userId'";
	mysql_query($query);
	header('Location:manageMoviesView.php');
?>