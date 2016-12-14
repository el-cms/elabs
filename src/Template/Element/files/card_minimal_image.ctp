<?php

echo $this->Html->link($this->Html->image('../uploads/thumbs' . $data['filename'], ['alt' => h($data['title'])]), ['controller' => 'Files', 'action' => 'view', $data['id']], ['escape' => false]);
