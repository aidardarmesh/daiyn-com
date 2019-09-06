function getName(fileName) {
	// DIVIDING STRING TO PIECES THAT WERE DIVIDED BY DOT
	var pieces = fileName.split('.');
	var name = "";

	// SUMMING UP ALL PIECES EXCEPT LAST
	for (var i = 0; i < pieces.length - 1; i++) {
		name += pieces[i] + '.';
	}
	return name.substring(0, name.length - 1);
}