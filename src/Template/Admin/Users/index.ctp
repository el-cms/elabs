<table class="table table-condensed">
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id') ?></th>
            <th><?php echo $this->Paginator->sort('role') ?></th>
            <th><?php echo $this->Paginator->sort('username') ?></th>
            <th><?php echo $this->Paginator->sort('realname') ?></th>
            <th><?php echo $this->Paginator->sort('status') ?></th>
            <th><?php echo $this->Paginator->sort('created') ?></th>
            <th class="actions"><?php echo __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($users as $user):
            switch ($user->status):
                case 0: // Waiting for approval
                    $style = 'line-amber';
                    break;
                case 1: // Approved
                    $style = 'line-green';
                    break;
                case 2: // Locked
                    $style = 'line-red';
                    break;
                case 3: // Deleted
                    $style = 'line-grey';
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
            <tr id="userLine<?php echo $this->Number->format($user->id) ?>" class="<?php echo $style ?>">
                <td><?php echo $this->Number->format($user->id) ?></td>
                <td><?php echo __d('amdin', '{0}&nbsp;{1}', ['<span class="fa fa-fw fa-' . $roleIcon . '"></span>', ucfirst(h($user->role))]) ?></td>
                <td><?php echo h($user->username) ?></td>
                <td><?php echo h($user->realname) ?></td>
                <td id="userStatus<?php echo $user->id ?>"><?php echo $this->UsersAdmin->statusLabel($user->status) ?></td>
                <td><?php echo h($user->created) ?></td>
                <td class="padding-no">
                    <ul class="margin-no nav nav-list">
                        <li>
                            <?php
                            echo $this->Html->link('<span class="fa fa-list" title="' . __d('admin', 'Quick details') . '"></span>', '#', [
                                'data-toggle' => 'modal',
                                'data-target' => '#userModal',
                                'data-id' => $user->id,
                                'data-action' => 'getDetails',
                                'class' => 'text-sec waves-attach waves-effect',
                                'escape' => false
                            ]);
                            ?>
                        </li>
                        <li>
                            <?php
                            echo $this->Html->link('<span class="fa fa-eye" title="' . __d('admin', 'Full details') . '"></span>', ['action' => 'view', $user->id], [
                                'class' => 'text-sec waves-attach waves-effect',
                                'escape' => false
                            ]);
                            ?>
                        </li>
                        <li id="btnLock<?php echo $user->id ?>">
                            <?php
                            // Icons vars are used in JS too.
                            $unlockIcon = '<span class="fa fa-unlock-alt fa-fw" title="' . __d('admin', 'Unlock') . '"></span>';
                            $lockIcon = '<span class="fa fa-lock fa-fw" title="' . __d('admin', 'Lock') . '"></span>';
                            $activateIcon = '<span class="fa fa-check fa-fw" title="' . __d('admin', 'Activate') . '"></span>';
                            if ($user->status === 2):
                                echo $this->Html->link($unlockIcon, '#', [
                                    'onClick' => "lock({$user->id}, 'unlock')",
                                    'class' => 'text-sec waves-attach waves-effect',
                                    'escape' => false,
                                    'id' => 'btnLockLnk' . $user->id
                                ]);
                            elseif ($user->status === 1):
                                echo $this->Html->link($lockIcon, '#', [
                                    'onClick' => "lock({$user->id}, 'lock')",
                                    'class' => 'text-sec waves-attach waves-effect',
                                    'escape' => false,
                                    'id' => 'btnLockLnk' . $user->id
                                ]);
                            elseif ($user->status === 0):
                                echo $this->Html->link($activateIcon, '#', [
                                    'onClick' => "activate({$user->id})",
                                    'class' => 'text-sec waves-attach waves-effect',
                                    'escape' => false,
                                    'id' => 'btnLockLnk' . $user->id
                                ]);
                            else:
                                echo '<a class="text-sec"><span class="fa fa-fw"></span></a>';
                            endif;
                            ?>
                        </li>
                        <li id="btnClose<?php echo $user->id ?>">
                            <?php
                            if ($user->status != 3):
                                echo $this->Html->link('<span class="fa fa-times" title="' . __d('admin', 'Close') . '"></span>', '#', [
                                    'onClick' => "closeAccount({$user->id})",
                                    'class' => 'text-sec waves-attach waves-effect',
                                    'escape' => false
                                ]);
                            endif;
                            ?>
                        </li>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div aria-hidden="true" class="modal" id="userModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-heading">
                <a class="modal-close" data-dismiss="modal">×</a>
                <h2 class="modal-title" id="uModTitle">Modal Title</h2>
            </div>
            <div class="modal-inner" id="modal-content">
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
                    <button class="btn btn-flat btn-brand waves-attach waves-effect" data-dismiss="modal" type="button">Close</button>
                </p>
            </div>
        </div>
    </div>
</div>

<?php
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
          $('#userLine' + id).addClass('line-grey');
          $('#userStatus' + id).html('<?php echo $this->UsersAdmin->statusLabel(3) ?>');
          $('#btnLock' + id).remove();
          $('#btnClose' + id).remove();
        } else {
          alert('<?php echo __d('admin', 'An error occured when you tried to close this account.') ?>');
        }
      });
    }

    function lock(id, action) {
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
          lineColor = 'line-green';
          statusLabel = '<?php echo $this->UsersAdmin->statusLabel(1) ?>';
          lnkIcon = '<?php echo $lockIcon ?>';
          lnkAction = 'lock(' + id + ',lock)';
        } else if (response.user.status === 2) {
          lineColor = 'line-red';
          statusLabel = '<?php echo $this->UsersAdmin->statusLabel(2) ?>';
          lnkIcon = '<?php echo $unlockIcon ?>';
          lnkAction = 'lock(' + id + ',unlock)';
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
          lineColor = 'line-green';
          statusLabel = '<?php echo $this->UsersAdmin->statusLabel(1) ?>';
          lnkIcon = '<?php echo $lockIcon ?>';
          lnkAction = 'lock(' + id + ',lock)';
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
echo $this->element('layout/paginationlinks');
