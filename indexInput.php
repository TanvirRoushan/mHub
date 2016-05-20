<?php

session_start();
$con = mysql_connect("localhost", "817046_dost01", "moviepass");
if (!$con) {
    echo "<script type='text/javascript'>alert('server is currently unavailable');</script>";
}
//echo "Unable to Connected\n";
mysql_select_db('mhub_zymichost_moviedb');

if (isset($_POST['signin'])) {
    $loginemail = $_POST['email_login'];
    $loginpassword = $_POST['password_login'];
    $query = "select * from user where email='$loginemail' and password='$loginpassword';";
    $queryresult = mysql_query($query);
    if ($queryresult) {
        if ($row = mysql_fetch_array($queryresult)) {
            //echo "found";
            $_SESSION['id'] = $row['userId'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['firstName'] = $row['firstName'];
            $_SESSION['lastName'] = $row['lastName'];
            $_SESSION['flag'] = $row['flag'];
            $_SESSION['showinfomarker'] = -1;
            if ($_SESSION['flag'] == 2) {
                header('Location:index.php');
            } else {
                header('Location:homeView.php');
            }
            mysql_close($con);
        } else {
            //echo "not found";
            mysql_close($con);
            header('Location:index.php');
        }

        //header('Location:homeView.php');
    } else {
        //echo "<script type='text/javascript'>alert('$_POST[username]');</script>";
        //echo "query didn't work";
        mysql_close($con);
        header('Location:index.php');
    }
}
?>