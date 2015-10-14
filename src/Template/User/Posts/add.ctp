<?php
$formTemplate = [
		'label' => '<label class="floating-label {{attrs.class}}" {{attrs}}>{{text}}</label>',
		'checkboxContainer' => '<div class="form-group"><div class="checkbox switch">{{content}}</div></div>',
		'submitContainer' => '{{content}}',
];
echo $this->Form->create($post);
$this->Form->templates($formTemplate);
?>
<div class="col-sm-3">
	<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
			<li class="heading"><?= __('Actions') ?></li>
			<li><?= $this->Html->link(__('List Posts'), ['action' => 'index']) ?></li>
			<li><?= $this->Html->link(__('List Licenses'), ['controller' => 'Licenses', 'action' => 'index']) ?></li>
    </ul>
	</nav>
</div>
<div class="col-sm-6">
	<?php
	echo $this->Form->input('title');
	echo $this->Form->input('excerpt');
	echo $this->Form->input('text');
	?>
</div>
<div class="col-sm-3">
	<?php
	echo $this->Form->input('sfw', ['class' => 'access_hide', 'label' => __d('elabs', 'This is NSFW')]);
	echo $this->Form->input('anon', ['class' => 'access_hide', 'label' => __d('elabs', 'Post as anonymous')]);
	echo $this->Form->input('published', ['class' => 'access_hide', 'label' => __d('elabs', 'Published')]);
	echo $this->Form->input('license_id', ['options' => $licenses]);
	?>
	<div class="form-group-btn">
		<?php echo $this->Form->submit(__('Submit')); ?>
	</div>
</div>
<?php
$this->Form->end();
