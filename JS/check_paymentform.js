//Card Validation-----------------------------------------------
var card_no = document.getElementById('card_no');
card_no.addEventListener("change", chk_card_no ,false);

var security_code = document.getElementById('security_code');
security_code.addEventListener("change", chk_security_code ,false);

var card_name = document.getElementById('name_onCard');
card_name.addEventListener("change", chk_name_onCard ,false);
//--------------------------------------------------------------
//Delivery Address Validation-----------------------------------
var delivery_address = document.getElementsByClassName('delivery');
delivery_address[0].addEventListener("change", chk_deli_name ,false);
delivery_address[1].addEventListener("change", chk_deli_name ,false);

delivery_address[2].addEventListener("change", chk_postal_code , false);
delivery_address[4].addEventListener("change", chk_address , false); 
delivery_address[5].addEventListener("change", chk_contact_no , false);
//-------------------------------------------------------------
//Billing Address Validation-----------------------------------
var billing_address = document.getElementsByClassName('billing');
billing_address[0].addEventListener("change", chk_postal_code ,false);
billing_address[1].addEventListener("change", chk_address ,false);