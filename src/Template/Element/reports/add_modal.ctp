<div aria-hidden="true" class="modal" id="reportModal" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close" aria-hidden="true">×</button>
                <h4 class="modal-title" id="uModTitle"><?php echo __d('elabs', 'Report something') ?></h4>
            </div>
            <?php
            echo $this->Form->create('Report', ['url' => $this->Url->build(['plugin' => null, 'prefix' => false, 'controller' => 'Reports', 'action' => 'add'], true), 'idPrefix' => 'reports']);
            ?>
            <div class="modal-body" id="modal-content">
                <div class="alert alert-info">
                    <?php echo $this->Html->iconT('info-circle 2x', __d('elabs', 'You have found something wrong or want to react about something ? Your comments are welcome.')); ?>
                </div>
                <?php
                if (is_null($authUser)):
                    echo $this->Form->input('name', array(
                        'label' => __d('elabs', 'Your name'),
                        'placeholder' => __d('elabs', 'Name'),
                        'required' => true,
                    ));
                    echo $this->Form->input('email', array(
                        'label' => __d('elabs', 'Your e-mail'),
                        'placeholder' => __d('elabs', 'E-mail'),
                        'required' => false,
                    ));
                    ?>
                <?php else: ?>
                    <div class="input-static"><?php echo $authUser['username'] ?></div>
                <?php endif; ?>
                <?php
                echo $this->Form->input('reason', array(
                    'type' => 'textarea',
                    'label' => __d('elabs', 'Reason for your report'),
                    'class' => 'form-control',
                    'placeholder' => __d('elabs', 'Reason'),
                    'required' => true
                ));
                ?>
                <div class="reportsModalBody" hidden aria-hidden="true">
                    <?php echo $this->Form->input('body', ['type' => 'text', 'id' => 'reportsbody', 'label' => __d('elabs', 'This field must stay empty. It will prove us that you\'re an human.')]); ?>
                </div>
            </div>
            <div class="modal-footer">
                <?php
                echo $this->Form->hidden('url', ['id' => 'reportModalUrl']);
                echo $this->Form->button(__d('elabs', 'Send the report'), array(
                    'class' => 'btn btn-primary',
                ));
                ?>
                <button class="btn btn-warning" data-dismiss="modal" type="button"><?php echo __d('elabs', 'Cancel') ?></button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<?php
$this->append('pageBottomScripts');
?>
<script>
    // Reports modal
    $('#reportModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var itemTarget = button.data('itemtarget'); // Button that triggered the modal
      $('#reportModalUrl').val(itemTarget);
    });
</script>
<?php
$this->end();
