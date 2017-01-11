<?php

namespace App\Controller;

use App\Model\Table\LanguagesTable;
use Cake\Core\Configure;
use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * Languages Controller
 *
 * @property LanguagesTable $Languages
 */
class LanguagesController extends AppController
{

    /**
     * Index method
     *
     * @param string $filter Filter to apply to the query
     *
     * @return void
     */
    public function index($filter = 'hideEmpties')
    {
        // Paginate options:
        $this->paginate = [
            'order' => ['name' => 'asc'],
            'sortWhitelist' => ['name', 'album_count', 'file_count', 'note_count', 'post_count', 'project_count']
                ] + $this->paginate;

        // Query
        $query = $this->Languages->find();

        // Filters
        if ($filter === 'hideEmpties') {
            $query->where([
                ['OR' =>
                    [
                        'album_count >' => '0',
                        'file_count >' => '0',
                        'note_count >' => '0',
                        'post_count >' => '0',
                        'project_count >' => '0',
                    ]
                ]
            ]);
        }

        $languages = $this->paginate($query);
        $this->set(compact('languages', 'filter'));
        $this->set('_serialize', ['languages']);
    }

    /**
     * View method
     *
     * @param string|null $id Language id.
     * @return void
     * @throws RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $query = $this->Languages->getWithContain($id, ['sfw' => !$this->seeNSFW]);

        $this->set('language', $query);
        $this->set('_serialize', ['language']);
    }
}
