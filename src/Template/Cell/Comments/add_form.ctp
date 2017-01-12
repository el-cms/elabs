<?php
echo $this->Form->Create($model, ['url' => ['controller' => 'Comments', 'action' => 'add']]);
?>
<h2><?php echo __d('elabs', 'Add comment') ?></h2>
<div class="row">
    <?php if (is_null($authUser)): ?>

        <div class="col-sm-6">
            <?php
            echo $this->Form->input('name', array(
                'label' => __d('elabs', 'Your name'),
                'placeholder' => __d('elabs', 'Name'),
                'required' => true,
            ));
            ?>
        </div>
        <div class="col-sm-6">
            <?php
            echo $this->Form->input('email', array(
                'label' => __d('elabs', 'Your e-mail'),
                'placeholder' => __d('elabs', 'E-mail'),
                'required' => false,
            ));
            ?>
        </div>
    <?php else: ?>
        <div class="col-sm-12">
            <div class="input-static"><strong><?php echo __d('elabs', 'You\'re about to post your comment as:') ?></strong> <?php echo $authUser['username'] ?></div>
        </div>
    <?php endif; ?>
</div>

<?php echo $this->Form->input('message', ['label' => __d('elabs', 'Your comment')]); ?>
<div class="row">
    <div class="col-sm-8">
        <?php echo $this->Form->input('allow_contact', ['label' => __d('elabs', 'Allow the author to contact me by email')]); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $this->Form->submit(__d('elabs', 'Send'), ['class' => 'btn-primary']) ?>
    </div>
</div>
<div hidden aria-hidden="true">
    <?php echo $this->Form->input('body', ['type' => 'text', 'id' => 'commentsbody', 'label' => __d('elabs', 'This field must stay empty. It will prove us that you\'re an human.')]); ?>
</div>
<?php
echo $this->Form->end();
