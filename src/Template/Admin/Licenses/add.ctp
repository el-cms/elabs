<?php
/*
 * File:
 *   src/Templates/Admin/Licenses/add.ctp
 * Description:
 *   Form to add a license
 * Layout element:
 *   adminform.ctp
 */

// Page title
$this->assign('title', __d('elabs', 'New license'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Licenses'), ['action' => 'index']);
$this->Html->addCrumb($this->fetch('title'));

// Related links block
// -------------------
$this->start('pageLinks');
$linkOptions = ['class' => 'list-group-item', 'escape' => false];
$linkIcon=$this->Html->iconT('list', __d('elabs', 'List of licenses'));
echo $this->Html->link($linkIcon, ['prefix' => 'admin', 'controller' => 'Licenses', 'action' => 'index'], $linkOptions);
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
        <?php echo $this->Form->submit(__d('elabs', 'Create'), ['class' => 'btn-primary btn-block']); ?>
    </div>
</div>
<?php
echo $this->Form->end();
$this->end();

// Load the custom layout element
// ------------------------------
echo $this->element('layouts/adminform');
