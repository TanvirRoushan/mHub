<?php
session_start();
if ($_SESSION['id'] == "") {
    header("Location:index.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>M~Hub | Movie Entry</title>
        <meta name="author" content="Tanvir" />
        <link rel="shortcut icon" href="images/icon.ico" >
        <link rel="stylesheet" type="text/css" href="css/blueprint/blueprint/ie.css"/>
        <link rel="stylesheet" type="text/css" href="css/blueprint/blueprint/screen.css"/>
        <link rel="stylesheet" type="text/css" href="css/blueprint/blueprint/plugins/buttons/screen.css"/>
        <link rel="stylesheet" type="text/css" href="css/blueprint/blueprint/src/forms.css"/>
        <link rel="stylesheet" type="text/css" href="css/custom.css"/>
        <link rel="stylesheet" type="text/css" href="css/nav.css">
        <script type="text/javascript" src='scripts/jquery.js'></script>
        <script type="text/javascript" src='scripts/jquery.min.js'></script>

        <script type="text/javascript" src='scripts/search_imdb.js'></script>

        <style type="text/css"></style>
    </head>
    <body>
        <script type="text/javascript">
            function test() {
                alert("The search will get the Name, imdb link and Release Date from imdb website, and add them to the form automatically.");
            }

            function getInfoFromFile() {
                //alert("in");
                var file = document.getElementById('selectedFile').files[0];
                var str = "";
                var siz, typ, format;
                if(file) {
                    str = file.type;
                    var i = str.indexOf('/');
                    if(i < 0) {
                        document.getElementById('size').value = "";
                        document.getElementById('format').value = "";
                        alert("Invalid file format.");
                        //return false;
                    } else {
                        typ = str.substring(0, i);
                        if(typ != "video") {
                            document.getElementById('size').value = "";
                            document.getElementById('format').value = "";
                            alert("the specified file is not a video !");
                            //return false;
                        } else {
                            format = str.substring(i + 1, str.length);
                            siz = file.size;
                            document.getElementById('id_size').value = siz;
                            document.getElementById('id_format').value = format;
                            alert("Info added successfully.");
                            //return true;
                        }
                    }
                } else {
                    alert("Select a propper File.");
                    //return false;
                }
            }

            function verify() {
                var ti = document.getElementById('id_title').value;
                //alert("ti: >	"+ti);
                var id = document.getElementById('id_imdb_link').value;
                //alert("id: >"+id);
                var yr = document.getElementById('id_year').value;
                //alert("year: >"+yr);
                var sz = document.getElementById('id_size').value;
                //alert("size: >"+sz);
                var fo = document.getElementById('id_format').value;
                //alert("format: >"+fo);
                var re = document.getElementById('id_resolution').value;
                //alert("resolution: >"+re);
                if(ti == "" | id == "" | yr == "" | sz == "" | fo == "" | re == "" | ti == "undefined" | id == "undefined" | yr == "undefined" | sz == "undefined" | fo == "undefined" | re == "undefined") {
                    alert("Fill up the Form Propperly !");
                    return false;
                }
                alert('Your entry will be sent to the Admin !')
                return true;
            }
        </script>
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
                        <li><a href="profilePageView.php" title="Profile"> Welcome <?php echo $_SESSION['firstName']
?></a>
                        </li>
                        <li>
                            <a href="homeView.php" title="Home Page">Home</a>
                        </li>
                        <li>
                            <a href="dashboardView.php" title="My Dashboard">Dashboard</a>
                        </li>
                        <li>
                            <a href="contactView.php" title="About Us">About</a>
                        </li>
                        <?php
                        $flag = $_SESSION['flag'];
                        if ($flag == 1) {
                            ?>
                            <li>
                                <a href="adminPanelView.php" title="Admin">Admin Panel</a>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="logout.php" name="logoutbutton" title="Logout">Logout</a>
                        </li>
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
            <script type="text/javascript" src="scripts/jquery.js"></script>
            <script type="text/javascript"  src="scripts/jquery.autocomplete.js"></script>
            <script>
                $(document).ready(function() {
                    $("#id_search").autocomplete("autocomplete.php", {
                        selectFirst : true
                    });
                });

            </script>
            <div class="span-1">
                .
            </div>
            <div class="span-12 entryDetail">
                <span class="span-8 info push-1 signindiv"> <label for="dummy1"><h3>Movie Detail Entry</h3></label> <label for="dummy1">Search your movie in IMDb</label>
                    <input type="text"  id="id_search" class="text" name="movieSearch" value="">
                    <!-- class = "text" remove korsee ai line theke. -->
                    <input type="button" onclick="search_imdb(document.getElementById('id_search').value)" value="Search IMDb"/>
                    <br>
                    <br>
                    <!--  <form method="post" action ="movieUpdateInput.php"> -->
                    <form method="post" action ="movieUpdateInput.php" onsubmit="return verify()">
                        <label for="dummy1">Title</label>
                        <input type="text" class="text" id="id_title" name="movieTitle" value="">
                        </br> <label for="dummy_url">IMDb Link</label>
                        <input type="url" placeholder="http://www.imdb.com/title/..." class="text" id="id_imdb_link" name="movieLink" value="">
                        <br>
                        <label for="dummy1">Year</label>
                        <br>
                        <input type="text" class="text" id="id_year" name="movieYear" value="">
                        <br>
                        <br>
                        <label for="dummy1">Show Your Movie File:</label>
                        <input type="file" class="text" id="selectedFile" name="dummy1" value="" onchange="getInfoFromFile()">
                        <br>
                        <br>
                        <label for="dummy1">Size</label>
                        <br>
                        <input  type="number" class="text" id="id_size" name="movieSize" value="">
                        <br>
                        <label for="dummy1">Format</label>
                        <br>
                        <input type="text" id="id_format" name="movieFormat" value="">
                        <br>
                        <label for="dummy1">Resolution</label>
                        <br>
                        <input type="number" class="text" id="id_resolution" name="movieResolution" value="">
                        <br>
                        <br>
                        <label>File Type</label>
                        <br>
                        <input type="radio" name="filetype" value="BluRay">
                        Bluray Rip
                        <br>
                        <input type="radio" name="filetype" value="CDRip">
                        CD Rip
                        <br>
                        <input type="radio" name="filetype" value="DVDRip">
                        DVD Rip
                        <br>
                        <input type="radio" name="filetype" value="others">
                        Others
                        <br>
                        <input type="text" class="text" name="otherFT">
                        <input type="submit" name="submit_entry" value="Submit Request"/>
                    </form> </span>
            </div>
            <span class="span-8 push-1 success last signindiv"> <h2> HOLLYWOOD TOP CHART </h2> <img src="images/top1.jpg" alt="rotating image" width="310" height="220" id="rotator"> </span>
            <span class="span-8 push-1 info  last registerdiv">
                <br>
                <h2> UPCOMING MOVIES! </h2> <img src="images/up1.jpg" alt="rotating image" width="310" height="220" id="rotator2"> </span>
            <div id="pp_div" class="popup">
                <table>
                    <tr>
                        <td id="pp_title" style="width: 300px; background:#C6D880; font-weight: bold; font-size: large;"></td>
                        <td style="width: 200px; background:#92cae4; font-weight: bold; font-size: medium;"> Movie Details </td>
                    </tr>
                    <tr>
                        <td><img width="auto" height="auto" src="" id="pp_poster"></td>
                        <td>
                            <table>
                                <tr>
                                    <td><b>Year</b></td>
                                    <td id="pp_year"></td>
                                </tr>
                                <tr>
                                    <td><b>Rating</b></td>
                                    <td id="pp_rating"></td>
                                </tr>
                                <tr>
                                    <td><b>Genre</b></td>
                                    <td id="pp_genre"></td>
                                </tr>
                                <tr>
                                    <td><b>Runtime</b></td>
                                    <td id="pp_runtime"></td>
                                </tr>
                                <tr>
                                    <td><b>IMDB ID</b></td>
                                    <td id="pp_imdbID"></td>
                                </tr>
                            </table>
                            <table style="padding-top:20px;" align="center">
                                <tr>
                                    <td colspan="2" style="background:#d12f19; font-weight: bold;">Is this the Movie?</td>
                                </tr>
                                <tr>
                                    <td>
                                        <button onclick="yes()">
                                            Yes
                                        </button></td>
                                    <td>
                                        <button onclick="no()">
                                            No
                                        </button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <a target="blank" id="toSearchImdb" target="" onmouseup="no()") >Go to imdb.com</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <script type="text/javascript">
            (function() {
                var rotator = document.getElementById('rotator');
                // change to match image ID
                var imageDir = 'images/';
                var delayInSeconds = 3;
                var images = ['top2.jpg', 'top3.jpg', 'top4.jpg', 'top5.jpg', 'top6.jpg', 'top7.jpg', 'top1.jpg'];
                // don't change below this line
                var num = 0;
                var changeImage = function() {
                    var len = images.length;
                    rotator.src = imageDir + images[num++];
                    if(num == len) {
                        num = 0;
                    }
                };
                setInterval(changeImage, delayInSeconds * 1000);
            })();
            (function() {
                var rotator = document.getElementById('rotator2');
                // change to match image ID
                var imageDir = 'images/';
                var delayInSeconds = 4;
                var images = ['up2.jpg', 'up3.jpg', 'up4.jpg', 'up5.jpg', 'up6.jpg', 'up7.jpg', 'up8.jpg', 'up9.jpg', 'up1.jpg'];
                // don't change below this line
                var num = 0;
                var changeImage = function() {
                    var len = images.length;
                    rotator.src = imageDir + images[num++];
                    if(num == len) {
                        num = 0;
                    }
                };
                setInterval(changeImage, delayInSeconds * 1000);
            })();

        </script>
    </body>
</html>