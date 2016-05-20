<?php
session_start();
if ($_SESSION['flag'] == 0) {
    header("Location:homeView.php");
}
if ($_SESSION['id'] == "") {
    header("Location:index.php");
}
$id;
$email;
$name;
$flag;
$birthday;
$address;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>M~Hub | Admin-Manage Member</title>
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
            <div class="span-22 success admin column-5">
                <label for="dummy1"><h3>User Details</h3></label>

                <?php
                $con = mysql_connect("localhost", "817046_dost01", "moviepass");
                mysql_select_db("mhub_zymichost_moviedb", $con);
                $query = "SELECT userId, user.email, user.firstName, user.lastName, user.birthday, user.address, user.flag from user order by flag,firstName asc";
                $result = mysql_query($query);
                if ($result) {
                    while ($rows = mysql_fetch_array($result)) {
                        $id = $rows['userId'];
                        $email = $rows['email'];
                        $name = $rows['firstName'] . " " . $rows['lastName'];
                        $birthday = $rows['birthday'];
                        $address = $rows['address'];
                        $flag = $rows['flag'];
                        ?>
                        <table border="2px" style="border-bottom: ridge;border-bottom-width: 10px">
                            <tr> <td>Name:</td><td><?php echo $name; ?></td> </tr>
                            <tr><td>Email Address:</td><td><?php echo $email; ?></td></tr>
                            <tr> <td>Birthday:</td><td><?php echo $birthday; ?></td> </tr>
                            <tr> <td>Address</td><td><?php echo $address ?></td> </tr>
                            <tr> <td> <?php if ($flag == 0 | $flag == 2) { $a = "makeAdmin.php?userId=$id"; ?>
                                        <a href="<?php echo $a ?>"><button  type="submit" class="button positive">Make Admin</button></a> <?php } 
                                        else if ($flag == 1) { $a = "removeAdmin.php?userId=$id"; ?>
                                        <a href="<?php echo $a ?>"><button  type="submit" class="button negative">Remove Admin</button></a> <?php } ?> </td>
                                <td>  <?php if ($flag == 0 | $flag == 1) { $a = "blockUser.php?userId=$id"; ?>
                                        <a href="<?php echo $a ?>"><button  type="submit" class="button negative">Block User</button></a> <?php } 
                                        else if ($flag == 2) {  $a = "unblockUser.php?userId=$id"; ?>
                                        <a href="<?php echo $a ?>"><button  type="submit" class="button positive">Unblock User</button></a><?php } ?> </td>
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