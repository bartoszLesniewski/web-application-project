<!DOCTYPE html>
<html lang="pl">
	<head>
		<?php include "includes/head.inc.php"; ?>
		<script src="../static/js/gallery.js"></script>
	</head>
	
	<body>
		<header>
			<img src="../static/img/player_mini.png" alt="Player picture">
			<h1>Piłka nożna</h1>
		</header>
		<?php require "partial/navigation_view.php"; ?>
		<main>
			<?php if (isset($blad)): ?>
				<div class="warning" style="margin: 50px 50px 10px 50px;">
					<p>Coś poszło nie tak :( Spróbuj ponownie za chwilę lub skontaktuj się z administratorem</p>
				</div>
				<img src="../static/img/sad_pepe.png" alt="Error" style="display: block; margin-left: auto; margin-right: auto; margin-bottom: 20px;">
			<?php else: ?>
			<h2 class="title">Poniżej znajdziesz zapamiętane przez Ciebie zdjęcia</h2>
			<div class="gallery">
				<?php if (count($images)): ?>
					<?php foreach ($images as $image): ?>
						<div class="image">
							<a href="watermarks/<?= $image['image_name'] ?>">
								<img src="thumbnails/<?= $image['image_name'] ?>" alt="<?= $image['title'] ?>">
							</a>
							<div class="description">
								<p><span style="color: #307a0d;">Tytuł:</span> <?= $image['title'] ?></p>
								<p><span style="color: #307a0d;">Autor:</span> <?= $image['author'] ?></p>
								<?php if($image['status'] != "publiczne"): ?>
								<p><span style="color: red;">zdjęcie prywatne</span></p>
								<?php endif ?>
								<label><input form="deleteForm" type="checkbox" name="delete[]" value="<?= $image['_id'] ?>"> <i>Zaznacz zdjęcie</i></label>
							</div>
						</div>
					<?php endforeach ?>
				<?php else: ?>
					<div class="info">
						Nie zapamiętałeś jeszcze żadnych zdjęć
					</div>
				<?php endif ?>
				
				<div class="preview">
					<div class="exit">&times;</div>
					<img src="" alt=""> 
				</div>
			</div>

			<?php if(count($images)): ?>
			<div class="center">
				<form id="deleteForm" method="POST">
					<input type="submit" name="deleteSubmit" value="Usuń zaznaczone z zapamiętanych">
				</form>
			</div>
			<?php endif ?>
			
			<?php require "partial/pagination_view.php"; ?>
			
			<?php endif ?>
		</main>
		<?php include "includes/footer.inc.php"; ?>
	</body>
</html>