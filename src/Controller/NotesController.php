<?php

namespace App\Controller;

use App\Model\Table\NotesTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Response;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;

/**
 * Notes Controller
 *
 * @property NotesTable $Notes
 */
class NotesController extends AppController
{

    /**
     * Index method
     *
     * @param string $filter Filter model name
     * @param string $id Foreign key
     *
     * @return Response|void
     */
    public function index($filter = null, $id = null)
    {
        $query = $this->Notes->find();

        $query->select(['id', 'text', 'sfw', 'created', 'modified', 'user_id', 'license_id', 'language_id'])
                ->where(['Notes.status' => STATUS_PUBLISHED])
                ->contain([
                    'Users' => ['fields' => ['id', 'username', 'realname']],
                    'Licenses' => ['fields' => ['id', 'name', 'icon']],
                    'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
                    'Projects' => ['fields' => ['id', 'name', 'ProjectsNotes.note_id']],
                ])
                ->order(['Notes.created' => 'desc']);

        // Sfw condition
        if (!$this->request->session()->read('seeNSFW')) {
            $query->where(['sfw' => true]);
        }

        // Other conditions:
        if (!is_null($filter)) {
            switch ($filter) {
                case 'language':
                    $query->where(['Languages.id' => $id]);
                    break;
                case 'license':
                    $query->where(['Licenses.id' => $id]);
                    break;
                case 'user':
                    $query->where(['Users.id' => $id]);
                    break;
                case 'project':
                    $query->matching('Projects', function ($q) use ($id) {
                        return $q->where(['Projects.id' => $id]);
                    });
                    break;
                default:
                    throw new NotFoundException;
            }

            // Get additionnal infos infos
            $modelName = Inflector::camelize(Inflector::pluralize($filter));
            $FilterModel = TableRegistry::get($modelName);
            $filterData = $FilterModel->get($id);

            $this->set('filterData', $filterData);
        }

        $notes = $this->paginate($query);

        $this->set('filter', $filter);
        $this->set('notes', $notes); //$this->paginate($this->Notes));
        $this->set('_serialize', ['notes']);
    }

    /**
     * View method
     *
     * @param string|null $id Note id.
     * @return Response|void
     * @throws RecordNotFoundException When record not found.
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
            'conditions' => ['Notes.status' => STATUS_PUBLISHED],
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
