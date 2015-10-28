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
  <div class="content-sub-heading"><?php echo __d('elabs', 'Actions') ?></div>
  <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
      <li><?php echo $this->Html->link(__('Your articles'), ['action' => 'manage']) ?></li>
      <li><?php echo $this->Html->link(__('List available licenses'), ['prefix' => false, 'controller' => 'Licenses', 'action' => 'index']) ?></li>
    </ul>
  </nav>
</div>
<div class="col-sm-6">
  <?php
  // Required fields are still set to required=>false as there is an issue with codeMirror
  echo $this->Form->input('title', ['label' => ['class' => 'floating-label']]);
  echo $this->Form->input('excerpt', ['required' => false, 'id' => 'excerptArea', 'label' => __d('posts', 'Introduction')]);
  $this->CodeMirror->add('excerptArea', [], ['%s.setSize(null, "150")']);
  echo $this->Form->input('text', ['required' => false, 'id' => 'textArea', 'label' => __d('posts', 'Article contents')]);
  $this->CodeMirror->add('textArea');

  $this->append('pageBottomScripts');
  echo $this->CodeMirror->scripts();
  $this->end();
  ?>
</div>
<div class="col-sm-3">
  <?php
  echo $this->Form->input('sfw', ['class' => 'access_hide', 'label' => __d('elabs', 'This is SFW')]);
  echo $this->Form->input('published', ['class' => 'access_hide', 'label' => __d('posts', 'Published')]);
  echo $this->Form->input('license_id', ['options' => $licenses]);
  ?>
  <div class="form-group-btn">
    <?php echo $this->Form->submit(__('Submit')); ?>
  </div>
</div>
<?php
echo $this->Form->end();
