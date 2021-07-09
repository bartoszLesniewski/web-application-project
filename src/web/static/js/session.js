document.addEventListener("DOMContentLoaded", function(e) {
	var links = document.querySelectorAll("#websites a");
	printCounters();
	
	for (let i = 0; i < links.length; i++)
		(links[i]).addEventListener("click", incrementVisits);
});

function printCounters()
{
	var paragraphs = document.querySelectorAll("#websites li p");
	var links = document.querySelectorAll("#websites a");
	
	for (let i = 0; i < paragraphs.length; i++)
	{
		var id = links[i].id;
		
		if (sessionStorage.getItem(id) === null)
			sessionStorage.setItem(id, 0);
		
		paragraphs[i].innerHTML = "Odwiedziłeś tę stronę już: " + sessionStorage.getItem(id) + " razy";	
	}
}

function incrementVisits()
{
	var id = this.id;
	var counterValue = parseInt(sessionStorage.getItem(id)) + 1;
	sessionStorage.setItem(id, counterValue);
	
	printCounters();
}