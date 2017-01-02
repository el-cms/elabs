<?php

namespace App\Controller;

use App\Model\Table\LicensesTable;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;

/**
 * Licenses Controller
 *
 * @property LicensesTable $Licenses
 */
class LicensesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'sortWhiteList' => ['name', 'post_count', 'project_count', 'file_count'],
            'order' => ['name' => 'asc']
        ];
        $this->set('licenses', $this->paginate($this->Licenses));
        $this->set('_serialize', ['licenses']);
    }

    /**
     * View method
     *
     * @param string|null $id License id.
     * @return void
     * @throws NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $seeNSFW = $this->request->session()->read('seeNSFW');
        $contains = [
            'Languages' => ['fields' => ['id', 'iso639_1', 'name']],
            'Users' => ['fields' => ['id', 'username']]
        ];
        $query = $this->Licenses->find();
        $query->select()
                ->where(['Licenses.id' => $id])
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
                ]);

        $license = $query->firstOrFail();
        $this->set('license', $license);
        $this->set('_serialize', ['license']);
    }
}
