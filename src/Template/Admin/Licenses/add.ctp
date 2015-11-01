<?php
$this->assign('title', __d('licenses', 'New license'));

$formTemplate = [
    'label' => '<label class="form-label {{attrs.class}}" {{attrs}}>{{text}}</label>',
    'checkboxContainer' => '<div class="form-group"><div class="checkbox switch">{{content}}</div></div>',
    'submitContainer' => '{{content}}',
];
$this->loadHelper('CodeMirror');
echo $this->Form->create($license);
$this->Form->templates($formTemplate);
?>
<div class="col-sm-3">
    <div class="content-sub-heading"><?php echo __d('elabs', 'Actions') ?></div>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List licenses'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="col-sm-6">
    <?php
    echo $this->Form->input('name');
    echo $this->Form->input('short_description', ['required' => false, 'id' => 'descriptionArea', 'label' => __d('licenses', 'Short description')]);
    $this->CodeMirror->add('descriptionArea');

    $this->append('pageBottomScripts');
    echo $this->CodeMirror->scripts();
    $this->end();
    ?>
</div>
<div class="col-sm-3">
    <?php
    echo $this->Form->input('link');
    echo $this->Form->select('icon', ['creative-commons' => 'Creative Commons', 'copyright' => 'Copyright sign']);
    ?>
    <div class="form-group-btn">
        <?php echo $this->Form->submit(__('Submit')); ?>
    </div>
</div>
<?php
echo $this->Form->end();
