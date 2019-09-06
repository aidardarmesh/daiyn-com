function showFiles(container) {
	// SHOWING FILES
	$('#files').css({
		'display': 'block'
	});

	// SHOWING PERSONAL INFO BLOCK
	showPersonal(true);

	// BLURING PREVIEW
	showCopiesTool(false);
	document.getElementById('currentFileName').innerHTML = '';

	var filesNumberValue = filesNumber(container);

	// MOVE CAROUSEL ONLY IF NUMBER OF FILES IN DATA MORE THAN 2
	// BECAUSE THIS IS THE ONLY NEED
	if (filesNumberValue > 2) {
		state = -101.5 * (filesNumberValue - 2);
	} else {
		state = 0;
	}

	// ACTUAL CAROUSEL MOVE EITHER STATE IS 0 OR NOT
	$('#carousel').css({
		'margin-left': state + 'px'
	});

	// ZEROIZING CONTENT OF CAROUSEL
	carousel.innerHTML = '';

	// FULFILLING CAROUSEL WITH ALL FILES IN DATA
	for (var i in container) {
		var child = createChild(container, container[i], i);
		carousel.appendChild(child);
	}
}

function showCopiesTool(choice) {
	if (choice == true) {
		$('#copies-tool').css({
			'display': 'inline-block'
		});
	} else {
		$('#copies-tool').css({
			'display': 'none'
		});
	}
}

function showCopies(choice){
	if(choice == true){
		$('#copies').css({
			'display': 'block'
		});
	} else {
		$('#copies').css({
			'display': 'none'
		});
	}
}

function showPersonal(choice){
	if(choice == true){
		$('#personal').css({
			'display': 'block'
		});
	} else {
		$('#personal').css({
			'display': 'none'
		});
	}
}