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
$this->assign('title', __d('posts', 'Edit file  "{0}"', $file->name));


// Actions block
// -------------
$this->start('pageActions');
echo $this->Form->postLink(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-trash"></span>', 'Delete']), ['action' => 'delete', $file->id], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $file->id), 'escape' => false, 'class' => 'btn btn-danger btn-sm btn-block']);
$this->end();

// Related links block
// -------------------
$this->start('pageLinks');
$linkOptions = ['class' => 'list-group-item', 'escape' => false];
echo $this->Html->link(__d('files', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-list"></span>', 'Your files']), ['action' => 'index'], $linkOptions);
echo $this->Html->link(__d('files', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-plus"></span>', 'New file']), ['action' => 'add'], $linkOptions);
echo $this->Html->link(__d('licenses', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-list"></span>', 'List available licenses']), ['prefix' => false, 'controller' => 'Licenses', 'action' => 'index'], $linkOptions);
$this->end();

// Page content block
// ------------------
$this->start('pageContent');
echo $this->Form->create($file);
echo $this->Form->input('description', ['type' => 'textarea', 'required' => false, 'id' => 'descArea', 'label' => __d('posts', 'Description'), 'value'=>$file->description]);
$this->CodeMirror->add('descArea');
echo $this->Form->input('license_id ', ['options' => $licenses, 'class' => 'selecter', 'data-selecter-options' => '{"cover":"true"}']);
?>
<div class="row">
    <div class="col-sm-6">
        <?php echo $this->Form->input('sfw', ['label' => __d('elabs', 'This is SFW')]); ?>
    </div>
    <div class="col-sm-6">
        <?php echo $this->Form->submit(__d('files', 'Update'), ['class' => 'btn-primary btn-block']); ?>
    </div>
</div>
<?php
echo $this->Form->end();
$this->end();

// Load the custom layout element
// ------------------------------
echo $this->element('layouts/defaultform');
