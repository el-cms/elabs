<?php
$this->assign('title', __d('elabs', 'Admin/Licenses/Edit> {0}', $license->name));

$formTemplate = [
    'label' => '<label class="form-label {{attrs.class}}" {{attrs}}>{{text}}</label>',
    'checkboxContainer' => '<div class="form-group"><div class="checkbox switch">{{content}}</div></div>',
    'submitContainer' => '{{content}}',
];

$linkOptions = ['class' => 'btn btn-flat waves-attach waves-button waves-effect', 'escape' => false];
?>
<div class="col-sm-3">
    <div class="side-menu">
        <div class="content-sub-heading"><?php echo __d('elabs', 'Actions') ?></div>
        <div class="side-menu-content">
            <?php
            echo $this->Form->postLink(
                    __('Delete'), ['action' => 'delete', $license->id], ['confirm' => __('Are you sure you want to delete # {0}?', $license->id), 'escape' => false, 'class' => 'btn btn-red waves-attach waves-button waves-effect']
            )
            ?></li>
        </div>
    </div>
    <div class="side-menu">
        <div class="content-sub-heading"><?php echo __d('elabs', 'Navigation') ?></div>
        <div class="side-menu-content">
            <ul>
                <li><?php echo $this->Html->link(__d('licenses', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-list"></span>', 'List available licenses']), ['action' => 'index'], $linkOptions) ?></li>
            </ul>
        </div>
    </div>
</div>
<?php
echo $this->Form->create($license);
$this->Form->templates($formTemplate);
?>
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
