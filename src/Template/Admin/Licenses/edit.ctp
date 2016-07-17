<?php
/*
 * File:
 *   src/Templates/Admin/Licenses/edit.ctp
 * Description:
 *   Form to edit a license
 * Layout element:
 *   defaultform.ctp
 */

// Page title
$this->assign('title', __d('elabs', 'Admin/Licenses/Edit&gt; {0}', $license->name));

// Actions block
// -------------
$this->start('pageActions');
echo $this->Form->postLink(__('{0}&nbsp;{1}', [$this->Html->icon('trash'), __('Delete')]), ['action' => 'delete', $license->id], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $license->id), 'escape' => false, 'class' => 'btn btn-danger btn-block']);
$this->end();

// Related links block
// -------------------
$this->start('pageLinks');
$linkOptions = ['class' => 'list-group-item', 'escape' => false];
echo $this->Html->link(__d('licenses', '{0}&nbsp;{1}', [$this->Html->icon('list'), 'List licenses']), ['prefix' => 'admin', 'controller' => 'Licenses', 'action' => 'index'], $linkOptions);
echo $this->Html->link(__d('licenses', '{0}&nbsp;{1}', [$this->Html->icon('plus'), 'Add a license']), ['prefix' => 'admin', 'controller' => 'Licenses', 'action' => 'add'], $linkOptions);
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
        <?php echo $this->Form->submit(__d('elabs', 'Save changes'), ['class' => 'btn-primary btn block']); ?>
    </div>
</div>
<?php
echo $this->Form->end();
$this->end();

// Load the custom layout element
// ------------------------------
echo $this->element('layouts/adminform');
