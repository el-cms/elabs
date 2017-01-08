<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tag Entity
 *
 * @property string $id
 * @property int $album_count
 * @property int $file_count
 * @property int $note_count
 * @property int $post_count
 * @property int $project_count
 *
 * @property \App\Model\Entity\File[] $files
 * @property \App\Model\Entity\Note[] $notes
 * @property \App\Model\Entity\Post[] $posts
 * @property \App\Model\Entity\Project[] $projects
 */
class Tag extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    /**
     * Returns the sum of all counters
     *
     * @return int
     */
    protected function _getTotalItems()
    {
        return $this->_properties['album_count'] + $this->_properties['file_count'] + $this->_properties['note_count'] + $this->_properties['post_count'] + $this->_properties['project_count'];
    }
}
