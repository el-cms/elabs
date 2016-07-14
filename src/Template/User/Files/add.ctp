<?php
$this->assign('title', __d('files', 'Add a file'));

$linkOptions = ['class' => 'list-group-item', 'escape' => false];

// Related links block
// -------------------
$this->start('pageLinks');
echo $this->Html->link(__d('files', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-list"></span>', 'Your files']), ['action' => 'index'], $linkOptions);
echo $this->Html->link(__d('licenses', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-list"></span>', 'List available licenses']), ['prefix' => false, 'controller' => 'Licenses', 'action' => 'index'], $linkOptions);
$this->end();

// Page content block
// ------------------
$this->start('pageContent');
echo $this->Form->create($file, ['type' => 'file']);
echo $this->Form->input('file', ['type' => 'file']);
echo $this->Form->input('description', ['required' => false, 'id' => 'descArea', 'label' => __d('posts', 'Description')]);
$this->CodeMirror->add('descArea');
echo $this->Form->input('license_id', ['options' => $licenses, 'class' => 'selecter', 'data-selecter-options' => '{"cover":"true"}']);
?><div class="row">
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

// Form options
// ------------
$this->start('formOptions');
$this->end();

// Load the custom layout element
// ------------------------------
echo $this->element('layouts/defaultadd');
