<div aria-hidden="true" class="modal" id="loginModal" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close" aria-hidden="true">×</button>
                <h4 class="modal-title"><?php echo __d('elabs', 'Login') ?></h4>
            </div>
            <div class="modal-body text-center">
                <span class="fa-stack fa-5x">
                  <?php
                  echo $this->Html->icon('circle-o stack-2x');
                  echo $this->Html->icon('user stack-1x', ['class' => 'text-primary']);
                  ?>
                </span>
                <?php echo $this->element('users/loginform') ?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" data-dismiss="modal" type="button"><?php echo __d('elabs', 'Cancel') ?></button>
            </div>
        </div>
    </div>
</div>