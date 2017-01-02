<?php
/*
 * File:
 *   src/Templates/Users/Posts/edit.ctp
 * Description:
 *   Form to add a post
 * Layout element:
 *   defaultform.ctp
 */

// Page title
$this->assign('title', $post->title);

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Articles'), ['action' => 'index']);
$this->Html->addCrumb(__d('elabs', 'Edit {0}', [h($post->title)]));

// Page actions
// ------------
$this->start('pageActions');
echo $this->Form->postLink($this->Html->iconT('trash', __d('elabs', 'Delete')), ['action' => 'delete', $post->id], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $post->id), 'escape' => false, 'class' => 'btn btn-danger btn-block']);
$this->end();

// Related links block
// -------------------
$this->start('pageLinks');
$linkOptions = ['class' => 'list-group-item', 'escape' => false];
echo $this->Html->link($this->Html->iconT('list', __d('elabs', 'Your articles')), ['action' => 'index'], $linkOptions);
echo $this->Html->link($this->Html->iconT('list', __d('elabs', 'List available licenses')), ['prefix' => false, 'controller' => 'Licenses', 'action' => 'index'], $linkOptions);
$this->end();

// Page content block
// ------------------
$this->start('pageContent');
echo $this->Form->create($post);
// Required fields are still set to required=>false as there is an issue with codeMirror
echo $this->Form->input('title', ['label' => ['class' => 'floating-label']]);
echo $this->Form->input('excerpt', ['type' => 'textarea', 'required' => false, 'id' => 'excerptArea', 'label' => __d('elabs', 'Introduction')]);
$this->CodeMirror->add('excerptArea', [], ['%s.setSize(null, "150")']);
echo $this->Form->input('text', ['required' => false, 'id' => 'textArea', 'label' => __d('elabs', 'Article contents')]);
$this->CodeMirror->add('textArea');
?>
<div class="row">
    <div class="col-sm-4">
        <?php echo $this->Form->input('license_id', ['options' => $licenses]); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $this->Form->input('language_id', ['options' => $languages]); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $this->Form->input('projects._ids', ['options' => $projects]); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <?php echo $this->Form->input('sfw', ['class' => 'access_hide', 'label' => __d('elabs', 'This is SFW')]); ?>
    </div>
    <div class="col-sm-3">
        <?php echo $this->Form->input('status', ['required' => false, 'type' => 'checkbox', 'value' => STATUS_PUBLISHED, 'class' => 'access_hide', 'label' => __d('elabs', 'Published')]); ?>
    </div>
    <div class="col-sm-3">
        <?php echo $this->Form->input('isMinor', ['type' => 'checkbox', 'checked' => true, 'label' => __d('elabs', 'Minor update')]); ?>
        <?php echo $this->Form->input('hide_from_acts', ['label' => __d('elabs', 'Skip front page')]); ?>
    </div>
    <div class="col-sm-3">
        <?php echo $this->Form->submit(__d('elabs', 'Save the changes'), ['class' => 'btn btn-primary']); ?>
    </div>
</div>
<?php
echo $this->Form->end();
$this->end();

// Load the custom layout element
// ------------------------------
echo $this->element('layouts/defaultform');
