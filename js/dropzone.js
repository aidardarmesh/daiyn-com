var dropzone = document.getElementById('dropzone');

dropzone.ondragover = function() {
	// MAKING BORDER DARKER
	$(this).addClass('dragover');
	return false;
}

dropzone.ondragleave = function() {
	// MAKING BORDER LIGHTER
	$(this).removeClass('dragover');
	return false;
}

dropzone.ondrop = function(e) {
	// BLOCKING DEFAULT BROWSER BEHAVIOUR
	e.preventDefault();

	// MAKING BORDER LIGHTER
	$(this).removeClass('dragover');

	// ADDING FILTERED FILES
	addFilteredFiles(data, e.dataTransfer.files);

	// REFRESHING FILES NUMBER LABEL
	filesNumberRefresh('files-number', data);

	// SHOWING FILES
	showFiles(data);
}

var dropzoneInput = document.getElementById('dropzone-input');

dropzoneInput.onchange = function() {
	// ADDING FILTERED FILES
	addFilteredFiles(data, this.files);

	// REFRESHING FILES NUMBER LABEL
	filesNumberRefresh('files-number', data);

	// SHOWING FILES
	showFiles(data);
}

dropzone.onclick = function() {
	// IMITATING DROPZONE CLICKING
	dropzoneInput.click();
}