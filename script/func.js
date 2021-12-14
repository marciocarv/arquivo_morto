function replace(valor){

	valor = valor.toString().replace("a", "");
	valor = valor.toString().replace("b", "");
	valor = valor.toString().replace("c", "");
	valor = valor.toString().replace("d", "");
	valor = valor.toString().replace("e", "");
	valor = valor.toString().replace("f", "");
	valor = valor.toString().replace("g", "");
	valor = valor.toString().replace("h", "");
	valor = valor.toString().replace("i", "");
	valor = valor.toString().replace("j", "");
	valor = valor.toString().replace("k", "");
	valor = valor.toString().replace("l", "");
	valor = valor.toString().replace("m", "");
	valor = valor.toString().replace("n", "");
	valor = valor.toString().replace("o", "");
	valor = valor.toString().replace("p", "");
	valor = valor.toString().replace("q", "");
	valor = valor.toString().replace("r", "");
	valor = valor.toString().replace("s", "");
	valor = valor.toString().replace("t", "");
	valor = valor.toString().replace("u", "");
	valor = valor.toString().replace("v", "");
	valor = valor.toString().replace("w", "");
	valor = valor.toString().replace("x", "");
	valor = valor.toString().replace("y", "");
	valor = valor.toString().replace("z", "");

	return valor;
	
}

function replaceString(valor){
	valor = valor.toString().replace("á", "&aacute;");
	valor = valor.toString().replace("ã", "&atilde;");
	valor = valor.toString().replace("à", "&agrave;");
	valor = valor.toString().replace("â", "&acirc;");
	valor = valor.toString().replace("Á", "&Aacute;");
	valor = valor.toString().replace("Ã", "&Atilde;");
	valor = valor.toString().replace("À", "&Agrave;");
	valor = valor.toString().replace("Â", "&Acirc;");
	valor = valor.toString().replace("é", "&eacute;");
	valor = valor.toString().replace("è", "&egrave;");
	valor = valor.toString().replace("ê", "&ecirc;");
	valor = valor.toString().replace("Ê", "&Ecirc;");
	valor = valor.toString().replace("É", "&Eacute;");
	valor = valor.toString().replace("È", "&Egrave;");
	valor = valor.toString().replace("í", "&iacute;");
	valor = valor.toString().replace("ì", "&igrave;");
	valor = valor.toString().replace("î", "&icirc;");
	valor = valor.toString().replace("Î", "&Icirc;");
	valor = valor.toString().replace("Í", "&Iacute;");
	valor = valor.toString().replace("Ì", "&Igrave;");
	valor = valor.toString().replace("ó", "&oacute;");
	valor = valor.toString().replace("ò", "&ograve;");
	valor = valor.toString().replace("õ", "&otilde;");
	valor = valor.toString().replace("ô", "&ocirc;");
	valor = valor.toString().replace("Ó", "&Oacute;");
	valor = valor.toString().replace("Ò", "&Ograve;");
	valor = valor.toString().replace("Õ", "&Otilde;");
	valor = valor.toString().replace("Ô", "&Ocirc;");
	valor = valor.toString().replace("ú", "&uacute;");
	valor = valor.toString().replace("ù", "&ugrave;");
	valor = valor.toString().replace("û", "&ucirc;");
	valor = valor.toString().replace("ç", "&ccedil;");
	valor = valor.toString().replace("Ç", "&Ccedil;");

	return valor;
	
}

