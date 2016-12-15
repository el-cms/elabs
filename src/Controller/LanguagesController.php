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
     * @return void
     */
    public function index()
    {
        $languages = $this->paginate($this->Languages);

        $this->set(compact('languages'));
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
        $languageConfig = ['fields' => ['id', 'name', 'iso639_1']];
        $userConfig = ['fields' => ['id', 'username']];
        $options = [
            'contain' => [
                'Posts' => [
                    'fields' => ['id', 'title', 'excerpt', 'modified', 'publication_date', 'sfw', 'user_id', 'license_id', 'language_id'],
                    'conditions' => [ // SFW is made after
                        'Posts.status' => STATUS_PUBLISHED,
                    ],
                    'Users' => $userConfig,
                    'Licenses' => $licenseConfig,
                ],
                'Notes' => [
                    'fields' => ['id', 'text', 'sfw', 'modified', 'created', 'user_id', 'license_id', 'language_id'],
                    'conditions' => [ // SFW is made after
                        'Notes.status' => STATUS_PUBLISHED,
                    ],
                    'Users' => $userConfig,
                    'Licenses' => $licenseConfig,
                ],
                'Projects' => [
                    'fields' => ['id', 'name', 'short_description', 'sfw', 'created', 'modified', 'user_id', 'license_id', 'language_id'],
                    'conditions' => [ // SFW is made after
                        'Projects.status' => STATUS_PUBLISHED,
                    ],
                    'Users' => $userConfig,
                    'Licenses' => $licenseConfig,
                ],
                'Files' => [
                    'fields' => ['id', 'name', 'description', 'filename', 'sfw', 'created', 'modified', 'user_id', 'license_id', 'language_id'],
                    'conditions' => [ // SFW is made after
                        'Files.status' => STATUS_PUBLISHED,
                    ],
                    'Users' => $userConfig,
                    'Licenses' => $licenseConfig,
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
