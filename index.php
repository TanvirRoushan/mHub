<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Welcome | M~Hub</title>
        <meta name="author" content="Tanvir" />
        <link rel="shortcut icon" href="images/icon.ico" >
        <link rel="stylesheet" type="text/css" href="css/blueprint/blueprint/ie.css"/>
        <link rel="stylesheet" type="text/css" href="css/blueprint/blueprint/screen.css"/>
        <link rel="stylesheet" type="text/css" href="css/blueprint/blueprint/plugins/buttons/screen.css"/>
        <link rel="stylesheet" type="text/css" href="css/blueprint/blueprint/src/forms.css"/>
        <link rel="stylesheet" type="text/css" href="css/custom.css"/>
        <link rel='stylesheet' id='camera-css' href='css/camera.css' type='text/css' media='all'> 
        <script type='text/javascript' src='scripts/jquery.min.js'></script>
        <script type='text/javascript' src='scripts/jquery.mobile.customized.min.js'></script>
        <script type='text/javascript' src='scripts/jquery.easing.1.3.js'></script> 
        <script type='text/javascript' src='scripts/camera.min.js'></script> 

        <script>
            jQuery(function(){
                jQuery('#camera_wrap_1').camera({
                });
            });
        </script>
    </head>

    <body>
        <div class="container maincontainer">
            <div class="span-24   head">
                <img  src="images/header.jpg" alt="Banner">
            </div>

            <span class="span-24  menubar">.<br><br><br></span>

            <div class="span-14 advertise last">
                 <h2><center><b> OUR TOP CHART MOVIES </b></center></h2><br> <br>
                <div class="fluid_container">
                    <div class="camera_azure_skin camera_wrap" id="camera_wrap_1">
                        <div  data-src="images/slides/iceage.jpg"> </div>
                        <div  data-src="images/slides/batman.jpg"> </div>
                        <div  data-src="images/slides/Sherlok.jpg"> </div>
                        <div  data-src="images/slides/brave.jpg"> </div>
                        <div  data-src="images/slides/realsteel.jpg"> </div>
                        <div data-src="images/slides/titanic.jpg"> </div>
                        <div  data-src="images/slides/battleship.jpg"> </div>
                        <div  data-src="images/slides/bourne.jpg"> </div>
                    </div>
                </div>
            </div>

            <span class="span-8 success last  push-1 signindiv">
                <form action="indexInput.php" method="post">
                    <label for="dummy1"><h3>Sign-In </h3></label>
                    <label for="dummy1">E-mail</label><br>
                    <input type="text" class="text" id="id_email_login" name="email_login" value="">
                    <label for="dummy3">Password</label><br>
                    <input type="password" class="text" id="id_password_login" name="password_login" value="">
                    <input type="submit" name="signin" value="Sign-In"><br>
                </form>
            </span>

            <span class="span-8 push-1 info   registerdiv"><br>
                <label for="dummy3"><h3>Not Registered!</h3></label>
                <a href="registerView.php"> <input type="submit" value="Sign-Up"> </a>
            </span>
        </div>
    </body>
</html>