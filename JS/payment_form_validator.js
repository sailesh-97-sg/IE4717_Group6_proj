var flag1;
var flag2;
var flag3;
var flag4;
var flag5;
var flag6;
var flag7;
var flag8;
var flag9;

function chk_card_no(event){
    var dom = event.currentTarget;
    var pos = dom.value.search(/(^\d{4})[ -]?(\d{4})[ -]?(\d{4})[ -]?(\d{4}$)/g);
    //alert("regex is" + pos);
    if(pos != 0){
        //alert("Card Number must be 16 digit numbers between 0-9.");
        dom.setCustomValidity("Card Number must be 16 digit numbers between 0-9.");
        dom.reportValidity();
        setTimeout(function(){dom.setCustomValidity("");},2000)
        dom.focus();
        dom.select();
        flag1 = false;
        return false;
    }
    flag1 = true;
}

function chk_security_code(event){
    var dom = event.currentTarget;
    var pos = dom.value.search(/\d{3}/g);
    if(pos != 0){
        dom.setCustomValidity("Security code must be 3 digit numbers between 0-9");
        dom.reportValidity();
        setTimeout(function(){dom.setCustomValidity("");},2000)
        dom.focus();
        dom.select();
        flag2 = false;
        return false;
    }
    flag2 = true;
}

function chk_expiry_date(){
    var month = document.getElementById('expiry_month');
    var year = document.getElementById('expiry_year');
    var today;

    today = new Date();
    current_month = today.getMonth();
    current_year = today.getFullYear();
    var somedate = new Date();
    somedate.setFullYear(year.value,month.value,1);
    somedate_month = somedate.getMonth();
    somedate_year = somedate.getFullYear();

    if(somedate_year > current_year){
        flag3 = true;
        return true;
    } else if(somedate_year == current_year){
        if(somedate_month >= current_month){
            flag3 = true;
            return true;
        } else {
            month.setCustomValidity("Invalid Expiry Month");
            month.reportValidity();
            setTimeout(function(){month.setCustomValidity("");},2000)
            month.focus();
            flag3 = false;
            return false;
        }
    } else {
        year.setCustomValidity("Invalid Expiry Year");
        year.reportValidity();
        setTimeout(function(){year.setCustomValidity("");},2000)
        year.focus();
        flag3 = false;
        return false;
    }
}

function chk_name_onCard(event){
    var dom = event.currentTarget;
    //var pattern = /([a-z]+ ?){2,4}/;
    var pattern = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/g;
    var pos = dom.value.search(pattern);

    if(pos == -1){
        dom.setCustomValidity("Name must not include invalid characters.(e.g. digits, $,@,%,&) and have more than one word.");
        dom.reportValidity();
        setTimeout(function(){dom.setCustomValidity("");},2000)
        dom.focus();
        dom.select();
        flag4 = false;
        return false;
    } else {
        dom.value = dom.value.toUpperCase();
        flag4 = true;
        return true;
    }
}

function chk_first_name(event){
    var dom = event.currentTarget;
    //var pattern = /([a-z]+ ?){1,3}/;
    var pattern = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/g;
    var pos = dom.value.search(pattern);

    if(pos!= 0){
        dom.setCustomValidity("Name must not include invalid characters.(e.g. digits, $,@,%,&) and have one or more than one word.");
        dom.reportValidity();
        setTimeout(function(){dom.setCustomValidity("");},2000)
        dom.focus();
        dom.select();
        flag5 = false;
        return false;
    } else {
        dom.value = dom.value.toUpperCase();
        flag5 = true;
        return true;
    }
}

function chk_last_name(event){
    var dom = event.currentTarget;
    //var pattern = /([a-z]+ ?){1,3}/;
    var pattern = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/g;
    var pos = dom.value.search(pattern);

    if(pos!= 0){
        dom.setCustomValidity("Name must not include invalid characters.(e.g. digits, $,@,%,&) and have one or more than one word.");
        dom.reportValidity();
        setTimeout(function(){dom.setCustomValidity("");},2000)
        dom.focus();
        dom.select();
        flag9 = false;
        return false;
    } else {
        dom.value = dom.value.toUpperCase();
        flag9 = true;
        return true;
    }
}

function chk_postal_code(event){
    var dom = event.currentTarget;
    var pattern = /\d{6}/;
    var pos = dom.value.search(pattern);

    if(pos!=0){
        dom.setCustomValidity("Invalid Postal Code. Singapore Postal code is 6-digit number.");
        dom.reportValidity();
        setTimeout(function(){dom.setCustomValidity("");},2000)
        dom.focus();
        dom.select();
        flag6 = false;
        return false;
    }
    flag6 = true;
}

function chk_address(event){
    var dom = event.currentTarget;
    var pattern = /[@!$%^&*]+/g;
    var pos = dom.value.search(pattern);

    if(pos != -1){
        dom.setCustomValidity("Address must not include invalid characters. (!@$%^&*).");
        dom.reportValidity();
        setTimeout(function(){dom.setCustomValidity("");},2000)
        dom.focus();
        dom.select();
        flag7 = false;
        return false;
    }
    flag7 = true;
}

function chk_contact_no(event){
    var dom = event.currentTarget;
    var pattern = /^[\+]?([0-9]{1,3})?[0-9]{8}$/g;
    var pos = dom.value.search(pattern);

    if(pos != 0){
        dom.setCustomValidity("Contact Number must be 8-digit combination with or without country code e.g (+)(65)12345678");
        dom.reportValidity();
        setTimeout(function(){dom.setCustomValidity("");},3000)
        dom.focus();
        dom.select();
        flag8 = false;
        return false;
    }
    flag8 = true;
}