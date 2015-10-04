<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= '  alert-' . $params['class'];
}
?>
<div class="alert<?= h($class) ?>"><?= h($message) ?></div>
