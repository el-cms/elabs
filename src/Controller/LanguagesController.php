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
        $seeNSFW = $this->request->session()->read('seeNSFW');
        $contains = [
            'Licenses' => ['fields' => ['id', 'name', 'icon', 'link']],
            'Languages' => ['fields' => ['id', 'iso639_1']],
            'Users' => ['fields' => ['id', 'username']]
        ];

        $query = $this->Languages->find();

        $query->select()
                ->where(['Languages.id' => $id])
                ->contain([
                    'Posts' => function ($q) use ($contains, $seeNSFW) {
                        $q = $q->select(['id', 'title', 'excerpt', 'modified', 'publication_date', 'sfw', 'user_id', 'license_id', 'language_id'])
                                ->where(['Posts.status' => STATUS_PUBLISHED])
                                ->contain($contains)
                                ->limit(Configure::read('cms.maxRelatedData'));
                        if (!$seeNSFW) {
                            $q = $q->where(['Posts.sfw' => true]);
                        }

                        return $q;
                    },
                    'Notes' => function ($q) use ($contains, $seeNSFW) {
                        $q = $q->select(['id', 'text', 'sfw', 'modified', 'created', 'user_id', 'license_id', 'language_id'])
                                ->where(['Notes.status' => STATUS_PUBLISHED])
                                ->contain($contains)
                                ->limit(Configure::read('cms.maxRelatedData'));
                        if (!$seeNSFW) {
                            $q = $q->where(['Notes.sfw' => true]);
                        }

                        return $q;
                    },
                    'Projects' => function ($q) use ($contains, $seeNSFW) {
                        $q = $q->select(['id', 'name', 'short_description', 'sfw', 'created', 'modified', 'user_id', 'license_id', 'language_id'])
                                ->where(['Projects.status' => STATUS_PUBLISHED])
                                ->contain($contains)
                                ->limit(Configure::read('cms.maxRelatedData'));
                        if (!$seeNSFW) {
                            $q = $q->where(['Projects.sfw' => true]);
                        }

                        return $q;
                    },
                    'Files' => function ($q) use ($contains, $seeNSFW) {
                        $q = $q->select(['id', 'name', 'description', 'filename', 'sfw', 'created', 'modified', 'user_id', 'license_id', 'language_id'])
                                ->where(['Files.status' => STATUS_PUBLISHED])
                                ->contain($contains)
                                ->limit(Configure::read('cms.maxRelatedData'));
                        if (!$seeNSFW) {
                            $q = $q->where(['Files.sfw' => true]);
                        }

                        return $q;
                    },
                    'Albums' => function ($q) use ($contains, $seeNSFW) {
                        $q = $q->select(['id', 'name', 'description', 'sfw', 'created', 'modified', 'user_id', 'language_id'])
                                ->where(['Albums.status' => STATUS_PUBLISHED])
                                ->contain([
                                    'Languages' => $contains['Languages'],
                                    'Users' => $contains['Users'],
                                    'Files' => function ($q) {
                                        return $q->select(['id', 'name', 'filename', 'sfw', 'created', 'modified', 'user_id', 'license_id', 'AlbumsFiles.album_id'])
                                                ->limit(Configure::read('cms.maxRelatedData'));
                                    }
                                ])
                                ->limit(Configure::read('cms.maxRelatedData'));
                        if (!$seeNSFW) {
                            $q = $q->where(['Albums.sfw' => true]);
                        }

                        return $q;
                    },
                ]);

        $language = $query->firstOrFail();
        $this->set('language', $language);
        $this->set('_serialize', ['language']);
    }
}
