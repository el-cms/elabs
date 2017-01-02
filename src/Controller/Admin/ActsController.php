<?php

namespace App\Controller\Admin;

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
            'models' => [
                'Files' => __d('elabs', 'File'),
                'Notes' => __d('elabs', 'Note'),
                'Posts' => __d('elabs', 'Article'),
                'Projects' => __d('elabs', 'Project'),
                'Albums' => __d('elabs', 'Album'),
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
//        $done=[];
        $errors = 0;
        if ($this->request->is('POST')) {
            // Get connection:
            $connection = ConnectionManager::get('default');
            $this->Acts->deleteAll('1=1');
            $models = ['Files', 'Posts', 'Projects', 'Notes', 'Albums'];
            foreach ($models as $model) {
//                $done[$model]=['add'=>0, 'edit'=>0];
                $query = $this->$model->find('all', ['conditions' => ['status' => STATUS_PUBLISHED, 'hide_from_acts' => false]]);
                foreach ($query as $item) {
                    // Add
                    $act = $this->Acts->patchEntity($this->Acts->newEntity(), ['fkid' => $item->id, 'model' => $model, 'type' => 'add', 'created' => $item->created]); //, 'user_id' => $uid]);
                    if (!$this->Acts->save($act)) {
                        $errors ++;
                    }
//                    $done[$model]['add']++;
                    // Edit
                    if ($item->created != $item->modified) {
//                        $done[$model]['edit']++;
                        $act = $this->Acts->patchEntity($this->Acts->newEntity(), ['fkid' => $item->id, 'model' => $model, 'type' => 'edit', 'created' => $item->modified]); //, 'user_id' => $uid]);
                        if (!$this->Acts->save($act)) {
                            $errors ++;
                        }
                    }
                }
            }
//            debug($done);die;
            if ($errors > 0) {
                $this->Flash->error(__dn('elabs', 'An error occured during the cleanup. Please, try again.', '{0,number} errors occured during the cleanup. Please, try again.', $errors, $errors));
            } else {
                $this->Flash->success(__d('elabs', 'Acts table has been rebuilt.'));
            }
            $this->redirect($this->request->referer());
        } else {
            throw new \Cake\Network\Exception\MethodNotAllowedException(__d('elabs', 'Use the menu to access this functionality'));
        }
    }
}
