<?php
use Cake\Core\Configure;

if (Configure::read('debug')):
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error400.ctp');

    $this->start('file');
?>
<?php if ($error->queryString) : ?>
    <p class="notice">
        <strong>SQL Query: </strong>
        <?php echo h($error->queryString) ?>
    </p>
<?php endif; ?>
<?php if ($error->params) : ?>
        <strong>SQL Query Params: </strong>
        <?php echo Debugger::dump($error->params) ?>
<?php endif; ?>
<?php echo $this->element('auto_table_warning') ?>
<?php
    if (extension_loaded('xdebug')):
        xdebug_print_function_stack();
    endif;

    $this->end();
endif;
?>
<h2 class="text-red"><?php echo h($message) ?></h2>
<p class="error">
    <strong><?php echo __d('cake', 'Error') ?>: </strong>
    <?php echo sprintf(
        __d('cake', 'The requested address %s was not found on this server.'),
        "<strong>'{$url}'</strong>"
    ) ?>
</p>
