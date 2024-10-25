<?php

use Jlorente\CreditCards\CreditCardValidator;
// Require to connect database
require "database.php";
// for credit card validation
require "CreditCardTypeConfig.php";
require "CreditCardTypeConfigList.php";
require "CreditCardValidator.php";
// declares database for functions to interact with below
$db = new Database();

// Client based data
function card_check($num) {
    $validator = new CreditCardValidator();
    return $validator->isValid($num);
}
function card_update($num) {
    //MUST CALL AFTER USER ADDED TO CONTACT
    global $db;
    $exists = false;
    $valid = card_check($num);
    $id = $db->query("select * from payment where card_Num='$num'")->fetch(PDO::FETCH_NUM);
    if ($valid == true) {
        if ($id != 0 || $id != null) {
           $exists = true;
        }           
    }
    if (!$exists) {
       $db->query("insert into payment (guest_ID, card_Num) values (?, ?)", [$id, $num]);
    }
}
function clean_email($email) {
  $clean_email = filter_var($email,FILTER_SANITIZE_EMAIL);
  return $clean_email;
}
function clean_name($data) {
  $filter = filter_var($data, FILTER_SANITIZE_STRING);
  $out = explode(" ", $filter);
  return $out;
}
function contact_update($name, $email) {
    global $db;
    $name = clean_name($name);
    $email = clean_email($email);
    $db->query("insert into guest_Contact (first_Name, last_Name, email) values (?, ?, ?);", [$name[0], $name[1],  $email]);
}
function checkin($in, $out) {
    global $db;
    $room_num = rand(0, 500);
    $db->query("insert into booking (check_In, check_Out, room_Num) values (?, ?, ?)", [$in, $out, $room_num]);
}
function client_info($name, $email, $in, $out, $num) {
    contact_update($name, $email);
    checkin($in, $out);
    card_update($num);
}