<?php
/*
 * File:
 *   src/Templates/Licenses/view.ctp
 * Description:
 *   Display of a single license
 * Layout element:
 *   defaultview.ctp
 */
use Cake\Core\Configure;

// Page title
$this->assign('title', __d('elabs', 'License: {0}', h($license->name)));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'About'), ['controller' => 'Pages', 'action' => 'display', 'about']);
$this->Html->addCrumb(__d('elabs', 'Licenses'), ['action' => 'index']);
$this->Html->addCrumb(__d('elabs', 'Content with the {0} license', [h($license->name)]));

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo $this->Html->iconT('font', __d('elabs', 'Name:')) ?></strong> <?php echo $this->Html->iconT(h($license->icon), h($license->name)) ?></li>
    <li class="separator"></li>
    <li><strong><?php echo $this->Html->iconT('font', __dn('elabs', '{0} article', '{0} articles', $license->post_count, [$license->post_count])) ?></strong></li>
    <li><strong><?php echo $this->Html->iconT('sticky-note', __dn('elabs', '{0} note', '{0} notes', $license->note_count, $license->note_count)) ?></strong></li>
    <li><strong><?php echo $this->Html->iconT('file-o', __dn('elabs', '{0} file','{0} files', $license->file_count, $license->file_count)) ?></strong></li>
    <li><strong><?php echo $this->Html->iconT('cogs', __dn('elabs', '{0} project', '{0} projects', $license->project_count, $license->project_count)) ?></strong></li>
</ul>
<?php
$this->end();

// Block: Actions
// --------------
$this->start('pageActions');
echo $this->Html->link($this->Html->iconT('external-link', __d('elabs', 'More info online')), h($license->link), ['escape' => false, "class" => "btn btn-block"]);
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div class="panel">
    <ul class="nav nav-tabs nav-justified">
        <li class="active">
            <?php
            echo $this->Html->link(
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all articles with this license')]), 
                    ['controller' => 'posts', 'action' => 'index', 'license', $license->id], 
                    ['escape' => false, 'class' => 'tab-btn-right']
            )
            ?>
            <a data-toggle="tab" href="#posts-tab"><?php echo __d('elabs', 'Articles') ?></a>
        </li>
        <li>
            <?php
            echo $this->Html->link(
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all notes with this license')]), 
                    ['controller' => 'notes', 'action' => 'index', 'license', $license->id], 
                    ['escape' => false, 'class' => 'tab-btn-right']
            )
            ?>
            <a data-toggle="tab" href="#notes-tab"><?php echo __d('elabs', 'Notes') ?></a>
        </li>
        <li>
            <?php
            echo $this->Html->link(
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all projects with this license')]), 
                    ['controller' => 'projects', 'action' => 'index', 'license', $license->id], 
                    ['escape' => false, 'class' => 'tab-btn-right']
            )
            ?>
            <a data-toggle="tab" href="#projects-tab"><?php echo __d('elabs', 'Projects') ?></a>
        </li>
        <li>
            <?php
            echo $this->Html->link(
                    $this->Html->icon('chevron-right', ['title' => __d('elabs', 'Display all files with this license')]), 
                    ['controller' => 'files', 'action' => 'index', 'license', $license->id], 
                    ['escape' => false, 'class' => 'tab-btn-right']
            )
            ?>
            <a data-toggle="tab" href="#files-tab"><?php echo __d('elabs', 'Files') ?></a>
        </li>
    </ul>
    <div class="tab-content">
        <h4>
            <?php echo __d('elabs', 'Last {0} elements with this license', [Configure::read('cms.maxRelatedData')]) ?>
        </h4>
        <?php
        if (!$seeNSFW):
            ?>
            <div class="alert alert-info alert-sm">
                <?php echo $this->Html->iconT('info', __d('elabs','Some entries may be hidden, depending on your NSFW settings.')) ?>
            </div>
        <?php endif; ?>
        <div class="tab-pane fade active in" id="posts-tab">
            <?php
            if (!empty($license->posts)):
                foreach ($license->posts as $posts):
                    echo $this->element('posts/card', ['data' => $posts, 'licenseInfo' => false, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="notes-tab">
            <?php
            if (!empty($license->notes)):
                foreach ($license->notes as $note):
                    echo $this->element('notes/card', ['data' => $note, 'licenseInfo' => false, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="projects-tab">
            <?php
            if (!empty($license->projects)):
                foreach ($license->projects as $projects):
                    echo $this->element('projects/card', ['data' => $projects, 'licenseInfo' => false, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="files-tab">
            <?php
            if (!empty($license->files)):
                foreach ($license->files as $files):
                    echo $this->element('files/card', ['data' => $files, 'licenseInfo' => false, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>
    </div>
</div>
<?php
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/defaultview');
