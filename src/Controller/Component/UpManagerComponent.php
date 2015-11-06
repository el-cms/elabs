<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * CakePHP FileComponent
 */
class UpManagerComponent extends Component
{
    public $components = ['Auth'];
    // This should be moved in config file from here
    public $accepted = [
        'image' => ['jpg', 'jpeg', 'png', 'gif'],
        'audio' => ['mp3', 'ogg'],
        'video' => ['mp4', 'webm'],
        'text' => ['md', 'markdown', 'mdown', 'txt', 'odt', 'pdf', 'tex', 'nfo'],
        'other' => ['blend', 'dwg', 'dxf', 'sql']
    ];
    public $maxSize = 1024 * 1024 * 3;
    public $filePath = '{y}' . DS . '{m}';
    public $thumbPath = 'thumbs' . DS . '{y}' . DS . '{m}';
    public $baseDir = 'uploads' . DS;
    // ^ to here ^
    public $currentFilePath;
    public $currentThumbPath;

    /**
     * Returns an unique filename for the new file.
     * 
     * @param string $original
     * @return string New filename
     */
    public function makeFileName($ext)
    {
        return time() . '.' . $ext;
    }

    /**
     * Checks if the given file ext is in the allowed exts array
     * 
     * @param string $file Filename
     * @return boolean
     */
    public function checkFileType($file)
    {
        foreach ($this->accepted as $family) {
            if (in_array($file, $family)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Return true if the given file size is smaller or equal to the maximum file
     * size allowed
     * 
     * @param int $size File size
     * @return string Created path
     */
    public function checkFileSize($size)
    {
        return ($this->maxSize >= $size);
    }

    public function preparePath($type = 'file')
    {
        $data = [
            'username' => $this->Auth->user('username'),
            'userid' => $this->Auth->user('id'),
            'y' => date('Y'),
            'm' => date('m'),
            'd' => date('d'),
        ];
        if ($type === 'thumb') {
            $this->currentThumbPath = $this->thumbPath;
            foreach ($data as $k => $v) {
                $this->currentThumbPath = preg_replace("@\{$k\}@", $v, $this->currentThumbPath);
            }
            new Folder(WWW_ROOT . $this->baseDir . $this->currentThumbPath, true, '0755');
            return $this->currentThumbPath;
        } elseif ($type === 'file') {
            $this->currentFilePath = $this->filePath;
            foreach ($data as $k => $v) {
                $this->currentFilePath = preg_replace("@\{$k\}@", $v, $this->currentFilePath);
            }
            new Folder(WWW_ROOT . $this->baseDir . $this->currentFilePath, true, '0755');
            return $this->currentFilePath;
        }
    }
//    public function path(){
//        
//        return APP.DS.'webroot'.DS.'files'.$this->Auth->user('username');
//    }
//    
//    public function preparePath($path){
//        
//        return new Folder($path, true, '777');
//    }
}
