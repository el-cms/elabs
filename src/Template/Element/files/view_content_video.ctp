<?php

echo $this->Html->media('../uploads/' . $data['filename'], ['type' => $data['mime'], 'controls', 'fullBase' => true, 'width' => '100%', 'text' => __d('files', 'Your browser does not support the video element.')]);
