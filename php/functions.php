<?php
// Require to connect database
require "database.php";
// for credit card validation
use Jlorente\CreditCards\CreditCardValidator;
require "vendor/jlorente/php-credit-cards/src/CreditCardTypeConfig.php";
require "vendor/jlorente/php-credit-cards/src/CreditCardTypeConfigList.php";
require "vendor/jlorente/php-credit-cards/src/CreditCardValidator.php";
// declares database for functions to interact with below
$db = new Database();
// get current guest ID
function get_id() {
    $id = $db->query("select * from guest_Contact order by guest_ID desc limit 1")->fetch(PDO::FETCH_NUM);
    $id = $id[0]++;
    return $id;
}
function card_check($num) {
    $validator = new CreditCardValidator();
    return $validator->isValid($num);
}
function card_update($num) {
    //MUST CALL AFTER USER ADDED TO CONTACT
    $exists = false;
    // Note cannot contain sql injection if cardnum is valid thus further sanitisation not needed
    $valid = card_check($num);
    if ($valid == true) {
        if ($db->query("select * from payment where card_Num='$num'")->fetch(PDO::FETCH_NUM) == 0) {
           $exists = true;
        }           
    }
    if ($exists) {
       $db->query("insert into payment (card_Num) value ($num)");
    }
    
}
function clean_email($email) {
  $clean_email = filter_var($email,FILTER_SANITIZE_EMAIL);
  return $clean_email;
}
function clean_string($data) {
  $out = filter_var($data, FILTER_SANITIZE_STRING);
  return $out;
}
function contact_update($name, $email) {
    $name = clean_string($name);
    $email = clean_email($email);
    $db->query("insert into guest_Contact (name, email) values ($name, $email)");
}
function checkin($in, $out) {
    $room_num = rand(0, 500);
    $db->query("insert into booking (check_In, check_Out, room_Num) values ($in, $out, $room_num)");
}
function client_info($name, $mail, $in, $out, $num) {
    contact_update($name, $mail);
    checkin($in, $out);
    card_update($num);

}