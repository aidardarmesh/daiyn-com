var leftBtn = document.getElementById('left-btn');

leftBtn.onclick = function() {
	if (state < 0) {
		state += 101.5;
		$('#carousel').css({
			'margin-left': state + 'px'
		});
	}
}

var rightBtn = document.getElementById('right-btn');

rightBtn.onclick = function() {
	var filesNumberValue = filesNumber(data);
	if (state > (filesNumberValue - 2) * (-101.5)) {
		state -= 101.5;
		$('#carousel').css({
			'margin-left': state + 'px'
		});
	}
}