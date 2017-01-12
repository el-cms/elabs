<div class="card<?php echo ($event ? ' card-event' : '') ?><?php echo ($data['sfw'] === false) ? ' nsfw' : '' ?>">
    <div class="card-main">
        <!-- Card toolbar -->
        <ul class="card-toolbar">
            <!-- Report link -->
            <li><?php echo $this->Html->reportLink($this->Url->build(['prefix' => false, 'controller' => 'Projects', 'action' => 'view', $data['id']], true), ['class' => 'report-link', 'icon' => true]) ?></li>
            <!-- Language pill -->
            <?php if (!isset($languageInfo) || $languageInfo): ?>
                <li><a class="language-pill"<?php echo $this->Html->langAttr($data['language']['iso639_1']) ?>><?php echo $data['language']['name'] ?></a></li>
            <?php endif; ?>
            <!-- SFW pill-->
            <?php if (!$data['sfw']): ?>
                <li><a class="nsfw-pill"><?php echo __d('elabs', 'NSFW') ?></a></li>
            <?php endif; ?>
        </ul>
        <!-- Headings -->
        <div class="card-heading">
            <!-- Icon -->
            <div class="card-heading-side">
                <?php echo $this->Html->icon('cogs 3x') ?>
            </div>
            <!-- Header -->
            <div class="card-header">
                <!-- Title -->
                <h3<?php echo $this->Html->langAttr($data['language']['iso639_1']) ?>><?php echo $this->Html->link(h($data['name']), ['prefix' => false, 'controller' => 'Projects', 'action' => 'view', $data['id']]) ?></h3>
                <ul class="card-informations">
                    <?php if (!isset($userInfo) || $userInfo): ?>
                        <li>
                            <?php echo $this->Html->iconT('user', __d('elabs', 'Manager: ')); ?>
                            <?php echo $this->Html->link($data['user']['username'], ['prefix' => false, 'controller' => 'Users', 'action' => 'view', $data['user']['id']]) ?>
                        </li>
                        <?php
                    endif;
                    if (!isset($licenseInfo) || $licenseInfo):
                        ?>
                        <li>
                            <?php echo $this->Html->iconT('copyright', __d('elabs', 'License:')); ?>
                            <?php
                            $linkIcon = $this->Html->iconT($data['license']['icon'], $data['license']['name']);
                            echo $this->Html->link($linkIcon, ['prefix' => false, 'controller' => 'Licenses', 'action' => 'view', $data['license']['id']], ['escape' => false])
                            ?>
                        </li>
                        <?php
                    endif;
                    if (!$event):
                        ?>
                        <li>
                            <?php echo $this->Html->iconT('calendar', __d('elabs', 'Created on: {0}', h($data['created']))); ?>
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
        <div class="card-content"<?php echo $this->Html->langAttr($data['language']['iso639_1']) ?>>
            <?php echo $this->Html->displayMD($data['short_description']) ?>
        </div>
    </div>
</div>