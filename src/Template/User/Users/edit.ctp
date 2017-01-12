<?php
/*
 * File:
 *   src/Templates/User/Users/edit.ctp
 * Description:
 *   User's page to update its profile
 * Layout element:
 *   defaultindex.ctp
 */

use Cake\Core\Configure;

// Page title
$this->assign('title', __d('elabs', 'Update your profile'));

// Breadcrumbs
$this->Html->addCrumb($this->fetch('title'));

// Related links block
// -------------------
$this->start('pageLinks');
$linkOptions = ['class' => 'list-group-item', 'escape' => false];
echo $this->Html->link($this->Html->iconT('eye', __d('elabs', 'View your profile online')), ['prefix' => false, 'action' => 'view', $user->id], $linkOptions);
$this->end();

// Page content block
// ------------------
$this->start('pageContent');
?>
<div class="panel">
    <ul id="userTabs" class="nav nav-tabs nav-justified">
        <li class="active"><a data-toggle="tab" href="#tab-general" aria-expanded="true"><?php echo $this->Html->iconT('user', __d('elabs', 'General informations')) ?></a></li>
        <li><a data-toggle="tab" href="#tab-preferences" aria-expanded="false"><?php echo $this->Html->iconT('sliders', __d('elabs', 'Preferences')) ?></a></li>
        <li><a data-toggle="tab" href="#tab-password" aria-expanded="false"><?php echo $this->Html->iconT('lock', __d('elabs', 'Change password')) ?></a></li>
        <li><a data-toggle="tab" href="#tab-close" aria-expanded="false"><?php echo $this->Html->iconT('times', __d('elabs', 'Close account')) ?></a></li>
    </ul>
    <div id="userTabsContent" class="tab-content">
        <div class="tab-pane fade active in" id="tab-general">
            <?php
            echo $this->Form->create($user, ['class' => 'form']);
            ?>
            <fieldset>
                <div class="row">
                    <div class="col-sm-12">
                        <?php echo $this->Form->input('email', ['label' => __d('elabs', 'E-mail')]); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <?php echo $this->Form->input('first_name', ['label' => __d('elabs', 'First name')]); ?>
                    </div>
                    <div class="col-sm-6">
                        <?php echo $this->Form->input('last_name', ['label' => __d('elabs', 'Last name')]); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php
                        echo $this->Form->input('website', ['label' => __d('elabs', 'Website'), 'placeholder' => 'http://']);
                        echo $this->Form->input('bio', ['label' => __d('elabs', 'About you'), 'id' => 'bioArea']);
                        echo $this->element('layout/loader_codemirror', ['textareas' => ['bioArea']]);
                        ?>
                    </div>
                </div>
            </fieldset>
            <div class="form-group-btn">
                <?php echo $this->Form->submit(__d('elabs', 'Save the changes'), ['class' => 'btn-success']) ?>
            </div>
            <?php echo $this->Form->end() ?>
        </div>

        <div class="tab-pane fade" id="tab-preferences">
            <h4><?php echo $this->Html->iconT('sliders', __d('elabs', 'General')) ?></h4>
            <?php echo $this->Form->create($user, ['class' => 'form', 'url' => ['action' => 'updatePrefs']]); ?>
            <fieldset>
                <?php
                $userPrefs = $this->UsersUser->getPreferences($authUser['preferences']);
                // Default site lang
                echo $this->Form->input('preferences[defaultSiteLanguage]', [
                    'type' => 'select',
                    'options' => $sLanguages,
                    'value' => $userPrefs['defaultSiteLanguage'],
                    'label' => __d('elabs', 'Default site language'),
                ]);
                echo $this->Form->input('preferences[defaultWritingLanguage]', [
                    'type' => 'select',
                    'options' => $wLanguages,
                    'value' => $userPrefs['defaultWritingLanguage'],
                    'label' => __d('elabs', 'Default language for new content')
                ]);
                echo $this->Form->input('preferences[defaultWritingLicense]', [
                    'type' => 'select',
                    'options' => $licenses,
                    'value' => $userPrefs['defaultWritingLicense'],
                    'label' => __d('elabs', 'Default license for new content')
                ]);
                echo $this->Form->input('preferences[showNSFW]', [
                    'type' => 'checkbox',
                    'checked' => $userPrefs['showNSFW'],
                    'label' => __d('elabs', 'Display NSFW content')
                ]);
                ?>
            </fieldset>
            <div class="form-group-btn">
                <?php echo $this->Form->submit(__d('elabs', 'Save the changes'), ['class' => 'btn-success']) ?>
            </div>
            <?php echo $this->Form->end() ?>
            <h4><?php echo $this->Html->iconT('plug', __d('elabs', 'API')) ?></h4>
            <?php
            $btn = $this->Html->tag('button', $this->Html->icon('refresh'), ['class' => 'btn btn-default']);
            $reloadApiTokenBtn = $this->Html->tag('span', $btn, ['class' => 'input-group-btn', 'title' => __d('elabs', 'Generate a new token'), 'onClick' => 'regenerateToken()',]);
            echo $this->Form->input('api_token', ['id' => 'api_token', 'label' => __d('elabs', 'Your API token'), 'disabled' => true, 'value' => $user->api_token, 'append' => ['class' => 'input-group-btn', $reloadApiTokenBtn], 'help' => __d('elabs', 'If you regenerate your API token, you\'ll have to re-enter it or re-log in your clients')])
            ?>
        </div>

        <div class="tab-pane fade" id="tab-password">
            <?php
            echo$this->Form->create($user, ['url' => ['action' => 'update_password']]);
            echo $this->Form->input('current_password', ['type' => 'password', 'label' => __d('elabs', 'Current password')]);
            echo $this->Form->input('password', ['type' => 'password', 'value' => '', 'label' => __d('elabs', 'New password')]);
            echo $this->Form->input('password_confirm', ['type' => 'password', 'value' => '', 'label' => __d('elabs', 'Confirmation')]);
            ?>
            <div class="form-group-btn">
                <?php echo $this->Form->submit(__d('elabs', 'Update password'), ['class' => 'btn-success']) ?>
            </div>
            <?php echo $this->Form->end() ?>
        </div>

        <div class="tab-pane fade" id="tab-close">
            <?php
            echo $this->Form->create($user, ['url' => ['action' => 'close_account']]);
            echo $this->Form->input('current_password', ['type' => 'password', 'label' => __d('elabs', 'Current password')]);
            ?>
            <div class="form-group-btn">
                <?php echo $this->Form->button(__d('elabs', 'Close your account'), ['class' => 'btn-danger']) ?>
            </div>
            <?php echo $this->Form->end() ?>
        </div>

    </div>

</div>
<?php
$this->end();

// Additionnal JS
// --------------
$this->append('pageBottomScripts');
?>
<script>
    $(document).ajaxSend(function (e, xhr, settings) {
      xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->params['_csrfToken'] ?>');
    });
    function regenerateToken() {
      var request = $.ajax({
        type: "POST",
        url: "<?php echo $this->Url->build(['plugin' => null, 'prefix' => 'user', 'controller' => 'Users', 'action' => 'generateApiToken']) ?>",
        dataType: 'json',
        async: true
      });
      request.fail(function (jqXHR, textStatus) {
        alert(<?php echo __d('elabs', '"Request failed: " + textStatus') ?>);
      });
      request.success(function (response) {
        $('#api_token').val(response.api_token);
      });
    }
</script>
<?php
$this->end();
// Load the custom layout element
// ------------------------------
echo $this->element('layouts/defaultform');
