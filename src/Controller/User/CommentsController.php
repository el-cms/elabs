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
        $userConfig = ['fields' => ['id', 'first_name', 'last_name', 'username']];
        $languageConfig = ['fields' => ['id', 'name', 'iso639_1']];

        // Get the list of items
        $this->paginate = [
            'contain' => [
                'Posts' => [
                    'fields' => ['id', 'title', 'user_id', 'language_id'],
                    'Languages' => $languageConfig,
                ],
                'Projects' => [
                    'fields' => ['id', 'name', 'user_id', 'language_id'],
                    'Languages' => $languageConfig,
                ],
                'Files' => [
                    'fields' => ['id', 'name', 'user_id', 'language_id'],
                    'Languages' => $languageConfig,
                ],
                'Notes' => [
                    'fields' => ['id', 'text', 'user_id', 'language_id'],
                    'Languages' => $languageConfig,
                ],
                'Albums' => [
                    'fields' => ['id', 'name', 'user_id', 'language_id'],
                    'Languages' => $languageConfig,
                ],
                'Users' => $userConfig,
            ],
            'limit' => 30,
            'order' => [
                'Comments.created' => 'desc'
            ],
            'conditions' => ['OR' => [
                    ['Albums.user_id' => $userId],
                    ['Notes.user_id' => $userId],
                    ['Files.user_id' => $userId],
                    ['Projects.user_id' => $userId],
                    ['Posts.user_id' => $userId],
                ]
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
