<?php
$formTemplate = [
    'label' => '<label class="form-label {{attrs.class}}" {{attrs}}>{{text}}</label>',
    'checkboxContainer' => '<div class="form-group"><div class="checkbox switch">{{content}}</div></div>',
    'submitContainer' => '{{content}}',
];
$this->loadHelper('CodeMirror');
echo $this->Form->create($post);
$this->Form->templates($formTemplate);
?>
<div class="col-sm-3">
  <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
      <li><?= $this->Html->link(__('List Posts'), ['action' => 'index']) ?></li>
      <li><?= $this->Html->link(__('List available licenses'), ['controller' => 'Licenses', 'action' => 'index']) ?></li>
    </ul>
  </nav>
</div>
<div class="col-sm-6">
  <?php
  // Required fields are still set to required=>false as there is an issue with codeMirror
  echo $this->Form->input('title', ['required' => false, 'label' => ['class' => 'floating-label']]);
  echo $this->Form->input('excerpt', ['required' => false, 'id' => 'excerptArea', 'label' => __d('elabs', 'Introduction')]);
  echo $this->Form->input('text', ['required' => false, 'id' => 'textArea', 'label' => __d('elabs', 'Article contents')]);
  $this->CodeMirror->add('excerptArea', [], ['%s.setSize(null, "150")']);
  $this->CodeMirror->add('textArea');
  $this->append('pageBottomScripts');
  echo $this->CodeMirror->scripts();
  $this->end();
  ?>
</div>
<div class="col-sm-3">
  <?php
  echo $this->Form->input('sfw', ['class' => 'access_hide', 'label' => __d('elabs', 'This is NSFW')]);
  echo $this->Form->input('published', ['class' => 'access_hide', 'label' => __d('elabs', 'Published')]);
  echo $this->Form->input('license_id', ['options' => $licenses]);
  ?>
  <div class="form-group-btn">
    <?php echo $this->Form->submit(__('Submit')); ?>
  </div>
</div>
<?php
$this->Form->end();

