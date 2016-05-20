<?php
session_start();
if($_SESSION['id']==""){
	header("Location:index.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>M~Hub | Contact</title>
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

           <div class="span-24  menubar">
                <script>
                    var el = document.getElementsByTagName("body")[0];
                    el.className = "";
                </script>

                <nav id="topNav">
                    <ul>
                        <li> <a href="profilePageView.php" title="Profile"> Welcome <?php echo $_SESSION['firstName'] ?></a> </li>
                        <li> <a href="homeView.php" title="Home Page">Home</a> </li>
                        <li> <a href="dashboardView.php" title="My Dashboard">Dashboard</a></li>
                        <li>  <a href="contactView.php" title="About Us">About</a> </li>
                        <?php 
						$flag = $_SESSION['flag'];
						if($flag == 1){
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
                (function($){
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

            <div class="span-2">.</div>

            <div class="span-18 about"><br>
                <label for="dummy1"><h2>About the M~Hub</h2></label>
                <div class="span-1">.</div>
                <div class="span-13 append-3 movielistAbout"> <br>  
                    <span class="border large"> 
                        <p>  This web-site houses movie information. It is a part of our Database project.
                            We developed this site as the final project work of Database Systems [CSE370] in 
                            the semseter Fall 2012. We are the students of BRAC University, Dhaka. Our Project
                            mentors were faculty members Md. Abdur Rahman Adnan and Hossain Arif.</p>
                        <p> For any query, suggestion, or support regarding our web-site, please contact us. </p>
                        <label for="dummy1"><h3>E-mail us at - mdost370 [at] gmail.com</h3></label> 
                        <div class="column-1">.</div>
                        <label for="dummy1"><h3>Developers</h3></label>
                        <li style="font-size: 14pt"><em> Dipankar Chaki     - 09101017</em></li>
                        <li style="font-size: 14pt"><em> Onishim Hasdak     - 09201003 </em></li>
                        <li style="font-size: 14pt"><em> Tanvir Roushan     - 09201006 </em></li>
                        <li style="font-size: 14pt"><em> Syeed Chowdhury    - 09201014 </em></li>
                        <li style="font-size: 14pt"><em> Moumita Roy        - 11301025 </em></li>
                    </span>
                </div>
            </div>
        </div>
    </body>
</html>