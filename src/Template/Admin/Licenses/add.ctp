<?php
$this->assign('title', __d('licenses', 'New license'));

$formTemplate = [
    'label' => '<label class="form-label {{attrs.class}}" {{attrs}}>{{text}}</label>',
    'checkboxContainer' => '<div class="form-group"><div class="checkbox switch">{{content}}</div></div>',
    'submitContainer' => '{{content}}',
];
echo $this->Form->create($license);
$this->Form->templates($formTemplate);
$linkOptions = ['class' => 'btn btn-flat waves-attach waves-button waves-effect', 'escape' => false];
?>
<div class="col-sm-3">
    <div class="side-menu">
        <div class="content-sub-heading"><?php echo __d('elabs', 'Navigation') ?></div>
        <div class="side-menu-content">
            <ul>
                <li><?php echo $this->Html->link(__d('licenses', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-list"></span>', 'List available licenses']), ['action' => 'index'], $linkOptions) ?></li>
            </ul>
        </div>
    </div>
</div>
<div class="col-sm-6">
    <?php
    echo $this->Form->input('name');
    echo $this->Form->input('link');
    ?>
    <div class="form-group form-group-label form-group-brand">
        <label class="form-label " for="icon"><?php echo __d('licenses', 'Icon') ?></label>
        <?php echo $this->Form->select('icon', ['creative-commons' => 'Creative Commons', 'copyright' => 'Copyright sign']); ?>
    </div>
    <?php
    $this->end();
    ?>
</div>
<div class="col-sm-3">
    <div class="form-group-btn">
        <?php echo $this->Form->submit(__('Submit')); ?>
    </div>
</div>
<?php
echo $this->Form->end();
