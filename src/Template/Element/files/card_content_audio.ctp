<?php

echo $this->Html->media('../uploads/' . $data['filename'], ['type' => $data['mime'], 'style' => 'width:100%', 'controls', 'fullBase' => true, 'text' => __d('files', 'Your browser does not support the audio element.')]);
