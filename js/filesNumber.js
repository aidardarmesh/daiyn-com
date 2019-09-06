function filesNumber(container) {
	var count = 0;
	for (var i in container) count++;
	return count;
}