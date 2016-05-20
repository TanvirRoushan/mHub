<?php
session_start();
if ($_SESSION['flag'] == 0 | $_SESSION['flag'] == 2) {
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
        <title>M~Hub | Administrator Panel Dashboard</title>
        <meta name="author" content="Tanvir" />
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
            <div class="span-24   head ">
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
                        if ($flag == 1) {
                            ?>
                            <li style="z-index: 99" >
                                <a href="adminPanelView.php" title="Admin">Admin Panel</a>
                                <ul>
                                    <li><a href="manageRequestView.php" title="">Manage Request</a></li>
                                    <li><a href="manageDownWantView.php" title="">Manage DL & WANT</a> </li>
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
            <?php
            $dif;
            $query = "Select count(*) from user";
            $result = mysql_query($query);
            $noOfTotalUser;
            if ($result) {
                while ($row = mysql_fetch_array($result)) {
                    $noOfTotalUser = $row['count(*)'];
                }
            }
            $query = "select count(*) from user where flag!=2";
            $result = mysql_query($query);
            $noOfActiveUser;
            if ($result) {
                while ($row = mysql_fetch_array($result)) {
                    $noOfActiveUser = $row['count(*)'];
                }
            }
            $dif = $noOfTotalUser - $noOfActiveUser;
            $noOfNormalUsers;
            $noOfAdminUsers;
            $query = "select count(*) from user where flag=0";
            $result = mysql_query($query);
            $noOfActiveUser;
            if ($result) {
                while ($row = mysql_fetch_array($result)) {
                    $noOfNormalUsers = $row['count(*)'];
                }
            }
            $query = "select count(*) from user where flag=1";
            $result = mysql_query($query);
            $noOfActiveUser;
            if ($result) {
                while ($row = mysql_fetch_array($result)) {
                    $noOfAdminUsers = $row['count(*)'];
                }
            }
            ?>
            <div class="span-24  menu"></div>
            <div class="span-22 success admin">
                <br>
                <h3>User at a Glance</h3>
                <table style="border: groove; border-width: 5px">
                    <tr>
                        <th>Total Number of Users<?php echo ": " . $noOfTotalUser; ?></th>
                    </tr>
                    <tr>
                        <td>Total Number of active Users<?php echo ": " . $noOfActiveUser; ?></td>
                        <td>Total Number of blocked Users<?php echo ": " . $dif; ?></td>
                    </tr>
                    <tr>
                        <td>Total Number of General Users<?php echo ": " . $noOfNormalUsers; ?></td>
                        <td>Total Number of Administrator<?php echo ": " . $noOfAdminUsers; ?></td>
                    </tr>
                    <table style="border: groove; border-width: 5px">
                        <tr>
                            <td><b>Name</b></td><td><b>Email</b></td><td><b>Member Since</b></td><td><b>Role</b></td>
                        </tr>
                        <?php
                        $query = "SELECT firstName, lastName, email, flag, joinDate from user order by flag,joinDate, firstName";
                        $result = mysql_query($query);
                        if ($result) {
                            while ($row = mysql_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['firstName'] . " " . $row['lastName']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['joinDate']; ?></td>
                                    <td><?php
                        $potaka = $row['flag'];
                        if ($potaka == 0) {
                            echo "General User";
                        } else if ($potaka == 1) {
                            echo "Admin User";
                        } else if ($potaka == 2) {
                            echo "Blocked User";
                        }
                                ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </table>
                <h3>Movies at a Glance</h3>
                <?php
                $query = "select count(distinct name)\n"
                        . "from movie, entry\n"
                        . "where entry.approvedBy != 0 and entry.deletedBy = 0 and entry.rejectedBy = 0 and entry.movieId = movie.movieId\n"
                        . "order by name";
                $result = mysql_query($query);
                $noOfTotalUMovies;
                if ($result) {
                    while ($row = mysql_fetch_array($result)) {
                        $noOfTotalUMovies = $row['count(distinct name)'];
                    }
                }
                ?>



                <?php
                $query = "select count(name)\n"
                        . "from movie, entry\n"
                        . "where entry.approvedBy != 0 and entry.deletedBy = 0 and entry.rejectedBy = 0 and entry.movieId = movie.movieId\n"
                        . "order by name";
                $result = mysql_query($query);
                $noOfTotalMovies;
                if ($result) {
                    while ($row = mysql_fetch_array($result)) {
                        $noOfTotalMovies = $row['count(name)'];
                    }
                }
                ?>


                <table style="border: ridge; border-width: 5px">
                    <th>Movies in Numbers</th>
                    <tr>
                        <td><b>Total Number of Unique Movies</b><?php echo ": " . $noOfTotalUMovies; ?> </td>
                        <td><b>Total Number of Movies</b><?php echo ": " . $noOfTotalMovies; ?></td>
                    </tr>
                </table>
                <table style="border: ridge; border-width: 5px">
                    <tr>
                        <td><b>Name</b></td><td><b>Available Movies</b></td>
                    </tr>
                    <?php
                    $sfirstName;
                    $slastName;
                    $withComma;
                    $explode;
                    $query = "select group_concat(movie.name), user.firstName, user.lastName from movie, user, entry where movie.movieId=entry.movieId and user.userId=entry.userId and entry.approvedBy!=0 and entry.rejectedBy=0 and entry.deletedBy=0 group by user.firstName, user.lastName";
                    $result = mysql_query($query);
                    if ($result) {
                        while ($row = mysql_fetch_array($result)) {
                            $sfirstName = $row['firstName'];
//echo $sfirstName."</br>";
                            $slastName = $row['lastName'];
//echo $slastName."</br>";
                            $withComma = $row['group_concat(movie.name)'];
//echo $withComma."</br>";
                            $explode = explode(",", $withComma);
//print_r($explode);
                            ?>
                            <tr>
                                <td><?php echo $sfirstName . " " . $slastName
                            ?></td>
                                <td>
                                    <table>
                                        <?php
                                        foreach ($explode as $value) {
                                            ?>
                                            <tr>
                                                <?php
                                                echo $value . "<br>";
                                                ?>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
                <!-- <table style="border: ridge; border-width: 4px">
                <tr><td>User Name</td><td>Email Address</td><td>Birthday</td><td>Movie Name</td><td>Release Year</td></tr>
                <?php
                $query = "select user.firstName, user.lastName, user.birthday, user.email, user.address, movie.name, movie.imdbLink, movie.year from movie, user, entry where entry.movieId = movie.movieId and entry.userId = user.userId and entry.approvedBy != 0 and entry.deletedBy = 0 and entry.rejectedBy = 0 order by year, name";
                $result = mysql_query($query);
                if ($result) {
                    while ($rows = mysql_fetch_array($result)) {
                        ?>
                                <tr><td><?php echo $rows['firstName'] . " " . $rows['lastName']; ?></td>
                                <td><?php echo $rows['email']; ?></td>
                                <td><?php echo $rows['birthday']; ?></td>
                                <a style="text-decoration: none" href="<?php echo $rows['imdbLink']; ?>"><td><?php echo $rows['name']; ?></td></a>
                                <td><?php echo $rows['year']; ?></td>
                                </tr>
                        <?php
                    }
                }
                ?> -->
                </table> <h3>Want Corner at a Glance</h3>
                <table style="border: ridge; border-width: 5px">
                    <tr>
                        <td><b>Movie Name</b></td><td><b>Wanted By</b></td>
                    </tr>
                    <?php
                    $query = "SELECT movie.name, user.firstName, user.lastName from movie, user, want where movie.movieId=want.movieId and user.userId=want.userId and want.approvedBy=1";
                    $result = mysql_query($query);
                    if ($result) {
                        while ($row = mysql_fetch_array($result)) {
                            ?>
                            <tr>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['firstName'] . " " . $row['lastName']; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
                <h3>Download Corner at a Glance</h3>
                <table style="border: ridge; border-width: 5px">
                    <tr>
                        <td><b>Movie Name</b></td><td><b>Downloading By</b></td>
                    </tr>
                    <?php
                    $query = "SELECT movie.name, user.firstName, user.lastName from movie, user, download where movie.movieId=download.movieId and user.userId=download.userId and download.approvedBy=1";
                    $result = mysql_query($query);
                    if ($result) {
                        while ($row = mysql_fetch_array($result)) {
                            ?>
                            <tr>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['firstName'] . " " . $row['lastName']; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>