<div class="card<?php echo ($event ? ' card-event' : '') ?><?php echo ($data['sfw'] === false) ? ' nsfw' : '' ?>">
    <div class="card-main">
        <!-- Card toolbar -->
        <ul class="card-toolbar">
            <!-- Report link -->
            <li><?php echo $this->Html->reportLink($this->Url->build(['prefix' => false, 'controller' => 'Projects', 'action' => 'view', $data['id']], true), ['class' => 'report-link', 'icon' => true]) ?></li>
            <!-- SFW pill-->
            <?php if (!$data['sfw']): ?>
                <li><a class="nsfw-pill"><?= __('NSFW') ?></a></li>
            <?php endif; ?>
        </ul>
        <!-- Headings -->
        <div class="card-heading">
            <!-- Icon -->
            <div class="card-heading-side">
                <i class="fa fa-cogs fa-3x"></i>
            </div>
            <!-- Header -->
            <div class="card-header">
                <!-- Title -->
                <h3><?php echo $this->Html->link(h($data['name']), ['prefix' => false, 'controller' => 'Projects', 'action' => 'view', $data['id']]) ?></h3>
                <ul class="card-informations">
                    <?php if (!isset($userInfo) || $userInfo): ?>
                        <li>
                            <?= __('{0}&nbsp;{1}', [$this->Html->icon('user'), __('Manager:')]) ?>
                            <?= $this->Html->link($data['user']['username'], ['prefix' => false, 'controller' => 'Users', 'action' => 'view', $data['user']['id']]) ?>
                        </li>
                        <?php
                    endif;
                    if (!isset($licenseInfo) || $licenseInfo):
                        ?>
                        <li>
                            <?php echo __('{0}&nbsp;{1}', [$this->Html->icon('copyright'), __('License:')]) ?>
                            <?php echo $this->Html->link(__('{0}&nbsp;{1}', [$this->Html->icon($data['license']['icon']), $data['license']['name']]), ['prefix' => false, 'controller' => 'Licenses', 'action' => 'view', $data['license']['id']], ['escape' => false]) ?>
                        </li>
                        <?php
                    endif;
                    if (!$event):
                        ?>
                        <li>
                            <?php
                            echo __('{0} {1}', [$this->Html->icon('calendar'), __d('posts', 'Published on: {0}', h($data['publication_date']))]);
                            if ($data['publication_date'] < $data['modified']):
                                echo ' - ' . __d('elabs', 'Updated on: {0}', h($data['modified']));
                            endif;
                            ?>
                        </li>
                        <?php
                    endif;
                    ?>
                </ul>
            </div>
        </div>
        <!-- Content -->
        <div class="card-content">
            <?php echo $this->Html->displayMD($data['short_description']) ?>
        </div>
    </div>
</div>