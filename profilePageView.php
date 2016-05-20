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

if (isset($_POST['picSubmit'])) {
    $allowedExts = array("jpg", "jpeg", "gif", "png", "pjpeg");
    $extension = end(explode(".", $_FILES["file"]["name"]));
    if (
            (
            ($_FILES["file"]["type"] == "image/jpg")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/png")
            || ($_FILES["file"]["type"] == "image/pjpeg")
            )
            && ($_FILES["file"]["size"] < 1048577)) {
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "
		<br>
		";
        } else {
//			echo "Upload: " . $_FILES["file"]["name"] . "
//		<br>
//		";
//			echo "Type: " . $_FILES["file"]["type"] . "
//		<br>
//		";
//			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB
//		<br>
//		";
//			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "
//		<br>
//		";

            $files = glob("upload/p_" . $_SESSION['id'] . "_*");
            $proPicFile = $files[0];


            $picDir = "upload/";
            $picName = "p_" . $_SESSION['id'] . "_" . $_FILES["file"]["name"];
            if (file_exists($proPicFile)) {
                move_uploaded_file($_FILES["file"]["tmp_name"], $picDir . "temp_" . $picName);
                unlink($proPicFile);
                rename($picDir . "temp_" . $picName, $picDir . $picName);

                //	echo"File Replaced.";
            } else {
                move_uploaded_file($_FILES["file"]["tmp_name"], $picDir . $picName);
                //echo "Stored in: " . "upload/" . $picDir.$picName;
            }
            $proPicFile = $picDir . $picName;
        }
    } else {
        echo "Invalid file";
    }
} else {
    $files = glob("upload/p_" . $_SESSION['id'] . "_*");
    $proPicFile = $files[0];

    if ($proPicFile == "") {
        $proPicFile = "images/propic.png";
    }
}


$query = "SELECT * FROM user WHERE userId=" . $_SESSION['id'];
$info = mysql_query($query);
if ($info) {
    while ($rows = mysql_fetch_array($info)) {
        $username = $rows['firstName'] . " " . $rows['lastName'];
        $email = $rows['email'];
        $birthday = $rows['birthday'];
        $address = $rows['address'];
        $joindate = $rows['joinDate'];
    }
}

$countQuery = "SELECT count(movieId) from entry where userId=" . $_SESSION['id']
        . " and entry.approvedBy != 0 and entry.deletedBy = 0
			and entry.rejectedBy = 0";
$countResult = mysql_query($countQuery);
if ($countResult) {
    $row = mysql_fetch_array($countResult);
    $totalmovies = $row['count(movieId)'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>M~Hub | Profile</title>
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
    <script  type="text/javascript">
        function showUploadPic() {
            doc = document.getElementById("uploadPic");
            if(doc.style.display == "block") {
                doc.style.display = "none";
            } else {
                doc.style.display = "block";
            }
        }
    </script>
    <body>
        <div class="container maincontainer">
            <div class="span-24 head"><img  src="images/header.jpg" alt="Banner">
            </div>
            <div class="span-24 menu">
                <script>
                    var el = document.getElementsByTagName("body")[0];
                    el.className = "";

                </script>
                <nav id="topNav">
                    <ul>
                        <li><a href="profilePageView.php" title="Profile"> Welcome <?php echo $_SESSION['firstName'] ?></a></li>
                        <li> <a href="homeView.php" title="Home Page">Home</a> </li>
                        <li> <a href="dashboardView.php" title="My Dashboard">Dashboard</a> </li>
                        <li> <a href="contactView.php" title="About Us">About</a> </li>
                        <?php
                        $flag = $_SESSION['flag'];
                        if ($flag == 1) {
                        ?>
                            <li><a href="adminPanelView.php" title="Admin">Admin Panel</a></li><?php } ?>
                        <li> <a href="logout.php" name="logoutbutton" title="Logout">Logout</a></li>
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
            
            <span class="span-5 push-3 notice prifilePic">
                <div class="span-6 push-3" id="uploadPic" style="position: absolute; background: teal; display: none;">
                    <form id="picFile" method="post" action="profilePageView.php" enctype="multipart/form-data">
                        <input name="file" type="file" value=""/>
                        <br>
                        <input name="picSubmit" type="submit" value="Submit Picture" class="span-6" style="margin-left: 5px"/>
                    </form>
                </div>
                <div id="changePic" onclick="showUploadPic()">
                    Change Picture
                </div> <img src="<?php echo $proPicFile; ?>" alt="m_image" width="190" height="180" id=""> 
            </span>
            
            <div class="span-4">.</div>
            <span class="span-8 push-3 error registerdiv">
                <h3> Info & Stats </h3>
                <table>
                    <tr>
                        <td><label>Name:</label></td>
                        <td><?php echo $username; ?></td>
                    </tr>
                    <tr>
                        <td><label>Email:</label></td>
                        <td><?php echo $email; ?></td>
                    </tr>
                    <tr>
                        <td><label>Birthday:</label></td>
                        <td><?php echo $birthday; ?></td>
                    </tr>
                    <tr>
                        <td><label>Join Date:</label></td>
                        <td><?php echo $joindate; ?></td>
                    </tr>
                    <tr>
                        <td><label>Address:</label></td>
                        <td><?php echo $address; ?></td>
                    </tr>
                    <tr>
                        <td><label>Number of Movies Owned:</label></td>
                        <td><?php echo $totalmovies; ?></td>
                    </tr>
                </table>
            </span>
            
            <div span class="span-13  push-5 error registerdiv" >
            <br>
                <h3> Interest & Bio </h3>
                <label>Favorite Quote:  </label><br><br>
                <label>Occupation: </label><br><br>
                <label>Relationship Status: </label><br><br>
                <label>Interests:</label><br><br>
                <label>Favorite Movies: </label>
            </span>
            </div>
        </div>
    </body>
</html>