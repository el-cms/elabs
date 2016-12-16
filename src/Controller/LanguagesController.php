<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Languages Controller
 *
 * @property \App\Model\Table\LanguagesTable $Languages
 */
class LanguagesController extends AppController
{

    /**
     * Index method
     *
     * @param string $filter Filter to apply to the query
     *
     * @return void
     */
    public function index($filter = 'hideEmpties')
    {
        $query = $this->Languages->find();

        // Filters
        if ($filter === 'hideEmpties') {
            $query->where([
                    ['OR' =>
                        [
                        'album_count >' => '0',
                        'file_count >' => '0',
                        'note_count >' => '0',
                        'post_count >' => '0',
                        'project_count >' => '0',
                        ]
                    ]
            ]);
        }

        $languages = $this->paginate($query);
        $this->set(compact('languages', 'filter'));
        $this->set('_serialize', ['languages']);
    }

    /**
     * View method
     *
     * @param string|null $id Language id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $licenseConfig = ['fields' => ['id', 'name', 'icon', 'link']];
        $languageConfig = ['fields' => ['id', 'iso639_1']];
        $userConfig = ['fields' => ['id', 'username']];
        $options = [
            'contain' => [
                'Posts' => [
                    'fields' => ['id', 'title', 'excerpt', 'modified', 'publication_date', 'sfw', 'user_id', 'license_id', 'language_id'],
                    'conditions' => [// SFW is made after
                        'Posts.status' => STATUS_PUBLISHED,
                    ],
                    'Users' => $userConfig,
                    'Licenses' => $licenseConfig,
                    'Languages' => $languageConfig,
                ],
                'Notes' => [
                    'fields' => ['id', 'text', 'sfw', 'modified', 'created', 'user_id', 'license_id', 'language_id'],
                    'conditions' => [// SFW is made after
                        'Notes.status' => STATUS_PUBLISHED,
                    ],
                    'Users' => $userConfig,
                    'Licenses' => $licenseConfig,
                    'Languages' => $languageConfig,
                ],
                'Projects' => [
                    'fields' => ['id', 'name', 'short_description', 'sfw', 'created', 'modified', 'user_id', 'license_id', 'language_id'],
                    'conditions' => [// SFW is made after
                        'Projects.status' => STATUS_PUBLISHED,
                    ],
                    'Users' => $userConfig,
                    'Licenses' => $licenseConfig,
                    'Languages' => $languageConfig,
                ],
                'Files' => [
                    'fields' => ['id', 'name', 'description', 'filename', 'sfw', 'created', 'modified', 'user_id', 'license_id', 'language_id'],
                    'conditions' => [// SFW is made after
                        'Files.status' => STATUS_PUBLISHED,
                    ],
                    'Users' => $userConfig,
                    'Licenses' => $licenseConfig,
                    'Languages' => $languageConfig,
                ],
                'Albums' => [
                    'fields' => ['id', 'name', 'description', 'sfw', 'created', 'modified', 'user_id', 'language_id'],
                    'conditions' => [// SFW is made after
                        'status' => STATUS_PUBLISHED,
                    ],
                    'Files' => [
                        'fields' => ['id', 'name', 'filename', 'sfw', 'created', 'modified', 'user_id', 'license_id', 'AlbumsFiles.album_id'],
                    ],
                    'Languages' => $languageConfig,
                ],
            ],
        ];
        // SFW options
        if ($this->request->session()->read('seeNSFW') === false) {
            $options['contain']['Files']['conditions']['Files.sfw'] = true;
            $options['contain']['Notes']['conditions']['Notes.sfw'] = true;
            $options['contain']['Posts']['conditions']['Posts.sfw'] = true;
            $options['contain']['Projects']['conditions']['Projects.sfw'] = true;
        }

        $language = $this->Languages->get($id, $options);
        $this->set('language', $language);
        $this->set('_serialize', ['language']);
    }
}
