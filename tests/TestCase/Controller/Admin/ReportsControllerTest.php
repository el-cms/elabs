<?php

namespace App\Test\TestCase\Controller\Admin;

use App\Test\TestCase\BaseTextCase;

/**
 * App\Controller\Admin\ReportsController Test Case
 */
class ReportsControllerTest extends BaseTextCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.languages', // Needed for some layout vars
        'app.reports',
        'app.users',
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
        $this->get('/admin/reports');

        $this->assertResponseOk();
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testView()
    {
        // Set session data
        $this->session($this->userCreds['admin']);
        $this->get('/admin/reports/view/1');

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

        // Count items
        $Reports = \Cake\ORM\TableRegistry::get('Reports');
        $nb = $Reports->find()->count();
        $this->post('/admin/reports/delete/1');
        $nb2 = $Reports->find()->count();
        $this->assertEquals($nb - 1, $nb2);

        $this->assertRedirect('/admin/reports');
    }
}
