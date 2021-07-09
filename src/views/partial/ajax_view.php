<div class="gallery">
	<?php if (isset($blad)): ?>
		<div class="warning" style="margin-left: auto, margin-right: auto;">
			<p>Coś poszło nie tak :( Spróbuj ponownie za chwilę lub skontaktuj się z administratorem</p>
		</div>
	<?php else: ?>
		<?php if (count($images)): ?>
			<?php foreach ($images as $image): ?>
				<div class="image">
					<img src="thumbnails/<?= $image['image_name'] ?>" alt="<?= $image['title'] ?>">
					<div class="description">
						<p><span style="color: #307a0d;">Tytuł:</span> <?= $image['title'] ?></p>
						<p><span style="color: #307a0d;">Autor:</span> <?= $image['author'] ?></p>
						<?php if($image['status'] != "publiczne"): ?>
						<p><span style="color: red;">zdjęcie prywatne</span></p>
						<?php endif ?>
					</div>
				</div>
			<?php endforeach ?>
		<?php else: ?>
			<div class="info">
				Brak zdjęć do wyświetlenia
			</div>
		<?php endif ?>
	<div class="preview">
		<div class="exit">&times;</div>
		<img src="" alt=""> 
	</div>
	<?php endif ?>
</div>