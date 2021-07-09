$(function() {
	$("#showBtn").on("click", function() 
	{
	  runEffect();
	});

	$("#hideBtn").on("click", function()
	{
		callback();
	});

	$("#sendLink").on("click", function()
	{
		if(addLink())
			callback();
		
		document.querySelector("#adres").value = "http://";
		document.querySelector("#nazwa").value = "";
	});

	$("#effect").hide();
});

function addLink()
{
	var adres = document.querySelector("#adres").value;
	var nazwa = document.querySelector("#nazwa").value;

	if ((adres.trim()).length == 0 || (nazwa.trim()).length == 0)
	{
		$( "#dialog" ).dialog();
		return false;
	}
	else
	{
		var punkt = document.createElement("li");
		var link = document.createElement("a");
		var atrybut = document.createAttribute("href");
		atrybut.value = adres;
		var text = document.createTextNode(nazwa);
		
		link.setAttributeNode(atrybut);
		link.appendChild(text);
		
		punkt.appendChild(link);
		
		var lista = document.querySelector("#websites ul");
		lista.appendChild(punkt);
		
		return true;
	}
}

function runEffect() 
{
	$("#effect").show("clip", 1000);
};

function callback() 
{
	$("#effect").hide("clip", 1000);
};