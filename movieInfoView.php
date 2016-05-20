<?php
session_start();
if ($_SESSION['id'] == "") {
	header("Location:index.php");
}
$movieName;
$imdbLink;
$year;
$size;
$format;
$resolution;
$rip;
$toWhom;
$emailAddress;
$selectedMovie = $_GET['movieId'];
$con = mysql_connect("localhost", "817046_dost01", "moviepass");
mysql_select_db("mhub_zymichost_moviedb", $con);
$query = "select name, imdbLink, year from movie where movieId=$selectedMovie";
$result = mysql_query($query);
if ($result) {
	while ($rows = mysql_fetch_array($result)) {
		$movieName = $rows['name'];
		$imdbLink = $rows['imdbLink'];
		$year = $rows['year'];
	}
}

//echo $selectedMovie;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>M~Hub | <?php echo $movieName; ?></title>
		<meta name="author" content="Tanvir" />
                <link rel="shortcut icon" href="images/icon.ico" >
		<link rel="stylesheet" type="text/css" href="css/blueprint/blueprint/ie.css"/>
		<link rel="stylesheet" type="text/css" href="css/blueprint/blueprint/screen.css"/>
		<link rel="stylesheet" type="text/css" href="css/blueprint/blueprint/plugins/buttons/screen.css"/>
		<link rel="stylesheet" type="text/css" href="css/blueprint/blueprint/src/forms.css"/>
		<link rel="stylesheet" type="text/css" href="css/custom.css"/>
		<link rel="stylesheet" type="text/css" href="css/nav.css">
		<style type="text/css"></style>
	</head>
	<body>
		<div class="container maincontainer">
			<div class="span-24   head">
				<img  src="images/header.jpg" alt="Banner">
			</div>
			<div class="span-24  menu">
				<script>
					var el = document.getElementsByTagName("body")[0];
					el.className = "";

				</script>
				<nav id="topNav">
					<ul>
						 <li><a href="profilePageView.php" title="Profile"> Welcome <?php echo $_SESSION['firstName']?></a></li>
						<li><a href="homeView.php" title="Home Page">Home</a></li>
						<li><a href="dashboardView.php" title="My Dashboard">Dashboard</a></li>
						<li><a href="contactView.php" title="About Us">About</a></li>
						<?php 
						$flag = $_SESSION['flag'];
						if($flag == 1){
						 ?>
						<li><a href="adminPanelView.php" title="Admin">Admin Panel</a></li>
						<?php } ?>
						<li><a href="logout.php" name="logoutbutton" title="Logout">Logout</a></li>
					</ul>
				</nav>
				<div class="content"></div>
				<script src="scripts/jquery.js"></script>
				<script src="scripts/modernizr.js"></script>
			</div>
			<script>
				(function($) {
					var nav = $("#topNav");
					nav.find("li").each(function() {
						if ($(this).find("ul").length > 0) {
							$("<span>").text("^").appendTo($(this).children(":first"));
							$(this).mouseenter(function() {
								$(this).find("ul").stop(true, true).slideDown();
							});
							$(this).mouseleave(function() {
								$(this).find("ul").stop(true, true).slideUp();
							});
						}
					});
				})(jQuery);

			</script>
			<div class="span-1">
				.
			</div>
			<div class="span-21 entryDetail">
				<span class="span-9 info push-1 signindiv"> <label for="dummy1"><h2>Movie Detail</h2></label>
					<table>
						<tr>
							<td>Name:</td>
							<td><?php echo $movieName; ?></td>
						</tr>
						<tr>
							<td>IMDb link:</td>
							<td><a id="link" target="_blank" href="<?php echo $imdbLink; ?>"><?php echo $imdbLink; ?></a></td>
						</tr>
						<tr>
							<td>Rating:</td>
							<td id="rating"></td>
						</tr>
						<tr>
							<td>Year:</td>
							<td><label><?php echo $year; ?></label></td>
						</tr>
						<tr>
							<td>Genre:</td>
							<td id="genre"></td>
						</tr>
						<tr>
							<td>Cast:</td>
							<td id="cast"></td>
						</tr>
						<tr>
							<td>Plot:</td>
							<td id="plot"></td>
						</tr>
					</table>
				</span>
				
				
				<div class="span-1">
					.
				</div>
				<span class="push-1 success last signindiv"> <h3> The Movie Poster from IMDb </h3> <img id="poster" src="" alt="m_image" width="auto" height="auto" id=""> </span>
				<span class="span-18 push-1 success last signindiv"> <h3> This Movie all the way .... </h3>
					<table border="1">
						<tr>
							<td>Size</td>
							<td>Format</td>
							<td>Resolution</td>
							<td>rip</td>
							<td>Available to</td>
							<td>REQUEST</td>
							</tr>
					<?php
					//$con = mysql_connect("localhost", "root", "");
					//mysql_select_db("movie_db", $con);
					$query = "select entry.size, entry.format, entry.resolution, entry.rip, user.userId, user.firstName, user.lastName, user.email from entry, user where entry.userId=user.userId and approvedBy!=0 and rejectedBy=0 and deletedBy=0 and entry.movieId=$selectedMovie ";
					$result = mysql_query($query);
					if($result){
						while($rows = mysql_fetch_array($result)){
							$size = $rows['size'];
							$format = $rows['format'];
							$resolution = $rows['resolution'];
							$rip = $rows['rip'];
							$toWhom = $rows['firstName']." ".$rows['lastName'];
							$emailAddress = $rows['email'];
							//echo $emailAddress;
							?>
							<tr>
								<td><?php echo $size/1048576 ." MB" ?></td>
								<td><?php echo $format; ?></td>
								<td><?php echo $resolution; ?></td>
								<td><?php echo $rip; ?></td>
								<td><?php echo $toWhom; ?></td>
								<?php
									$a = "sendMail.php?toWhom=$toWhom&email=$emailAddress&movieName=$movieName";
                                ?>
								<td><a href="<?php echo $a; ?>"><button style="background-color: black; color: white">REQUEST</button></a></td>
							</tr>
							<?php
							}
							}
					?>
					</table>
					 </span>
			</div>
			<!--  <span class="span-8 push-1 success last signindiv">
			<h3> The Movie Poster from IMDb </h3>
			<img src="images/" alt="m_image" width="310" height="220" id="">
			</span> -->
			<!--            <span class="span-8 push-1 info  last registerdiv"><br>
			<h2> UPCOMING MOVIES! </h2>
			<img src="images/image4.jpg" alt="rotating image" width="310" height="220" id="rotator2">
			</span>-->
		</div>
		<script type="text/javascript">
			var link = document.getElementById('link').href.toString();
			exp = new RegExp("tt\\d+");
			var id = exp.exec(link);
			my_url = "http://www.imdbapi.com/?i="+id;
			$.getJSON(my_url, function(json_data) {
				//alert(json_data.Poster);
				document.getElementById('poster').src = json_data.Poster;
				document.getElementById('rating').innerHTML = json_data.imdbRating;
				document.getElementById('genre').innerHTML = json_data.Genre;
				document.getElementById('cast').innerHTML = json_data.Actors;
				document.getElementById('plot').innerHTML = json_data.Plot;
			});
		
		</script>
	</body>
</html>