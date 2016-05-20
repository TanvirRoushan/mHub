<?php
session_start();
if (isset($_POST['submit_entry'])) {
	$movieTitle = $_POST['movieTitle'];
	$movieLink = $_POST['movieLink'];
	$movieYear = $_POST['movieYear'];
	$userId = $_SESSION['id'];
	//echo $movieTitle . " " . $movieLink . " " . $movieYear;

	$con = mysql_connect("localhost", "817046_dost01", "moviepass");
	mysql_select_db("mhub_zymichost_moviedb", $con);
	$query = "INSERT INTO movie (name, imdbLink, year) VALUES('$movieTitle','$movieLink','$movieYear')";
	$queryResult = mysql_query($query);
	$query = "SELECT movieId FROM movie WHERE imdbLink='$movieLink'";
	$queryResult = mysql_query($query);
	$movieId = 0;
	$entryId = 0;
	
	if ($queryResult) {
		if ($rows = mysql_fetch_array($queryResult)) {
			$movieId = $rows['movieId'];
			//echo "movieId ".$movieId;
		}
	}
	$size = $_POST['movieSize'];
	$format = $_POST['movieFormat'];
	$resolution = $_POST['movieResolution'];
	$rip = $_POST['filetype'];
	if ($rip == 'ot') {
		//echo "inserted";
		$rip = $_POST['otherFT'];
	}
	//echo "</br>" . $size . " " . $format . " " . $resolution . " " . $rip;
	if($_SESSION['flag']!=0){
	$query = "INSERT INTO entry (size, format, resolution, rip, movieId, userId, approvedBy) VALUES('$size','$format','$resolution','$rip', '$movieId', '$userId', '$_SESSION[id]')";
	$queryResult = mysql_query($query);

	$query = "SELECT entryId FROM entry WHERE size='$size' AND format='$format' AND resolution='$resolution' AND rip='$rip' AND movieId='$movieId' ";
	$queryResult = mysql_query($query);
	if($queryResult){
		while($rows = mysql_fetch_array($queryResult)){
			$entryId = $rows['entryId'];
		}
	}
	}else{
		$query = "INSERT INTO entry (size, format, resolution, rip, movieId, userId) VALUES('$size','$format','$resolution','$rip', '$movieId', '$userId')";
	$queryResult = mysql_query($query);

	$query = "SELECT entryId FROM entry WHERE size='$size' AND format='$format' AND resolution='$resolution' AND rip='$rip' AND movieId='$movieId' ";
	$queryResult = mysql_query($query);
	if($queryResult){
		while($rows = mysql_fetch_array($queryResult)){
			$entryId = $rows['entryId'];
		}
	}
	}
	
	
	//echo "userId: ".$userId.",movieId: ".$movieId."entryId: ".$entryId;
	$query = "INSERT INTO has (userId, movieId, entryId) VALUES('$userId','$movieId','$entryId')";
	$queryResult = mysql_query($query);
	header('Location:homeView.php');
}
?>