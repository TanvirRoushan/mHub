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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>M~Hub | Admin-Manage Movie</title>
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
                        <li><a href="dashboardView.php" title="My Dashboard">Dashboard</a> </li>
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
            <div class="span-22 success admin">
                <br>
                <?php
                $allMovieName;
				$allMovieId;
				$allEntryId;
				$allUserId;
				$allUserFirstName;
				$allUserLastName;
				$allImdbLink;
				$allYear;
				$allSize;
				$allResolution;
                ?>
                <label for="dummy1"><h3>Movie Manager</h3></label>               
                <div class="span-22  head">
                    <h3>Movies Available to Users</h3>
                    <table>
                    	<tr><td>Movie Name</td><td>Release Year</td><td>Size</td><td>Available To</td><td></td></tr>
                    	<tr><td></td><td></td><td></td><td></td><td></td></tr>
                    <?php
                    $query = "SELECT movie.movieId, 
                    entry.entryId, user.userId, movie.name, 
                    user.firstName, user.lastName, movie.imdbLink, 
                    movie.year, entry.size, entry.resolution\n"
    . "FROM movie, entry, user\n"
    . "WHERE entry.userId = user.userId\n"
    . "AND entry.movieId = movie.movieId\n"
    . "AND entry.approvedBy !=0\n"
    . "AND entry.deletedBy =0\n"
    . "AND entry.rejectedBy =0 order by name,size asc";
	$result = mysql_query($query);
					if($result){
						while($rows = mysql_fetch_array($result)){
							$allMovieName = $rows['name'];
							$allMovieId = $rows['movieId'];
							$allUserId = $rows['userId'];
							$allEntryId = $rows['entryId'];
							$allUserFirstName = $rows['firstName'];
							$allUserLastName = $rows['lastName'];
							$allImdbLink = $rows['imdbLink'];
							$allYear = $rows['year'];
							$allSize = $rows['size'];
							$allResolution = $rows['resolution'];
							$allFullName = $allUserFirstName." ".$allUserLastName;
							$a = "movieInfoView.php?movieId=$allMovieId";
                     		$b = "deleteMovie.php?entryId=$allEntryId";
							?>
							<tr><td><a href="<?php echo $a; ?>"><?php echo $allMovieName; ?></a></td><td><?php echo $allYear ?></td><td><?php echo floor($allSize/1048576) ." MB" ?></td><td><?php echo $allFullName;?></td><td><a href="<?php echo $b ?>"><button  type="submit" class="button negative">Delete Record</button></a></td></tr>
							
							
							<?php
						}
					}
                    ?>
                    </table>
                </div>
                
                <div class="span-24">.</div>
                <div class="span-22  head">
                	<h3>Movies Wanted by Users</h3>
                	<table>
                		<tr><td>Name</td><td>Release Year</td><td>Available to</td><td></td></tr>
                		<tr><td></td><td></td><td></td><td></td></tr>
                    <?php
                    $wantName;
					$wantFirstName;
					$wantLastName;
					$wantYear;
					$wantMovieId;
					$wantUserId;
					$wantFullName;
					$wantImdbLink;
                    $query = "SELECT movie.name, movie.year, movie.imdbLink, user.firstName, user.lastName, movie.movieId, user.userId from user, movie, want where want.approvedBy=1 and want.userId=user.userId and want.movieId=movie.movieId";
					$result= mysql_query($query);
					if($result){
						while($rows = mysql_fetch_array($result)){
							$wantName = $rows['name'];
							$wantYear = $rows['year'];
							$wantFirstName = $rows['firstName'];
							$wantLastName = $rows['lastName'];
							$wantMovieId = $rows['movieId'];
							$wantUserId = $rows['userId'];
							$wantImdbLink = $rows['imdbLink'];
							$wantFullName = $wantFirstName." ".$wantLastName;
							$a = $a = "manageWant.php?movieId=$wantMovieId&userId=$wantUserId";
							?>
							<tr><td><a href="<?php echo $wantImdbLink; ?>"><?php echo $wantName; ?></a></td><td><?php echo $wantYear;?></td><td><?php echo $wantFullName ?></td><td><a href="<?php echo $a ?>"><button  type="submit" class="button negative">Delete Want Record</button></a></td></tr>
							<?php
						}
					}
                    ?>
                    </table>
                </div>
                
                <div class="span-24">.</div>
                <div class="span-22  head">
                    <h3>Movies downloaded by Users</h3>
                	<table>
                		<tr><td>Name</td><td>Release Year</td><td>Available to</td><td></td></tr>
                		<tr><td></td><td></td><td></td><td></td></tr>
                    <?php
                    $downloadName;
					$downloadFirstName;
					$downloadLastName;
					$downloadYear;
					$downloadMovieId;
					$downloadUserId;
					$downloadFullName;
					$downloadImdbLink;
                    $query = "SELECT movie.name, movie.year, movie.imdbLink, user.firstName, user.lastName, movie.movieId, user.userId from user, movie, download where download.approvedBy=1 and download.userId=user.userId and download.movieId=movie.movieId";
					$result= mysql_query($query);
					if($result){
						while($rows = mysql_fetch_array($result)){
							$downloadName = $rows['name'];
							$downloadYear = $rows['year'];
							$downloadFirstName = $rows['firstName'];
							$downloadLastName = $rows['lastName'];
							$downloadMovieId = $rows['movieId'];
							$downloadUserId = $rows['userId'];
							$downloadImdbLink = $rows['imdbLink'];
							$downloadFullName = $downloadFirstName." ".$downloadLastName;
							$a = $a = "manageDownload.php?movieId=$downloadMovieId&userId=$downloadUserId";
							?>
							<tr><td><a href="<?php echo $downloadImdbLink; ?>"><?php echo $downloadName; ?></a></td><td><?php echo $downloadYear;?></td><td><?php echo $downloadFullName ?></td><td><a href="<?php echo $a ?>"><button  type="submit" class="button negative">Delete Download Record</button></a></td></tr>
							<?php
						}
					}
                    ?>
                    </table>
                </div>
                
            </div>
        </div>
    </body>
</html>