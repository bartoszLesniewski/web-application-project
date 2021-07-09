document.addEventListener("DOMContentLoaded", function (e) {
	
	var button = document.querySelector(".btn");
	var list = document.querySelector(".menu");
	
	function show()
	{
		list.classList.toggle("active");
	}
	
	button.addEventListener("click", show);;
	
});