<?php

use Cake\Core\Configure;

$this->assign('title', __('Error: {0}', $message));

if (Configure::read('debug')):
    $this->layout = 'dev_error';

    $this->assign('templateName', 'error400.ctp');

    $this->start('file');

    if (!empty($error->queryString)) :
        ?>
        <p class="notice">
            <strong>SQL Query: </strong>
            <?php echo h($error->queryString) ?>
        </p>
        <?php
    endif;
    if (!empty($error->params)) :
        ?>
        <strong>SQL Query Params: </strong>
        <?php
        echo Debugger::dump($error->params);
    endif;
    echo $this->element('auto_table_warning');
    if (extension_loaded('xdebug')):
        xdebug_print_function_stack();
    endif;

    $this->end();
endif;
?>
<p>
    <strong><?php echo __d('cake', 'Error:') ?> </strong>
    <?php
    echo sprintf(
            __d('cake', 'The requested address %s was not found on this server.'), "<strong>'{$url}'</strong>"
    )
    ?>
</p>
