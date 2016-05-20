<?php
session_start();
if ($_SESSION['id'] == "") {
    header("Location:index.php");
}
$sessionId = $_SESSION['id'];
$size;
$format;
$resolution;
$rip;
$imdbLink;
$entryId;
$name;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>M~Hub | My Dashboard</title>
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
                        <li><a href="profilePageView.php" title="Profile"> Welcome <?php echo $_SESSION['firstName'] ?></a> </li>
                        <li> <a href="homeView.php" title="Home Page">Home</a> </li>
                        <li> <a href="dashboardView.php" title="My Dashboard">Dashboard</a></li>
                        <li>  <a href="contactView.php" title="About Us">About</a> </li>
                        <?php
                        $flag = $_SESSION['flag'];
                        if ($flag == 1) {
                            ?>
                            <li>
                                <a href="adminPanelView.php" title="Admin">Admin Panel</a>
                            </li>
                        <?php } ?>
                        <li> <a href="logout.php" name="logoutbutton" title="Logout">Logout</a></li>
                    </ul>
                </nav>

                <div class="content">
                </div>

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

            <div class="span-1">.</div>

            <div class="span-11 advertise_three"><br>
                 <label for="dummy1"><h3>Want to Add a New Movie?</h3> </label>
                <a href="movieUpdateView.php"><center><input type="submit" value="Add Movie"></center></a><br><br>
                <label for="dummy1"><h3><center>~ YOUR COLLECTION ~<h3></center></h3></label>
<!--                <input type="text" class="text" id="dummy1" name="dummy1" value="">  -->
                
                <div class="span-10 movielist_two">
                     <div style="height:750px;width:420px;border:1px solid #ccc;overflow:auto;">   
                    <table>
                        <?php
                        $con = mysql_connect("localhost", "817046_dost01", "moviepass");
                        mysql_select_db("mhub_zymichost_moviedb", $con);
                        $query = "SELECT entry.entryId, entry.size, entry.format, entry.resolution, entry.rip, movie.imdbLink,movie.movieId, movie.name FROM movie, entry WHERE movie.movieId=entry.movieId and entry.userId=$sessionId and entry.approvedBy!=0 and entry.deletedBy=0 and entry.rejectedBy=0 order by name asc;";
                        $result = mysql_query($query);
                        if ($result) {
                            while ($rows = mysql_fetch_array($result)) {
                                $size = $rows['size'];
                                $format = $rows['format'];
                                $resolution = $rows['resolution'];
                                $rip = $rows['rip'];
                                $name = $rows['name'];
                                $movieId = $rows['movieId'];
                                $imdbLink = $rows['imdbLink'];
                                $entryId = $rows['entryId'];
                                ?>

                                <tr>
                                    <td>Movie Name:</td>
                                    <td><?php echo $name ?></td>
                                </tr>
                                <tr>
                                    <td>IMDb Link:</td>
                                    <td><a target="_blank" href="<?php echo $imdbLink ?>"><?php echo $imdbLink; ?></a></td>
                                </tr>
                                <tr>
                                    <td>Size:</td>
                                    <td><?php echo floor($size / 1048576) . " MB"; ?></td>
                                </tr>
                                <tr>
                                    <td>Format:</td>
                                    <td><?php echo $format; ?></td>
                                </tr>
                                <tr>
                                    <td>Resolution:</td>
                                    <td><?php echo $resolution; ?></td>
                                </tr>
                                <tr>
                                    <td>Rip:</td>
                                    <td><?php echo $rip; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php $b = "delete.php?entryId=$entryId"
                                        ?>
                                        <a href="<?php echo $b ?>"><button type="submit" class="button negative">Delete From Account</button></a>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <?php
                            }
                        } else {
                            echo "unsuccessfull";
                        }
                        ?>

                    </table>
                    </div>
                </div>
            </div>

            <span class="span-9 push-1 success last signindiv">
                <form action="wantMovie.php" method="post">
                    <label for="dummy1"><h3>Movie you Want to See</h3></label>
                    <label for="dummy1">Name</label><br>
                    <input type="text" class="text" id="dummy1" name="wantName" value=""><br>
                    <label for="dummy1">IMDb Link</label><br>
                    <input type="text" class="text" id="dummy1" name="wantImdbLink" value=""><br>
                    <label for="dummy1">Release Year</label><br>
                    <input type="text" class="text" id="dummy1" name="wantYear" value=""><br>
                    <input type="submit" value="Want" class="button">
                </form>
                
                
                
                <br><br>

                <div class="span-9 head">
                    <div style="height:150px;width:350px;border:1px solid #ccc;overflow:auto;">   
                       <?php
                $wantMovieName;
				$wantMovieId;
				$wantUserId;
                $query = "SELECT movie.name, movie.movieId, want.userId from movie, want where movie.movieId=want.movieId and want.userId='$_SESSION[id]' and want.approvedBy=1";
				$result = mysql_query($query);
				if($result){
					while($rows = mysql_fetch_array($result)){
						$wantMovieName = $rows['name'];
						$wantMovieId = $rows['movieId'];
						$wantUserId = $rows['userId'];
						?>
						<table style="border: ridge; border-width: 5px">
							<tr>
								<?php $a = "dontWant.php?movieId=$wantMovieId&userId=$wantUserId"; ?>
								<td><?php echo $wantMovieName; ?></td>
								<td><a href="<?php echo $a ?>"><button  type="submit" class="button negative">Don't Want Anymore</button></a></td>
							</tr>
						</table>
						<?php
						}
						}
                ?>
                    </div>
                </div>
            </span>

            <span class="span-9 push-1 info  last registerdiv"><br>
                <label for="dummy1"><h3>Movie you are currently Downloading</h3></label>
