<div class="alert alert-danger" onclick="this.classList.add('hidden');">
	<?= h($message) ?>
	<?php if (isset($params) AND isset($params['errors'])) : ?>
		<ul class="list">
			<?php foreach ($params['errors'] as $error) : ?>
				<li><span class="fa fa-warning"></span>&nbsp;<?= h($error) ?></li>
				<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</div>
