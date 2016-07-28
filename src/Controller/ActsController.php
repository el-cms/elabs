<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Acts Controller
 *
 * @property \App\Model\Table\ActsTable $Acts
 */
class ActsController extends AppController
{

    /**
     * Config value, like strings and model names.
     * Filled in initialize();
     *
     * @var array
     */
    public $config = [
        'strings' => [],
        'models' => [],
    ];

    /**
     * Loads additionnal models and create the configuration array
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        // Create config strings
        $this->config = [
            'strings' => [
                'edit' => __d('elabs', 'has been updated'),
                'delete' => __d('elabs', 'has been removed'),
            ],
            'models' => [
                'Files' => __d('elabs', 'File'),
                'Posts' => __d('elabs', 'Article'),
                'Projects' => __d('elabs', 'Project'),
            ]
        ];

        // Load models
        foreach ($this->config['models'] as $model => $item) {
            $this->$model = TableRegistry::get($model);
        }
    }

    /**
     * Index method
     *
     * @param string $hidePosts Hides the posts, 'yes' or 'no'
     * @param string $hideProjects Hides the projects, 'yes' or 'no'
     * @param string $hideFiles Hides the files, 'yes' or 'no'
     * @param string $hideUpdates Hides the updates, 'yes' or 'no'
     *
     * @return void
     */
    public function index($hidePosts = 'no', $hideProjects = 'no', $hideFiles = 'no', $hideUpdates = 'no')
    {
        // Commons fields to get from Licenses table
        $licenseConfig = ['fields' => ['id', 'name', 'icon', 'link']];
        $userConfig = ['fields' => ['id', 'realname', 'username']];

        // Get the list of items
        $this->paginate = [
            'contain' => [
                'Posts' => [
                    'fields' => ['id', 'title', 'excerpt', 'modified', 'publication_date', 'sfw', 'user_id', 'created', 'license_id'],
                    'conditions' => [ // SFW is made after
                        'Posts.status' => 1,
                    ],
                    'Licenses' => $licenseConfig,
                    'Users' => $userConfig,
                ],
                'Projects' => [
                    'fields' => ['id', 'name', 'short_description', 'sfw', 'created', 'modified', 'user_id', 'license_id'],
                    'conditions' => [ // SFW is made after
                        'Projects.status' => 1,
                    ],
                    'Licenses' => $licenseConfig,
                    'Users' => $userConfig,
                ],
                'Files' => [
                    'fields' => ['id', 'name', 'description', 'filename', 'created', 'modified', 'sfw', 'user_id', 'license_id'],
                    'conditions' => [ // SFW is made after
                        'Files.status' => 1,
                    ],
                    'Licenses' => $licenseConfig,
                    'Users' => $userConfig,
                ],
            ],
//            'fields' => ['id', 'type', 'fkid', 'model', 'Users.id', 'Users.username'],
            'limit' => 30,
            'order' => [
                'Acts.created' => 'desc'
            ]
        ];

        // SFW conditions :
        if (!$this->request->session()->read('seeNSFW')) {
            $this->paginate['contain']['Posts']['conditions']['Posts.sfw'] = true;
            $this->paginate['contain']['Projects']['conditions']['Projects.sfw'] = true;
            $this->paginate['contain']['Files']['conditions']['Files.sfw'] = true;
        }
        // Filters
        $models = []; // Models to be displayed
        if ($hideProjects === 'no') {
            $models[] = 'Projects';
        }
        if ($hidePosts === 'no') {
            $models[] = 'Posts';
        }
        if ($hideFiles === 'no') {
            $models[] = 'Files';
        }
        $this->paginate['conditions']['model IN'] = $models;

        if ($hideUpdates === 'yes') {
            $this->paginate['conditions']['type'] = 'add';
        }

        $acts = $this->paginate($this->Acts);

        // Pass variables to view
        $this->set('filterUpdates', $hideUpdates);
        $this->set('filterProjects', $hideProjects);
        $this->set('filterPosts', $hidePosts);
        $this->set('filterFiles', $hideFiles);
        $this->set('acts', $acts);
        $this->set('config', $this->config);
        $this->set('_serialize', ['acts']);
    }
}
