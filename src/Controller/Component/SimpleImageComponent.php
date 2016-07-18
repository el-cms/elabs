<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

/**
 * File: SimpleImage.php
 *
 * This class perform very basic images manipulation.
 *
 * ---------------------------------------------------------------------------
 * Modified by Manuel Tancoigne <m.tancoigne@gmail.com>
 * Date: 09/2013
 * ---
 * Original Author: Simon Jarvis
 * Copyright: 2006 Simon Jarvis
 * Original Date: 08/11/06
 * Original Link: http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details:
 * http://www.gnu.org/licenses/gpl.html
 *
 */
class SimpleImageComponent extends Component
{

    // Original image
    public $image;
    // Modified image
    public $currentImage;
    // Image type
    public $imageType;
    // Log of actions
    public $log = [];

    /**
     * Loads an image
     *
     * @param string $filename Image to load
     *
     * @return bool True in case of success, false on failure.
     */
    public function load($filename)
    {
        if (!$imageInfo = getimagesize($filename)) {
            return false;
        }
        $this->imageType = $imageInfo[2];
        if ($this->imageType == IMAGETYPE_JPEG) {
            if (!$this->image = imagecreatefromjpeg($filename)) {
                return false;
            }
        } elseif ($this->imageType == IMAGETYPE_GIF) {
            if (!$this->image = imagecreatefromgif($filename)) {
                return false;
            }
        } elseif ($this->imageType == IMAGETYPE_PNG) {
            if (!$this->image = imagecreatefrompng($filename)) {
                return false;
            }
        }
        $this->currentImage = $this->image;

        return true;
    }

    /**
     * Saves an image
     *
     * @param string $filename Image file name
     * @param bool $original Save the original image if true, modified if false.
     * @param string $imageType Image format
     * @param int $compression Compression rate (mainly for Jpgs)
     * @param int $permissions Permissions for the new file
     *
     * @return bool True in case of success, false on failure.
     */
    public function save($filename, $original = false, $imageType = null, $compression = 100, $permissions = null)
    {
        // Selecting image
        $image = ($original === true) ? $this->image : $this->currentImage;
        if ($imageType == null) {
            $imageType = $this->imageType;
        }
        if ($imageType == IMAGETYPE_JPEG) {
            if (!imagejpeg($image, $filename, $compression)) {
                return false;
            }
        } elseif ($imageType == IMAGETYPE_GIF) {
            if (!imagegif($image, $filename)) {
                return false;
            }
        } elseif ($imageType == IMAGETYPE_PNG) {
            if (!imagepng($image, $filename)) {
                return false;
            }
        }
        if ($permissions != null) {
            chmod($filename, $permissions);
        }

        return true;
    }

    /**
     * Returns the image without saving it. Useful for direct rendering
     *
     * @param string $imageType Image format
     * @param bool $original Display original image if true, modified image if false.
     *
     * @return void
     */
    public function output($imageType = IMAGETYPE_JPEG, $original = true)
    {
        $image = ($original == true) ? $this->image : $this->currentImage;
        if ($imageType == IMAGETYPE_JPEG) {
            imagejpeg($image);
        } elseif ($imageType == IMAGETYPE_GIF) {
            imagegif($image);
        } elseif ($imageType == IMAGETYPE_PNG) {
            imagepng($image);
        }
    }

    /**
     * Gets the image width
     *
     * @return int Image width
     */
    public function getWidth()
    {
        return imagesx($this->currentImage);
    }

    /**
     * Gets the current image height
     *
     * @return int image height
     */
    public function getHeight()
    {
        return imagesy($this->currentImage);
    }

    /**
     * Resize image to desired height. Width will be resized with a ratio.
     *
     * @param int $height Desired height
     *
     * @return void
     */
    public function resizeToHeight($height)
    {
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
    }

    /**
     * Resize image to desired width. Height will be resized with a ratio.
     *
     * @param int $width Desired width
     *
     * @return void
     */
    public function resizeToWidth($width)
    {
        $ratio = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        $this->resize($width, $height);
    }

    /**
     * Resize an image using a certain scale.
     *
     * @param int $scale Scale factor
     *
     * @return void
     */
    public function scale($scale)
    {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getheight() * $scale / 100;
        $this->resize($width, $height);
    }

