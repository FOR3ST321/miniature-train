$("#gender_filter").on("change", function () {
    window.location = '/home/' + $(this).val();
});

$("#lang").on("change", function () {
    window.location = $(this).val();
});

$("#regis_noBtn").hide();
$("#regist_fee").on('keyup', function (e) {
    let price = parseInt($("#regist_price").text());
    if ($(this).val().length > 0) {
        let amount = parseInt($(this).val());
        console.log(amount, price)
        if(amount < price){
            $("#regis_noBtn").hide();
            $("#regis_payment_btnTxt").text("Pay");
            $("#regist_pay_button").attr("disabled", true);
            $("#notif_regist").text(`*You need more ${price-amount} coin to complete the registration`);
        }
        else{
            if(amount !== price){
                $("#notif_regist").text(`*You overpaid ${amount-price} coin(s), would you like to deposit the remaining coins?`);
                $("#regis_payment_btnTxt").text("Yes, Deposit");
            }
            $("#regist_pay_button").removeAttr("disabled");
            $("#regis_noBtn").show();
        }
    } else {
        $("#send_button").attr("disabled", "true");
    }
});

$("#regis_noBtn").on('click', function (e) {
    $("#regist_fee").focus();
});