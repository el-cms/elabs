<?php

use Cake\Core\Configure;

/*
 * Dev view
 */
if (Configure::read('debug')):
    $this->layout = 'dev_error';

    $this->assign('pageTitle', 'Error 4xx');
    $this->assign('title', $message);
    $this->assign('templateName', 'error400.ctp');

    $this->start('file');
    ?>
    <?php if (!empty($error->queryString)) : ?>
        <p class="notice">
            <strong>SQL Query: </strong>
            <?= h($error->queryString) ?>
        </p>
    <?php endif; ?>
    <?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
        <?php Debugger::dump($error->params) ?>
    <?php endif; ?>
    <?= $this->element('auto_table_warning') ?>
    <?php
    if (extension_loaded('xdebug')):
        xdebug_print_function_stack();
    endif;

    $this->end();

/*
 * Production view:
 */
else:
    // Overrides of Cake messages
    $errorHint = $message;
    switch ($code):
        case 404:
            $errorMessage = 'Page not found';
            $errorHint = sprintf(__d('elabs', 'The requested address %s was not found on this server.'), "<strong>'{$url}'</strong>");
            break;
        case 405:
            $errorMessage = __d('elabs', 'Method not allowed');
            break;
        default:
            $errorMessage = __d('elabs', 'A wild unexpected error occured.');
    endswitch;

    $this->assign('title', __d('elabs', 'Error {0}: {1}', [$code, $errorMessage]));

    // Breadcrumbs
    $this->Html->addCrumb($this->fetch('title'));

    // Helpers
    $this->loadHelper('CowSays');

    // Layout
    $this->layout = 'error';
    ?>
    <div class="text-center">
        <?php echo $this->CowSays->sayError($errorHint); ?>
    </div>
<?php endif;