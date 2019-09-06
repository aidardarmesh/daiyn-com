phone = document.getElementById('phone');

phone.onfocus = function() {
	$('#phone').removeClass('shake');
}

phone.onchange = function() {
	if (!isPhoneCorrect(this.value)) {
		$('#phone').addClass('shake');
	}
}

function isPhoneCorrect(phoneString) {
	if (phoneString.match(/\87\d{9}\b/) != null) {
		return true;
	} else {
		return false;
	}
}