<?php
session_start();
	$sessionFlag = $_SESSION['flag'];
if($sessionFlag == ""){
	header('Location:index.php');
}
$userFlag = $_SESSION['flag'];
//echo "user flag: ".$userFlag;
    $name = $_POST['wantName'];
	$link = $_POST['wantImdbLink'];
	$year = $_POST['wantYear'];
	$con = mysql_connect("localhost", "817046_dost01", "moviepass");
	$userId = $_SESSION['id'];
	$movieId;
	mysql_select_db("mhub_zymichost_moviedb", $con);
	$query = "INSERT INTO movie (name, imdbLink, year)VALUES('$name','$link','$year')";
	$result = mysql_query($query);
	$query = "SELECT movieId FROM movie where imdbLink='$link' and name='$name'";
	$result = mysql_query($query);
	if($result){
		if($rows = mysql_fetch_array($result)){
			$movieId = $rows['movieId'];
		}
	}
	$userFlag = $_SESSION['flag'];
	if($userFlag == 0){
	$query = "INSERT INTO want (userId, movieId)VALUES($userId, $movieId)";
		//echo "added non direct";
	}else{
		$query = "INSERT INTO want (userId, movieId, approvedBy)VALUES($userId, $movieId, 1)";
		//echo "added direct";
	}
	$result = mysql_query($query);
	if($result){
		//echo true;
	}
	header('Location:dashboardView.php');
?>