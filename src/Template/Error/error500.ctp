<?php

use Cake\Core\Configure;
use Cake\Error\Debugger;

/*
 * Dev view
 */
if (Configure::read('debug')):
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('pageTitle', 'Error 5xx');
    $this->assign('templateName', 'error500.ctp');

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
    <?php if ($error instanceof Error) : ?>
        <strong>Error in: </strong>
        <?= sprintf('%s, line %s', str_replace(ROOT, 'ROOT', $error->getFile()), $error->getLine()) ?>
    <?php endif; ?>
    <?php
    echo $this->element('auto_table_warning');

    if (extension_loaded('xdebug')):
        xdebug_print_function_stack();
    endif;

    $this->end();
/*
 * Production view
 */
else:
    $this->assign('title', __d('elabs', 'Error: {0}', $message));

    // Breadcrumbs
    $this->Html->addCrumb($this->fetch('title'));

    // Helpers
    $this->loadHelper('CowSays');

    // Layout
    $this->layout = 'error';
    ?>
    <div class="text-center">
        <?php
        $string = __d('elabs', 'Error:') . "\n" . $message;
        echo $this->CowSays->sayError($string);
        ?>
    </div>
<?php endif;
