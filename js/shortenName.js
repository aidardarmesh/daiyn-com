function shortenName(name) {
	if (name.length > 7) {
		return name.substring(0, 7) + "...";
	}
	return name;
}