<?php
$this->assign('title', h($post->title));

$this->start('pageInfos');
?>

<dl>
  <dt><?php echo __('Author') ?></dt>
  <dd><?php echo $post->has('user') ? $this->Html->link($post->user->username, ['controller' => 'Users', 'action' => 'view', $post->user->id]) : '' ?></dd>
  <dt><?php echo __('License') ?></dt>
  <dd><?php echo $post->has('license') ? $this->Html->link($post->license->name, ['controller' => 'Licenses', 'action' => 'view', $post->license->id]) : '' ?></dd>
  <dt><?php echo __('Publication Date') ?></dt>
  <dd><?php echo h($post->publication_date) ?></dd>
  <dt><?php echo __('Updated on') ?></dt>
  <dd><?php echo h($post->modified) ?></dd>
  <dt><?php echo __('Safe content') ?></dt>
  <dd class="label label-<?php echo $post->sfw ? 'green' : 'red'; ?>"><?php echo $post->sfw ? __d('elabs', '{0}&nbsp;Yes', '<span class="fa fa-check-circle"></span>') : __d('elabs', '{0}&nbsp;No', '<span class="fa fa-times-circle"></span>'); ?></dd>
</dl>

<?php
$this->end();

$this->start('pageContent');
?>

<div class="col-sm-9 ">

  <?php echo $this->Markdown->transform($post->excerpt) ?>
  <hr/>
  <?php echo $this->Markdown->transform($post->text); ?>
</div>
<?php
echo $this->element('layout/loader_prism');
$this->end();

echo $this->element('layouts/defaultview');

