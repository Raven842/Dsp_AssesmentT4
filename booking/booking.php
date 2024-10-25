<?php 
// requires function
require "functions.php";

var_dump($_POST);
die ();
$checkIn = $_POST["checkIn"]; 
$checkOut = $_POST["checkOut"];
$mail = $_POST["mail"];
$name = $_POST["name"];
$cardNum = $_POST["cardNum"];

// submission of data
client_info($name, $mail, $checkIn, $checkOut, $cardNum);

