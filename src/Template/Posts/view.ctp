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
$this->assign('title', h($post->title));

// Language
$this->assign('contentLanguage', $post->language->iso639_1);

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Articles'), ['action' => 'index']);
$this->Html->addCrumb($this->Html->langLabel($post->title, $post->language->iso639_1, ['label' => false]));

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo __d('elabs', 'Author:') ?></strong> <?php echo $this->Html->link($post->user->username, ['controller' => 'Users', 'action' => 'view', $post->user->id]) ?></li>
    <li><strong><?php echo __d('elabs', 'License:') ?></strong> <?php echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', [$this->Html->icon($post->license->icon), $post->license->name]), ['controller' => 'Licenses', 'action' => 'view', $post->license->id], ['escape' => false]) ?></li>
    <li><strong><?php echo __d('elabs', 'Language:') ?></strong> <?php echo $this->Html->langLabel($post->language->name, $post->language->iso639_1) ?></li>
    <li><strong><?php echo __d('elabs', 'Publication Date:') ?></strong> <?php echo h($post->publication_date) ?></li>
    <?php if ($post->has('modified')): ?>
        <li><strong><?php echo __d('elabs', 'Updated on:') ?></strong> <?php echo h($post->modified) ?></li>
    <?php endif; ?>
    <li>
        <strong><?php echo __d('elabs', 'Safe content:') ?></strong>
        <span class="label label-<?php echo $post->sfw ? 'success' : 'danger'; ?>">
            <?php echo $post->sfw ? __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('check-circle'), __d('elabs', 'Yes')]) : __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('circle-o'), __d('elabs', 'No')]); ?>
        </span>
    </li>
</ul>
<?php
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div lang="<?php echo $post->language->id ?>">
    <?php
    echo $this->Html->displayMD($post->excerpt);
    echo $this->Html->displayMD($post->text);
    ?>
</div>
<?php
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultview');
