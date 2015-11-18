<?php
$class = 'message';
if ($params['class']) {
    $class .= '  alert-' . $params['class'];
}
?>
<div class="alert<?php echo h($class) ?>"><?php echo h($message) ?></div>
