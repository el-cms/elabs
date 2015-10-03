<?php
$this->assign('title', 'Home - News and updates');
?>

<div class="container">
	<section class="content-inner">

		<div class="row">

			<div class="col-sm-4">
				<h2 class="content-sub-heading">Latest news</h2>
				<?= $this->Element('home/last_news'); ?>
			</div>
			<div class="col-sm-4">
				<h2 class="content-sub-heading">Project updates</h2>
				<?= $this->Element('home/last_projects'); ?>
			</div>
			<div class="col-sm-4">
				<h2 class="content-sub-heading">Files</h2>
				<?= $this->Element('home/last_files'); ?>
			</div>

		</div>

	</section>
</div>