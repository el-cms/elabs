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
$this->assign('title', __d('projects', 'New project'));

// Related links block
// -------------------
$this->start('pageLinks');
$linkOptions = ['class' => 'list-group-item', 'escape' => false];
echo $this->Html->link(__d('projects', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-list"></span>', 'Your projects']), ['action' => 'index'], $linkOptions);
echo $this->Html->link(__d('licenses', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-list"></span>', 'List available licenses']), ['prefix' => false, 'controller' => 'Licenses', 'action' => 'index'], $linkOptions);
$this->end();

// Page content block
// ------------------
$this->start('pageContent');
echo $this->Form->create($project);
// Required fields are still set to required=>false as there is an issue with codeMirror
echo $this->Form->input('name', ['label' => ['class' => 'floating-label']]);
echo $this->Form->input('short_description', ['required' => false, 'id' => 'excerptArea', 'label' => __d('projects', 'Short description')]);
echo $this->Form->input('description', ['required' => false, 'id' => 'descriptionArea', 'label' => __d('projects', 'Full description')]);
$this->CodeMirror->add('excerptArea', [], ['%s.setSize(null, "150")']);
echo $this->Form->input('mainurl', ['label' => __d('projects', 'Main URL')]);
$this->CodeMirror->add('descriptionArea');
echo $this->Form->input('license_id', ['options' => $licenses]);
?>
<div class="row">
    <div class="col-sm-6">
        <?php echo $this->Form->input('sfw', ['class' => 'access_hide', 'label' => __d('elabs', 'This is SFW')]); ?>
    </div>
    <div class="col-sm-6">
        <?php echo $this->Form->submit(__d('projects', 'Save this project'), ['class' => 'btn-primary btn-block']); ?>
    </div>
</div>
<?php
echo $this->Form->end();
$this->end();

// Load the custom layout element
// ------------------------------
echo $this->element('layouts/defaultform');
