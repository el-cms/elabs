<?php
/*
 * File:
 *   src/Templates/Users/Albums/add.ctp
 * Description:
 *   Form to add an album
 * Layout element:
 *   defaultform.ctp
 */
// Page title
$this->assign('title', __d('elabs', 'New album'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Albums'), ['action' => 'index']);
$this->Html->addCrumb($this->fetch('title'));

// Related links block
// -------------------
$this->start('pageLinks');
$linkOptions = ['class' => 'list-group-item', 'escape' => false];
echo $this->Html->link($this->Html->iconT('list', __d('elabs', 'Your albums')), ['controller' => 'albums', 'action' => 'index'], $linkOptions);
echo $this->Html->link($this->Html->iconT('list', __d('elabs', 'Your files')), ['controller' => 'files', 'action' => 'index'], $linkOptions);
echo $this->Html->link($this->Html->iconT('list', __d('elabs', 'Your projects')), ['controller' => 'projects', 'action' => 'index'], $linkOptions);
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
    <div class="col-sm-12">
        <?php echo $this->Form->input('tags._ids', ['label' => __d('elabs', 'Tags'), 'options' => [], 'data-role' => 'tagsinput']); ?>
    </div>
</div>
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
    <div class="col-sm-4">
        <?php echo $this->Form->input('sfw', ['label' => __d('elabs', 'This is SFW')]); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $this->Form->input('hide_from_acts', ['label' => __d('elabs', 'Skip front page')]); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $this->Form->submit(__d('elabs', 'Create the album'), ['class' => 'btn-primary btn-block']); ?>
    </div>
</div>
<?php
echo $this->Form->end();
$this->end();

// Load the custom layout element
// ------------------------------
echo $this->element('layouts/defaultform');
