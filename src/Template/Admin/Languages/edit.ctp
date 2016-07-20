<?php
/*
 * File:
 *   src/Templates/Admin/Licenses/edit.ctp
 * Description:
 *   Form to edit a license
 * Layout element:
 *   adminform.ctp
 */

// Page title
$this->assign('title', __d('elabs', 'Admin/Languages/Edit&gt; {0}', $language->name));

// Actions block
// -------------
$this->start('pageActions');
echo $this->Form->postLink(__('{0}&nbsp;{1}', [$this->Html->icon('trash'), __('Delete')]), ['action' => 'delete', $language->id], ['confirm' => __d('elabs', 'Are you sure you want to delete # {0}?', $language->id), 'escape' => false, 'class' => 'btn btn-danger btn-block']);
$this->end();

// Related links block
// -------------------
$this->start('pageLinks');
$linkOptions = ['class' => 'list-group-item', 'escape' => false];
echo $this->Html->link(__d('languages', '{0}&nbsp;{1}', [$this->Html->icon('list'), 'List languages']), ['prefix' => 'admin', 'controller' => 'Languages', 'action' => 'index'], $linkOptions);
echo $this->Html->link(__d('languages', '{0}&nbsp;{1}', [$this->Html->icon('plus'), 'Add a language']), ['prefix' => 'admin', 'controller' => 'Languages', 'action' => 'add'], $linkOptions);
$this->end();

// Page content block
// ------------------
$this->start('pageContent');
echo $this->Form->create($language)
?>
<div class="row">
    <div class="col-sm-6">
        <?php
        echo $this->Form->input(
                'id', ['type' => 'text',
            'required' => true,
            'label' => __d('languages', '3 letters ID'),
            'help' => $this->Html->link(__d('languages', 'See the list of ISO 639-2 languages names'), 'https://www.loc.gov/standards/iso639-2/php/code_list.php', ['target' => '_blank'])
        ]);
        ?>
    </div>
    <div class="col-sm-6">
        <?php echo $this->Form->input('name', ['label' => __d('languages', 'Language, in native form')]); ?>
    </div>
</div>
<?php
echo $this->Form->submit(__d('elabs', 'Save changes'), ['class' => 'btn-primary btn block']);
echo $this->Form->end();
$this->end();

// Load the custom layout element
// ------------------------------
echo $this->element('layouts/adminform');
