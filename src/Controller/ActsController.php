<?php

namespace App\Controller;

use App\Model\Table\ActsTable;
use Cake\ORM\TableRegistry;

/**
 * Acts Controller
 *
 * @property ActsTable $Acts
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
                'Notes' => __d('elabs', 'Note'),
                'Albums' => __d('elabs', 'Album'),
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
     * @param string $updateFilter Hides the updates, 'yes' or 'no'
     *
     * @return void
     */
    public function index($updateFilter = 'showUpdates')
    {
        // Prepare the pagination and filter
        $this->paginate = [
            'limit' => 30,
            'order' => [
                'Acts.created' => 'desc'
            ],
            'sortWhiteList' => [],
        ];

        if ($updateFilter === 'hideUpdates') {
            $this->paginate['conditions']['type'] = 'add';
        }

        $acts = $this->paginate($this->Acts->find('default', ['sfw' => !$this->seeNSFW]));

        // Pass variables to view
        $this->set('filterUpdates', $updateFilter);
        $this->set('acts', $acts);
        $this->set('config', $this->config);
        $this->set('_serialize', ['acts']);
    }
}
