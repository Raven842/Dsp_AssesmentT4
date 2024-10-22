<?php

use Jlorente\CreditCards\CreditCardValidator;


require "database.php";
// declares database for functions to interact with below


require "vendor/jlorente/php-credit-cards/src/CreditCardTypeConfig.php";
require "vendor/jlorente/php-credit-cards/src/CreditCardTypeConfigList.php";
require "vendor/jlorente/php-credit-cards/src/CreditCardValidator.php";
$db = new Database();
// get current guest ID
function get_id($data) {
    $id = $data->query("select * from payment order by guest_ID desc limit 1")->fetch(PDO::FETCH_NUM);
    $id = $id[0];
    $id++;
    return $id;
}
function avail_check($roomType, $data) {
    $numAvail = $data->query("select * from room_Avail where type='$roomType'")->fetch(PDO::FETCH_ASSOC);
    if ($numAvail > 0) {
        $isAvail = true;
    } else {
        $isAvail = false;
    }
    return $isAvail;
}
function card_check($num) {
    $validator = new CreditCardValidator();
    return $validator->isValid($num);
}
function card_update($num, $data) {
    //MUST CALL AFTER USER ADDED TO CONTACT
    $exists = false;
    $valid = card_check($num);
    $id = get_id($data);
    if ($valid == true) {
        if ($data->query("select * from payment where card_Num='$num'")->fetch(PDO::FETCH_NUM) == 0) {
           $exists = true;
        }           
    }
    if ($exists) {
       $data->query("insert into payment (guest_ID, card_Num) values ($id, $num)");
    }
    
}
