<?php

namespace App\Test\TestCase\Controller\Admin;

use App\Test\TestCase\BaseTextCase;

/**
 * App\Controller\Admin\LicensesController Test Case
 */
class LicensesControllerTest extends BaseTextCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.languages', // For the layout
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
        $this->get('/admin/licenses');

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
        $Licenses = \Cake\ORM\TableRegistry::get('Licenses');

        // Insertions
        // ----------
        // Count licenses before insert
        $nb = $Licenses->find()->count();
        $postData = [
            'name' => 'Test_License',
            'link' => 'http://some_url',
            'icon' => 'creative-commons',
        ];
        $this->post('/admin/licenses/add', $postData);
        // Count posts after insert
        $nb2 = $Licenses->find()->count();
        $this->assertEquals($nb + 1, $nb2);
        // Redirection
        $this->assertRedirect('/admin/licenses');

        // Form
        // ----
        $this->get('/admin/licenses/add');
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
        $Languages = \Cake\ORM\TableRegistry::get('Licenses');

        // Edition
        // -------
        $postData = [
            'name' => 'new name',
            'link' => 'http://creativecommons.org/licenses/by/',
            'icon' => 'creative-commons',
        ];
        $this->post('/admin/licenses/edit/1', $postData);
        $nb = $Languages->find('all', ['conditions' => ['id' => 1, 'name' => 'new name']])->count();
        $this->assertEquals(1, $nb);
        // Redirection
        $this->assertRedirect('/admin/licenses');

        // Form
        // ----
        $this->get('/admin/licenses/edit/1');
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

        $this->post('/admin/licenses/delete/1');

        $this->assertResponseFailure();
    }
}
