<?php
/*
 * File:
 *   src/Templates/Users/Files/add.ctp
 * Description:
 *   Form to add a file
 * Layout element:
 *   defaultform.ctp
 */

// Page title
$this->assign('title', __d('files', 'Add a file'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Files'), ['action' => 'index']);
$this->Html->addCrumb($this->fetch('title'));

// Related links block
// -------------------
$this->start('pageLinks');
$linkOptions = ['class' => 'list-group-item', 'escape' => false];
echo $this->Html->link(__d('files', '{0}&nbsp;{1}', [$this->Html->icon('list'), 'Your files']), ['action' => 'index'], $linkOptions);
echo $this->Html->link(__d('licenses', '{0}&nbsp;{1}', [$this->Html->icon('list'), 'List available licenses']), ['prefix' => false, 'controller' => 'Licenses', 'action' => 'index'], $linkOptions);
$this->end();

// Page content block
// ------------------
$this->start('pageContent');
echo $this->Form->create($file, ['type' => 'file']);
echo $this->Form->input('file', ['type' => 'file']);
echo $this->Form->input('description', ['type' => 'textarea', 'required' => false, 'id' => 'descArea', 'label' => __d('posts', 'Description')]);
$this->CodeMirror->add('descArea');
?>
<div class="row">
    <div class="col-sm-6">
        <?php echo $this->Form->input('license_id', ['options' => $licenses]); ?>
    </div>
    <div class="col-sm-6">
        <?php echo $this->Form->input('language_id', ['options' => $languages, 'default'=>'fra']); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php echo $this->Form->input('sfw', ['label' => __d('elabs', 'This is SFW')]); ?>
    </div>
    <div class="col-sm-6">
        <?php echo $this->Form->submit(__d('files', 'Add the file'), ['class' => 'btn-primary btn-block']); ?>
    </div>
</div>
<?php
echo $this->Form->end();
$this->end();

// Load the custom layout element
// ------------------------------
echo $this->element('layouts/defaultform');
