<?php

namespace App\Controller\User;

use App\Controller\Admin\AdminAppController;

/**
 * Albums Controller
 *
 * @property \App\Model\Table\AlbumsTable $Albums
 */
class AlbumsController extends UserAppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($nsfw = 'all')
    {
        $this->paginate = [
            'fields' => ['id', 'name', 'description', 'sfw', 'created', 'modified'],
            'contain' => [
                'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
                'Files' => ['fields' => ['id', 'name', 'AlbumsFiles.album_id']],
                'Projects' => ['fields' => ['id', 'name', 'ProjectsAlbums.album_id']],
            ],
            'conditions' => ['user_id' => $this->Auth->user('id')],
            'order' => ['name' => 'desc'],
            'sortWhitelist' => ['name', 'created', 'modified', 'sfw'],
        ];

        if ($nsfw === 'safe') {
            $this->paginate['conditions']['sfw'] = 1;
        } elseif ($nsfw === 'unsafe') {
            $this->paginate['conditions']['sfw'] = 0;
        }

        $this->set('filterNSFW', $nsfw);

        $this->set('albums', $this->paginate($this->Albums));
        $this->set('_serialize', ['albums']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $album = $this->Albums->newEntity();
        if ($this->request->is('post')) {
            $dataSent = $this->request->data;
            $dataSent['user_id'] = $this->Auth->user('id');
            $album = $this->Albums->patchEntity($album, $dataSent);
            if ($this->Albums->save($album)) {
                $this->Flash->success(__('The album has been saved.'));
                $this->Act->add($album->id, 'add', 'Album', $album->created);
                
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__d('elabs', 'The album could not be saved. Please, try again.'));
                $errors = $album->errors();
                $errorMessages = [];
                array_walk_recursive($errors, function ($a) use (&$errorMessages) {
                    $errorMessages[] = $a;
                });
                $this->Flash->error(__d('elabs', 'Some errors occured. Please, try again.'), ['params' => ['errors' => $errorMessages]]);
            }
        }
        $languages = $this->Albums->Languages->find('list', ['limit' => 200]);
        $files = $this->Albums->Files->find('list', ['limit' => 200, ['condition' => ['user_id' => $this->Auth->user('id')]]]);
        $projects = $this->Albums->Projects->find('list', ['limit' => 200, ['condition' => ['user_id' => $this->Auth->user('id')]]]);
        $this->set(compact('album', 'languages', 'files', 'projects'));
        $this->set('_serialize', ['album']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Album id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $album = $this->Albums->get($id, [
            'contain' => ['Files', 'Projects']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $album = $this->Albums->patchEntity($album, $this->request->data);
            if ($this->Albums->save($album)) {
                $this->Flash->success(__('The album has been saved.'));
                $this->Act->add($album->id, 'edit', 'Album', $album->created);


                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The album could not be saved. Please, try again.'));
            }
        }
        $languages = $this->Albums->Languages->find('list', ['limit' => 200]);
        $files = $this->Albums->Files->find('list', ['limit' => 200, ['condition' => ['user_id' => $this->Auth->user('id')]]]);
        $projects = $this->Albums->Projects->find('list', ['limit' => 200, ['condition' => ['user_id' => $this->Auth->user('id')]]]);
        $this->set(compact('album', 'languages', 'files', 'projects'));
        $this->set('_serialize', ['album']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Album id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $album = $this->Albums->get($id);
        if ($this->Albums->delete($album)) {
            $this->Flash->success(__('The album has been deleted.'));
        } else {
            $this->Flash->error(__('The album could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
