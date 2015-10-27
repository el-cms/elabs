<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= '  alert-' . $params['class'];
}
?>
<div class="alert<?php echo h($class) ?>"><?php echo h($message) ?></div>
