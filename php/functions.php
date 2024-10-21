<?php

use Jlorente\CreditCards\CreditCardValidator;
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
 $validator = new CreditCardValidator([
    CreditCardValidator::TYPE_VISA,
    CreditCardValidator::TYPE_AMERICAN_EXPRESS,
    CreditCardValidator::TYPE_MASTERCARD,    
 ]);
 return $validator->isValid($num);
}
function card_update($num, $db) {
    if card_check($num) {
        $db->query("insert into payment (card_Num) values ($num)");
    }
}