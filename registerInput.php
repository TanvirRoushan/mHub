<?php

session_start();
$con = mysql_connect("localhost", "817046_dost01", "moviepass");
if (!$con)
    echo "Unable to Connected\n";
mysql_select_db('mhub_zymichost_moviedb');

if (isset($_POST['signup'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $pass = $_POST['password'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $date = $_POST['registrationDay'];
    $mon = $_POST['registrationMonth'];
    $year = $_POST['registrationYear'];
    $bday = $year . "-" . $mon . "-" . $date;

    //$a = getdate();
    //$date = mktime(0,0,0,$a[mday],$a[month],$a[year]);
    //$joindate = date("Y-m-d", $date);
    $joindate = date("Y-m-d");
    //echo($firstname."</br>".$lastname."</br>".$pass."</br>".$bday."</br>".$address."</br>".$joindate."</br>");
    $query = "insert into user (firstName, lastName, email, password, birthDay, address, joinDate) values('$firstname', '$lastname', '$email', '$pass', '$bday', '$address', '$joindate');";
    $queryresult = mysql_query($query);
    if ($queryresult) {
        //echo("successful");
        $query2 = "SELECT userId FROM user WHERE email='$email'";
        $queryResult2 = mysql_query($query2);
        if ($rows = mysql_fetch_array($queryResult2)) {
            $_SESSION['id'] = $rows['userId'];
            //echo $_SESSION['id'];
        }
        mysql_close($con);
        //$_SESSION['id'] = $row['userId'];
        $_SESSION['email'] = $email;
        $_SESSION['firstName'] = $firstname;
        $_SESSION['lastName'] = $lastname;
        $_SESSION['flag'] = "0";
        $_SESSION['showinfomarker'] = -1;
        header('Location:homeView.php');
    } else {
        echo("failed");
        header('Location:registerView.php');
    }
}
?>