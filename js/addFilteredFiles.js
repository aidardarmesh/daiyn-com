function addFilteredFiles(container, files) {
	// LOOPING INPUT FILES
	for (var i = 0; i < files.length; i++) {
		if (isAppropriateFile(files[i])) {
			// CREATING ID FOR ELEMENT IN CONTAINER
			var hash = createHash(16);
			container[hash] = {};

			// CONFIGURING COMMON PROPERTIES
			container[hash].file = files[i];
			container[hash].copies = 1;

			// GETTING NAME TO HELP USER MANAGE FILES
			container[hash].short_name = shortenName(getName(container[hash].file.name));

			// ADJUSTING SPECIFIC PROPERTIES
			if (files[i].type.includes("pdf")) {
				// FOR PDF
				container[hash].type = "pdf";
			} else if (files[i].type.includes("msword")) {
				// FOR .DOC
				container[hash].type = "doc";
			} else if (files[i].type.includes("vnd.openxmlformats-officedocument.wordprocessingml.document")) {
				// FOR .DOCX
				container[hash].type = "docx";
			}
		} else {
			alert(files[i].name + " не поддерживается");
		}
	}
}