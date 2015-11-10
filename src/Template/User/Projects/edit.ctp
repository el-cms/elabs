<?php
$this->assign('title', __d('projects', 'Edit project "{0}"', $project->name));

$formTemplate = [
    'label' => '<label class="form-label {{attrs.class}}" {{attrs}}>{{text}}</label>',
    'checkboxContainer' => '<div class="form-group"><div class="checkbox switch">{{content}}</div></div>',
    'submitContainer' => '{{content}}',
];

$this->loadHelper('CodeMirror');
$linkOptions = ['class' => 'btn btn-flat waves-attach waves-button waves-effect', 'escape' => false];
?>
<div class="col-sm-3">
    <div class="side-menu">
        <div class="content-sub-heading"><?php echo __d('elabs', 'Actions') ?></div>
        <div class="side-menu-content">
            <?php echo $this->Form->postLink(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-trash"></span>', 'Delete']), ['action' => 'delete', $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id), 'escape' => false, 'class' => 'btn btn-red waves-attach waves-button waves-effect']) ?>
        </div>
    </div>

    <div class="side-menu">
        <div class="content-sub-heading"><?php echo __d('elabs', 'Navigation') ?></div>
        <div class="side-menu-content">
            <ul>
                <li><?php echo $this->Html->link(__d('projects', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-list"></span>', 'Your projects']), ['action' => 'index'], $linkOptions) ?></li>
                <li><?php echo $this->Html->link(__d('licenses', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-list"></span>', 'List available licenses']), ['prefix' => false, 'controller' => 'Licenses', 'action' => 'index'], $linkOptions) ?></li>
            </ul>
        </div>
    </div>
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
