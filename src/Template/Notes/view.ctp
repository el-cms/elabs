<?php
/*
 * File:
 *   src/Templates/Notes/view.ctp
 * Description:
 *   Display of a single note
 * Layout element:
 *   defaultview.ctp
 */

// Page title
$this->assign('title', __d('elabs', 'A note'));

// Language
$this->assign('contentLanguage', $note->language->iso639_1);

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Notes'), ['action' => 'index']);
$this->Html->addCrumb($this->fetch('title'));

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo __d('elabs', 'Author:') ?></strong> <?php echo $this->Html->link($note->user->username, ['controller' => 'Users', 'action' => 'view', $note->user->id]) ?></li>
    <li><strong><?php echo __d('elabs', 'License:') ?></strong> <?php echo $this->Html->link($this->Html->iconT($note->license->icon, $note->license->name), ['controller' => 'Licenses', 'action' => 'view', $note->license->id], ['escape' => false]) ?></li>
    <li><strong><?php echo __d('elabs', 'Language:') ?></strong> <?php echo $this->Html->langLabel($note->language->name, $note->language->iso639_1) ?></li>
    <li><strong><?php echo __d('elabs', 'Created on:') ?></strong> <?php echo h($note->created) ?></li>
    <?php if ($note->has('modified')): ?>
        <li><strong><?php echo __d('elabs', 'Updated on:') ?></strong> <?php echo h($note->modified) ?></li>
    <?php endif; ?>
    <li>
        <strong><?php echo __d('elabs', 'Safe content:') ?></strong>
        <span class="label label-<?php echo $note->sfw ? 'success' : 'danger'; ?>">
            <?php echo $note->sfw ? $this->Html->iconT('check-circle', __d('elabs', 'Yes')) : $this->Html->iconT('circle-o', __d('elabs', 'No')); ?>
        </span>
    </li>
</ul>
<?php
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div lang="<?php echo $note->language->id ?>">
    <?php echo $this->Html->displayMD($note->text); ?>
</div>
<?php
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultview');