    /**
     * Resize image to given width and height
     *
     * @param int $width Desired width
     * @param int $height Desired height
     *
     * @return void
     */
    public function resize($width, $height)
    {
        $newImage = imagecreatetruecolor($width, $height);
        imagecopyresampled($newImage, $this->currentImage, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->currentImage = $newImage;
    }

    /**
     * Crops the current image to the desired dimensions
     *
     * @param int $width Desired width
     * @param int $height Desired height
     * @param int $startX Crop horizontal start point
     * @param int $startY Crop vertical start point
     *
     * @return void
     */
    public function crop($width, $height, $startX = 0, $startY = 0)
    {
        // Getting image width/height
        $imageX = $this->getHeight();
        $imageY = $this->getWidth();
        // Finding the longest side
        $biggestSide = ($imageX > $imageY) ? $imageX : $imageY;
        // Determinating the crop sizes
        $cropX = $width;
        $cropY = $height;
        // Creating image
        $newImage = imagecreatetruecolor($width, $height);
        imagecopyresampled($newImage, $this->currentImage, 0, 0, $startX, $startY, $width, $height, $cropX, $cropY);
        $this->currentImage = $newImage;
    }

    /**
     * Center crops an image to the desired width and height.
     * The cropped image will be in the center of the original image.
     *
     * @param int $width Image width, in pixels
     * @param int $height Image height, in pixels
     *
     * @return void
     */
    public function centerCrop($width, $height)
    {
        // Determining start points
        $imgX = $this->getWidth();
        $imgY = $this->getHeight();
        $startX = ($imgX - $width) / 2;
        $startY = ($imgY - $height) / 2;
        $this->crop($width, $height, (int)$startX, (int)$startY);
    }

    /**
     * Resets the current image to original image.
     *
     * @return bool
     */
    public function reset()
    {
        $this->currentImage = $this->image;

        return true;
    }

    /**
     * Watermarks an image
     *
     * @param string $source Watermark image path
     * @param string $position Position on image (can be top-left, top right, bottom-right, bottom-left)
     *
     * @return void
     */
    public function waterMark($source, $position = 'bottom-left')
    {
        // Watermark margins:
        $margins = 5;
        // Getting the waterMark image:
        $w = new SimpleImage;
        $w->load($source);
        // Getting the watermark position:
        switch ($position) {
            case 'top-left':
                $startX = $margins;
                $startY = $margins;
                break;
            case 'top-right':
                $startX = $this->getWidth() - $w->getWidth() - $margins;
                $startY = $margins;
                break;
            case 'bottom-right':
                $startX = $this->getWidth() - $w->getWidth() - $margins;
                $startY = $this->getHeight() - $w->getHeight() - $margins;
                break;
            // Bottom left:
            default:
                $startX = $margins;
                $startY = $this->getHeight() - $w->getHeight() - $margins;
                break;
        }
        $newImage = $this->currentImage;
        imagecopy($newImage, $w->currentImage, $startX, $startY, 0, 0, $w->getWidth(), $w->getHeight());
        $this->currentImage = $newImage;
    }

    /**
     * Crops an image from its center
     *
     * @param int $width Desired width
     * @param int $height Desired height
     *
     * @return void
     */
    public function centerCropFull($width, $height)
    {
        // Checking for file sizes
        $this->resizeSmallestTo(($width > $height) ? $width : $height);
        $this->centerCrop($width, $height);
    }

    /**
     * Resizes and crops an image
     *
     * @param int $width Desired width
     * @param int $height Desired height
     *
     * @return void
     */
    public function cropFull($width, $height)
    {
        // Checking for file sizes
        $this->resizeSmallestTo(($width > $height) ? $width : $height);
        $this->crop($width, $height);
    }

    /**
     * Returns the log array.
     *
     * @return array The log array
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * Resize the image, based on th smallest side.
     *
     * @param int $size Desired size for the smallest side
     *
     * @return void
     */
    public function resizeSmallestTo($size)
    {
        if ($this->getHeight() >= $this->getWidth()) {
            //Must resize width
            $this->resizeToWidth($size);
        } else {
            //Must resize height
            $this->resizeToHeight($size);
        }
    }

    /**
     * Resize the image, based on th biggest side.
     *
     * @param int $size Desired size for the biggest side
     *
     * @return void
     */
    public function resizeBiggestTo($size)
    {
        if ($this->getHeight() <= $this->getWidth()) {
            //Must resize width
            $this->resizeToWidth($size);
        } else {
            //Must resize height
            $this->resizeToHeight($size);
        }
    }

    /**
     * Rotates an image
     *
     * @param int $angle Desired angle to rotate (clockwise)
     *
     * @return void
     */
    public function rotate($angle = 90)
    {
        $this->image = imagerotate($this->image, $angle, 0);
    }

    /**
     * Rotates an image horizontally or vertically
     *
     * @param string $direction 'x' for horizontal (default), 'y' for vertical
     *
     * @return void
     */
    public function rotateTo($direction = 'x')
    {
        if ($direction == "x") {
            if ($this->getHeight() > $this->getWidth()) {
                $this->rotate(90);
            }
        } elseif ($direction == "y") {
            if ($this->getWidth() > $this->getHeight()) {
                $this->rotate(90);
            }
        }
    }
}
