<div aria-hidden="true" class="modal" id="loginModal" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close" aria-hidden="true">×</button>
                <h4 class="modal-title"><?php echo __d('elabs', 'Login') ?></h4>
            </div>
            <div class="modal-body text-center">
                <span class="fa-stack fa-5x">
                    <i class="fa fa-circle-o fa-stack-2x"></i>
                    <i class="fa fa-user fa-stack-1x text-brand"></i>
                </span>
                <?php echo $this->element('users/loginform') ?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-flat btn-warning" data-dismiss="modal" type="button"><?php echo __('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>