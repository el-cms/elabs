<?php

use Cake\Core\Configure;
?>
<div class="card<?php echo ($event ? ' card-event' : '') ?><?php echo ($data['sfw'] === false) ? ' nsfw' : '' ?>">
    <div class="card-main">
        <!-- Card toolbar -->
        <ul class="card-toolbar">
            <!-- Report link -->
            <li><?php echo $this->Html->reportLink($this->Url->build(['prefix' => false, 'controller' => 'Files', 'action' => 'view', $data['id']], true), ['class' => 'report-link', 'icon' => true]) ?></li>
            <!-- Language pill -->
            <li><a class="language-pill"<?php echo $this->Html->langAttr($data['language']['iso639_1']) ?>><?php echo $data['language']['name'] ?></a></li>
            <!-- SFW pill-->
            <?php if (!$data['sfw']): ?>
                <li><a class="nsfw-pill"><?php echo __d('elabs', 'NSFW') ?></a></li>
            <?php endif; ?>
        </ul>
        <!-- Headings -->
        <div class="card-heading">
            <!-- Icon -->
            <div class="card-heading-side">
                <?php echo $this->Html->icon('book 3x') ?>
            </div>
            <!-- Header -->
            <div class="card-header">
                <!-- Title -->
                <h3><?php echo $this->Html->link(h($data['name']), ['prefix' => false, 'controller' => 'Albums', 'action' => 'view', $data['id']]) ?></h3>
                <ul class="card-informations">
                    <?php if (!isset($userInfo) || $userInfo): ?>
                        <li>
                            <?php echo $this->Html->iconT('user', __d('elabs', 'Creator:')); ?>
                            <?php echo $this->Html->link($data['user']['username'], ['prefix' => false, 'controller' => 'Users', 'action' => 'view', $data['user']['id']]) ?>
                        </li>
                        <?php
                    endif;
                    if (!$event):
                        ?>
                        <li>
                            <?php echo $this->Html->iconT('calendar', __d('elabs', 'Added on: {0}', h($data['created']))); ?>
                        </li>
                        <?php
                        if ($data['publication_date'] < $data['modified']):
                            ?>
                            <li>
                                <?php echo $this->Html->iconT('refresh', __d('elabs', 'Updated on: {0}', h($data['modified']))); ?>
                            </li>
                            <?php
                        endif;
                    endif;
                    $nbProj = count($data['projects']);
                    if ((!isset($projectInfo) || $projectInfo) && $nbProj > 0):
                        ?>
                        <li>
                            <?php
                            $projectsList = $this->Html->arrayToString(array_map(function($project) {
                                        return $this->Html->Link($project->name, ['controller' => 'Projects', 'action' => 'view', $project->id]);
                                    }, $data['projects']));
                            echo $this->Html->iconT('puzzle-piece', __d('elabs', '{0} {1}', [__dn('elabs', 'Project:', 'Projects:', $nbProj), $projectsList]));
                            ?>
                        </li>
                        <?php
                    endif;
                    ?>
                    <li>
                        <?php echo $this->Html->iconT('tags', __d('elabs', 'Tags:')); ?>
                        <?php
                        if (count($data->tags) > 0):
                            echo $this->Html->arrayToString(array_map(function($tag) {
                                        return $this->Html->Link($tag->id, ['prefix' => false, 'controller' => 'Tags', 'action' => 'view', $tag->id]);
                                    }, $data->tags));
                        else:
                            echo __d('elabs', 'No tags');
                        endif;
                        ?>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Content -->
        <div class="card-content">
            <?php
            if (!empty($data['description'])):
                ?>
                <div <?php echo $this->Html->langAttr($data['language']['iso639_1']) ?>>
                    <?php echo $this->Html->displayMD($data['description']) ?>
                </div>
                <?php
            endif;
            $filesCount = count($data['files']);
            if ($filesCount > 0):
                ?>
                <!-- Scrollbar -->
                <div class="scrollbar-buttons">
                    <!-- Left button -->
                    <div
                        class="scrollbar-direction-left"
                        id="scrollButton-<?php echo $data['id'] ?>-L"
                        onmouseover="scroll('#scrollButton-<?php echo $data['id'] ?>-L', '#scrollbar-<?php echo $data['id'] ?>', 'left')"
                        >
                            <?php echo $this->Html->icon('chevron-left', ['fixed' => false]) ?>
                    </div>
                    <!-- Right button -->
                    <div
                        class="scrollbar-direction-right"
                        id="scrollButton-<?php echo $data['id'] ?>-R"
                        onmouseover="scroll('#scrollButton-<?php echo $data['id'] ?>-R', '#scrollbar-<?php echo $data['id'] ?>', 'right')"
                        >
                            <?php echo $this->Html->icon('chevron-right', ['fixed' => false]) ?>
                    </div>
                </div>

                <div class="scrollbar">
                    <!-- Visible area with no overflow-->
                    <div class="scrollbar-viewport" id="scrollbar-<?php echo $data['id'] ?>">
                        <!-- Scrollbar -->
                        <div class="scrollbar-content">
                            <!-- Item list -->
                            <?php
                            $limit = Configure::read('cms.maxRelatedData');
                            $forLimit = ($limit > $filesCount) ? $filesCount : $limit;
                            for ($i = 0; $i < $forLimit; $i++):
                                $file = $data['files'][$i];
                                ?>
                                <div class="scrollbar-item card-mini-item">
                                    <div class="card-mini-item-content">
                                        <?php
                                        $config = $this->Items->fileConfig($file['filename']);
                                        if ($file->sfw || $seeNSFW):
                                            echo $this->element('files/card_minimal_' . $config['element'], ['data' => $file]);
                                        else:
                                            echo $this->element('layout/nsfw_block');
                                        endif;
                                        ?>
                                    </div>
                                </div>
                                <?php
                            endfor;
                            if ($filesCount > $limit):
                                ?>
                                <div class="scrollbar-item more-item">
                                    <div class="card-mini-item-content">
                                        <?php echo $this->element('layout/more_block', ['number' => $filesCount - $limit]); ?>
                                    </div>
                                </div>
                                <?php
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            else:
                echo $this->element('layout/empty');
            endif;
            ?>
        </div>
    </div>
</div>