<!--                <input type=search results=5 placeholder=Search... name=s>-->
                <form action="downloadMovie.php" method="post">
                    <label for="dummy1">Name</label><br>
                    <input type="text" class="text" id="dummy1" name="downloadName" value=""><br>
                    <label for="dummy1">IMDb Link</label><br>
                    <input type="text" class="text" id="dummy1" name="downloadImdbLink" value=""><br>
                    <label for="dummy1">Release Year</label><br>
                    <input type="text" class="text" id="dummy1" name="downloadYear" value=""><br>
                    <input type="submit" value="Downloading" class="button"><br>
                </form>
                <br><br>
                
                <div class="span-9 head">
                    <div style="height:150px;width:350px;border:1px solid #ccc;overflow:auto;">   
                       <?php
                $downloadMovieName;
				$downloadMovieId;
				$downloadUserId;
                $query = "SELECT movie.name, movie.movieId, download.userId from movie, download where movie.movieId=download.movieId and download.userId='$_SESSION[id]' and download.approvedBy=1";
			$result = mysql_query($query);
			if($result){
				while($rows = mysql_fetch_array($result)){
					$downloadMovieName = $rows['name'];
					$downloadMovieId = $rows['movieId'];
					$downloadUserId = $rows['userId'];
					?>
				<table border="2px" style="border: ridge; border-width: 5px">
					<tr></tr>
						<tr>
							
							<td><h4><?php echo $downloadMovieName; ?></h4></td>
							<td></td>
						</tr>
						<tr>
							<td>
							<?php $a = "dontDownload.php?movieId=$downloadMovieId&userId=$downloadUserId"; ?>
							<a href="<?php echo $a ?>"><button  type="submit" class="button negative">Cancel Download</button></a>
							</td>
							<td>
								<?php $b = "downloadComplete.php?movieId=$downloadMovieId&userId=$downloadUserId"; ?>
							<a href="<?php echo $b ?>"><button  type="submit" class="button positive">Download Complete</button></a>
							</td>
						</tr>
					</table>
					<?php
					}
					}
                ?>
                    </div>
                </div>
            </span>
        </div>
    </body>
</html>