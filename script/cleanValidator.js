/*
	Clean Form Validation was written from scratch by Marc Grabanski
// http://marcgrabanski.com/code/clean-form-validation
/* Under the Creative Commons Licence http://creativecommons.org/licenses/by/3.0/
	Share or Remix it but please Attribute the authors. */

var cleanValidator = {
	init: function (settings) {
		this.settings = settings;
		this.form = document.getElementById(this.settings["formId"]);
		formInputs = this.form.getElementsByTagName("input");

		// change color of inputs on focus
		for(i=0;i<formInputs.length;i++)
		{
			if(formInputs[i].getAttribute("type") != "submit") {
				input = formInputs[i];
				input.style.background = settings["inputColors"][0];
				input.onblur = function () {
					this.style.background = settings["inputColors"][0];
				}
				input.onfocus = function () {
					this.style.background = settings["inputColors"][1];
				}
			}
		};
		this.form.onsubmit = function () {


			error = cleanValidator.validate();

			if(error.length < 1) {
				return true;
			} else {
				cleanValidator.printError(error);
				return false;
			}
		};
	},
	validate: function () {
		error = '';
		validationTypes = new Array("isRequired", "isEmail", "isNumeric", "isDate");
		for(n=0; n<validationTypes.length; n++) {
			var x = this.settings[validationTypes[n]];
			if(x != null) {
				for(i=0; i<x.length; i++)
				{
					inputField = document.getElementById(x[i]);
					switch (validationTypes[n]) {
						case "isRequired" :
						valid = !isRequired(inputField.value);
						errorMsg = "\xE9 um campo obrigat\xF3rio.";
						break;

						case "isEmail" :
						valid = isEmail(inputField.value);
						errorMsg = "\xE9 um endere\xE7o de email inv\xE1lido.";
						break;

						case "isNumeric" :
						valid = isNumeric(inputField.value);
						errorMsg = "apenas números s\xE3o permitidos";
						break;

						case "isDate" :						
						valid = isDate(inputField.value);
						errorMsg = "data inv\xE1lida!";
						break;
					}

					if(!valid) {
						error += x[i]+" "+errorMsg+"\n";
						inputField.style.background = this.settings["errorColors"][0];
						inputField.style.border = "1px solid "+this.settings["errorColors"][1];


					} else {
						inputField.style.background = this.settings["inputColors"][0];
						inputField.style.border = '1px solid';

					}
				}
			}return error;
		}
		return error;
	},

	printError: function (error) {
		alert(error);
	}
};

// returns true if the string is not empty
function isRequired(str){
	return (str == null) || (str.length == 0);
}
// returns true if the string is a valid email
function isEmail(str){
	if(isRequired(str)) return false;
	var re = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i
	return re.test(str);
}
// returns true if the string only contains characters 0-9 and is not null
function isNumeric(str){
	if(isRequired(str)) return false;
	var re = /[\D]/g
	if (re.test(str)) return false;
	return true;
}

//by mariano
function isDate(str){
	//if(isRequired(str)) return false;	
	var bissexto = 0;
	var data = str;
	var tam = data.length;	
	if (tam == 10){
		var dia = data.substr(0,2);
		var mes = data.substr(3,2);
		var ano = data.substr(6,4);
			if ((ano > 1900)||(ano < 2100)){
				switch (mes){
					case '01':
					case '03':
					case '05':
					case '07':
					case '08':
					case '10': 
					case '12': 
					if  (dia <= 31){
						return true;
					}
					break;
					case '04':
					case '06':
					case '09':
					case '11': 
					if  (dia <= 30){ 
						return true; 
					}
					break;
					case '02':	/* Validando ano Bissexto / fevereiro / dia */ 
					if ((ano % 4 == 0) || (ano % 100 == 0) || (ano % 400 == 0)){
						bissexto = 1;                                        
					}                                        
					if ((bissexto == 1) && (dia <= 29)){
						return true;
					} 
					if ((bissexto != 1) && (dia <= 28)){
						return true; 
					}                                                              
					break;
				}  
		} 
	}               
	return false;
}