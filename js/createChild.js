function createChild(container, element, id) {
	// CREATING CHILD WRAPPER
	var childWrapper = document.createElement('div');
	childWrapper.className = 'child-wrapper';
	childWrapper.id = id;

	// CREATING CHILD
	var child = document.createElement('div');
	child.className = 'child ' + element.type;

	// CREATING CLOSE BUTTON
	var close = document.createElement('div');
	close.innerHTML = '&#10005;';
	close.className = 'close ' + element.type;

	child.onclick = function() {
		// ADJUSTING COPIES OPTION
		document.getElementById('copies-sum').innerHTML = element.copies;

		// UNSTYLING PREVIOUS CHILD
		if (activeChildId != "") {
			// CLOSE BUTTON
			document.getElementById(activeChildId).childNodes[0].style.color = null;
			// CHILD ITSELF
			document.getElementById(activeChildId).childNodes[1].style.borderColor = "#fff";
		}

		// TARGETTING ACTIVE CHILD
		activeChildId = this.parentNode.id;

		// STYLING ACTIVE CHILD
		switch (element.type) {
			case 'doc':
				this.style.borderColor = '#1d3d51';
				this.parentNode.childNodes[0].style.color = '#1d3d51';
				break;
			case 'docx':
				this.style.borderColor = '#3498db';
				this.parentNode.childNodes[0].style.color = '#3498db';
				break;
			case 'pdf':
				this.style.borderColor = '#e74c3c';
				this.parentNode.childNodes[0].style.color = '#e74c3c';
				break;
			default:
				this.style.borderColor = '#fff';
		}

		// SHOWING NAME OF CURRENT FILE
		document.getElementById('currentFileName').innerHTML = element.short_name;

		// SHOWING COPIES
		showCopies(true);

		// SHOWING COPIES TOOL
		showCopiesTool(true);
	}

	close.onclick = function() {
		// DELETING FROM DOM
		var childWrapperId = this.parentNode.id;
		if (this.parentNode.id == activeChildId) {
			activeChildId = "";

			// BLURING PREVIEW
			showCopiesTool(false);
			document.getElementById('currentFileName').innerHTML = '';
		}
		$('#' + childWrapperId).addClass('zoomOut');
		setTimeout(function() {
			carousel.removeChild(document.getElementById(childWrapperId));
		}, 350);

		// DELETING FROM DATA
		delete container[childWrapperId];
		filesNumberRefresh('files-number', container);

		// ADJUSTING MARGIN-LEFT
		if (filesNumber(container) > 2) {
			state = -101.5 * (filesNumber(container) - 2);
		} else {
			state = 0;
		}
		$('#carousel').css({
			'margin-left': state + 'px'
		});
	}

	// CREATING NAME
	var nameContainer = document.createElement('p');
	nameContainer.innerHTML = element.short_name;

	// ASSEMBLING
	childWrapper.appendChild(close);
	child.appendChild(nameContainer);
	childWrapper.appendChild(child);

	// READY!
	return childWrapper;
}