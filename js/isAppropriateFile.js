function isAppropriateFile(file) {
	switch (file.type) {
		// PDF
		case "application/pdf":
			return true;
			// DOC
		case "application/msword":
			return true;
			// DOCX
		case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
			return true;
		default:
			return false;
	}
}