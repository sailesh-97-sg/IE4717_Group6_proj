function chk_card_no(event){
    var dom = event.currentTarget;
    var pos = dom.value.search(/\d{16}/);

    if(pos != 0){
        dom.setCustomValidity("Card Number must be 16 digit numbers between 0-9.");
        dom.reportValidity();
        dom.focus();
        dom.select();
        return false;
    }
}

function chk_security_code(event){
    var dom = event.currentTarget;
    var pos = dom.value.search(/\d{3}/);
    if(pos != 0){
        dom.setCustomValidity("Security code must be 3 digit numbers between 0-9");
        dom.reportValidity();
        dom.focus();
        dom.select();
        return false;
    }
}

function chk_expiry_date(event){
    var month = document.getElementById('expiry_month');
    var year = document.getElementById('expiry_year');
    var today, someday;
    var dom = event.currentTarget;

    today = new Date();
    current_month = today.getMonth() + 1;
    current_year = today.getFullYear();
    somedate = new Date();
    somedate.setFullYear(year.value,month.value,1);
    somedate_month = somedate.getMonth();
    somedate_year = somedate.getFullYear();

    if(somedate_year < current_year){
        alert("Invalid Expiry Year");
        return false;
    } else if(somedate_month <= current_month){
        alert("Invalid Expiry Month");
        return false;
    }
}

function chk_name_onCard(event){
    var dom = event.currentTarget;
    var pattern = /([A-Z][a-z]+ ?){1,4}/;
    var pos = dom.value.search(pattern);

    if(pos != 0){
        dom.setCustomValidity("Card Number must be 16 digit numbers between 0-9.");
        dom.reportValidity();
        dom.focus();
        dom.select();
        return false;
    }
}