<?php
$this->assign('title', __d('posts', 'Article: {0}', h($post->title)));

$this->start('pageInfos');
?>

<ul class="list-unstyled">
    <li><strong><?php echo __d('posts', 'Author:') ?></strong> <?php echo $this->Html->link($post->user->username, ['controller' => 'Users', 'action' => 'view', $post->user->id]) ?></li>
    <li><strong><?php echo __d('licenses', 'License:') ?></strong> <?php echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-' . $post->license->icon . '"></span>', $post->license->name]), ['controller' => 'Licenses', 'action' => 'view', $post->license->id], ['escape' => false]) ?></li>
    <li><strong><?php echo __d('posts', 'Publication Date:') ?></strong> <?php echo h($post->publication_date) ?></li>
    <?php if ($post->has('modified')): ?>
        <li><strong><?php echo __d('elabs', 'Updated on:') ?></strong> <?php echo h($post->modified) ?></li>
    <?php endif; ?>
    <li><strong><?php echo __d('elabs', 'Safe content:') ?></strong> <span class="label label-<?php echo $post->sfw ? 'success' : 'danger'; ?>"><?php echo $post->sfw ? __d('elabs', '{0}&nbsp;Yes', '<span class="fa fa-check-circle"></span>') : __d('elabs', '{0}&nbsp;No', '<span class="fa fa-times-circle"></span>'); ?></span></li>
</ul>

<?php
$this->end();

$this->start('pageContent');
echo $this->Html->displayMD($post->excerpt)
?>
<hr/>
<?php
echo $this->Html->displayMD($post->text);
echo $this->element('layout/loader_prism');
$this->end();

echo $this->element('layouts/defaultview');

