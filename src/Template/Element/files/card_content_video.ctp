<?php

echo $this->Html->media('../uploads/' . $data['filename'], ['style' => 'width:100%', 'controls', 'fullBase' => true, 'text' => __d('elabs', 'Your browser does not support the video element.')]);
