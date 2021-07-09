$(document).ready(function(){
	//load();
	function load (title)
	{
		$.ajax
		({
			url: "szukaj",
			method: "POST",
			data:
			{
				reg: title
			},
			success: function(data) 
			{
				$('.result').html(data);
				addListeners();
			}
		});
	}

	$('#searchInput').keyup(function(){
		var search = $('#searchInput').val();
		if(search != '')
			load(search);
		else
			$('.result').html("");		
	});
});