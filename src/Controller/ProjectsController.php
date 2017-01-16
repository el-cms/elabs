<?php

namespace App\Controller;

use App\Model\Table\ProjectsTable;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;

/**
 * Projects Controller
 *
 * @property ProjectsTable $Projects
 */
class ProjectsController extends AppController
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
        $this->paginate['sortWhitelist'] = ['name', 'created', 'modified'];
        $query = $this->Projects->find('withContain', ['sfw' => !$this->seeNSFW]);

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
            $filterData = $FilterModel->getWithContain($id);

            $this->set('filterData', $filterData);
        }
        $this->set('filter', $filter);
        $this->set('projects', $this->paginate($query));
        $this->set('_serialize', ['projects']);
    }

    /**
     * View method
     *
     * @param string|null $id Project id.
     * @return void
     * @throws NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $project = $this->Projects->getWithContain($id, [
            'sfw' => !$this->seeNSFW,
            'withAlbums' => true,
            'withFiles' => true,
            'withNotes' => true,
            'withPosts' => true,
            ]);

        //SFW state
        if (!$project->sfw && !$this->seeNSFW) {
            $this->set('name', $project->name);
            $this->viewBuilder()->template('nsfw');
        } else {
            $this->set('project', $project);
            $this->set('_serialize', ['project']);
        }
    }
}
