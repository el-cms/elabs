<?php

namespace App\Controller;

use App\Model\Table\PostsTable;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;

/**
 * Posts Controller
 *
 * @property PostsTable $Posts
 */
class PostsController extends AppController
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
        $query = $this->Posts->find();
        $query->select(['id', 'title', 'excerpt', 'sfw', 'modified', 'publication_date', 'user_id', 'license_id', 'language_id'])
                ->where(['Posts.status' => STATUS_PUBLISHED])
                ->contain([
                    'Users' => ['fields' => ['id', 'username', 'realname']],
                    'Licenses' => ['fields' => ['id', 'name', 'icon']],
                    'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
                    'Projects' => ['fields' => ['id', 'name', 'ProjectsPosts.post_id']],
                ])
                ->order(['publication_date' => 'desc']);

        // Sfw condition
        if (!$this->request->session()->read('seeNSFW')) {
            $query->where(['Posts.sfw' => true]);
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
        $this->set('posts', $this->paginate($query));
        $this->set('_serialize', ['posts']);
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return void
     * @throws NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => [
                'Users' => ['fields' => ['id', 'username', 'realname']],
                'Licenses' => ['fields' => ['id', 'name', 'icon']],
                'Languages' => ['fields' => ['id', 'name', 'iso639_1']],
                'Projects' => ['fields' => ['id', 'name', 'ProjectsPosts.post_id']],
            ],
            'conditions' => ['Posts.status' => STATUS_PUBLISHED],
        ]);

        // It will be great when i'll find a way to nicely handle exceptions/errors
        if (!$post->sfw && !$this->request->session()->read('seeNSFW')) {
            $this->set('title', $post->title);
            // And make a proper common error page
            $this->viewBuilder()->template('nsfw');
        } else {
            $this->set('post', $post);
            $this->set('_serialize', ['post']);
        }
    }
}
