var lfGlobal = { "siteUrl": "http:\/\/127.0.0.1\/", "dateMinYear": "1920", "dateMaxYear": 2019 };
var lfCountries = ["Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo, Democratic Republic of the", "Congo, Republic of the", "Costa Rica", "C\u00f4te d&#039;Ivoire", "Croatia", "Cuba", "Cura\u00e7ao", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Faroe Islands", "Fiji", "Finland", "France", "French Polynesia", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Greenland", "Grenada", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "North Korea", "South Korea", "Kosovo", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Palestine, State of", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Puerto Rico", "Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Saint Martin", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Sint Maarten", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "Spain", "Sri Lanka", "Sudan", "Sudan, South", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Virgin Islands, British", "Virgin Islands, U.S.", "Yemen", "Zambia", "Zimbabwe"]; var gf_global = { "gf_currency_config": { "name": "U.S. Dollar", "symbol_left": "$", "symbol_right": "", "symbol_padding": "", "thousand_separator": ",", "decimal_separator": ".", "decimals": 2 }, "base_url": "http:\/\/127.0.0.1\/wp-content\/plugins\/gravityforms-master", "number_formats": [], "spinnerUrl": "http:\/\/127.0.0.1\/wp-content\/plugins\/gravityforms-master\/images\/spinner.gif" };
var lfForm = {
	"title": "Type Form",
	"description": "Type Form",
	"labelPlacement": "top_label",
	"descriptionPlacement": "below",
	"button": {
		"type": "text",
		"text": "Submit",
		"imageUrl": ""
	},
	"fields": [],
	"version": "2.3.2",
	"id": 1,
	"useCurrentUserAsAuthor": true,
	"postContentTemplateEnabled": false,
	"postTitleTemplateEnabled": false,
	"postTitleTemplate": "",
	"postContentTemplate": "",
	"lastPageButton": null,
	"pagination": null,
	"firstPageCssClass": null,
	"postAuthor": "1",
	"postCategory": "1",
	"postFormat": "0",
	"postStatus": "draft",
	"notifications": {
		"5bc439d485436": {
			"id": "5bc439d485436",
			"to": "{admin_email}",
			"name": "Admin Notification",
			"event": "form_submission",
			"toType": "email",
			"subject": "New submission from {form_title}",
			"message": "{all_fields}"
		}
	},
	"confirmations": {
		"5bc439d4950f2": {
			"id": "5bc439d4950f2",
			"name": "Default Confirmation",
			"isDefault": true,
			"type": "message",
			"message": "Thanks for contacting us! We will get in touch with you shortly.",
			"url": "",
			"pageId": "",
			"queryString": ""
		}
	},
	"i18n": {
		"multichoiceTip": "Choose as many as you like and <strong> press ENTER <\/strong>",
		"multichoiceTipMobile": "Choose as many as you like",
		"hintKey": "Key",
		"textareaTip": "To add a paragraph, press <strong> SHIFT + ENTER <\/strong>",
		"uploadButton": "Upload",
		"pressEnter": "press <strong> ENTER <\/strong>",
		"checkboxTip": "Choose as many as you like",
		"multiselectTip": "Press <strong> SHIFT + ENTER <\/strong> and choose as many as you like",
		"progressPercentage": "$1 completed",
		"progressProportional": "$1 of $2 answered",
		"pageProgress": "Step $1 of $2",
		"submit": "Submit",
		"sendEmail": "Send Email",
		"selectFile": "Select file",
		"selectFiles": "Select files",
		"dropFilesHere": "Drop files here or",
		"today": "Today",
		"or": "or",
		"prev": "Previous",
		"next": "Next",
		"select": "Select",
		"yes": "Yes",
		"no": "No",
		"errors": {
			"reviewIsNeeded": "Some fields needs to be reviewed.",
			"required": "You forgot to fill out this field.",
			"reviewFields": "Review Fields",
			"noDuplicates": "It already exists.",
			"invalidUrl": "Enter a valid Website URL, like $1",
			"rangeNotBetween": "Enter a value between $1 and $2.",
			"rangeBelowExpected": "Enter a value greater than or equal to $1.",
			"rangeAboveExpected": "Enter a value less than or equal to $1.",
			"invalidEmail": "Please enter a valid email address.",
			"emailsDoNotMatch": "Your emails do not match.",
			"maxReached": "Maximum number of files reached",
			"fileExceedsLimit": "File exceeds size limit",
			"invalid_file": "There was an problem while verifying your file.",
			"illegal_extension": "Sorry, this file extension is not permitted for security reasons.",
			"illegal_type": "Sorry, this file type is not permitted for security reasons.",
			"unknown_error": "There was a problem while saving the file on the server"
		}
	},
	"ajaxurl": "../\/demo_merge.php",
	"gfUploadUrl": "http:\/\/127.0.0.1\/?gf_page=c5a7b8a3beabe33",
	"wpnonce": "72bec651b8",
	"renderWelcome": true,
	"lastform": {
		"welcomeEnabled": 0
	},
	"save": {
		"enabled": 0
	}
};
var baseOptions = ["Yes", "No"];
var diffOptions = ["NSW, Australia", "London, England"];
var rowCount = 0;

