<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use App\Model\Table\UsersTable;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    use \CakeDC\Users\Controller\Traits\LoginTrait;
    use \CakeDC\Users\Controller\Traits\RegisterTrait;



    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'sortWhiteList' => ['username', 'first_name', 'last_name', 'created'],
            'order' => ['Users.real_name' => 'asc'],
            'conditions' => [
                'OR' => [['active' => STATUS_ACTIVE], ['active' => STATUS_LOCKED]]
            ],
            'sortWhitelist' => ['username', 'first_name', 'last_name', 'created'],
            // Email should only be used for Gravatar.
            'fields' => ['id', 'username', 'first_name', 'last_name', 'email', 'website', 'created', 'post_count', 'project_count', 'file_count', 'note_count', 'album_count']
        ];
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $licenseConfig = ['fields' => ['id', 'name', 'icon', 'link']];
        $languageConfig = ['fields' => ['id', 'name', 'iso639_1']];
        $options = [
            'fields' => ['id', 'username', 'first_name', 'last_name', 'email', 'bio', 'website', 'created', 'post_count', 'project_count', 'file_count', 'note_count', 'album_count'],
            'contain' => [
                'Posts' => [
                    'fields' => ['id', 'title', 'excerpt', 'modified', 'publication_date', 'sfw', 'user_id', 'license_id'],
                    'conditions' => [// SFW is made after
                        'status' => STATUS_PUBLISHED,
                    ],
                    'Licenses' => $licenseConfig,
                    'Languages' => $languageConfig,
                    'Projects' => ['fields' => ['id', 'name', 'ProjectsPosts.post_id']],
                ],
                'Notes' => [
                    'fields' => ['id', 'text', 'sfw', 'modified', 'created', 'user_id', 'license_id', 'language_id'],
                    'conditions' => [// SFW is made after
                        'Notes.status' => STATUS_PUBLISHED,
                    ],
                    'Licenses' => $licenseConfig,
                    'Languages' => $languageConfig,
                    'Projects' => ['fields' => ['id', 'name', 'ProjectsNotes.note_id']],
                ],
                'Projects' => [
                    'fields' => ['id', 'name', 'short_description', 'sfw', 'created', 'modified', 'user_id', 'license_id'],
                    'conditions' => [// SFW is made after
                        'status' => STATUS_PUBLISHED,
                    ],
                    'Licenses' => $licenseConfig,
                    'Languages' => $languageConfig,
                ],
                'Files' => [
                    'fields' => ['id', 'name', 'description', 'filename', 'sfw', 'created', 'modified', 'user_id', 'license_id'],
                    'conditions' => [// SFW is made after
                        'status' => STATUS_PUBLISHED,
                    ],
                    'Licenses' => $licenseConfig,
                    'Languages' => $languageConfig,
                    'Projects' => ['fields' => ['id', 'name', 'ProjectsFiles.file_id']],
                ],
                'Albums' => [
                    'fields' => ['id', 'name', 'sfw', 'created', 'modified', 'user_id'],
                    'conditions' => [// SFW is made after
                        'status' => STATUS_PUBLISHED,
                    ],
                    'Languages' => $languageConfig,
                    'Files' => [
                        'fields' => ['id', 'name', 'filename', 'sfw', 'created', 'modified', 'user_id', 'license_id', 'AlbumsFiles.album_id'],
                    ],
                ],
            ],
            'conditions' => ['OR' => [['active' => STATUS_ACTIVE], ['active' => STATUS_LOCKED]]],
        ];

        // SFW options
        if ($this->request->session()->read('seeNSFW') === false) {
            $options['contain']['Files']['conditions']['Files.sfw'] = true;
            $options['contain']['Notes']['conditions']['Notes.sfw'] = true;
            $options['contain']['Posts']['conditions']['Posts.sfw'] = true;
            $options['contain']['Projects']['conditions']['Projects.sfw'] = true;
            $options['contain']['Albums']['conditions']['Albums.sfw'] = true;
        }

        $user = $this->Users->get($id, $options);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

}
