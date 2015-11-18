<?php
$this->assign('title', __d('license', 'License: {0}', h($license->name)));

$this->start('pageInfos');
?>
<dl>
    <dt><?php echo __d('files', 'Name') ?></dt>
    <dd><?php echo __d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-' . h($license->icon) . '"></span>', h($license->name)]) ?></dd>
</dl>
<?php echo $this->Html->link(__d('elabs', '{0}&nbsp;{1}', ['<span class="fa fa-external-link"></span>', __d('licenses', 'More info online')]), h($license->link), ['escape' => false]) ?>

<?php
$this->end();

$this->start('pageContent');
?>    

<nav class="tab-nav tab-nav-brand">
    <ul class="nav nav-justified">
        <li class="active">
            <a class="waves-attach waves-effect" data-toggle="tab" href="#posts-tab"><?php echo __d('posts', 'Articles ({0})', $this->Number->format($license->post_count)) ?></a>
        </li>
        <li>
            <a class="waves-attach waves-effect" data-toggle="tab" href="#projects-tab"><?php echo __d('projects', 'Projects ({0})', $this->Number->format($license->project_count)) ?></a>
        </li>
        <li>
            <a class="waves-attach waves-effect" data-toggle="tab" href="#files-tab"><?php echo __d('files', 'Files ({0})', $this->Number->format($license->file_count)) ?></a>
        </li>
    </ul>
    <div class="tab-nav-indicator"></div>
</nav>
<div class="tab-pane fade active in" id="posts-tab">
    <?php
    if ($license->posts):
        foreach ($license->posts as $posts):
            echo $this->element('posts/card', ['data' => $posts, 'licenseInfo' => false]);
        endforeach;
    else:
        echo $this->element('layout/empty', ['alternative' => false]);
    endif;
    ?>
</div>

<div class="tab-pane" id="projects-tab">
    <?php
    if ($license->projects):
        foreach ($license->projects as $projects):
            echo $this->element('projects/card', ['data' => $projects, 'licenseInfo' => false]);
        endforeach;
    else:
        echo $this->element('layout/empty', ['alternative' => false]);
    endif;
    ?>
</div>

<div class="tab-pane" id="files-tab">
    <?php
    if ($license->files):
        foreach ($license->files as $files):
            echo $this->element('files/card', ['data' => $files, 'licenseInfo' => false]);
        endforeach;
    else:
        echo $this->element('layout/empty', ['alternative' => false]);
    endif;
    ?>
</div>
<?php
$this->end();

echo $this->element('layouts/defaultview');
