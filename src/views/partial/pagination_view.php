<div class="center">
	<div class="pagination">
		<?php if ($page > 1): ?>
			<a href="?page=<?= $prev ?>">&laquo;</a>
			<?php for ($i = 1; $i < $page; $i++): ?>
				<a href="?page=<?= $i ?>"><?= $i ?></a>
			<?php endfor ?>
			<a class="active" href="?page=<?= $page ?>"><?= $page ?></a>
			<?php if ($page * $limit < $total): ?>
				<?php for ($i = $page + 1; $i <= ceil($total / $limit); $i++): ?>
					<a href="?page=<?= $i ?>"><?= $i ?></a>
				<?php endfor ?>
				<a href="?page=<?= $next ?>">&raquo;</a>
			<?php endif ?>
		<?php else: ?>
			<?php if ($page * $limit < $total): ?>
				<a class="active" href="?page=<?= $page ?>"><?= $page ?></a>
				<?php for ($i = $page + 1; $i <= ceil($total / $limit); $i++): ?>
					<a href="?page=<?= $i ?>"><?= $i ?></a>
				<?php endfor ?>
				<a href="?page=<?= $next ?>">&raquo;</a>
			<?php endif ?>
		<?php endif ?>
	</div>
</div>