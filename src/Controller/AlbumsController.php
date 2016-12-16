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
        $query = $this->Albums->find();
        $query->select(['id', 'name', 'description', 'created', 'modified', 'sfw', 'status', 'user_id'])
                ->where(['Albums.status' => STATUS_PUBLISHED])
                ->contain([
                    'Users' => ['fields' => ['id', 'username', 'realname']],
                    'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
                    'Projects' => ['fields' => ['id', 'name', 'ProjectsAlbums.album_id']],
                    'Files' => [
                        'fields' => ['id', 'name', 'filename', 'sfw', 'AlbumsFiles.album_id'],
                        'conditions' => [
                            'status' => STATUS_PUBLISHED,
                        ],
                    ],
                ])
                ->order(['Albums.created' => 'desc']);

        // Sfw condition
        if (!$this->request->session()->read('seeNSFW')) {
            $query->where(['Albums.sfw' => true]);
        }

        // Other conditions:
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
        $album = $this->Albums->get($id, [
            'contain' => ['Users', 'Languages', 'Files', 'Projects']
        ]);

        //SFW state
        if (!$album->sfw && !$this->request->session()->read('seeNSFW')) {
            $this->set('name', $album->name);
            $this->viewBuilder()->template('nsfw');
        } else {
            $this->set('album', $album);
            $this->set('_serialize', ['album']);
        }
    }
}
