<?php

namespace App\Controller;

use App\Model\Table\AlbumsTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Response;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;

/**
 * Albums Controller
 *
 * @property AlbumsTable $Albums
 */
class AlbumsController extends AppController
{

    /**
     * Index method
     *
     * @param string $filter Parameter to filter on
     * @param string $id Id of the model to filter
     *
     * @return Response|void
     */
    public function index($filter = null, $id = null)
    {
        // Pagination options
        $this->paginate['sortWhitelist'] = ['name', 'created', 'modified'];

        // Query
        $query = $this->Albums->find('withContain', ['sfw' => !$this->seeNSFW]);

        // Filter:
        if (!is_null($filter)) {
            switch ($filter) {
                case 'language':
                    $query->where(['Languages.id' => $id]);
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

            // Get additionnal infos
            $modelName = Inflector::camelize(Inflector::pluralize($filter));
            $FilterModel = TableRegistry::get($modelName);
            $filterData = $FilterModel->getWithoutContain($id);
            $this->set('filterData', $filterData);
        }
        $this->set('filter', $filter);
        $this->set('albums', $this->paginate($query));
        $this->set('_serialize', ['files']);
    }

    /**
     * View method
     *
     * @param string|null $id Album id.
     * @return Response|void
     * @throws RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sfw = !$this->seeNSFW;
        $album = $this->Albums->getWithContain($id, ['sfw' => $sfw]);

        //SFW state
        if (!$album->sfw && $sfw === true) {
            $this->set('name', $album->name);
            $this->viewBuilder()->template('nsfw');
        } else {
            $this->set('album', $album);
            $this->set('_serialize', ['album']);
        }
    }
}
