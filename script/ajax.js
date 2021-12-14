try
{
	xmlhttp = new XMLHttpRequest();//new ActiveXObject("Msxml2.XMLHTTP");
}
catch (ee)
{
	try
	{
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch (e)
	{
		try
		{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(E)
		{
			xmlhttp = false;
		}
	}			
}
function sintonia(arquivo,div)
{
	//abre a conexao
	//var msg = "<div align='center'><img src='load.gif' border='0' alt='Carregando...' /></div>";
	xmlhttp.open("GET",arquivo,"carregando...");
	xmlhttp.onreadystatechange=function ()
								{
									if(xmlhttp.readyState!=4)
									{
										document.getElementById(div).innerHTML="<br><br><br><br><br><br><br><br><br><img src='load.gif' border='0' alt='Carregando...' />";
									}else
									if(xmlhttp.readyState==4) //mostra o html recebido
									{
										document.getElementById(div).innerHTML=xmlhttp.responseText
									}
								}
	//executa
	xmlhttp.send(null)
}


function mostra(){
	document.getElementById('msg').style.innerHTML="teste";
}
window.status='CMDCA - Conselho Municipal dos Direitos da Criança e do Adolescente';