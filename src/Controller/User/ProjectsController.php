<?php

namespace App\Controller\User;

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
        $projects = $this->Projects->find('users', ['uid' => $this->Auth->user('id')]);

        $this->paginate = [
            'order' => ['created' => 'desc'],
            'sorWhiteList' => ['name', 'created', 'published'],
        ];

        if ($nsfw === 'safe') {
            $this->paginate['conditions']['sfw'] = SFW_SAFE;
        } elseif ($nsfw === 'unsafe') {
            $this->paginate['conditions']['sfw'] = SFW_UNSAFE;
        }
        if ($status === 'locked') {
            $this->paginate['conditions']['status'] = STATUS_LOCKED;
        }

        $this->set('projects', $this->paginate($projects));
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
            $this->request->data['status'] = STATUS_PUBLISHED;
            // Manage tags
            $this->request->data['tags']['_ids'] = $this->TagManager->merge($this->request->data('tags._ids'));
            // Preparing data
            $project = $this->Projects->patchEntity($project, $this->request->data);
            if ($this->Projects->save($project)) {
                $this->Flash->success(__d('elabs', 'The project has been saved.'));
                if (!$project->hide_from_acts) {
                    $this->Act->add($project->id, 'add', 'Projects', $project->created);
                }
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
        $licenses = $this->Projects->Licenses->find('list');
        $languages = $this->Projects->Languages->find('list');
        $this->set(compact('project', 'licenses', 'languages'));
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
            'contain' => [
                'Tags' => ['fields' => ['id', 'ProjectsTags.project_id']],
            ],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $oldActState = $project->hide_from_acts;
            // Manage tags
            $this->request->data['tags']['_ids'] = $this->TagManager->merge($this->request->data('tags._ids'));
            $project = $this->Projects->patchEntity($project, $this->request->data);
            if ($this->Projects->save($project)) {
                $this->Flash->success(__d('elabs', 'The project has been saved.'));
                if ($this->request->data['isMinor'] == '0' && !$project->hide_from_acts) {
                    $this->Act->add($project->id, 'edit', 'Projects', $project->modified);
                }
                if ($oldActState === false && $project->hide_from_acts) {
                    $this->Flash->success(__d('elabs', 'The album has been removed from front page.'));
                    $this->Act->remove($project->id);
                }
                $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__d('elabs', 'The project could not be saved. Please, try again.'));
                $errors = $project->errors();
                $errorMessages = [];
                array_walk_recursive($errors, function ($a) use (&$errorMessages) {
                    $errorMessages[] = $a;
                });
                $this->Flash->error(__d('elabs', 'Some errors occured. Please, try again.'), ['params' => ['errors' => $errorMessages]]);
            }
        }
        $licenses = $this->Projects->Licenses->find('list');
        $languages = $this->Projects->Languages->find('list');
        $this->set(compact('project', 'licenses', 'languages'));
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
            $this->Flash->success(__d('elabs', 'The project has been deleted.'));
            $this->Act->remove($id);
        } else {
            $this->Flash->error(__d('elabs', 'The project could not be deleted. Please, try again.'));
        }
        $this->redirect(['action' => 'index']);
    }
}
