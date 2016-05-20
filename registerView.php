<?php
session_start();
?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Create Account | M~Hub</title>
        <meta name="author" content="Tanvir" />
        <link rel="shortcut icon" href="images/icon.ico" >
        <link rel="stylesheet" type="text/css" href="css/blueprint/blueprint/ie.css"/>
        <link rel="stylesheet" type="text/css" href="css/blueprint/blueprint/screen.css"/>
        <link rel="stylesheet" type="text/css" href="css/blueprint/blueprint/plugins/buttons/screen.css"/>
        <link rel="stylesheet" type="text/css" href="css/blueprint/blueprint/src/forms.css"/>
        <link rel="stylesheet" type="text/css" href="css/custom.css"/>
        <link rel='stylesheet' id='camera-css' href='css/camera.css' type='text/css' media='all'>
        <script type="text/javascript" src='scripts/jquery.js'></script>
        <script type='text/javascript' src='scripts/jquery.min.js'></script>
        <script type='text/javascript' src='scripts/jquery.mobile.customized.min.js'></script>
        <script type='text/javascript' src='scripts/jquery.easing.1.3.js'></script>
        <script type='text/javascript' src='scripts/camera.min.js'></script>
        <script>
            jQuery(function() {
                jQuery('#camera_wrap_1').camera({
                });
            });

            function checkPasswordMatch() {
                var pass = $("#id_password").val();
                var confirmPassword = $("#id_rpassword").val();

                if (pass != confirmPassword) {
                    $("#errorshowingdiv").html("Passwords do not match!");
                } else {
                    $("#errorshowingdiv").html("Passwords match.");
                }
            }
            $(document).ready(function() {
                $("#id_rpassword").keyup(checkPasswordMatch);
            });

            function check() {
                if ($("#id_firstname").val() == "" || $("#id_lastname").val() == "" || $("#id_email").val() == ""
                    || $("#id_password").val() == "" || $("#id_rpassword").val() == "" || $("#id_birthday").val() == "" 
                    || $("#id_address").val() == "") {
                    alert("Fill up the form propperly.");
                    return false;
                } else {
                    alert("Proceed...");
                    return true;
                }
            }

            function errorMessage($message) {
                alert($message);
            }
        </script>
    </head>

    <body>
        <div class="container maincontainer">
            <div class="span-24   head">
                <img  src="images/header.jpg" alt="Banner">
            </div>
             <span class="span-24  menubar"> .<br><br><br></span>
            
            <div class="span-14 last advertise"><br>
                <h2><center><b> OUR TOP CHART MOVIES </b></center></h2><br>
                <div class="fluid_container">
                    <div class="camera_azure_skin camera_wrap" id="camera_wrap_1">
                        <div  data-src="images/slides/realsteel.jpg"></div>
                        <div  data-src="images/slides/brave.jpg"></div>
                        <div  data-src="images/slides/batman.jpg"></div>
                        <div  data-src="images/slides/titanic.jpg"></div>
                        <div  data-src="images/slides/safehouse.jpg"></div>
                        <div  data-src="images/slides/bond007.jpg"></div>
                        <div  data-src="images/slides/iceage.jpg"></div>
                    </div>
                </div>
            </div>
            
            <span class="span-8 info push-1 signindiv">
                <form method="post" action="registerInput.php" onsubmit="return check()">
                    <label for="dummy1"><h3>Create a M~Hub Account</h3></label>
                    <label for="dummy1">First Name</label>
                    <input type="text" class="text" id="id_firstname" name="firstname" value="">
                    <label for="dummy1">Last Name</label>
                    <input type="text" class="text" id="id_lastname" name="lastname" value="">
                    <label for="dummy3">Password</label>
                    <input type="password" class="text" id="id_password" name="password" value="">
                    <label for="dummy3">Re-type Password</label>
                    <input type="password" class="text" id="id_rpassword" onchange="checkPasswordMatch();" value="">
                    <div style="color: red; min-height: 20px; min-width: 60px" id="errorshowingdiv"></div>
                    <label for="dummy_email">E-mail Address</label>
                    <input type="email" placeholder="example@gmail.com" class="text" id="id_email" name="email" value="">
                    <label for="dummy1">Birthday</label><br>
                    Day <input name="registrationDay" id="user_lic" type="number" min="1" max="31" step="1" value ="1"/>
                    Month <input name="registrationMonth" id="user_lic" type="number" min="1" max="12" step="1" value ="1"/>
                    Year <input name="registrationYear" id="user_lic" type="number" min="1980" max="2010" step="1" value ="1990"/><br><br>
                    <label for="dummy1">Address</label>
                    <input type="text" class="text" id="id_address" name="address" value=""><br><br>
                    <input type="submit" name="signup" value="Sign-Up">
                </form> 
            </span>
        </div>
    </body>
</html>