<!DOCTYPE html>
<html lang="pl">
	<head>
		<?php include "includes/head.inc.php"; ?>
	</head>
	
	<body>
		<header>
			<img src="../static/img/player_mini.png" alt="Player picture">
			<h1>Piłka nożna</h1>
		</header>
		<?php require "partial/navigation_view.php"; ?>
		<main>
			<div class="warning" style="margin: 50px 50px 10px 50px;">
				<p>Nie znaleziono strony o podanym adresie</p>
			</div>
			<img src="../static/img/error.png" alt="Error" style="display: block; margin-left: auto; margin-right: auto; margin-bottom: 20px;">				
		</main>
		<?php include "includes/footer.inc.php"; ?>
	</body>
</html>