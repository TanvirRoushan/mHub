<?php

session_start();
if (isset($_POST['logoutbutton'])) {
    session_destroy();
}
if (isset($_POST['submitting'])) {
    echo "<script type='text/javascript'>alert('got something');</script>";
}
?>