<?php 

require "../php/functions.php";

$checkIn = $_POST["in"]; 
$checkOut = $_POST["out"];
$name = $_POST["name"];
$mail = $_POST["mail"];
$cardNum = $_POST["num"];
// submission of data
client_info($name, $mail, $checkIn, $checkOut, $cardNum);
echo ' <script type="text/JavaScript">
    window.location.replace("https://127.0.0.1/Dsp_AssesmentT4/php/sucess.php");
    </script> ';