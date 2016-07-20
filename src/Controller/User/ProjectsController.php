<?php

namespace App\Controller\User;

use App\Controller\AppController;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 */
class ProjectsController extends UserAppController
{

    /**
     * Index method
     * @param string $nsfw Filter NSFW content
     * @param string $status Filter status
     *
     * @return void
     */
    public function index($nsfw = 'all', $status = 'all')
    {
        $this->paginate = [
            'fields' => ['id', 'name', 'sfw', 'created', 'modified', 'status', 'license_id', 'user_id'],
            'contain' => [
                'Licenses' => ['fields' => ['id', 'name']]
            ],
            'conditions' => ['user_id' => $this->Auth->user('id')],
            'order' => ['created' => 'desc'],
            'sorWhiteList' => ['name', 'created', 'published'],
        ];

        if ($nsfw === 'safe') {
            $this->paginate['conditions']['sfw'] = 1;
        } elseif ($nsfw === 'unsafe') {
            $this->paginate['conditions']['sfw'] = 0;
        }
        if ($status === 'locked') {
            $this->paginate['conditions']['status'] = 2;
        }

        $this->set('projects', $this->paginate($this->Projects));
        $this->set('filterNSFW', $nsfw);
        $this->set('filterStatus', $status);
        $this->set('_serialize', ['projects']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $project = $this->Projects->newEntity();
        if ($this->request->is('post')) {
            // New values :
            $this->request->data['user_id'] = $this->Auth->user('id');
            $this->request->data['status'] = 1;
            // Preparing data
            $project = $this->Projects->patchEntity($project, $this->request->data);
            if ($this->Projects->save($project)) {
                $this->Flash->success(__d('project', 'The project has been saved.'));
                $this->Act->add($project->id, 'add', 'Projects', $project->created);
                $this->redirect(['action' => 'index']);
            } else {
                $errors = $project->errors();
                $errorMessages = [];
                array_walk_recursive($errors, function ($a) use (&$errorMessages) {
                    $errorMessages[] = $a;
                });
                $this->Flash->error(__d('elabs', 'Some errors occured. Please, try again.'), ['params' => ['errors' => $errorMessages]]);
            }
        }
        $licenses = $this->Projects->Licenses->find('list', ['limit' => 200]);
//        $users = $this->Projects->Users->find('list', ['limit' => 200]);
        $this->set(compact('project', 'licenses', 'users'));
        $this->set('_serialize', ['project']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Project id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $project = $this->Projects->get($id, [
            'conditions' => ['user_id' => $this->Auth->user('id')],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->data);
            if ($this->Projects->save($project)) {
                $this->Flash->success(__d('project', 'The project has been saved.'));
                if ($this->request->data['isMinor'] == '0') {
                    $this->Act->add($project->id, 'edit', 'Projects', $project->modified);
                }
                $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__d('project', 'The project could not be saved. Please, try again.'));
                $errors = $project->errors();
                $errorMessages = [];
                array_walk_recursive($errors, function ($a) use (&$errorMessages) {
                    $errorMessages[] = $a;
                });
                $this->Flash->error(__d('elabs', 'Some errors occured. Please, try again.'), ['params' => ['errors' => $errorMessages]]);
            }
        }
        $licenses = $this->Projects->Licenses->find('list', ['limit' => 200]);
        $this->set(compact('project', 'licenses'));
        $this->set('_serialize', ['project']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Project id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->Projects->get($id, [
            'conditions' => [
                'user_id' => $this->Auth->user('id')
            ]
        ]);
        if ($this->Projects->delete($project)) {
            $this->Flash->success(__d('project', 'The project has been deleted.'));
            $this->Act->remove($id);
        } else {
            $this->Flash->error(__d('project', 'The project could not be deleted. Please, try again.'));
        }
        $this->redirect(['action' => 'index']);
    }
}
