<?php
session_start();
if ($_SESSION['flag'] == 0) {
    header("Location:homeView.php");
}
if ($_SESSION['id'] == "") {
    header("Location:index.php");
}
$con = mysql_connect("localhost", "817046_dost01", "moviepass");
mysql_select_db("mhub_zymichost_moviedb", $con);
$wantName;
$wantImdbLink;
$wantYear;
$wantFirstName;
$wantLastName;
$movieId;
$userId;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>M~Hub | Admin-Manage Down Want</title>
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
                        <li><a href="profilePageView.php" title="Profile"> Welcome <?php echo $_SESSION['firstName'] ?></a></li>
                        <li><a href="homeView.php" title="Home Page">Home</a></li>
                        <li><a href="dashboardView.php" title="My Dashboard">Dashboard</a></li>
                        <li><a href="contactView.php" title="About Us">About</a></li>
                        <?php
                        $flag = $_SESSION['flag'];
                        if ($flag == 1) {
                            ?>
                            <li><a href="adminPanelView.php" title="Admin">Admin Panel</a>                            
                                <ul>
                                    <li><a href="manageRequestView.php" title="">Manage Request</a></li>
                                    <li><a href="manageDownWantView.php" title="">Manage DL & WANT</a></li>
                                    <li><a href="manageMembersView.php" title="">Manage Members</a></li>
                                    <li class="last"><a href="manageMoviesView.php" title="">Manage Movies</a></li>
                                </ul>
                            </li>
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
                        if($(this).find("ul").length > 0) {
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
            <div class="span-24  menu"> </div>
            <div class="span-11  success wantadmin">
                <h3>Want Approval</h3>
                <?php
                $query = "SELECT movie.name, movie.imdbLink, movie.year, user.firstName, user.lastName, user.userId, movie.movieId FROM movie, user, want WHERE movie.movieId=want.movieId and user.userId=want.userId and want.approvedBy=0 order by year asc";
				$result = mysql_query($query);
				if($result){
					while($rows = mysql_fetch_array($result)){
						$wantName = $rows['name'];
						$wantImdbLink = $rows['imdbLink'];
						$wantYear = $rows['year'];
						$wantFirstName = $rows['firstName'];
						$wantLastName = $rows['lastName'];
						$movieId = $rows['movieId'];
						$userId = $rows['userId'];
						$name = $wantFirstName." ".$wantLastName;
						?>
						<table border="2px" style="border-bottom: ridge;border-bottom-width: 10px">
							<tr>
								<td>Movie Name:</td>
								<td><?php echo $wantName;?></td>
							</tr>
							<tr>
								<td>IMDb Link:</td>
								<td><a href="<?php echo $wantImdbLink ?>"><?php echo $wantImdbLink; ?></a></td>
							</tr>
							<tr>
								<td>Release Year:</td>
								<td><?php echo $wantYear; ?></td>
							</tr>
							<tr>
								<td>Available to:</td>
								<td><?php echo $name; ?></td>
							</tr>
							<tr>
								<td>
									<?php $a = "approveWant.php?movieId=$movieId&userId=$userId" ?><a href="<?php echo $a ?>"><button  type="submit" class="button positive">Approve</button></a>
								</td>
								<td>
									<?php $a = "declineWant.php?movieId=$movieId&userId=$userId" ?><a href="<?php echo $a ?>"><button  type="submit" class="button negative">Ignore</button></a>
								</td>
							</tr>
						</table>
						<?php
					}
				}
                ?>
            </div>

            <div class="span-11 last success wantadmin">
                <h3>Download Approval</h3>
                <?php
                $query = "SELECT movie.name, movie.imdbLink, movie.year, user.firstName, user.lastName, user.userId, movie.movieId FROM movie, user, download WHERE movie.movieId=download.movieId and user.userId=download.userId and download.approvedBy=0 order by year asc";
				$result = mysql_query($query);
				if($result){
					while($rows = mysql_fetch_array($result)){
						$downloadName = $rows['name'];
						$downloadImdbLink = $rows['imdbLink'];
						$downloadYear = $rows['year'];
						$downloadFirstName = $rows['firstName'];
						$downloadLastName = $rows['lastName'];
						$movieId = $rows['movieId'];
						$userId = $rows['userId'];
						$name = $downloadFirstName." ".$downloadLastName;
						?>
						<table border="2px" style="border-bottom: ridge;border-bottom-width: 10px">
							<tr>
								<td>Movie Name:</td>
								<td><?php echo $downloadName;?></td>
							</tr>
							<tr>
								<td>IMDb Link:</td>
								<td><?php echo $downloadImdbLink; ?></td>
							</tr>
							<tr>
								<td>Release Year:</td>
								<td><?php echo $downloadYear; ?></td>
							</tr>
							<tr>
								<td>Available to:</td>
								<td><?php echo $name; ?></td>
							</tr>
							<tr>
								<td>
									<?php $a = "approveDownload.php?movieId=$movieId&userId=$userId" ?><a href="<?php echo $a ?>"><button  type="submit" class="button positive">Approve</button></a>
								</td>
								<td>
									<?php $a = "declineDownload.php?movieId=$movieId&userId=$userId" ?><a href="<?php echo $a ?>"><button  type="submit" class="button negative">Ignore</button></a>
								</td>
							</tr>
						</table>
						<?php
					}
				}
                ?>
            </div>
        </div>
    </body>
</html>