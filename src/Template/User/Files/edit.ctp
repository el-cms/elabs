<?php
/*
 * File:
 *   src/Templates/Users/Files/edit.ctp
 * Description:
 *   Form to edit a file
 * Layout element:
 *   defaultform.ctp
 */

// Page title
$this->assign('title', $file->name);

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Files'), ['action' => 'index']);
$this->Html->addCrumb(__d('elabs', 'Edit {0}', [$file->name]));

// Actions block
// -------------
$this->start('pageActions');
echo $this->Form->postLink($this->Html->iconT('trash', __d('elabs', 'Delete')), ['action' => 'delete', $file->id], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $file->id), 'escape' => false, 'class' => 'btn btn-danger btn-sm btn-block']);
$this->end();

// Related links block
// -------------------
$this->start('pageLinks');
$linkOptions = ['class' => 'list-group-item', 'escape' => false];
echo $this->Html->link($this->Html->iconT('list', __d('elabs', 'Your files')), ['action' => 'index'], $linkOptions);
echo $this->Html->link($this->Html->iconT('plus', __d('elabs', 'New file')), ['action' => 'add'], $linkOptions);
echo $this->Html->link($this->Html->iconT('list', __d('elabs', 'List available licenses')), ['prefix' => false, 'controller' => 'Licenses', 'action' => 'index'], $linkOptions);
$this->end();

// Page content block
// ------------------
$this->start('pageContent');
echo $this->Form->create($file);
echo $this->Form->input('description', ['type' => 'textarea', 'required' => false, 'id' => 'descArea', 'label' => __d('elabs', 'Description'), 'value' => $file->description]);
$this->CodeMirror->add('descArea');
?>
<div class="row">
    <div class="col-sm-4">
        <?php echo $this->Form->input('license_id', ['options' => $licenses]); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $this->Form->input('language_id', ['options' => $languages]); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $this->Form->input('sfw', ['label' => __d('elabs', 'This is SFW')]); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <?php echo $this->Form->input('projects._ids', ['options' => $projects]); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $this->Form->input('albums._ids', ['options' => $albums]); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $this->Form->input('hide_from_acts', ['label' => __d('elabs', 'Skip front page')]); ?>
        <?php echo $this->Form->input('isMinor', ['type' => 'checkbox', 'checked' => true, 'label' => __d('elabs', 'Minor update')]); ?>
        <?php echo $this->Form->submit(__d('elabs', 'Update'), ['class' => 'btn-primary btn-block']); ?>
    </div>
</div>
<?php
echo $this->Form->end();
$this->end();

// Load the custom layout element
// ------------------------------
echo $this->element('layouts/defaultform');
