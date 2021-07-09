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
				<h2 class="title">Wypełnij formularz rejestracji</h3>
				
				<?php if (count($errors)): ?>
					<?php foreach ($errors as $error): ?>
						<div class="error">
							<?= $error ?>
						</div>
					<?php endforeach ?>
				<?php endif ?>
				
				<form method="POST">
					<label for="email" class="row">Adres e-mail:</label>
					<input class="inputStyle" type="email" name="email" id="email" required value="<?= $model['tmpEmail'] ?>">
					
					<label for="login" class="row">Login:</label>
					<input class="inputStyle" type="text" name="login" id="login" required value="<?= $model['tmpLogin'] ?>">
					
					<label for="pass" class="row">Hasło:</label>
					<input class="inputStyle" type="password" name="pass" id="pass"required >
					
					<label for="repeatedPass" class="row">Powtórz hasło:</label>
					<input class="inputStyle" type="password" name="repeatedPass" id="repeatedPass" required>
					
					<div class="row"></div>
					<input type="submit" name="registerSubmit" value="Zarejestruj się">
				</form>
			</section>
		</main>
		<?php include "includes/footer.inc.php"; ?>
	</body>
</html>