function FormataValor(id,tammax,teclapres) {
    
	if(window.event){ // Internet Explorer
		var tecla = teclapres.keyCode; 
	}else 
	if(teclapres.which){ // Nestcape / firefox
		var tecla = teclapres.which;
	}	

	vr = document.getElementById(id).value;
	vr = replace(vr);
	vr = vr.toString().replace( "/", "" );
	vr = vr.toString().replace( "/", "" );
	vr = vr.toString().replace( ",", "" );
	vr = vr.toString().replace( ",", "" );
	vr = vr.toString().replace( ",", "" );
	vr = vr.toString().replace( ",", "" );
	vr = vr.toString().replace( ".", "" );
	vr = vr.toString().replace( ".", "" );
	vr = vr.toString().replace( ".", "" );
	vr = vr.toString().replace( ".", "" );

	if ((tecla > 47 && tecla < 58)){ // numeros de 0 a 9   
  
    }else{   
        if (tecla != 8){ // backspace   			
			alert("Digite somente numeros!");
        }else{   
            
		}  
    }   

	tam = vr.length;

	if (tam < tammax && tecla != 8){ 
		tam = vr.length + 1; 
	}

	if (tecla == 8 ){
		tam = tam - 1; 
	}

	if ( tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105 ){
		if ( tam <= 2 ){
			document.getElementById(id).value = vr;
		}
		if ((tam > 2) && (tam <= 5) ){
			document.getElementById(id).value = vr.substr( 0, tam - 2 ) + ',' + vr.substr( tam - 2, tam ); 
		}
		if ( (tam >= 6) && (tam <= 8) ){
			document.getElementById(id).value = vr.substr( 0, tam - 5 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam ); 
		}
		if ( (tam >= 9) && (tam <= 11) ){
			document.getElementById(id).value = vr.substr( 0, tam - 8 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam ); 
		}
		if ( (tam >= 12) && (tam <= 14) ){
			document.getElementById(id).value = vr.substr( 0, tam - 11 ) + '.' + vr.substr( tam - 11, 3 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam ); 
		}
		if ( (tam >= 15) && (tam <= 17) ){
			document.getElementById(id).value = vr.substr( 0, tam - 14 ) + '.' + vr.substr( tam - 14, 3 ) + '.' + vr.substr( tam - 11, 3 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam );
		}
	}
}

/********************************************************************************************************************************************************************************************************/

function fone(obj,prox) {
	switch (obj.value.length){
		case 1:                
			obj.value = "(" + obj.value;                
			break;        
		case 3:                
			obj.value = obj.value + ")";
			break;
		case 8:
			obj.value = obj.value + "-";
			break;          
		case 13:
			prox.focus();
			break;
	}
}

function formata_cep(obj,prox) {
	switch (obj.value.length){		
		case 5:
			obj.value = obj.value + "-";
			break;          
		case 9:
			prox.focus();
			break;
	}
}

function formata_insc_estadual(obj,prox) {
	switch (obj.value.length){		
		case 2:
			obj.value = obj.value + ".";
			break;    
		case 6:
			obj.value = obj.value + ".";
			break; 
		case 10:
			obj.value = obj.value + "-";
			break; 
		case 12:
			prox.focus();
			break;
	}
}

function formata_data(obj,prox) {
	switch (obj.value.length) {
		case 2:                
			obj.value = obj.value + "/";               
			break;       
		case 5:                
			obj.value = obj.value + "/";               
			break;        
		case 10: 
			var dia = obj.value.substring(0,2);
			var mes = obj.value.substring(3,5);
			var ano = obj.value.substring(6,10);
			var bissexto = 0;
			if((ano > 1900) && (ano < 2100)){
			
				if(mes == 01 || mes == 03 || mes==05 || mes==07 || mes==08 || mes==10 || mes==12){
					if((dia > 0) && (dia <=31)){
						prox.focus();
						return true; 						
					}else{
						alert("data invalida!");
						obj.value = "";
						obj.focus();                
						break;		
					}
				}else
				if(mes==04 || mes==06 || mes==09 || mes==11){
					if((dia > 0) && (dia <=30)){
						prox.focus();
						return true; 
					}else{
						alert("data invalida!");
						obj.value = "";
						obj.focus();                
						break;	
					}
				}else				
				if(mes==02){
					
					if ((ano % 4 == 0) || (ano % 100 == 0) || (ano % 400 == 0)){
						bissexto = 1;                                        
					}  
					
					if (bissexto == 1){					
						if((dia <= 29) && (dia > 0)){
							prox.focus();
							return true; 
						}else{
							alert("data invalida!");
							obj.value = "";
							obj.focus();                
							break;							
						}
					}else
					if (bissexto != 1){
						if((dia <= 28) && (dia > 0)){
							prox.focus();
							return true; 
						}else{
							alert("data invalida!");
							obj.value = "";
							obj.focus();                
							break;		
						}
					}                 
				}
			}else{
				alert("data invalida!");
				obj.value = "";
				obj.focus();                
				break;
			}
	}
}

