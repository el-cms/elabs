<?php

namespace App\View\Helper;

use Cake\View\Helper;

/**
 * CakePHP ItemsHelper
 */
class ItemsHelper extends Helper
{
    public $accepted = [
        'image' => ['jpg', 'jpeg', 'png', 'gif'],
        'audio' => ['mp3', 'ogg'],
        'video' => ['mp4', 'webm'],
        'text' => ['md', 'markdown', 'mdown', 'txt', 'odt', 'pdf', 'tex', 'nfo'],
        'other' => ['blend', 'dwg', 'dxf', 'sql']
    ];

    /**
     * Defines the type of element and icon of a given file
     *
     * @param string $filename Name of the file
     *
     * @return array
     */
    public function fileConfig($filename)
    {
        $info = pathinfo($filename);
        if (in_array($info['extension'], $this->accepted['image'])) {
            return [
                'icon' => 'file-image-o',
                'element' => 'image',
            ];
        } elseif (in_array($info['extension'], $this->accepted['audio'])) {
            return [
                'icon' => 'file-audio-o',
                'element' => 'audio',
            ];
        } elseif (in_array($info['extension'], $this->accepted['video'])) {
            return [
                'icon' => 'file-video-o',
                'element' => 'video',
            ];
        } elseif (in_array($info['extension'], $this->accepted['text'])) {
            return [
                'icon' => 'file-text-o',
                'element' => 'text',
            ];
        } else {
            return [
                'icon' => 'file-o',
                'element' => 'other',
            ];
        }
    }
}
