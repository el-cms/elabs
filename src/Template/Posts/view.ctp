<?php
$this->assign('title', h($post->title));

$this->start('pageInfos');
?>

<dl>
  <dt><?= __('Author') ?></dt>
  <dd><?= $post->has('user') ? $this->Html->link($post->user->username, ['controller' => 'Users', 'action' => 'view', $post->user->id]) : '' ?></dd>
  <dt><?= __('License') ?></dt>
  <dd><?= $post->has('license') ? $this->Html->link($post->license->name, ['controller' => 'Licenses', 'action' => 'view', $post->license->id]) : '' ?></dd>
  <dt><?= __('Publication Date') ?></dt>
  <dd><?= h($post->publication_date) ?></dd>
  <dt><?= __('Updated on') ?></dt>
  <dd><?= h($post->modified) ?></dd>
  <dt><?= __('Safe content') ?></dt>
  <dd class="label label-<?php echo $post->sfw ? 'green' : 'red'; ?>"><?= $post->sfw ? __d('elabs', '{0}&nbsp;Yes', '<span class="fa fa-check-circle"></span>') : __d('elabs', '{0}&nbsp;No', '<span class="fa fa-times-circle"></span>'); ?></dd>
</dl>

<?php
$this->end();

$this->start('pageContent');
?>

<div class="col-sm-9 ">

  <?= $this->Markdown->transform($post->excerpt) ?>
  <hr/>
  <?= $this->Markdown->transform($post->text); ?>
</div>
<?php
echo $this->element('layout/loader_prism');
$this->end();

echo $this->element('layouts/defaultview');

