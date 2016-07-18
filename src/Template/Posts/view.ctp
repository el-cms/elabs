<?php
/*
 * File:
 *   src/Templates/Posts/view.ctp
 * Description:
 *   Display of a single post
 * Layout element:
 *   defaultview.ctp
 */

// Page title
$this->assign('title', __d('posts', 'Article: {0}', h($post->title)));

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo __d('posts', 'Author:') ?></strong> <?php echo $this->Html->link($post->user->username, ['controller' => 'Users', 'action' => 'view', $post->user->id]) ?></li>
    <li><strong><?php echo __d('licenses', 'License:') ?></strong> <?php echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', [$this->Html->icon($post->license->icon), $post->license->name]), ['controller' => 'Licenses', 'action' => 'view', $post->license->id], ['escape' => false]) ?></li>
    <li><strong><?php echo __d('posts', 'Publication Date:') ?></strong> <?php echo h($post->publication_date) ?></li>
    <?php if ($post->has('modified')): ?>
        <li><strong><?php echo __d('elabs', 'Updated on:') ?></strong> <?php echo h($post->modified) ?></li>
    <?php endif; ?>
        <li>
            <strong><?php echo __d('elabs', 'Safe content:') ?></strong>
            <span class="label label-<?php echo $post->sfw ? 'success' : 'danger'; ?>">
                <?php echo $post->sfw ? __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('check-circle'), __('elabs', 'Yes')]) : __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('circle-o'), __('elabs', 'No')]); ?>
            </span>
        </li>
</ul>
<?php
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
echo $this->Html->displayMD($post->excerpt);
echo $this->Html->displayMD($post->text);
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultview');
