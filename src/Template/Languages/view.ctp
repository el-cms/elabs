<?php
/*
 * File:
 *   src/Templates/Languages/view.ctp
 * Description:
 *   Display of a single license
 * Layout element:
 *   defaultview.ctp
 */

// Page title
$this->assign('title', __d('elabs', 'Language: {0}', $this->Html->langLabel(h($language->name), $language->iso639_1, ['label' => false])));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'About'), ['controller' => 'Pages', 'action' => 'display', 'about']);
$this->Html->addCrumb(__d('elabs', 'Languages'), ['action' => 'index']);
$this->Html->addCrumb(__d('elabs', 'Content in "{0}"', $this->Html->langLabel(h($language->name), $language->iso639_1, ['label' => false])));

// Block: Item informations
// ------------------------
$this->start('pageInfos');
?>
<ul class="list-unstyled">
    <li><strong><?php echo __d('elabs', 'Name:') ?></strong> <span lang="<?php echo $language->iso639_1 ?>"><?php echo h($language->name) ?></span></li>
    <li><strong><?php echo __d('elabs', 'Available translation:') ?></strong> <?php echo $this->Html->checkIcon($language->has_site_translation) ?></li>
    <li><strong><?php echo __d('elabs', 'iso639-1 code:') ?></strong> <?php echo h($language->iso639_1) ?></li>
    <li><strong><?php echo __d('elabs', 'iso639-2 code:') ?></strong> <?php echo h($language->id) ?></li>
</ul>
<?php
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
        <li class="active"><a data-toggle="tab" href="#posts-tab"><?php echo __d('elabs', 'Articles {0}', '<span class="badge">' . $this->Number->format($language->post_count) . '</span>') ?></a></li>
        <li><a data-toggle="tab" href="#projects-tab"><?php echo __d('elabs', 'Projects {0}', '<span class="badge">' . $this->Number->format($language->project_count) . '</span>') ?></a></li>
        <li><a data-toggle="tab" href="#files-tab"><?php echo __d('elabs', 'Files {0}', '<span class="badge">' . $this->Number->format($language->file_count) . '</span>') ?></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="posts-tab">
            <?php
            if (!empty($language->posts)):
                foreach ($language->posts as $posts):
                    echo $this->element('posts/card', ['data' => $posts, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="projects-tab">
            <?php
            if (!empty($language->projects)):
                foreach ($language->projects as $projects):
                    echo $this->element('projects/card', ['data' => $projects, 'event' => false]);
                endforeach;
            else:
                echo $this->element('layout/empty', ['alternative' => false]);
            endif;
            ?>
        </div>

        <div class="tab-pane" id="files-tab">
            <?php
            if (!empty($language->files)):
                foreach ($language->files as $files):
                    echo $this->element('files/card', ['data' => $files, 'event' => false]);
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
