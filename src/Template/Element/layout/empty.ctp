<div class="empty">
    <p class="empty-symbol">&#8709;</p>
    <p><?php echo __d('elabs', 'Sorry, there is nothing to display here.') ?></p>
    <p>
        <?php
        if (isset($alternative) && $alternative):
            if (!isset($authUser['id'])):
                echo __d('elabs', 'Alternatively, you can {0} or {1} and start adding your own content !', [$this->Html->link(__d('elabs', 'register'), ['prefix' => false, 'controller' => 'users', 'action' => 'register']), $this->Html->link(__d('elabs', 'login'), ['prefix' => false, 'controller' => 'users', 'action' => 'login'])]);
            else:
                echo __d('elabs', 'Alternatively, you can start adding content !');
            endif;
        endif;
        ?>
    </p>
</div>
