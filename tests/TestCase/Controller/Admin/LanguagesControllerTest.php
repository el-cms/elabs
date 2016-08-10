<?php

namespace App\Test\TestCase\Controller\Admin;

use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\Admin\LanguagesController Test Case
 */
class LanguagesControllerTest extends IntegrationTestCase
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
     * Users credentials to put in session in order to create a fake authentication
     *
     * @var array
     */
    public $userCreds = [
        'admin' => ['Auth' => ['User' => ['id' => '70c8fff0-1338-48d2-b93b-942a26e4d685', 'email' => 'admin@example.com', 'username' => 'administrator', 'realname' => 'Administrator', 'website' => null, 'bio' => null, 'created' => null, 'modified' => null, 'role' => 'admin', 'see_nsfw' => true, 'status' => 1, 'file_count' => 3, 'note_count' => 0, 'post_count' => 1, 'project_count' => 3, 'preferences' => '{}']]],
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
        // Set session data
        $this->session($this->userCreds['admin']);
        $this->get('/admin/languages/delete/eng');

        $this->assertResponseFailure();
    }
}
