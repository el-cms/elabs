<div class="modal fade" tabindex="-1" role="dialog" id="loginModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo __d('elabs', 'Login') ?></h4>
            </div>
            <div class="modal-body text-center">
                <span class="fa-stack fa-5x">
                    <i class="fa fa-circle-o fa-stack-2x"></i>
                    <i class="fa fa-user fa-stack-1x text-brand"></i>
                </span>
                <?php echo $this->element('users/loginform') ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->