function createForm(item, parentRow, csskey) {
	var choices;
	var selected = true;
	var options = '';
	if (item.type == 'radio') {
		choices = [];
		options = baseOptions;
	}
	if (options) {
		for (opt in options) {
			if (opt > 0) selected = false;
			choices[choices.length] = {
				"text": options[opt],
				"value": item.id + '_@@@@_' + options[opt],
				"isSelected": selected,
				"price": ""
			}
		}
	}
	lfForm.fields[rowCount] = {
		"type": item.type,
		"id": item.id,
		"label": parentRow ? item.question : item.sub_question,
		"adminLabel": "",
		"isRequired": parentRow,
		"size": "medium",
		"errorMessage": "",
		"visibility": "visible",
		"inputs": null,
		"formId": 1,
		"description": "",
		"allowsPrepopulate": false,
		"inputMask": false,
		"inputMaskValue": "",
		"inputType": "",
		"labelPlacement": "",
		"descriptionPlacement": "",
		"subLabelPlacement": "",
		"placeholder": "",
		"cssClass": csskey ? "text-" + csskey : '',
		"inputName": "",
		"noDuplicates": false,
		"defaultValue": "",
		"choices": choices,
		"conditionalLogic": "",
		"productField": "",
		"enablePasswordInput": "",
		"maxLength": "",
		"pageNumber": 1,
		"displayOnly": "",
		"value": ""
	}
	rowCount++;
	if (item.subRow) {
		for (var subKey in item.subRow) {
			createForm(item.subRow[subKey], parentRow = false, item.id);
		}
	}
};
// for (var headKey in data) {
// 	var item = data[headKey];
// 	createForm(item, parentRow = true, csskey = 'parent-' + item.id);
// }

function makeRadioSelectOptions(items, isleaf) {
	var res = [];
	if (isleaf == 0) {
		var subRowFlag = true;
		for (var i in items) {
			// if (items[i].childRow) {
			// 	res = baseOptions;
			// 	subRowFlag = false;
			// }
			// if (subRowFlag)
			// 	res.push(items[i].sub_question);
			res[items[i].id] = items[i].sub_question;
		}
	} else {
		for (var i in items) {
			res[items[i].id] = items[i].child_question;
			// res.push(items[i].child_question);
		}
	}
	return res;
}

function createFormField(item) {
	if (item.type == 'value') return;
	var choices, inputs;
	var csskey = '';
	var selected = true;
	if (item.type == 'value') {
		csskey += " always-hide-item-" + (item.isleaf == 1 ? item.pid : item.subid) + ' ';
		// return;
	}
	// if (!item.type) item.type = 'text';
	if (item.isleaf == 0) {
		csskey += "parent-" + item.id;
	}
	if (item.isleaf == 1) {
		if (!item.childRow && item.type ==  'text') {			
			csskey += "subrow-" + item.pid;
		} else {
			csskey += " always-hide-item always-hide-" + item.pid;
		}
	}
	if (item.isleaf == 2) {
		csskey += "subrow-" + item.pid;
		// csskey += "child-" + item.subid;
	}

	if (item.type == "radio" || item.type == 'select' || item.type == 'checkbox') {
		choices = [];
		options = [];
		if (item.isleaf == '0' || item.subRow) {
			options = makeRadioSelectOptions(item.subRow, item.isleaf);
		}
		if (item.isleaf == '1' && item.childRow) {
			options = makeRadioSelectOptions(item.childRow, item.isleaf);
		}
		for (opt in options) {
			if (opt > 0) selected = false;
			if (!options[opt]) {
				continue;
			}
			choices[choices.length] = {
				"text": options[opt],
				"value": item.id + '_@@@@_' + options[opt],
				"isSelected": selected,
				"price": ""
			}
		}
		if (item.type == 'checkbox') {
			inputs = [];
			Object.keys(options).forEach(function(key) {
				inputs[inputs.length] = {
					"id": key,
					"label": options[key],
				}
			});
		}
		if (!options.length)
			item.type = 'text';
	}
	lfForm.fields[rowCount] = {
		"type": item.type,
		"id": item.id,
		"label": item.isleaf == 0 ? item.question : (item.isleaf == 1 ? item.sub_question : item.child_question),
		"adminLabel": "",
		"isRequired": item.isleaf == 0 ? true : false,
		"size": "medium",
		"errorMessage": "",
		"visibility": "visible",
		"formId": 1,
		"description": "",
		"allowsPrepopulate": false,
		"inputMask": false,
		"inputMaskValue": "",
		"inputType": "",
		"labelPlacement": "",
		"descriptionPlacement": "",
		"subLabelPlacement": "",
		"placeholder": "",
		"cssClass": csskey,
		"inputName": "",
		"noDuplicates": false,
		"defaultValue": "",
		"choices": choices,
		"inputs": item.type == 'checkbox' ? inputs : null, 
		"conditionalLogic": "",
		"productField": "",
		"enablePasswordInput": "",
		"maxLength": "",
		"pageNumber": 1,
		"displayOnly": "",
		"value": ""
	}
	rowCount++;
	if (item.subRow) {
		for (var j in item.subRow)
			createFormField(item.subRow[j]);
	}
	if (item.childRow) {
		for (var j in item.childRow)
			createFormField(item.childRow[j]);
	}
}

for (var i in data) {
	var item = data[i];
	createFormField(item);
}