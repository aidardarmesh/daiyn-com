function createHash(length) {
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
	var hash = "";
	for (var i = 0; i < length; i++) {
		var randomNumber = Math.floor(Math.random() * chars.length);
		hash += chars.substring(randomNumber, randomNumber + 1);
	}
	return hash;
}