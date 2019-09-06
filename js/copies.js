copiesMinus = document.getElementById('copies-minus');
copiesSum = document.getElementById('copies-sum');
copiesPlus = document.getElementById('copies-plus');

copiesMinus.onclick = function() {
	if (data[activeChildId].copies > 1) {
		data[activeChildId].copies--;
	}
	copiesSum.innerHTML = data[activeChildId].copies;
}

copiesPlus.onclick = function() {
	data[activeChildId].copies++;
	copiesSum.innerHTML = data[activeChildId].copies;
}