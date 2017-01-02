<?php
if(!is_array($params['class'])){
    $params['class']=preg_replace('/((^|\s)(danger|info|success|warning))/', '$2alert-$3', $params['class']);
    $params['class']=explode(' ', $params['class']);
}
$class = array_unique((array) $params['class']);
$message = (isset($params['escape']) && $params['escape'] === false) ? $message : h($message);

// Error messages
$list = null;
if (isset($params) AND isset($params['errors'])) :
    // Make the message bold
    $message = $this->Html->tag('strong', $message);
    $items = [];
    foreach ($params['errors'] as $error) :
        $items[] = $this->Html->tag('li', $this->Html->iconT('warning', h($error)));
    endforeach;
    $list = $this->Html->tag('ul', $items, ['class' => 'list-unstyled']);
endif;

// Button
$button=null;
if (in_array('alert-dismissible', $class)) {
    $button = <<<BUTTON
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
BUTTON;
}
$message = $button . $message;

echo $this->Html->div($class, $message . $list, $params['attributes']);
