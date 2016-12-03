<?php echo $this->Html->icon('file-audio-o 5x') ?>
<br>
<?php
echo $this->Html->link($data['name'], ['controller' => 'Files', 'action' => 'view', $data['id']]);
echo $this->Html->media('../uploads/' . $data['filename'], ['controls', 'fullBase' => true, 'text' => __d('elabs', 'Your browser does not support the audio element.')]);
