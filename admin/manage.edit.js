															/*
 * Grammatical Changes Database
 * Constructed by Matthew Kessanis, for Rachel Hendery

 * Record edit agent controller for database management - Version 1.05
 * <domain>/manage.edit.js
															*/

var urlParams;

function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function escapeHtml(text) {
	var map = {
		'&': '&amp;',
		'<': '&lt;',
		'>': '&gt;',
		'"': '&quot;',
		"'": '&#039;'
	};
	return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

function getUrlParams() {
	var match,
		pl     = /\+/g,  // Regex for replacing addition symbol with a space
		search = /([^&=]+)=?([^&]*)/g,
		decode = function (s) { return decodeURIComponent(s.replace(pl, " ")); },
		query  = window.location.search.substring(1);

	urlParams = {};
	while (match = search.exec(query))
	   urlParams[decode(match[1])] = decode(match[2]);
}


// TEXT INPUT -------------------------------------------------------------------------
function closeInput(elm,oldValue) {
	var td 					= elm.parentNode;
	var value 				= elm.value;
	var db_elm 				= [urlParams["table"]].concat(elm.parentNode.id.split("."));
	
	td.removeChild(elm);
	td.innerHTML = value;
	
	if (value != oldValue) {
		// Discuss preferred method with Rachel
		$.post( "manage.edit.php", {table: db_elm[0], row: db_elm[1], col: db_elm[2], newvalue: value, oldvalue: oldValue});
	}
}

function addInput(elm) {
	if (elm.getElementsByTagName('input').length > 0) {
		return;
	}
	
	var value = escapeHtml(elm.innerHTML);
	elm.innerHTML = '';

	var input = document.createElement('input');
	input.setAttribute('class', 'tableInput');
	input.setAttribute('type', 'text');
	input.setAttribute('value', value);
	input.setAttribute('onBlur', 'closeInput(this,\''+value+'\')');
	elm.appendChild(input);
	input.focus();
	
	// ADD Return Key Functionality
	input.onkeypress = function (e) {
		if (e.keyCode == 13) {
			input.blur();
		}
	};
}



// CERTAINTY INPUT ------------------------------------------------------------------
var certainty_btns = [];
var certainty_options = 10;

function hideCertaintyBtns(elm,oldValue) {
	var td 					= elm.parentNode;
	var value 				= elm.value;
	var db_elm 				= [urlParams["table"]].concat(td.id.split("."));
	for (var btn_i = 0; btn_i < certainty_options; ++btn_i) {
		td.removeChild(certainty_btns[btn_i]);
	}
	td.innerHTML = value;	
	if (value != oldValue || value == 0) {
		console.log('EDIT REQUEST SENT');
		$.post( "manage.edit.php", {table: db_elm[0], row: db_elm[1], col: db_elm[2], newvalue: value, oldvalue: oldValue});
	}
}

function showCertaintyBtns(elm) {
	if (elm.getElementsByTagName('button').length > 0) {
		return;
	}

	var value = escapeHtml(elm.innerHTML);
	if( value >= 0 && value <= certainty_options && value != '' ) {
		console.log('Value: '+value);
	}
	else {
		value = 0;
		console.log('Value changed to 0');
	}
	elm.innerHTML = '';
	
	for (var btn_i = 0; btn_i < certainty_options; ++btn_i) {
		certainty_btns[btn_i] = document.createElement('button');
		
		// Current value is shown
		if (btn_i == value) {
			certainty_btns[btn_i].setAttribute('class', 'certainty_btn_currentvalue');
		}
		else {
			certainty_btns[btn_i].setAttribute('class', 'certainty_btn');
		}
		certainty_btns[btn_i].setAttribute('id', 'btn.' + btn_i);
		certainty_btns[btn_i].setAttribute('value', btn_i);
		certainty_btns[btn_i].innerHTML = btn_i;
		certainty_btns[btn_i].setAttribute('onClick', 'hideCertaintyBtns(this,\''+value+'\');event.cancelBubble=true;');
		
		elm.appendChild(certainty_btns[btn_i]);
	}
	
	// ADD Keyboard Functionality
	document.onkeypress = function (e) {
		console.log(e.keyCode);
		var key = '';

		if (e.keyCode ==  13 || e.keyCode == 27 ) {
			if( elm.getElementsByTagName('button').length > 0 ) {

				console.log('CANCEL because of a keyboard stroke');
				for (var btn_i = 0; btn_i < certainty_options; ++btn_i) {
					elm.removeChild(certainty_btns[btn_i]);
				}
				elm.innerHTML = value;
			}
		}
		
		else if (e.keyCode >= 48 && e.keyCode <= (48+certainty_options-1) ) {
			key = e.keyCode - 48;
			document.getElementById("btn."+key).click();
		}
		else if (e.keyCode >= 96 && e.keyCode <= (96+certainty_options-1)) {
			key = e.keyCode - 96;
			document.getElementById("btn."+key).click();
		}
	};
	
	// ADD Mouse Functionality
	document.onmousedown = function (event) {
		if( (event.srcElement.id != elm.id) && (event.srcElement.tagName.toUpperCase() != 'BUTTON') && (elm.getElementsByTagName('button').length > 0) ) {
			console.log('CANCEL because of a click');
			for (var btn_i = 0; btn_i < certainty_options; ++btn_i) {
				elm.removeChild(certainty_btns[btn_i]);
			}
			elm.innerHTML = value;
		}
	};
}


// CHECKBOX INPUT ---------------------------------------------------------------------
var options_checkbox		= [];
var options_label			= [];
var optionArray 			= [];

function saveOptions(elm,oldValue) {
	var td 					= elm.parentNode;
	var db_elm				= [urlParams["table"]].concat(td.id.split("."));
	var labelsvalue			= [];
	var newvalue 			= [];
	
	for (var option_i = 0; option_i < optionArray.length; ++option_i) {
		newvalue[option_i]	= document.getElementById("box_"+option_i).checked;
		
		if (document.getElementById("box_"+option_i).checked) {
			labelsvalue.push(optionArray[option_i]);
		}
		td.removeChild(options_label[option_i]);
		td.removeChild(options_checkbox[option_i]);
	}

	var prior       		= td.raw;
	var value 				= newvalue.join(',');
	var shown  				= labelsvalue.join(',');
	var newvalue 			= value.concat('@',shown);
	
	if (prior != value) {
		console.log('EDIT REQUEST SENT');
		$.post( "manage.edit.php", {table: db_elm[0], row: db_elm[1], col: db_elm[2], newvalue: newvalue, oldvalue: prior});
	}
	td.innerHTML 			= shown;
	td.setAttribute('raw', value);
}


function cancelOptions(elm,oldValue) {
	var td 				= elm.parentNode;
	for (var option_i = 0; option_i < optionArray.length; ++option_i) {
		td.removeChild(options_label[option_i]);
		td.removeChild(options_checkbox[option_i]);
	}
	td.innerHTML = oldValue;
}

function showOptions(elm) {
	if (elm.getElementsByTagName('input').length > 0) {
		console.log('CALLED Esc Show Options');
		return;
	}
	var td_info		= elm.id.split(".");
	console.log('Row: '+td_info[0]+'; Column: '+td_info[1]+'; ');
	
	switch (td_info[1]) {
		case "ChangeType":
			optionArray = ["UNKNOWN", "Loss", "Merger", "Reanalysis", "Grammaticalisation", "Innovation", "Word Order Change", "Extension", "Redistribution Of Functions", "Expansion"];
			break;
		
		case "Domain":
			optionArray = ["UNKNOWN", "Phonology", "Morphology", "Syntax", "Morphosyntax", "Semantics", "lexicon"];
			break;
		
		case "EvidenceType":
			//var optionArray = ["UNKNOWN", "Reconstruction", "Related Languages", "Frequency", "", "", "", "", "", "", "", "", "", "", ""];
			optionArray = ["UNKNOWN", "Reconstruction", "Related Languages", "Frequency"];
			break;
		
		default:
			console.log('ERROR - Column Name UNDEFINED...');
			optionArray = [];
			break;
	}
	
	var value = escapeHtml(elm.innerHTML);
	elm.innerHTML = '';

	var currentvalues = elm.getAttribute('raw').split(',');
	console.log(currentvalues);
	
	for (var option_i = 0; option_i < optionArray.length; ++option_i) {
		options_checkbox[option_i] 			= document.createElement("input");
		options_checkbox[option_i].type 	= "checkbox";
		options_checkbox[option_i].id		= "box_"+option_i;
		options_checkbox[option_i].name 	= "options[]";
		options_checkbox[option_i].value 	= option_i;
		elm.appendChild(options_checkbox[option_i]);
		
		options_label[option_i]				= document.createElement("label")
		options_label[option_i].htmlFor 	= "box_"+option_i;
		options_label[option_i].appendChild(document.createTextNode(optionArray[option_i]));
		elm.appendChild(options_label[option_i]);

		if ( currentvalues[option_i] == 'true' ) {
			document.getElementById("box_"+option_i).checked = true;
		}
	}

	elm.appendChild(document.createElement("br"));
	
	var submit_btn 				= document.createElement('button');
		submit_btn.setAttribute('id', 'submit_btn');
		submit_btn.setAttribute('class', 'submit_btn');
		submit_btn.innerHTML = '&#10004;';
		submit_btn.setAttribute('onClick', 'saveOptions(this,\''+value+'\');event.cancelBubble=true;');
	elm.appendChild(submit_btn);
	
	var cancel_btn 				= document.createElement('button');
		cancel_btn.setAttribute('id', 'cancel_btn');
		cancel_btn.setAttribute('class', 'cancel_btn');
		cancel_btn.innerHTML = '&#10008;';
		cancel_btn.setAttribute('onClick', 'cancelOptions(this,\''+value+'\');event.cancelBubble=true;');
	elm.appendChild(cancel_btn);


	// ADD Keyboard Functionality
	document.onkeypress = function (e) {
		console.log(e.keyCode);
		var key = '';

		// ENTER KEY
		if (e.keyCode == 13) {
			if( elm.getElementsByTagName('input').length > 0 ) {
				console.log('ENTER -> SAVE because of a keyboard stroke');
				document.getElementById("submit_btn").click();
			}
		}

		// ESCAPE KEY
		else if (e.keyCode == 27) {
			if( elm.getElementsByTagName('input').length > 0 ) {
				console.log('CANCEL because of a keyboard stroke');
				document.getElementById("cancel_btn").click();
			}
		}
		
		else if (e.keyCode >= 48 && e.keyCode <= (48+optionArray.length-1) ) {
			key = e.keyCode - 48;
			document.getElementById("box_"+key).click();
		}
		else if (e.keyCode >= 96 && e.keyCode <= (96+optionArray.length-1)) {
			key = e.keyCode - 96;
			document.getElementById("box_"+key).click();
		}
	};
	
	// ADD Mouse Functionality
	document.onmousedown = function (event) {
		if( (event.srcElement.id != elm.id) && (event.srcElement.tagName.toUpperCase() != 'BUTTON') && (event.srcElement.tagName.toUpperCase() != 'INPUT') && (event.srcElement.tagName.toUpperCase() != 'LABEL') && (elm.getElementsByTagName('input').length > 0) ) {
			console.log('CANCEL because of a click');
			document.getElementById("cancel_btn").click();
		}
	};
}


// INSERT ROW -------------------------------------------------------------------------
function addRow(id) {
	$.post( "manage.newrecord.php", {table: urlParams["table"], row: id});
	window.location.reload(true);
}


// DELETE ROW -------------------------------------------------------------------------
function deleteRow(id) {
	var tr = document.getElementById(id);
	tr.parentNode.removeChild(tr);
	$.post( "manage.delete.php", {table: urlParams["table"], row: id});
}


// GET URL PARAMETERS AND REMOVE CODE INJECTION
getUrlParams();












