document.addEventListener("DOMContentLoaded", function(e) {
	
	var btnTheme = document.querySelector("#theme");
	var body = document.querySelector ("body");

	function setDark()
	{
		body.classList.add("dark-theme");
	}
	
	function setLight()
	{
		body.classList.remove("dark-theme");
	}
	
	function changeTheme()
	{
		if (localStorage.getItem("theme") == "light")
		{
			setDark();
			localStorage.setItem("theme", "dark");
		}
		
		else if (localStorage.getItem("theme") == "dark")
		{
			setLight();
			localStorage.setItem("theme", "light");
		}
	}
	
	if (localStorage.getItem("theme") === null)
		localStorage.setItem("theme", "light");
	
	else if (localStorage.getItem("theme") == "dark")
		setDark();
	
	btnTheme.addEventListener("click", changeTheme);
});