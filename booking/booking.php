<?php 
header('Location: ../php/success.php');
require "../php/functions.php";

$checkIn = $_POST["in"]; 
$checkOut = $_POST["out"];
$name = $_POST["name"];
$mail = $_POST["mail"];
$cardNum = $_POST["num"];
// submission of data
client_info($name, $mail, $checkIn, $checkOut, $cardNum);
exit();