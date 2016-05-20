<?php
session_start();
	$sessionFlag = $_SESSION['flag'];
if($sessionFlag == ""){
	header('Location:index.php');
}
$towhom = $_GET['toWhom'];
$email = $_GET['email'];
$movieName = $_GET['movieName'];
$useremail = $_SESSION['email'];
$name = $_SESSION['firstName']." ".$_SESSION['lastName'];

$messageBody1= "Dear User $towhom,\n$name has requested the movie $movieName which is in your possession.\n \nContact info of both party: \n  Requested to: \n    $towhom  $email \n  Requested by: ";
$messageBody2 = "\n    $name  $useremail \n \n \nRegards. \nM~HUB TEAM";

$subject = "request from ".$name." for ".$movieName;
// echo $towhom;
// echo "</br>";
// echo $email;
// echo "</br>";
// echo $movieName;
// echo "</br>";
// echo $useremail;
// echo "</br>";
// echo $name;
// echo "</br>";
// echo $messageBody1;
// echo "</br>";
// echo $messageBody2;
// echo "</br>";
// echo $subject;
// echo "</br>";
require_once 'swift/lib/swift_required.php';

$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
  ->setUsername('mdost370')
  ->setPassword('cse370project'); 
  
$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance($subject)
  ->setFrom(array('mdost370@gmail.com' => 'M~HUB'))
  ->setTo(array($email, $useremail))
  ->setBody($messageBody1." ".$messageBody2);

$result = $mailer->send($message);

header('Location:homeView.php'); // according to shaashwato
?>