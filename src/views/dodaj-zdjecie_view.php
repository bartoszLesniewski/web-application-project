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
				<h2 class="title">Dodawanie zdjęcia</h2>
				<p>Maksymalny rozmiar pliku wynosi 1 MB. Obsługiwane typy plików to .jpg oraz .png.</p>
				
				<?php if (count($errors)): ?>
					<?php foreach ($errors as $error): ?>
						<div class="error">
							<?= $error ?>
						</div>
					<?php endforeach ?>
				<?php endif ?>
				
				<form method="POST" enctype="multipart/form-data">
					<input class="inputStyle" type="file" name="image" required>
					
					<label for="watermark" class="row">Znak wodny (max. 18 znaków):</label>
					<input class="inputStyle" id="watermark" type="text" name="watermark" maxlength="18" required>
					
					<label for="title" class="row">Tytuł:</label>
					<input class="inputStyle" id="title" type="text" name="title">
					
					<label for="author" class="row">Autor:</label>
					<input class="inputStyle" id="author" type="text" name="author" value="<?= $login ?>">
					
					<?php if ($logged == true): ?>
						<label class="row">Status:</label>
						<label> <input type="radio" name="status" value="publiczne" id="pub" checked> Publiczne</label>
						<label> <input type="radio" name="status" value="prywatne" id="priv"> Prywatne</label>
						
					<?php endif ?>
					
					<div class="row"></div>
					<input type="submit" value="Dodaj zdjęcie" name="add">	
				</form>
			</section>
		</main>
		<?php include "includes/footer.inc.php"; ?>
	</body>
</html>