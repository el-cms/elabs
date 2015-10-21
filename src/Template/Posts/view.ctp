<?php
$this->assign('title', h($post->title))
?>

<div class="col-sm-3">
	<div class="content-sub-heading"><?php echo __d('elabs', 'About') ?></div>
	<dl>
		<dt><?= __('User') ?></dt>
		<dd><?= $post->has('user') ? $this->Html->link($post->user->username, ['controller' => 'Users', 'action' => 'view', $post->user->id]) : '' ?></dd>
		<dt><?= __('License') ?></dt>
		<dd><?= $post->has('license') ? $this->Html->link($post->license->name, ['controller' => 'Licenses', 'action' => 'view', $post->license->id]) : '' ?></dd>
		<dt><?= __('Publication Date') ?></dt>
		<dd><?= h($post->publication_date) ?></dd>
		<dt><?= __('Modified') ?></dt>
		<dd><?= h($post->modified) ?></dd>
		<dt><?= __('Safe content') ?></dt>
		<dd class="badge badge-<?php echo $post->sfw ? 'sfw' : 'nsfw'; ?>"><?= $post->sfw ? __d('elabs', '{0}&nbsp;Yes', '<span class="fa fa-check-circle"></span>') : __d('elabs', '{0}&nbsp;No', '<span class="fa fa-times-circle"></span>'); ?></dd>
	</dl>
</div>
<div class="col-sm-9 rendered-text">

	<?= $this->Markdown->transform($post->excerpt) ?>
	<hr/>
	<?= $this->Markdown->transform($post->text); ?>
</div>
<?php
echo $this->element('layout/loader_prism');
