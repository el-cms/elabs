<?php
/*
 * File:
 *   src/Templates/Users/Notes/add.ctp
 * Description:
 *   Form to add a note
 * Layout element:
 *   defaultform.ctp
 */

// Page title
$this->assign('title', __d('elabs', 'New note'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Notes'), ['action' => 'index']);
$this->Html->addCrumb($this->fetch('title'));

// Related links block
// -------------------
$this->start('pageLinks');
$linkOptions = ['class' => 'list-group-item', 'escape' => false];
echo $this->Html->link($this->Html->iconT('list', __d('elabs', 'Your notes')), ['action' => 'index'], $linkOptions);
echo $this->Html->link($this->Html->iconT('list', __d('elabs', 'List available licenses')), ['prefix' => false, 'controller' => 'Licenses', 'action' => 'index'], $linkOptions);
$this->end();

// Page content block
// ------------------
$this->start('pageContent');
echo $this->Form->create($note);
// Required fields are still set to required=>false as there is an issue with codeMirror
echo $this->Form->input('text', ['type' => 'textarea', 'required' => 'false', 'id' => 'noteArea']);
$this->CodeMirror->add('noteArea', [], ['%s.setSize(null, "150")']);
?>
<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->input('tags._ids', ['label' => __d('elabs', 'Tags'), 'options' => [], 'data-role' => 'tagsinput']); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <?php echo $this->Form->input('license_id', ['options' => $licenses, 'default' => $this->request->session()->read('defaultWritingLicense')]); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $this->Form->input('language_id', ['options' => $languages, 'default' => $this->request->session()->read('defaultWritingLanguage')]); ?>
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
        <?php echo $this->Form->submit(__d('elabs', 'Save the note'), ['class' => 'btn-primary btn-block']); ?>
    </div>
</div>
<?php
//echo $this->Form->input('tags._ids', ['options' => $tags]);
//echo $this->Form->input('projects._ids', ['options' => $projects]);
echo $this->Form->end();
$this->end();

// Load the custom layout element
// ------------------------------
echo $this->element('layouts/defaultform');
