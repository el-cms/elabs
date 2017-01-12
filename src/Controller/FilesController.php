<?php

namespace App\Controller;

use App\Model\Table\FilesTable;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Response;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;

/**
 * Files Controller
 *
 * @property FilesTable $Files
 */
class FilesController extends AppController
{

    /**
     * Index method
     *
     * @param string $filter Filter name
     * @param mixed $id Id to filter on
     *
     * @return void
     */
    public function index($filter = null, $id = null)
    {
        // Pagination options
        $this->paginate['sortWhitelist'] = ['name', 'created', 'modified'];

        // Query
        $query = $this->Files->find('withContain', ['sfw' => !$this->seeNSFW]);

        // Filters:
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

        $this->set('filter', $filter);
        $this->set('files', $this->paginate($query));
        $this->set('_serialize', ['files']);
    }

    /**
     * View method
     *
     * @param string|null $id File id.
     * @return void
     * @throws NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $file = $this->Files->getWithContain($id, ['sfw' => !$this->seeNSFW]);

        if (!$file->sfw && !$this->seeNSFW) {
            $this->set('name', $file->name);
            $this->viewBuilder()->template('nsfw');
        } else {
            $this->set('file', $file);
            $this->set('_serialize', ['file']);
        }
    }

    /**
     * Forces user to download the file
     * @param int $id File id
     *
     * @return Response
     */
    public function download($id)
    {
        $file = $this->Files->get($id, ['fields' => ['id', 'filename', 'name']]);
        $this->response->file('uploads/' . $file['filename'], ['download' => true, 'name' => $file['name']]);

        // Return response object to prevent controller from trying to render a view.
        return $this->response;
    }
}
