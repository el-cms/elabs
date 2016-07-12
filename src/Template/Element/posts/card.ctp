<div class="card<?php echo ($event ? ' card-event' : '') ?><?php echo ($data['sfw'] === false) ? ' nsfw' : '' ?>">
    <div class="card-main">
        <?php
        if (!$data['sfw']):
            ?>
            <div class="nsfw-pill"><?= __('NSFW')?></div>
            <?php
        endif;
        ?>
        <!-- Icon -->
        <div class="card-header-side">
            <i class="fa fa-font fa-3x"></i>
        </div>
        <!-- Header -->
        <div class="card-header">
            <!-- Report link -->
            <?php echo $this->Html->reportLink($this->Url->build(['prefix' => false, 'controller' => 'Posts', 'action' => 'view', $data['id']], true), ['class' => 'report-link']) ?>
            <!-- Title -->
            <h3><?php echo $this->Html->link(h($data['title']), ['prefix' => false, 'controller' => 'Posts', 'action' => 'view', $data['id']]) ?></h3>
            <ul class="card-informations">
                <?php if (!isset($userInfo) || $userInfo): ?>
                    <li>
                        <?= __('{0}&nbsp;{1}', [$this->Html->icon('user'), __('Author:')]) ?>
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
                if(!$event):
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
        <!-- Content -->
        <div class="card-content">
            <p>
                <?php echo $this->Html->displayMD($data['excerpt']) ?>
            </p>
        </div>
    </div>
</div>