<?php
$this->assign('title', __d('projects', 'Edit a project'));

$formTemplate = [
    'label' => '<label class="form-label {{attrs.class}}" {{attrs}}>{{text}}</label>',
    'checkboxContainer' => '<div class="form-group"><div class="checkbox switch">{{content}}</div></div>',
    'submitContainer' => '{{content}}',
];

$this->loadHelper('CodeMirror');

?>
<div class="col-sm-3">
  <div class="content-sub-heading"><?php echo __d('elabs', 'Actions') ?></div>
  <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
      <li><?php echo $this->Html->link(__('Your projects'), ['action' => 'manage']) ?></li>
      <li><?php echo $this->Html->link(__('List available licenses'), ['prefix' => false, 'controller' => 'Licenses', 'action' => 'index']) ?></li>
    </ul>
  </nav>
</div>
<?php
echo $this->Form->create($project);
$this->Form->templates($formTemplate);
?>
<div class="col-sm-6">
  <?php
  // Required fields are still set to required=>false as there is an issue with codeMirror
  echo $this->Form->input('name', ['label' => ['class' => 'floating-label']]);
  echo $this->Form->input('short_description', ['required' => false, 'id' => 'excerptArea', 'label' => __d('projects', 'Short description')]);
  echo $this->Form->input('description', ['required' => false, 'id' => 'descriptionArea', 'label' => __d('projects', 'Full description')]);
  $this->CodeMirror->add('excerptArea', [], ['%s.setSize(null, "150")']);
  echo $this->Form->input('mainurl', ['label' => __d('projects', 'Main URL')]);
  $this->CodeMirror->add('descriptionArea');

  $this->append('pageBottomScripts');
  echo $this->CodeMirror->scripts();
  $this->end();
  ?>
</div>
<div class="col-sm-3">
  <?php
  echo $this->Form->input('sfw', ['class' => 'access_hide', 'label' => __d('elabs', 'This is SFW')]);
  echo $this->Form->input('license_id', ['options' => $licenses]);
  ?>
  <div class="form-group-btn">
    <?php echo $this->Form->submit(__('Submit')); ?>
  </div>
</div>
<?php
echo $this->Form->end();
