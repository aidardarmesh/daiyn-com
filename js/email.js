email = document.getElementById('email');

email.onfocus = function() {
	$('#email').removeClass('shake');
}

email.onchange = function() {
	if (!isEmailCorrect(this.value)) {
		$('#email').addClass('shake');
	}
}

function isEmailCorrect(emailString) {
	if (emailString.match(/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/) != null) {
		return true;
	} else {
		return false;
	}
}