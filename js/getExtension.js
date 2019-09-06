function getExtension(fileName) {
	// DIVIDING STRING TO PIECES THAT WERE DIVIDED BY DOT
	var pieces = fileName.split('.');

	// LAST PIECE IS EXTENSION
	return pieces[pieces.length - 1];
}