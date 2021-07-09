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
			<section id="poll">
				<h2 class="title">Panel logowania</h3>
				
				<?php if (count($errors)): ?>
					<?php foreach ($errors as $error): ?>
						<div class="error">
							<?= $error ?>
						</div>
					<?php endforeach ?>
				<?php endif ?>
				
				<form method="POST">
					<label for="login" class="row">Login:</label>
					<input class="inputStyle" type="text" name="login" id="login" required>
					
					<label for="pass" class="row">Hasło:</label>
					<input class="inputStyle" type="password" name="pass" id="pass"required >
					
					<div class="row"></div>
					<input type="submit" name="loginSubmit" value="Zaloguj się">
				</form>
			</section>
		</main>
		<?php include "includes/footer.inc.php"; ?>
	</body>
</html>