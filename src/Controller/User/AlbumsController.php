<?php

namespace App\Controller\User;

/**
 * Albums Controller
 *
 * @property \App\Model\Table\AlbumsTable $Albums
 * @property \App\Controller\Component\TagManagerComponent $TagManager
 */
class AlbumsController extends UserAppController
{

    /**
     * Index method
     *
     * @param string $nsfw NSFW filter
     *
     * @return \Cake\Network\Response|void
     */
    public function index($nsfw = 'all')
    {
        $albums = $this->Albums->find('users', ['uid' => $this->Auth->user('id')]);
        $this->paginate = [
            'order' => ['name' => 'desc'],
            'sortWhitelist' => ['name', 'created', 'modified', 'sfw'],
        ];

        if ($nsfw === 'safe') {
            $this->paginate['conditions']['sfw'] = 1;
        } elseif ($nsfw === 'unsafe') {
            $this->paginate['conditions']['sfw'] = 0;
        }

        $this->set('filterNSFW', $nsfw);

        $this->set('albums', $this->paginate($albums));
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
            // Assigning values:
            $dataSent = $this->request->data;
            $dataSent['user_id'] = $this->Auth->user('id');
            $dataSent['status'] = STATUS_PUBLISHED;
            // Manage tags
            $dataSent['tags']['_ids'] = $this->TagManager->merge($this->request->data('tags._ids'));
            $album = $this->Albums->patchEntity($album, $dataSent);
            if ($this->Albums->save($album)) {
                $this->Flash->success(__d('elabs', 'The album has been saved.'));
                if (!$album->hide_from_acts) {
                    $this->Act->add($album->id, 'add', 'Albums', $album->created);
                }

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
        $languages = $this->Albums->Languages->find('list');
        $files = $this->Albums->Files->find('list', ['conditions' => ['user_id' => $this->Auth->user('id')]]);
        $projects = $this->Albums->Projects->find('list', ['conditions' => ['Projects.user_id' => $this->Auth->user('id')]]);
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
            'contain' => [
                'Files' => ['fields' => ['id', 'name', 'AlbumsFiles.album_id']],
                'Projects' => ['fields' => ['id', 'name', 'ProjectsAlbums.album_id']],
                'Tags' => ['fields' => ['id', 'AlbumsTags.album_id']],
            ],
            'conditions' => ['user_id' => $this->Auth->user('id')],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $oldActState = $album->hide_from_acts;
            // Manage tags
            $this->request->data['tags']['_ids'] = $this->TagManager->merge($this->request->data('tags._ids'));
            $album = $this->Albums->patchEntity($album, $this->request->data);
            if ($this->Albums->save($album)) {
                $this->Flash->success(__d('elabs', 'The album has been saved.'));
                if ($this->request->data['isMinor'] == '0' && !$album->hide_from_acts) {
                    $this->Act->add($album->id, 'edit', 'Albums', $album->modified);
                }
                if ($oldActState === false && $album->hide_from_acts) {
                    $this->Flash->success(__d('elabs', 'The album has been removed from front page.'));
                    $this->Act->remove($album->id);
                }

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__d('elabs', 'The album could not be saved. Please, try again.'));
            }
        }
        $languages = $this->Albums->Languages->find('list');
        $files = $this->Albums->Files->find('list', ['conditions' => ['user_id' => $this->Auth->user('id')]]);
        $projects = $this->Albums->Projects->find('list', ['conditions' => ['user_id' => $this->Auth->user('id')]]);
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
            $this->Flash->success(__d('elabs', 'The album has been deleted.'));
        } else {
            $this->Flash->error(__d('elabs', 'The album could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
