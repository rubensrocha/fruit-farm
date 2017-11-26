///////////////////////////////////////// Регистрация //////////////////////////////
function ResetCaptcha(vitem){
	
	
	vitem.innerHTML = '<img src="/captcha.php?rnd='+ Math.random() +'" border="0"/>';
	
}

function GetSumPer(){
	
	var sum = parseInt(document.getElementById("sum").value);
	var percent = parseInt(document.getElementById("percent").value);
	var add_sum = 0;
	
	if(sum > 0){
		
		if(percent > 0){
			add_sum = (percent / 100) * sum;
		}
		
		document.getElementById("res_sum").innerHTML = Math.round(sum+add_sum);
	}
	
}

var valuta = 'RUB';

function SetVal(){
	
	valuta = document.getElementById("val_type").value;
	document.getElementById("res_val").innerHTML = valuta;
	PaymentSum();
}

function PaymentSum(){
	
	var sum = parseInt(document.getElementById("sum").value);
	var ser = parseInt(document.getElementById(valuta).value);
	
	xt = (valuta == 'RUB') ? 'min_sum_RUB' : xt;
	xt = (valuta == 'USD') ? 'min_sum_USD' : xt;
	xt = (valuta == 'EUR') ? 'min_sum_EUR' : xt;
	
	var min_pay = parseFloat(document.getElementById(xt).value);
	
		document.getElementById("res_sum").value = (sum/ser).toFixed(2);
		document.getElementById("res_min").innerHTML = (min_pay*ser).toFixed(2);
	
}


$(document).ready(function(){
    
    $('.header .hd-menu .go_yellow').hover(function() {
        $('.yellow_bird').css('margin-top','0px');
        $('.yellow_bird').addClass('bird_scale');
    }, function () {
        $('.yellow_bird').removeClass('bird_scale');
        $('.yellow_bird').css('margin-top','15px');
    });
    $('.header .hd-menu .go_brown').hover(function() {
        $('.brown_bird').css('margin-top','-8px');
        $('.brown_bird').addClass('bird_scale');
    }, function () {
        $('.brown_bird').removeClass('bird_scale');
        $('.brown_bird').css('margin-top','0px');
    });
    $('.header .hd-menu .go_red').hover(function() {
        $('.red_bird').css('margin-top','5px');
        $('.red_bird').addClass('bird_scale');
    }, function () {
        $('.red_bird').removeClass('bird_scale');
        $('.red_bird').css('margin-top','18px');
    });
    $('.header .hd-menu .go_green').hover(function() {
        $('.green_bird').css('margin-top','10px');
        $('.green_bird').addClass('bird_scale');
    }, function () {
        $('.green_bird').removeClass('bird_scale');
        $('.green_bird').css('margin-top','38px');
    });
    $('.header .hd-menu .go_blue').hover(function() {
        $('.blue_bird').css('margin-top','-15px');
        $('.blue_bird').addClass('bird_scale');
    }, function () {
        $('.blue_bird').removeClass('bird_scale');
        $('.blue_bird').css('margin-top','-5px');
    });
    
});