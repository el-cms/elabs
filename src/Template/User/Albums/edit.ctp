<?php
/*
 * File:
 *   src/Templates/Users/Albums/edit.ctp
 * Description:
 *   Form to edit an album
 * Layout element:
 *   defaultform.ctp
 */
// Page title
$this->assign('title', $album->name);

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Albums'), ['action' => 'index']);
$this->Html->addCrumb(__d('elabs', 'Edit {0}', [$album->name]));

// Actions block
// -------------
$this->start('pageActions');
echo $this->Form->postLink($this->Html->iconT('trash', __d('elabs', 'Delete')), ['action' => 'delete', $album->id], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $album->id), 'escape' => false, 'class' => 'btn btn-danger btn-sm btn-block']);
$this->end();

// Related links block
// -------------------
$this->start('pageLinks');
$linkOptions = ['class' => 'list-group-item', 'escape' => false];
echo $this->Html->link($this->Html->iconT('list', __d('elabs', 'Your albums')), ['action' => 'index'], $linkOptions);
echo $this->Html->link($this->Html->iconT('list', __d('elabs', 'Your projects')), ['controller' => 'projects', 'action' => 'index'], $linkOptions);
echo $this->Html->link($this->Html->iconT('plus', __d('elabs', 'New album')), ['action' => 'add'], $linkOptions);
$this->end();

// Page content block
// ------------------
$this->start('pageContent');
echo $this->Form->create($album);
// Required fields are still set to required=>false as there is an issue with codeMirror
echo $this->Form->input('name', ['label' => ['class' => 'floating-label']]);
echo $this->Form->input('description', ['required' => false, 'id' => 'descriptionArea', 'label' => __d('elabs', 'Full description')]);
$this->CodeMirror->add('descriptionArea');
?>
<div class="row">
    <div class="col-sm-4">
        <?php echo $this->Form->input('language_id', ['options' => $languages, 'default' => $this->request->session()->read('defaultWritingLanguage')]); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $this->Form->input('files._ids', ['options' => $files]); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $this->Form->input('projects._ids', ['options' => $projects]); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php echo $this->Form->input('sfw', ['label' => __d('elabs', 'This is SFW')]); ?>
    </div>
    <div class="col-sm-6">
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

