<?php
/*
 * File:
 *   src/Templates/Users/Posts/add.ctp
 * Description:
 *   Form to add a post
 * Layout element:
 *   defaultform.ctp
 */

// Page title
$this->assign('title', __d('posts', 'New article'));

// Related links block
// -------------------
$this->start('pageLinks');
$linkOptions = ['class' => 'list-group-item', 'escape' => false];
echo $this->Html->link(__d('posts', '{0}&nbsp;{1}', [$this->Html->icon('list'), 'Your articles']), ['action' => 'index'], $linkOptions);
echo $this->Html->link(__d('licenses', '{0}&nbsp;{1}', [$this->Html->icon('list'), 'List available licenses']), ['prefix' => false, 'controller' => 'Licenses', 'action' => 'index'], $linkOptions);
$this->end();

// Page content block
// ------------------
$this->start('pageContent');
echo $this->Form->create($post);
// Required fields are still set to required=>false as there is an issue with codeMirror
echo $this->Form->input('title', ['label' => ['class' => 'floating-label']]);
echo $this->Form->input('excerpt', ['type' => 'textarea', 'required' => false, 'id' => 'excerptArea', 'label' => __d('posts', 'Introduction')]);
$this->CodeMirror->add('excerptArea', [], ['%s.setSize(null, "150")']);
echo $this->Form->input('text', ['required' => false, 'id' => 'textArea', 'label' => __d('posts', 'Article contents')]);
$this->CodeMirror->add('textArea');
?>
<div class="row">
    <div class="col-sm-6">
        <?php echo $this->Form->input('license_id', ['options' => $licenses]); ?>
    </div>
    <div class="col-sm-6">
        <?php echo $this->Form->input('language_id', ['options' => $languages]); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <?php echo $this->Form->input('sfw', ['label' => __d('elabs', 'This is SFW')]); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $this->Form->input('status', ['required' => false, 'type' => 'checkbox', 'label' => __d('posts', 'Published')]); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $this->Form->submit(__d('files', 'Save the article'), ['class' => 'btn-primary btn-block']); ?>
    </div>
</div>
<?php
echo $this->Form->end();
$this->end();

// Load the custom layout element
// ------------------------------
echo $this->element('layouts/defaultform');
