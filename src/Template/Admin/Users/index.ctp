<?php
/*
 * File:
 *   src/Templates/Admin/Users/index.ctp
 * Description:
 *   Administration - List of users, sortable
 * Layout element:
 *   adminindex.ctp
 * @todo: add filters
 * Notes: paginations links are in the table, not in a block.
 */

// Page title
$this->assign('title', __d('users', 'List of users'));

// Breadcrumbs
$this->Html->addCrumb(__d('elabs', 'Users'), ['action' => 'index']);
$this->Html->addCrumb($this->fetch('title'));

// Block: Page content
// -------------------
$this->start('pageContent');
?>
<div class="panel">
    <table class="table table-condensed table-striped table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('role', __d('users', 'Role')) ?></th>
                <th><?php echo $this->Paginator->sort('username', __d('users', 'Username')) ?></th>
                <th><?php echo $this->Paginator->sort('realname', __d('users', 'Name')) ?></th>
                <th><?php echo $this->Paginator->sort('status', __d('elabs', 'Status')) ?></th>
                <th><?php echo $this->Paginator->sort('created', __d('users', 'Join date')) ?></th>
                <th class="actions"><?php echo __d('elabs', 'Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($users as $user):
                switch ($user->status):
                    case 0: // Waiting for approval
                        $style = 'warning';
                        break;
                    case 1: // Approved
                        $style = 'success';
                        break;
                    case 2: // Locked
                        $style = 'danger';
                        break;
                    case 3: // Deleted
                        $style = 'disabled';
                        break;
                endswitch;

                switch ($user->role) {
                    case 'author':
                        $roleIcon = 'pencil';
                        break;
                    case 'admin':
                        $roleIcon = 'wrench';
                        break;
                    default:
                        $roleIcon = 'question';
                }
                ?>
                <tr id="userLine<?php echo $user->id ?>" class="<?php echo $style ?>">
                    <td><?php echo __d('amdin', '{0}&nbsp;{1}', [$this->Html->icon($roleIcon), ucfirst(h($user->role))]) ?></td>
                    <td><?php echo h($user->username) ?></td>
                    <td><?php echo h($user->realname) ?></td>
                    <td id="userStatus<?php echo $user->id ?>"><?php echo $this->UsersAdmin->statusLabel($user->status) ?></td>
                    <td><?php echo h($user->created) ?></td>
                    <td>
                        <div class="btn-group btn-group-xs">
                            <?php
                            echo $this->Html->link($this->Html->icon('list', ['title' => __d('admin', 'Quick details')]), '#', [
                                'data-toggle' => 'modal',
                                'data-target' => '#userModal',
                                'data-id' => $user->id,
                                'data-action' => 'getDetails',
                                'class' => 'btn btn-primary',
                                'escape' => false
                            ]);
                            echo $this->Html->link($this->Html->icon('eye', ['title' => __d('admin', 'Full details')]), ['action' => 'view', $user->id], [
                                'class' => 'btn btn-primary',
                                'escape' => false
                            ]);
                            // Icons vars are used in JS too.
                            $unlockIcon = $this->Html->icon('unlock-alt', ['title' => __d('admin', 'Unlock')]);
                            $lockIcon = $this->Html->icon('lock', ['title' => __d('admin', 'Lock')]);
                            $activateIcon = $this->Html->icon('check', ['title' => __d('admin', 'Activate')]);
                            if ($user->status === 2):
                                echo $this->Html->link($unlockIcon, '#', [
                                    'onClick' => "lock('{$user->id}', 'unlock')",
                                    'class' => 'btn btn-warning',
                                    'escape' => false,
                                    'id' => 'btnLockLnk' . $user->id
                                ]);
                            elseif ($user->status === 1):
                                echo $this->Html->link($lockIcon, '#', [
                                    'onClick' => "lock('{$user->id}', 'lock')",
                                    'class' => 'btn btn-warning',
                                    'escape' => false,
                                    'id' => 'btnLockLnk' . $user->id
                                ]);
                            elseif ($user->status === 0):
                                echo $this->Html->link($activateIcon, '#', [
                                    'onClick' => "activate('{$user->id}')",
                                    'class' => 'btn btn-warning',
                                    'escape' => false,
                                    'id' => 'btnLockLnk' . $user->id
                                ]);
                            else:
                                ?>
                                <a class="btn disabled"><?php echo $this->Html->icon('fw', ['fixed' => false]) ?></a>
                            <?php
                            endif;
                            if ($user->status != 3):
                                echo $this->Html->link($this->Html->icon('times', ['title' => __d('admin', 'Close')]), '#', [
                                    'onClick' => "closeAccount('{$user->id}')",
                                    'class' => 'btn btn-danger',
                                    'escape' => false
                                ]);
                            else:
                                ?>
                                <a class="btn disabled"><?php echo $this->Html->icon('fw', ['fixed' => false]) ?></a>
                            <?php
                            endif;
                            ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- User quickview modal -->
<div aria-hidden="true" class="modal" id="userModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="uModTitle">Modal Title</h4>
            </div>
            <div class="modal-body" id="modal-content">
                <dl class="dl-horizontal">
                    <dt><?php echo __d('elabs', 'Last update') ?></dt>
                    <dd id="uModUpdated"></dd>
                    <dt><?php echo __d('posts', 'Articles') ?></dt>
                    <dd id="uModArticleCount"></dd>
                    <dt><?php echo __d('projects', 'Projects') ?></dt>
                    <dd id="uModProjectCount"></dd>
                    <dt><?php echo __d('files', 'Files') ?></dt>
                    <dd id="uModFileCount"></dd>
                    <dt><?php echo __d('users', 'Bio') ?></dt>
                    <dd id="uModBio"></dd>
                </dl>
            </div>
            <div class="modal-footer">
                <p class="text-right">
                    <button class="btn btn-primary" data-dismiss="modal" type="button">Close</button>
                </p>
            </div>
        </div>
    </div>
</div>
<?php
$this->end();

// Custom scripts
$this->append('pageBottomScripts');
?>
<script>
    var target = '#modal-content';
    // User modal actions
    $('#userModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var id = button.data('id'); // Extract info from data-* attributes
      var action = button.data('action'); // Extract info from data-* attributes
      if (action === 'getDetails') {
        viewDetails(id);
      }

    });
    // Close account
    function closeAccount(id) {
      var request = $.ajax({
        type: "POST",
        url: "<?php echo $this->Url->build(['prefix' => 'admin', 'controller' => 'Users', 'action' => 'close']); ?>" + '/' + id,
        dataType: 'json',
        async: true
      });
      request.fail(function (jqXHR, textStatus) {
        alert(<?php echo __d('admin', '"Request failed: " + textStatus') ?>);
      });
      request.success(function (response) {
        console.log(response);
        if (response.user.status === 3) {
          $('#userLine' + id).removeClass();
          $('#userLine' + id).addClass('disabled');
          $('#userStatus' + id).html('<?php echo $this->UsersAdmin->statusLabel(3) ?>');
        } else {
          alert('<?php echo __d('admin', 'An error occured when you tried to close this account.') ?>');
        }
      });
    }

    function lock(id, action) {
      // Keep old value
      var oldClasses = $('#btnLockLnk' + id + '>i').attr('class');
      $('#btnLockLnk' + id + '>i').attr('class', 'fa fa-spinner fa-spinning fa-fw');
      var request = $.ajax({
        type: "POST",
        url: "<?php echo $this->Url->build(['prefix' => 'admin', 'controller' => 'Users', 'action' => 'lock']); ?>" + '/' + id + '/' + action,
        dataType: 'json',
        async: true
      });
      request.fail(function (jqXHR, textStatus) {
        alert(<?php echo __d('admin', '"Request failed: " + textStatus') ?>);
      });
      request.success(function (response) {
        if (response.user.status === 1) {
          lineColor = 'success';
          statusLabel = '<?php echo $this->UsersAdmin->statusLabel(1) ?>';
          lnkIcon = '<?php echo $lockIcon ?>';
          lnkAction = 'lock(\'' + id + '\', \'lock\')';
        } else if (response.user.status === 2) {
          lineColor = 'danger';
          statusLabel = '<?php echo $this->UsersAdmin->statusLabel(2) ?>';
          lnkIcon = '<?php echo $unlockIcon ?>';
          lnkAction = 'lock(\'' + id + '\', \'unlock\')';
        } else {
          alert('<?php echo __d('admin', 'Unknown user status') ?>');
        }
        $('#userLine' + id).removeClass();
        $('#userLine' + id).addClass(lineColor);
        $('#userStatus' + id).html(statusLabel);
        $('#btnLockLnk' + id).html(lnkIcon);
        $('#btnLockLnk' + id).attr('onClick', lnkAction);

      });
    }
    function activate(id) {
      var request = $.ajax({
        type: "POST",
        url: "<?php echo $this->Url->build(['prefix' => 'admin', 'controller' => 'Users', 'action' => 'activate']); ?>" + '/' + id,
        dataType: 'json',
        async: true
      });
      request.fail(function (jqXHR, textStatus) {
        alert(<?php echo __d('admin', '"Request failed: " + textStatus') ?>);
      });
      request.success(function (response) {
        if (response.user.status === 1) {
          lineColor = 'success';
          statusLabel = '<?php echo $this->UsersAdmin->statusLabel(1) ?>';
          lnkIcon = '<?php echo $lockIcon ?>';
          lnkAction = 'lock(\'' + id + '\', \'lock\')';
        }
        $('#userLine' + id).removeClass();
        $('#userLine' + id).addClass(lineColor);
        $('#userStatus' + id).html(statusLabel);
        $('#btnLockLnk' + id).html(lnkIcon);
        $('#btnLockLnk' + id).attr('onClick', lnkAction);

      });
    }

    // Retreive and write data to modal
    function viewDetails(id) {
      var request = $.ajax({
        type: "POST",
        url: "<?php echo $this->Url->build(['prefix' => 'admin', 'controller' => 'Users', 'action' => 'view']); ?>" + '/' + id,
        dataType: 'json',
        async: true
      });
//      request.done(function (msg) {
//        $("#log").html(msg);
//      });
      request.fail(function (jqXHR, textStatus) {
        alert(<?php echo __d('admin', '"Request failed: " + textStatus') ?>);
      });
      request.success(function (response) {
        $('#uModTitle').html(response.user.realname);
        $('#uModBio').html(response.user.bio);
        $('#uModArticleCount').html(response.user.post_count);
        $('#uModProjectCount').html((response.user.project_count + response.user.project_user_count) + ' (' + response.user.project_user_count + ')');
        $('#uModFileCount').html(response.user.file_count);
      });
    }
</script>
<?php
$this->end();

// Load the layout element
// -----------------------
echo $this->element('layouts/adminindex');
