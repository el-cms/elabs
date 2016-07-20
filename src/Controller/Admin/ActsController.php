<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminAppController;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

/**
 * Acts Controller
 *
 * @property \App\Model\Table\ActsTable $Acts
 */
class ActsController extends AdminAppController
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
                'edit' => __d('acts', 'has been updated'),
                'delete' => __d('acts', 'has been removed'),
            ],
            'models' => [
                'Files' => __d('files', 'File'),
                'Posts' => __d('posts', 'Article'),
                'Projects' => __d('projects', 'Project'),
            ]
        ];

        // Load models
        foreach ($this->config['models'] as $model => $item) {
            $this->$model = TableRegistry::get($model);
        }
    }

    /**
     * Re-builds the table
     *
     * @return void
     */
    public function clean()
    {
        $errors = 0;
        if ($this->request->is('POST')) {
            // Get connection:
            $connection = ConnectionManager::get('default');
            $truncate = $connection->query('truncate acts;');
            $models = ['Files', 'Posts', 'Projects'];
            foreach ($models as $model) {
                $query = $this->$model->find('all', ['conditions' => ['status' => 1]]);
                foreach ($query as $item) {
                    // Add
                    $act = $this->Acts->patchEntity($this->Acts->newEntity(), ['fkid' => $item->id, 'model' => $model, 'type' => 'add', 'created' => $item->created]); //, 'user_id' => $uid]);
                    if (!$this->Acts->save($act)) {
                        $errors ++;
                    }
                    // Edit
                    if ($item->created != $item->modified) {
                        $act = $this->Acts->patchEntity($this->Acts->newEntity(), ['fkid' => $item->id, 'model' => $model, 'type' => 'edit', 'created' => $item->modified]); //, 'user_id' => $uid]);
                        if (!$this->Acts->save($act)) {
                            $errors ++;
                        }
                    }
                }
            }
            if ($errors > 0) {
                $this->Flash->error(__d('elabs', '{0} errors occured during the cleanup. Please, try again.'));
            } else {
                $this->Flash->success(__d('elabs', 'Acts table has been rebuilt.'));
            }
        } else {
            $this->Flash->warning(__d('elabs', 'Use the menu to access this functionality'));
        }
        $this->redirect($this->request->referer());
    }
}
