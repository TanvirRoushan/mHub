<?php
    session_start();
	$sessionFlag = $_SESSION['flag'];
if($sessionFlag == ""){
	header('Location:index.php');
}
    $name = $_POST['downloadName'];
	$link = $_POST['downloadImdbLink'];
	$year = $_POST['downloadYear'];
	//echo $name;
	//echo $link;
	//echo $year;
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
	if($userFlag==0){
	$query = "INSERT INTO download (userId, movieId)VALUES($userId, $movieId)";
	}else{
		$query = "INSERT INTO download (userId, movieId, approvedBy)VALUES($userId, $movieId,1)";
	}
	$result = mysql_query($query);
	if($result){
		//echo true;
	}
	header('Location:dashboardView.php');
?>