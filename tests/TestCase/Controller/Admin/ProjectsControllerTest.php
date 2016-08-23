<?php

namespace App\Test\TestCase\Controller\Admin;

use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\Admin\ProjectsController Test Case
 */
class ProjectsControllerTest extends IntegrationTestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.languages', // Needed for some layout vars
        'app.projects',
        // Relations
        'app.acts',
        'app.languages',
        'app.licenses',
        'app.users',
    ];

    /**
     * Users credentials to put in session in order to create a fake authentication
     *
     * @var array
     */
    public $userCreds = [
        'admin' => ['Auth' => ['User' => ['id' => '70c8fff0-1338-48d2-b93b-942a26e4d685', 'email' => 'admin@example.com', 'username' => 'administrator', 'realname' => 'Administrator', 'website' => null, 'bio' => null, 'created' => null, 'modified' => null, 'role' => 'admin', 'status' => 1, 'file_count' => 3, 'note_count' => 0, 'post_count' => 1, 'project_count' => 3, 'preferences' => '{}']]],
    ];

    /**
     * Tests the index function
     */
    public function testIndex()
    {
        // Set session data
        $this->session($this->userCreds['admin']);
        $this->get('/admin/projects');

        // No error
        $this->assertResponseOk();
    }

    /**
     * Tests the view function
     */
    public function testView()
    {
        // Set session data
        $this->session($this->userCreds['admin']);
        $this->get('/admin/projects/view/47a35a14-62ac-4f68-b617-01fea96ffa30');

        // No error
        $this->assertResponseOk();
    }

    /**
     * Tests the changeState function
     */
    public function testChangeStateToLocked()
    {
        $projectPk = '47a35a14-62ac-4f68-b617-01fea96ffa30';
        $Projects = \Cake\ORM\TableRegistry::get('Projects');

        // Set session data
        $this->session($this->userCreds['admin']);

        // Lock
        // ----
        $this->get('/admin/projects/change_state/' . $projectPk . '/lock');
        // Checks the new state
        $nb = $Projects->find('all', ['conditions' => ['id' => $projectPk, 'status' => 2]])->count();
        $this->assertEquals(1, $nb, 'Project cannot be locked');
        // No error
        $this->assertRedirect('/admin/projects');

        // Unlock
        // ------
        $this->get('/admin/projects/change_state/' . $projectPk . '/unlock');
        // Checks the new state
        $nb = $Projects->find('all', ['conditions' => ['id' => $projectPk, 'status' => 1]])->count();
        $this->assertEquals(1, $nb, 'Project cannot be unlocked');
        // No error
        $this->assertRedirect('/admin/projects');

        // Remove
        // ------
        $this->get('/admin/projects/change_state/' . $projectPk . '/remove');
        // Checks the new state
        $nb = $Projects->find('all', ['conditions' => ['id' => $projectPk, 'status' => 3]])->count();
        $this->assertEquals(1, $nb, 'Project cannot be removed');
        // No error
        $this->assertRedirect('/admin/projects');

        // Unlock again (should be impossible)
        // ------------
        $this->get('/admin/projects/change_state/' . $projectPk . '/lock');
        // Checks the new state
        $nb = $Projects->find('all', ['conditions' => ['id' => $projectPk, 'status' => 2]])->count();
        $this->assertEquals(0, $nb, 'Removed project was unlocked');

        // Error
        $this->assertResponseError();

        // Ajax
        $this->markTestIncomplete('Missing ajax test');
    }
}
