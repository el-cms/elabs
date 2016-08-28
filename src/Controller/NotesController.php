<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Notes Controller
 *
 * @property \App\Model\Table\NotesTable $Notes
 */
class NotesController extends AppController
{

    /**
     * Index method
     *
     * @param string $filter Filter model name
     * @param string $id Foreign key
     *
     * @return \Cake\Network\Response|void
     */
    public function index($filter = null, $id = null)
    {
        $findOptions = [
            'fields' => ['id', 'text', 'sfw', 'created', 'modified', 'user_id', 'license_id', 'language_id'],
            'conditions' => ['Notes.status' => 1],
            'contain' => [
                'Users' => ['fields' => ['id', 'username', 'realname']],
                'Licenses' => ['fields' => ['id', 'name', 'icon']],
                'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
                'Projects' => ['fields' => ['id', 'name', 'ProjectsNotes.note_id']],
            ],
            'order' => ['created' => 'desc'],
            'sortWhitelist' => ['created', 'modified'],
        ];

        // Sfw condition
        if (!$this->request->session()->read('seeNSFW')) {
            $findOptions['conditions']['sfw'] = true;
        }

        // Other conditions:
        if (!is_null($filter)) {
            switch ($filter) {
                case 'language':
                    $findOptions['conditions']['Languages.id'] = $id;
                    break;
                case 'license':
                    $findOptions['conditions']['Licenses.id'] = $id;
                    break;
                case 'user':
                    $findOptions['conditions']['Users.id'] = $id;
                    break;
                default:
                    throw new \Cake\Network\Exception\NotFoundException;
            }
            // Get additionnal infos infos
            $modelName = \Cake\Utility\Inflector::camelize(\Cake\Utility\Inflector::pluralize($filter));
            $FilterModel = \Cake\ORM\TableRegistry::get($modelName);
            $filterData = $FilterModel->get($id);

            $this->set('filterData', $filterData);
        }
        $this->set('filter', $filter);
        $this->paginate = $findOptions;
        $this->set('notes', $this->paginate($this->Notes));
        $this->set('_serialize', ['notes']);
    }

    /**
     * View method
     *
     * @param string|null $id Note id.
     * @return \Cake\Network\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $note = $this->Notes->get($id, [
            'fields' => ['id', 'text', 'sfw', 'created', 'modified', 'user_id', 'license_id', 'language_id'],
            'contain' => [
                'Users' => ['fields' => ['id', 'username', 'realname']],
                'Licenses' => ['fields' => ['id', 'name', 'icon']],
                'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
                'Projects' => ['fields' => ['id', 'name', 'ProjectsNotes.note_id']],
            ],
            'conditions' => ['Notes.status' => 1],
        ]);

        // It will be great when i'll find a way to nicely handle exceptions/errors
        if (!$note->sfw && !$this->request->session()->read('seeNSFW')) {
            $this->set('title', __d('elabs', 'A note'));
            // And make a proper common error page
            $this->viewBuilder()->template('nsfw');
        } else {
            $this->set('note', $note);
            $this->set('_serialize', ['note']);
        }
    }
}
