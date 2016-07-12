<?php

use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->assign('title', __('Error: {0}', $message));

if (Configure::read('debug')):
    $this->layout = 'dev_error';

    $this->assign('templateName', 'error500.ctp');

    $this->start('file');
    ?>
    <?php if (!empty($error->queryString)) : ?>
        <p class="notice">
            <strong>SQL Query: </strong>
            <?php echo h($error->queryString) ?>
        </p>
    <?php endif; ?>
    <?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
        <?php echo Debugger::dump($error->params) ?>
    <?php endif; ?>
    <?php
    echo $this->element('auto_table_warning');

    if (extension_loaded('xdebug')):
        xdebug_print_function_stack();
    endif;

    $this->end();
endif;
?>
<p>
    <strong><?php echo __d('cake', 'Error') ?>: </strong>
    <?php echo h($message) ?>
</p>
