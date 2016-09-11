<?php

namespace App\Controller\User;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 */
class CommentsController extends UserAppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $userId = $this->Auth->user('id');

        // Commons fields to get from Licenses table
        $userConfig = ['fields' => ['id', 'realname', 'username']];
        $languageConfig = ['fields' => ['id', 'name', 'iso639_1']];

        // Get the list of items
        $this->paginate = [
            'contain' => [
                'Posts' => [
                    'conditions' => ['Posts.user_id' => $userId],
                    'fields' => ['id', 'title', 'user_id', 'language_id'],
                    'Languages' => $languageConfig,
                ],
                'Projects' => [
                    'conditions' => ['Projects.user_id' => $userId],
                    'fields' => ['id', 'name', 'user_id', 'language_id'],
                    'Languages' => $languageConfig,
                ],
                'Files' => [
                    'conditions' => ['Files.user_id' => $userId],
                    'fields' => ['id', 'name', 'user_id', 'language_id'],
                    'Languages' => $languageConfig,
                ],
                'Notes' => [
                    'conditions' => ['Notes.user_id' => $userId],
                    'fields' => ['id', 'text', 'user_id', 'language_id'],
                    'Languages' => $languageConfig,
                ],
            ],
            'limit' => 30,
            'order' => [
                'Comments.created' => 'desc'
            ],
            'sortWhiteList' => [],
        ];

        $comments = $this->paginate($this->Comments);

        // Pass variables to view
        $this->set('comments', $comments);
        $this->set('_serialize', ['comments']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__d('elabs', 'The comment has been deleted.'));
        } else {
            $this->Flash->error(__d('elabs', 'The comment could not be deleted. Please, try again.'));
        }
        $this->redirect($this->referer());
    }
}
