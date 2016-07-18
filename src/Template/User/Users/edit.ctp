<?php
/*
 * File:
 *   src/Templates/User/Users/edit.ctp
 * Description:
 *   User's page to update its profile
 * Layout element:
 *   defaultindex.ctp
 */

// Page title
$this->assign('title', __d('users', 'Update your profile'));
?>
<div class="panel">
    <ul id="userTabs" class="nav nav-tabs nav-justified">
        <li class="active"><a data-toggle="tab" href="#tab-general" aria-expanded="true"><?php echo __('{0}&nbsp;{1}', [$this->Html->icon('user'), __d('users', 'Main informations')]) ?></a></li>
        <li><a data-toggle="tab" href="#tab-password" aria-expanded="false"><?php echo __('{0}&nbsp;{1}', [$this->Html->icon('lock'), __d('users', 'Change password')]) ?></a></li>
        <li><a data-toggle="tab" href="#tab-close" aria-expanded="false"><?php echo __('{0}&nbsp;{1}', [$this->Html->icon('times'), __d('users', 'Close account')]) ?></a></li>
    </ul>
    <div id = "userTabsContent" class = "tab-content">
        <div class="tab-pane fade active in" id="tab-general">
            <div class="row">
                <div class="col-sm-4">
                    <?php echo $this->Html->link(__d('elabs ', '{0}&nbsp;{1} ', [$this->Html->icon('eye'), __d('users', 'View your profile online')]), ['prefix' => false, 'action' => 'view', $user->id], ['class' => 'btn btn-primary btn-block', 'escape' => false]) ?>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                    </p>
                    <p>
                        Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. 
                    </p>
                </div>
                <div class="col-sm-8">
                    <?php
                    echo $this->Form->create($user, ['class' => 'form']);
                    ?>
                    <fieldset>
                        <?php
                        echo $this->Form->input('email', ['label' => __d('elabs', 'E-Mail')]);
                        echo $this->Form->input('realname', ['label' => __d('elabs', 'Real name')]);
                        echo $this->Form->input('website', ['label' => __d('elabs', 'Web site')]);
                        echo $this->Form->input('bio', ['label' => __d('elabs', 'About you'), 'id' => 'bioArea']);
                        echo $this->Form->input('see_nsfw', ['label' => __d('elabs', 'Show NSFW content by default'), 'class' => 'access_hide']);
                        echo $this->element('layout/loader_codemirror', ['textareas' => ['bioArea']]);
                        ?>
                    </fieldset>
                    <div class="form-group-btn">
                        <?php echo $this->Form->submit(__d('elabs', 'Save changes'), ['class' => 'btn-success']) ?>
                    </div>
                    <?php echo $this->Form->end() ?>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="tab-password">
            <div class="row">
                <div class="col-sm-4">
                    <p>
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <p>
                        Cras mollis scelerisque nunc. Nullam arcu. Aliquam consequat. Curabitur augue lorem, dapibus quis, laoreet et, pretium ac, nisi. Aenean magna nisl, mollis quis, molestie eu, feugiat in, orci. In hac habitasse platea dictumst.
                    </p>
                </div>
                <div class="col-sm-8">
                    <?php
                    echo$this->Form->create($user, ['url' => ['action' => 'update_password']]);
                    echo $this->Form->input('current_password', ['type' => 'password', 'label' => __d('users', 'Current password')]);
                    echo $this->Form->input('password', ['type' => 'password', 'value' => '', 'label' => __d('users', 'New password')]);
                    echo $this->Form->input('password_confirm', ['type' => 'password', 'value' => '', 'label' => __d('users', 'Confirmation')]);
                    ?>
                    <div class="form-group-btn">
                        <?php echo $this->Form->submit(__d('users', 'Update password'), ['class' => 'btn-success']) ?>
                    </div>
                    <?php echo $this->Form->end() ?>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="tab-close">
            <div class="row">
                <div class="col-sm-4">
                    <p class="text-red">
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                    </p>
                    <p>
                        Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. 
                    </p>
                </div>
                <div class="col-sm-8">
                    <?php
                    echo $this->Form->create($user, ['url' => ['action' => 'close_account']]);
                    echo $this->Form->input('current_password', ['type' => 'password', 'label' => __d('users', 'Current password')]);
                    ?>
                    <div class="form-group-btn">
                        <?php echo $this->Form->button(__d('users', 'Close your account'), ['class' => 'btn-danger']) ?>
                    </div>
                    <?php echo $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="tabs-contents" class="tab-content">


</div>


