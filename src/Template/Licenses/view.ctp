<?php
/*
 * File:
 *   src/Templates/Licenses/view.ctp
 * Description:
 *   Display of a single license
 * Layout element:
 *   defaultview.ctp
 */

// Page title
$this->assign('title', __d('license', 'License: {0}', h($license->name)));

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo __d('files', 'Name:') ?></strong> <?php echo __d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-' . h($license->icon) . '"></span>', h($license->name)]) ?></li>
</ul>
<?php
$this->end();

// Block: Actions
// --------------
$this->start('pageActions');
echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-external-link"></span>', __d('licenses', 'More info online')]), h($license->link), ['escape' => false, "class" => "btn btn-block"]);
$this->end();

// Block: Page content
// -------------------
$this->start('pageContent');
if (!$seeNSFW):
    ?>
    <div class="alert alert-info alert-sm">
        <?php echo __d('elabs', 'Some entries may be hidden, depending on your NSFW settings.') ?>
    </div>
<?php endif; ?> 
<div class="panel">
    <ul class="nav nav-tabs nav-justified">
        <li class="active"><a data-toggle="tab" href="#posts-tab"><?php echo __d('posts', 'Articles {0}', '<span class="badge">' . $this->Number->format($license->post_count) . '</span>') ?></a></li>
        <li><a data-toggle="tab" href="#projects-tab"><?php echo __d('projects', 'Projects {0}', '<span class="badge">' . $this->Number->format($license->project_count) . '</span>') ?></a></li>
        <li><a data-toggle="tab" href="#files-tab"><?php echo __d('files', 'Files {0}', '<span class="badge">' . $this->Number->format($license->file_count) . '</span>') ?></a></li>
    </ul>
    <div class="tab-content">
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
