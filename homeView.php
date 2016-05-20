<?php
session_start();

if ($_SESSION['id'] == "") {
    header("Location:index.php");
}

function logout() {
    session_destroy();
    header('Location:index.php');
}

function passValue($parameter) {
    echo "<script type='text/javascript'>alert('got something');</script>";
}

$con = mysql_connect("localhost", "817046_dost01", "moviepass");
$selecteddatabase = mysql_select_db("mhub_zymichost_moviedb", $con);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>M~Hub | Home</title>
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

                <nav id="topNav" onclick="logout();">
                    <ul>
                        <li><a href="profilePageView.php" title="Profile"> Welcome <?php echo $_SESSION['firstName'] ?></a> </li>
                        <li> <a href="homeView.php" title="Home Page">Home</a> </li>
                        <li> <a href="dashboardView.php" title="My Dashboard">Dashboard</a> </li>
                        <li>  <a href="contactView.php" title="About Us">About</a> </li>
                        <?php
                        $flag = $_SESSION['flag'];
                        if ($flag == 1) {
                            ?>
                            <li>  <a href="adminPanelView.php" title="Admin">Admin Panel</a>  </li>
                        <?php } ?>
                        <li> <a href="logout.php" name="logoutbutton" title="Logout">Logout</a></li>
                    </ul>
                </nav>

<!-- 				<a onclick="<?php passValue(); ?>">hello</a> -->
                <div class="content">
                </div>

                <script src="scripts/jquery.js"></script>
                <script src="scripts/modernizr.js"></script>
            </div>
            <script type="text/javascript" src="scripts/jquery.js"></script>
            <script type="text/javascript"  src="scripts/jquery.autocomplete.js"></script>
            <script>
                $(document).ready(function() {
                    $("#id").autocomplete("autocomplete.php", {
                        selectFirst : true
                    });
                });
            </script>

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

            <div class="span-1">  . </div>

            <div class="span-12 homeMovie">
                <label for="dummy1"><h2><b><center>CENTRAL MOVIE COLLECTION</center></b></h2></label>
                <form name="test" id="test" method="get">
                    <input class="push-7 "type="search" results="5" placeholder="Search..." name="text" id="id">
                </form><br><br>
                <div style="min-height: 570px" class="span-10 movielist">
                    <div style="height:550px;width:450px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif; overflow:auto;">
                        <?php
                        $query = "select distinct(movie.name), movie.movieId,movie.year from movie, entry where movie.movieId=entry.movieId and entry.approvedBy!=0 and entry.deletedBy=0 and entry.rejectedBy=0 order by name,year asc";
                        $queryResult = mysql_query($query);
                        if ($queryResult) {
                            $numrows = mysql_num_rows($queryResult);
                            //echo "<script type='text/javascript'>alert($numrows);</script>";
                            while ($row = mysql_fetch_array($queryResult)) {
                                $movieName = $row['name'];
                                $movieId = $row['movieId'];
                                ?>
                                <form method="post">
                                    <?php $a = "movieInfoView.php?movieId=$movieId"
                                    ?>
                                    <li><a style="text-decoration: none; color: black" href="<?php echo $a ?>" name="<?php $movieId ?>">
                                            <?php
                                            echo $movieName;
                                            ?> 
                                        </a></li>
                                </form>
                                <?php
                            }
                        } else {
                            
                        }
                        ?>

                    </div>
                </div>
            </div>
            <form action="movieInfoView.php">
                <input type="hidden" name="selectedMovie" value="">
            </form>
            <span style="min-height: 290px" class="span-8 push-1 success last signindiv"> 
                <label for="dummy1">  <h3>Movie Others Want to See</h3></label>
                <div style="height:250px;width:300px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">

                    <?php
                    $query = "select movie.name, movie.imdbLink, user.userId from movie, user, want where movie.movieId=want.movieId and want.userId=user.userId and want.approvedBy=1 order by name asc";
                    $result = mysql_query($query);
                    $num = mysql_num_rows($result);
                    if ($num == 0) {
                        echo "No wanted Movies";
                    } else {
                        if ($result) {
                            while ($rows = mysql_fetch_array($result)) {
                                ?>
                                <li>
                                    <a style="text-decoration:  none" target="_blank" href="<?php echo $rows['imdbLink'] ?>">
                                        <?php
                                        echo $rows['name'];
                                        ?>
                                    </a>
                                </li>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
            </span>

            <span style="min-height: 290px" class="span-8 push-1 info  last registerdiv"><br>
                <label for="dummy1">  <h3>Currently Downloading</h3></label>
                <div style="height:250px;width:307px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
                    <?php
                    $query = "select movie.name, movie.imdbLink, user.userId from movie, user, download where movie.movieId=download.movieId and download.userId=user.userId and download.approvedBy=1 order by name asc";
                    $result = mysql_query($query);
                    $num = mysql_num_rows($result);
                    if ($num == 0) {
                        echo "Download not going on";
                    } else {
                        if ($result) {
                            while ($rows = mysql_fetch_array($result)) {
                                ?>
                                <li>
                                    <a style="text-decoration: none" target="_blank"  href="<?php echo $rows['imdbLink']; ?>"><?php
                    echo $rows['name'];
                                ?>
                                    </a>
                                </li>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
            </span>
        </div>
    </body>
</html>