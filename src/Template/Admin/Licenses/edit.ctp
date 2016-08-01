<?php
/*
 * File:
 *   src/Templates/Admin/Licenses/edit.ctp
 * Description:
 *   Form to edit a license
 * Layout element:
 *   adminform.ctp
 */

// Page title
$this->assign('title', $license->name);

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Licenses'), ['action' => 'index']);
$this->Html->addCrumb(__d('elabs', 'Edit {0}', [$license->name]));

// Actions block
// -------------
$this->start('pageActions');
$linkIcon=$this->Html->iconT('trash', __d('elabs', 'Delete'));
echo $this->Form->postLink($linkIcon, ['action' => 'delete', $license->id], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $license->id), 'escape' => false, 'class' => 'btn btn-danger btn-block']);
$this->end();

// Related links block
// -------------------
$this->start('pageLinks');
$linkOptions = ['class' => 'list-group-item', 'escape' => false];
echo $this->Html->link($this->Html->iconT('list', __d('elabs', 'List of licenses')), ['prefix' => 'admin', 'controller' => 'Licenses', 'action' => 'index'], $linkOptions);
echo $this->Html->link($this->Html->iconT('plus', __d('elabs', 'Add a license')), ['prefix' => 'admin', 'controller' => 'Licenses', 'action' => 'add'], $linkOptions);
$this->end();

// Page content block
// ------------------
$this->start('pageContent');
echo $this->Form->create($license);
echo $this->Form->input('name');
echo $this->Form->input('link');
?>
<div class="row">
    <div class="col-sm-6">
        <?php echo $this->Form->select('icon', ['creative-commons' => 'Creative Commons', 'copyright' => 'Copyright sign']); ?>
    </div>
    <div class="col-sm-6">
        <?php echo $this->Form->submit(__d('elabs', 'Save the changes'), ['class' => 'btn-primary btn block']); ?>
    </div>
</div>
<?php
echo $this->Form->end();
$this->end();

// Load the custom layout element
// ------------------------------
echo $this->element('layouts/adminform');
