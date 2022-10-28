//Card Validation-----------------------------------------------
var card_no = document.getElementById('card_no');
card_no.addEventListener("blur", chk_card_no ,false);

var security_code = document.getElementById('security_code');
security_code.addEventListener("blur", chk_security_code ,false);

var card_name = document.getElementById('name_onCard');
card_name.addEventListener("blur", chk_name_onCard ,false);
//--------------------------------------------------------------
//Delivery Address Validation-----------------------------------