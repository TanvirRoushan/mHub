<?php
session_start();
if ($_SESSION['flag'] == 0) {
    header("Location:homeView.php");
}
if ($_SESSION['id'] == "") {
    header("Location:index.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>M~Hub | Admin-Manage Request</title>
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
            <div class="span-22 center success admin"><br>
                <label for="dummy1"><h3>Pending Requests to Add Movies in Database</h3></label>
                <?php
                $movieName;
                $movieYear;
                $movieSize;
                $movieRip;
                $movieResolution;
                $movieFirstName;
                $movieLastName;
                $movieEntryId;
                $movieImdbLink;
                $con = mysql_connect("localhost", "817046_dost01", "moviepass");
                mysql_select_db("mhub_zymichost_moviedb", $con);
                $query = "SELECT movie.name, movie.year, entry.size, entry.rip, entry.resolution, user.firstName, user.lastName, entry.entryId, movie.imdbLink\n"
                        . "FROM movie, entry, user\n"
                        . "WHERE entry.approvedBy =0 and entry.rejectedBy=0 and deletedBy=0 and movie.movieId=entry.movieId and entry.userId=user.userId";
                $queryResult = mysql_query($query);
                if ($queryResult) {
                    while ($rows = mysql_fetch_array($queryResult)) {
                        $movieName = $rows['name'];
                        $movieYear = $rows['year'];
                        $movieSize = $rows['size'];
                        $movieRip = $rows['rip'];
                        $movieResolution = $rows['resolution'];
                        $movieFirstName = $rows['firstName'];
                        $movieLastName = $rows['lastName'];
                        $movieEntryId = $rows['entryId'];
                        $movieImdbLink = $rows['imdbLink'];
// function inMB(){
                        // $movieSize = $movieSize/8;
                        // $movieSize = $movieSize/1024;
// }
                        ?>
                        <table border="2px" style="border-bottom: ridge;border-bottom-width: 10px">
                            <tr> <td>Movie Name:</td> <td><?php echo $movieName ?></td> </tr>
                            <tr> <td>IMDb Link:</td> <td> <a target="_blank" href="<?php echo $movieImdbLink ?>"><?php echo $movieImdbLink ?></a></td> </tr>
                            <tr> <td>Request From:</td>  <td><?php echo $movieFirstName . " " . $movieLastName ?></td>  </tr>
                            <tr> <td>Size:</td>  <td> <?php echo floor($movieSize / 1048576) . " MB</br>" ?></td> </tr>
                            <tr> <td>Rip: </td><td><?php echo $movieRip . "</br>" ?></td></tr>
                            <tr> <td>Resolution:</td> <td> <?php echo $movieResolution . "</br>" ?></td></tr>
                            <tr>
                                <td><?php $a = "approve.php?entryId=$movieEntryId" ?><a href="<?php echo $a ?>"><button  type="submit" class="button positive">Accept</button></a></td>
                                <td> <?php $b = "reject.php?entryId=$movieEntryId" ?> <a href="<?php echo $b ?>"><button type="submit" class="button negative">Reject</button></a></td>
                            </tr>
                        </table>
                        <?php
                    }
                } else {
                    echo "<script type='text/javascript'>alert('got nothing');</script>";
                    echo "not done";
                }
                ?>
            </div>
        </div>
    </body>
</html>