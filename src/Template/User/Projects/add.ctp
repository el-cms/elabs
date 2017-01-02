<?php
/*
 * File:
 *   src/Templates/Users/Projects/add.ctp
 * Description:
 *   Form to add a project
 * Layout element:
 *   defaultform.ctp
 */

// Page title
$this->assign('title', __d('elabs', 'New project'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Projects'), ['action' => 'index']);
$this->Html->addCrumb($this->fetch('title'));

// Related links block
// -------------------
$this->start('pageLinks');
$linkOptions = ['class' => 'list-group-item', 'escape' => false];
echo $this->Html->link($this->Html->iconT('list', __d('elabs', 'Your projects')), ['action' => 'index'], $linkOptions);
echo $this->Html->link($this->Html->iconT('list', __d('elabs', 'List available licenses')), ['prefix' => false, 'controller' => 'Licenses', 'action' => 'index'], $linkOptions);
$this->end();

// Page content block
// ------------------
$this->start('pageContent');
echo $this->Form->create($project);
// Required fields are still set to required=>false as there is an issue with codeMirror
echo $this->Form->input('name', ['label' => ['class' => 'floating-label']]);
echo $this->Form->input('short_description', ['required' => false, 'id' => 'excerptArea', 'label' => __d('elabs', 'Short description')]);
echo $this->Form->input('description', ['required' => false, 'id' => 'descriptionArea', 'label' => __d('elabs', 'Full description')]);
$this->CodeMirror->add('excerptArea', [], ['%s.setSize(null, "150")']);
echo $this->Form->input('mainurl', ['label' => __d('elabs', 'Main URL')]);
$this->CodeMirror->add('descriptionArea');
?>
<div class="row">
    <div class="col-sm-6">
        <?php echo $this->Form->input('license_id', ['options' => $licenses, 'default' => $this->request->session()->read('defaultWritingLicense')]); ?>
    </div>
    <div class="col-sm-6">
        <?php echo $this->Form->input('language_id', ['options' => $languages, 'default' => $this->request->session()->read('defaultWritingLanguage')]); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <?php echo $this->Form->input('sfw', ['class' => 'access_hide', 'label' => __d('elabs', 'This is SFW')]); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $this->Form->input('hide_from_acts', ['label' => __d('elabs', 'Skip front page')]); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $this->Form->submit(__d('elabs', 'Save this project'), ['class' => 'btn-primary btn-block']); ?>
    </div>
</div>
<?php
echo $this->Form->end();
$this->end();

// Load the custom layout element
// ------------------------------
echo $this->element('layouts/defaultform');
