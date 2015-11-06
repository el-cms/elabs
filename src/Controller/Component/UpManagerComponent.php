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
    public $filePath = '{DS}{y}{DS}{m}';
    public $thumbPath = '{DS}thumbs{DS}{y}{DS}{m}';
    public $baseDir = 'uploads';
    // ^ to here ^
    public $currentFilePath;
    public $currentFilePathForDB;
    public $currentThumbPath;
    public $currentThumbPathForDB;

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

    /**
     * Creates the destination dir and returns an URL-friendly string to get to
     * the file, from the webroot dir (i.e: uploads/some/path/
     * 
     * @param string $type file or thumbnail
     * @return type
     */
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
            // Path for DB (url-friendly)
            $this->currentThumbPathForDB=preg_replace("@\{DS}@", '/', $this->currentThumbPath);
            // Path for files on FS
            $this->currentThumbPath=preg_replace("@\{DS}@", DS, $this->currentThumbPath);
            new Folder(WWW_ROOT . $this->baseDir . $this->currentThumbPath, true, '0755');
            return $this->currentThumbPathForDB;
        } elseif ($type === 'file') {
            $this->currentFilePath = $this->filePath;
            $this->currentFilePathForDB = $this->filePath;
            foreach ($data as $k => $v) {
                $this->currentFilePath = preg_replace("@\{$k\}@", $v, $this->currentFilePath);
            }
            // Path for DB (url-friendly)
            $this->currentFilePathForDB=preg_replace("@\{DS}@", '/', $this->currentFilePath);
            // Path for files on FS
            $this->currentFilePath=preg_replace("@\{DS}@", DS, $this->currentFilePath);
            new Folder(WWW_ROOT . $this->baseDir . $this->currentFilePath, true, '0755');
            return $this->currentFilePathForDB;
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
