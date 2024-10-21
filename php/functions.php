<?php
include "database.php";
// declares database for functions to interact with below
$db = new Database();
function avail_check($roomType, $db) {
    $numAvail = $db->query("select * from room_Avail where type='$roomType'")->execute();
    if ($numAvail > 0) {
        $isAvail = true;
    } else {
        $isAvail = false;
    }
    return $isAvail;
}
function card_check($num) {
    $len = strlen($num);
    
    return $isValid;
}