<?php
$this->assign('title', __d('files', 'Add a file'));

$formTemplate = [
    'label' => '<label class="form-label {{attrs.class}}" {{attrs}}>{{text}}</label>',
    'checkboxContainer' => '<div class="form-group"><div class="checkbox switch">{{content}}</div></div>',
    'submitContainer' => '{{content}}',
];

$this->loadHelper('CodeMirror');
echo $this->Form->create($file, ['type' => 'file']);
$this->Form->templates($formTemplate);
$linkOptions = ['class' => 'btn btn-flat waves-attach waves-button waves-effect', 'escape' => false];
?>
<div class="col-sm-3">
    <div class="side-menu">
        <div class="content-sub-heading"><?php echo __d('elabs', 'Navigation') ?></div>
        <div class="side-menu-content">
            <ul>
                <li><?php echo $this->Html->link(__d('files', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-list"></span>', 'Your files']), ['action' => 'index'], $linkOptions) ?></li>
                <li><?php echo $this->Html->link(__d('licenses', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-list"></span>', 'List available licenses']), ['prefix' => false, 'controller' => 'Licenses', 'action' => 'index'], $linkOptions) ?></li>
            </ul>
        </div>
    </div>
</div>
<div class="col-sm-6">
    <?php
    echo $this->Form->input('file', ['type' => 'file']);
    echo $this->Form->input('description', ['required' => false, 'id' => 'descArea', 'label' => __d('posts', 'Description')]);
    $this->CodeMirror->add('descArea');

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
