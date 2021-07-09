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
				<p><?= $komunikat ?></p>
			</div>
				<?php if ($kod == 404): ?>
				<img src="../static/img/error.png" alt="Error" style="display: block; margin-left: auto; margin-right: auto;">
				<?php elseif ($kod == 500): ?>
				<img src="../static/img/sad_pepe.png" alt="Error" style="display: block; margin-left: auto; margin-right: auto;">
				<?php endif ?>
				
		</main>
		<?php include "includes/footer.inc.php"; ?>
	</body>
</html>