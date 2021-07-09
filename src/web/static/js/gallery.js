window.addEventListener("load", function(e) {
	deleteLinks();
	addListeners();
});

function addListeners()
{
	var images = document.querySelectorAll(".image > img");
	
	if (images != null)
	{
		for (let i = 0; i < images.length; i++)
			images[i].addEventListener ("click", showBigger);
	}
	
	var exit = document.querySelector(".exit");
	
	if (exit != null)
		exit.addEventListener("click", close);
}

function showBigger()
{
	var div = document.querySelector(".preview");
	div.style.display = "flex"
	var image = div.querySelector("img");

	var source = this.getAttribute("src");
	source = source.replace("thumbnails", "watermarks");
	//source = source.replace("mini", "big");
	image.src = source;
	image.alt = this.alt;
}

function close()
{
	var div = document.querySelector(".preview");
	div.style.display = "none";
}

function deleteLinks()
{
	$(".image > a > img").unwrap();
}
