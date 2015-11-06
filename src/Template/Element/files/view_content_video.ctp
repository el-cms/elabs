<?php

echo $this->Html->media($data['filename'], ['type' => $data['mime'], 'controls', 'pathPrefix' => 'uploads/', 'width'=>'100%','text' => __d('files', 'Your browser does not support the video element.')]);
