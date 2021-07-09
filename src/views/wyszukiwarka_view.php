<!DOCTYPE html>
<html lang="pl">
	<head>
		<?php include "includes/head.inc.php"; ?>
		<script src="../static/js/gallery.js"></script>
		<script src="../static/js/ajax.js"></script>
	</head>
	
	<body>
		<header>
			<img src="../static/img/player_mini.png" alt="Player picture">
			<h1>Piłka nożna</h1>
		</header>
		<?php require "partial/navigation_view.php"; ?>
		<main> 
			<section class="searchSection">
				<h2 class="title">Wyszukiwarka zdjęć</h2>
				<input class="inputStyle" type="text" name="searchInput" id="searchInput" placeholder="Wpisz tytuł zdjęcia, które chcesz wyszukać">
				<div class="result"></div>
			</section>
		</main>
		<?php include "includes/footer.inc.php"; ?>
	</body>
</html>