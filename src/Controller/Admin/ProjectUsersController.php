<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * ProjectUsers Controller
 *
 * @property \App\Model\Table\ProjectUsersTable $ProjectUsers
 */
class ProjectUsersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Projects']
        ];
        $this->set('projectUsers', $this->paginate($this->ProjectUsers));
        $this->set('_serialize', ['projectUsers']);
    }

    /**
     * View method
     *
     * @param string|null $id Project User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectUser = $this->ProjectUsers->get($id, [
            'contain' => ['Users', 'Projects']
        ]);
        $this->set('projectUser', $projectUser);
        $this->set('_serialize', ['projectUser']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projectUser = $this->ProjectUsers->newEntity();
        if ($this->request->is('post')) {
            $projectUser = $this->ProjectUsers->patchEntity($projectUser, $this->request->data);
            if ($this->ProjectUsers->save($projectUser)) {
                $this->Flash->success(__('The project user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project user could not be saved. Please, try again.'));
            }
        }
        $users = $this->ProjectUsers->Users->find('list', ['limit' => 200]);
        $projects = $this->ProjectUsers->Projects->find('list', ['limit' => 200]);
        $this->set(compact('projectUser', 'users', 'projects'));
        $this->set('_serialize', ['projectUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Project User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projectUser = $this->ProjectUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectUser = $this->ProjectUsers->patchEntity($projectUser, $this->request->data);
            if ($this->ProjectUsers->save($projectUser)) {
                $this->Flash->success(__('The project user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project user could not be saved. Please, try again.'));
            }
        }
        $users = $this->ProjectUsers->Users->find('list', ['limit' => 200]);
        $projects = $this->ProjectUsers->Projects->find('list', ['limit' => 200]);
        $this->set(compact('projectUser', 'users', 'projects'));
        $this->set('_serialize', ['projectUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Project User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectUser = $this->ProjectUsers->get($id);
        if ($this->ProjectUsers->delete($projectUser)) {
            $this->Flash->success(__('The project user has been deleted.'));
        } else {
            $this->Flash->error(__('The project user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
