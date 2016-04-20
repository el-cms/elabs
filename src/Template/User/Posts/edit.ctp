<?php
$this->assign('title', __d('posts', 'Edit article "{0}"', $post->title));

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
            <?php echo $this->Form->postLink(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-trash"></span>', 'Delete']), ['action' => 'delete', $post->id], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $post->id), 'escape' => false, 'class' => 'btn btn-red waves-attach waves-button waves-effect']) ?>
        </div>
    </div>
    <div class="side-menu">
        <div class="content-sub-heading"><?php echo __d('elabs', 'Navigation') ?></div>
        <div class="side-menu-content">
            <ul>
                <li><?php echo $this->Html->link(__d('posts', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-list"></span>', 'Your articles']), ['action' => 'index'], $linkOptions) ?></li>
                <li><?php echo $this->Html->link(__d('licenses', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-list"></span>', 'List available licenses']), ['prefix' => false, 'controller' => 'Licenses', 'action' => 'index'], $linkOptions) ?></li>
            </ul>
        </div>
    </div>
</div>
<?php
echo $this->Form->create($post);
$this->Form->templates($formTemplate);
?>
<div class="col-sm-6">
    <?php
    // Required fields are still set to required=>false as there is an issue with codeMirror
    echo $this->Form->input('title', ['label' => ['class' => 'floating-label']]);
    echo $this->Form->input('excerpt', ['required' => false, 'id' => 'excerptArea', 'label' => __d('posts', 'Introduction')]);
    echo $this->Form->input('text', ['required' => false, 'id' => 'textArea', 'label' => __d('posts', 'Article contents')]);
    $this->CodeMirror->add('excerptArea', [], ['%s.setSize(null, "150")']);
    $this->CodeMirror->add('textArea');
    $this->append('pageBottomScripts');
    echo $this->CodeMirror->scripts();
    $this->end();
    ?>
</div>
<div class="col-sm-3">
    <?php
    echo $this->Form->input('sfw', ['class' => 'access_hide', 'label' => __d('elabs', 'This is SFW')]);
    echo $this->Form->input('status', ['required' => false, 'type' => 'checkbox', 'value' => '1', 'class' => 'access_hide', 'label' => __d('posts', 'Published')]);
    echo $this->Form->input('license_id', ['options' => $licenses]);
    ?>
    <div class="form-group-btn">
        <?php echo $this->Form->submit(__d('elabs', 'Save the changes')); ?>
    </div>
</div>
<?php
echo $this->Form->end();

