<?php
echo $this->Html->media('../uploads/' . $data['filename'], ['controls', 'fullBase' => true, 'text' => __d('elabs', 'Your browser does not support the video element.')]);
echo $this->Html->link($data['name'], ['controller' => 'Files', 'action' => 'view', $data['id']]);