function Apenas_Numeros(caracter){
	var nTecla = 0;  
	if (document.all) {
		nTecla = caracter.keyCode;  
	} else {
		nTecla = caracter.which;  
	}
	if ((nTecla> 47 && nTecla <58)  || nTecla == 8 || nTecla == 127  || nTecla == 0 || nTecla == 9 || nTecla == 13) { 	
		return true;  
	} else {          
		return false;  
	}
}

function validaCPF(cpf)  {  
	erro = new String;         
	if (cpf.value.length == 14){
		cpf.value = cpf.value.replace('.', '');
		cpf.value = cpf.value.replace('.', '');
		cpf.value = cpf.value.replace('-', '');
		var nonNumbers = /\D/;

		if (nonNumbers.test(cpf.value)){
			erro = "A verificacao de CPF suporta apenas números!";
		}else{
			if (cpf.value == "00000000000" || cpf.value == "11111111111" || cpf.value == "22222222222" || cpf.value == "33333333333" || cpf.value == "44444444444" || cpf.value == "55555555555" || cpf.value == "66666666666" || cpf.value == "77777777777" || cpf.value == "88888888888" || cpf.value == "99999999999") { 
				erro = "Número de CPF inválido!";
			
			}                                                
			var a = [];                                        
			var b = new Number;                                       
			var c = 11;                                         
			for (i=0; i<11; i++){                                                        
				a[i] = cpf.value.charAt(i);                                                        
				if (i < 9) 
					b += (a[i] * --c);
			}                                                
			if ((x = b % 11) < 2) { 
				a[9] = 0; 
			} else { 
				a[9] = 11-x 
			}                                        
			b = 0;                                        
			c = 11;                                                
			for (y=0; y<10; y++) 
				b += (a[y] * c--);                                                 
			if ((x = b % 11) < 2) { 
				a[10] = 0; 
			} else { 
				a[10] = 11-x; 
			}                                                
			if ((cpf.value.charAt(9) != a[9]) || (cpf.value.charAt(10) != a[10])) {
				erro = "Número de CPF inválido.";
			}                        
		}        
	}else{
		if(cpf.value.length == 0)                        
			return false                
		else                        
			erro = "Número de CPF inválido.";
	}        
	if (erro.length > 0) {
		formataCPF(cpf);
		alert(erro);  
		cpf.focus();  
		return false;       
	} 
	formataCPF(cpf);
	return true;     
}  //envento onkeyup 

function maskCPF(CPF) {        
	var evt = window.event;        
	kcode=evt.keyCode;        
	if (kcode == 8) 
	return;        
	if (CPF.value.length == 3) { 
		CPF.value = CPF.value + '.'; 
	}
	if (CPF.value.length == 7) { 
		CPF.value = CPF.value + '.'; 
	}        
	if (CPF.value.length == 11) { 
		CPF.value = CPF.value + '-'; 
	} 
}  // evento onblur 

function formataCPF(value) {        
	with (value){                
		value = value.substr(0, 3) + '.' + value.substr(3, 3) + '.' + value.substr(6, 3) + '-' + value.substr(9, 2);        
	} 
} 

function maskCNPJ(CNPJ) {        
	var evt = window.event;        
	kcode=evt.keyCode;        
	if (kcode == 8) 
	return;        
	if (CNPJ.value.length == 2) { 
		CNPJ.value = CNPJ.value + '.'; 
	}
	if (CNPJ.value.length == 6) { 
		CNPJ.value = CNPJ.value + '.'; 
	} 
	if (CNPJ.value.length == 10) { 
		CNPJ.value = CNPJ.value + '/'; 
	}   
	if (CNPJ.value.length == 15) { 
		CNPJ.value = CNPJ.value + '-'; 
	} 
}

/********************************************************************************************************************************************************************************************************/

$(document).ready(function() {
   $('table tbody tr:odd').addClass('corUm');
   $('table tbody tr:even').addClass('corDois');
});
