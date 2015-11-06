<?php

echo $this->Html->media($data['filename'], ['type' => $data['mime'], 'width'=>'100%','controls', 'pathPrefix' => 'uploads/', 'text' => __d('files', 'Your browser does not support the video element.')]);
