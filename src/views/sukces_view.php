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
			<div class="success" style="margin: 50px;">
				<?= $success ?>
			</div>
		</main>
		<?php include "includes/footer.inc.php"; ?>
	</body>
</html>