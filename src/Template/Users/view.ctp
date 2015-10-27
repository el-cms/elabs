<?php
$this->assign('title', h($user->realname));

$this->start('pageInfos');
?>
<dl>
	<dt><?= __('Username') ?></dt>
	<dd><?= h($user->username) ?></dd>
	<dt><?= __('Name') ?></dt>
	<dd><?= h($user->realname) ?></dd>
	<dt><?= __('Website') ?></dt>
	<dd><?= h($user->website) ?></dd>
	<dt><?= __('Member since') ?></dt>
	<dd><?= h($user->created) ?></dd>
	<dt></dt>
	<dd></dd>
</dl>
<?php
$this->end();

$this->start('pageContent');

echo h($user->bio);
?>

<nav class="tab-nav tab-nav-brand">
	<ul class="nav nav-justified">
		<li class="active">
			<a class="waves-attach waves-effect" data-toggle="tab" href="#posts-tab"><?= __d('posts', 'Articles') ?></a>
		</li>
		<li>
			<a class="waves-attach waves-effect" data-toggle="tab" href="#projects-tab"><?= __d('projects', 'Projects') ?></a>
		</li>
		<li>
			<a class="waves-attach waves-effect" data-toggle="tab" href="#files-tab"><?= __d('files', 'Files') ?></a>
		</li>
	</ul>
	<div class="tab-nav-indicator"></div>
</nav>

<div class="tab-pane fade active in" id="posts-tab">
	<?php
	if (!empty($user->posts)):
		foreach ($user->posts as $posts):
			echo $this->element('posts/card_belongtouser', ['data' => $posts]);
		endforeach;
	endif;
	?>
</div>

<div class="tab-pane" id="projects-tab">
	<?php
	if (!empty($user->projects)):
		foreach ($user->projects as $projects):
			echo $this->element('projects/card_belongtouser', ['data' => $projects]);
		endforeach;
	endif;
	?>
</div>

<div class="tab-pane" id="files-tab">
	
</div>
<?php
$this->end();

echo $this->element('layouts/defaultview');
