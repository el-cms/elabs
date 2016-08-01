<?php

echo $this->Html->media('../uploads/' . $data['filename'], ['controls', 'fullBase' => true, 'style' => 'width:100%', 'text' => __d('elabs', 'Your browser does not support the video element.')]);
