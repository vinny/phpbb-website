// Toggles an individual planel on the Team Listing page
function toggle_panel(id) {
	var e = document.getElementById(id);
	if(e.style.display == 'none' || e.style.display == '')
		e.style.display = 'block';
	else
		e.style.display = 'none';
}

// Hide the panels in runtime on page load if JavaScript is enabled
if (document.getElementById && document.getElementsByTagName && document.createTextNode) {
        document.write('<style type="text/css"> dd.detailed-definition { display: none; } </style>');
}