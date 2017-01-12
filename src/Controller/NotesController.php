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
        $this->paginate['sortWhitelist'] = ['created', 'modified'];
        $query = $this->Notes->find('withContain', ['sfw' => !$this->seeNSFW]);

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
                case 'tag':
                    $query->matching('Tags', function ($q) use ($id) {
                        return $q->where(['Tags.id' => $id]);
                    });
                    break;
                default:
                    throw new NotFoundException;
            }

            // Get additionnal infos infos
            $modelName = Inflector::camelize(Inflector::pluralize($filter));
            $FilterModel = TableRegistry::get($modelName);
            $filterData = $FilterModel->getWithoutContain($id);

            $this->set('filterData', $filterData);
        }

        $notes = $this->paginate($query);

        $this->set('filter', $filter);
        $this->set('notes', $notes);
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
        $note = $this->Notes->getWithContain($id, ['sfw' => !$this->seeNSFW]);

        if (!$note->sfw && !$this->seeNSFW) {
            $this->set('title', __d('elabs', 'A note'));
            $this->viewBuilder()->template('nsfw');
        } else {
            $this->set('note', $note);
            $this->set('_serialize', ['note']);
        }
    }
}
