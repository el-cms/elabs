<?php

namespace App\Test\TestCase\Controller\Admin;

use App\Test\TestCase\BaseTextCase;

/**
 * App\Controller\Admin\LanguagesController Test Case
 */
class LanguagesControllerTest extends BaseTextCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.languages',
        'app.files',
        'app.licenses',
        'app.posts',
        'app.users',
        'app.notes',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        // Set session data
        $this->session($this->userCreds['admin']);
        $this->get('/admin/languages');

        $this->assertResponseOk();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        // Enable CSRF related mocks
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        // Set session data
        $this->session($this->userCreds['admin']);
        $Languages = \Cake\ORM\TableRegistry::get('Languages');

        // Insertions
        // ----------
        // Count posts before insert
        $nb = $Languages->find()->count();
        $postData = [
            'id' => 'zzz',
            'iso639_1' => 'zz',
            'name' => 'Zzzz',
            'has_site_translation' => false,
            'translation_folder' => null,
        ];
        $this->post('/admin/languages/add', $postData);
        // Count posts after insert
        $nb2 = $Languages->find()->count();
        $this->assertEquals($nb + 1, $nb2);
        // Redirection
        $this->assertRedirect('/admin/languages');

        // Form
        // ----
        $this->get('/admin/languages/add');
        $this->assertResponseOk();
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testEdit()
    {
        // Enable CSRF related mocks
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        // Set session data
        $this->session($this->userCreds['admin']);
        $Languages = \Cake\ORM\TableRegistry::get('Languages');

        // Edition
        // -------
        $postData = [
            'iso639_1' => 'zz',
            'name' => 'Zzzz',
            'has_site_translation' => false,
            'translation_folder' => null,
        ];
        $this->post('/admin/languages/edit/eng', $postData);
        $nb = $Languages->find('all', ['conditions' => ['id' => 'eng', 'iso639_1' => 'zz']])->count();
        $this->assertEquals(1, $nb);
        // Redirection
        $this->assertRedirect('/admin/languages');

        // Form
        // ----
        $this->get('/admin/languages/edit/eng');
        $this->assertResponseOk();
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testDelete()
    {
        // Enable CSRF related mocks
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        
        // Set session data
        $this->session($this->userCreds['admin']);

        $this->post('/admin/languages/delete/eng');

        $this->assertResponseFailure();
    }
}
