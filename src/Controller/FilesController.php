<?php

namespace App\Controller;

use App\Controller\AppController;
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
        $query = $this->Files->find();
        $query->select(['id', 'name', 'filename', 'weight', 'description', 'created', 'modified', 'sfw', 'status', 'user_id', 'license_id', 'mime'])
                ->where(['Files.status' => STATUS_PUBLISHED])
                ->contain([
                    'Users' => ['fields' => ['id', 'username', 'realname']],
                    'Licenses' => ['fields' => ['id', 'name', 'icon']],
                    'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
                    'Projects' => ['fields' => ['id', 'name', 'ProjectsFiles.file_id']],
                    'Albums' => ['fields' => ['id', 'name', 'AlbumsFiles.file_id']],
                ])
                ->order(['Files.created' => 'desc']);

        // Sfw condition
        if (!$this->request->session()->read('seeNSFW')) {
            $query->where(['Files.sfw' => true]);
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
        $file = $this->Files->get($id, [
            'contain' => [
                'Users' => ['fields' => ['id', 'username', 'realname']],
                'Licenses',
                'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
                'Projects' => ['fields' => ['id', 'name', 'ProjectsFiles.file_id']],
                'Albums' => ['fields' => ['id', 'name', 'AlbumsFiles.file_id']],
            ]
        ]);
        // It will be great when i'll find a way to nicely handle exceptions/errors
        if (!$file->sfw && !$this->request->session()->read('seeNSFW')) {
            $this->set('name', $file->name);
            // And make a proper common error page
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
        $file = $this->Files->get($id);
        $this->response->file('uploads/' . $file['filename'], ['download' => true, 'name' => $file['name']]);

        // Return response object to prevent controller from trying to render a view.
        return $this->response;
    }
}
