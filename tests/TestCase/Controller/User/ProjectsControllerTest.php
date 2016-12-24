<?php

namespace App\Test\TestCase\Controller\User;

use App\Test\TestCase\BaseTextCase;

/**
 * App\Controller\User\ProjectsController Test Case
 */
class ProjectsControllerTest extends BaseTextCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.projects',
        'app.languages', // Needed for some layout vars
        'app.licenses',
        'app.users',
        'app.acts',
    ];

    /**
     * Test Index action
     *
     * @return void
     */
    public function testIndex() //nsfw //status
    {
        // Set session data
        $this->session($this->userCreds['author']);

        // No filters
        // ----------
        $this->get('/user/projects');
        $nb = count($this->_controller->viewVars['projects']);
        $this->assertEquals(3, $nb, 'Test #1');
        $this->assertResponseOk();

        // Sfw filter
        // ----------
        // Sfw only
        $this->get('/user/projects/index/safe/all');
        $nb = count($this->_controller->viewVars['projects']);
        $this->assertEquals(2, $nb, 'Test #2');
        $this->assertResponseOk();

        // Unsafe only
        $this->get('/user/projects/index/unsafe/all');
        $nb = count($this->_controller->viewVars['projects']);
        $this->assertEquals(1, $nb, 'Test #3');
        $this->assertResponseOk();

        // Status filter
        // -------------
        // Locked
        $this->get('/user/projects/index/all/locked');
        $nb = count($this->_controller->viewVars['projects']);
        $this->assertEquals(0, $nb, 'Test #4');
        $this->assertResponseOk();
    }

    /**
     * Test add action
     *
     * @return void
     */
    public function testAdd()
    {
        // Set session data
        $this->session($this->userCreds['author']);
        $Project = \Cake\ORM\TableRegistry::get('Projects');

        // Form
        // ----
        $this->get('/user/projects/add');
        $this->assertResponseOk();

        // Addition
        // --------
        $nb = $Project->find()->count();
        $postData = [
            'name' => 'TEST PROJECT',
            'short_description' => 'This is a short thing !',
            'description' => 'This is longer.',
            'mainurl' => 'http://another-project.com',
            'sfw' => true,
            'status' => 1,
            'created' => '2016-08-09 00:46:17',
            'modified' => '2016-08-09 00:46:17',
            'license_id' => 1,
            'language_id' => 'eng'
        ];
        $this->post('/user/projects/add', $postData);
        // Count projects after insert
        $nb2 = $Project->find()->count();
        $this->assertEquals($nb + 1, $nb2, 'Test #1');
        // Redirection
        $this->assertRedirect('/user/projects');

        // As another user & acts insert
        $Acts = \Cake\ORM\TableRegistry::get('Acts');
        $nbActs = $Acts->find()->count();
        $postData = [
            'name' => 'TEST PROJECT AS ANOTHER USER',
            'short_description' => 'This is a short thing !',
            'description' => 'This is longer.',
            'mainurl' => 'http://another-project.com',
            'sfw' => true,
            'status' => 1,
            'created' => '2016-08-09 00:46:17',
            'modified' => '2016-08-09 00:46:17',
            'license_id' => 1,
            'user_id' => '70c8fff0-1338-48d2-b93b-942a26e4d685',
            'language_id' => 'eng'
        ];
        // Find the project for the current user
        $this->post('/user/projects/add', $postData);
        $nb = $Project->find('all', ['conditions' => ['user_id' => 'c5fba703-fd07-4a1c-b7b0-345a77106c32', 'name' => 'TEST PROJECT AS ANOTHER USER']])->count();
        $this->assertEquals(1, $nb, 'Test #2');
        // Acts
        $nbActs2 = $Acts->find()->count();
        $this->assertEquals($nbActs + 1, $nbActs2, 'Test #3');
        // Redirection
        $this->assertRedirect('/user/projects');
    }

    /**
     * Test edit action
     *
     * @return void
     */
    public function testEdit()
    {
        // Set session data
        // ----------------
        $this->session($this->userCreds['author']);
        $Projects = \Cake\ORM\TableRegistry::get('Projects');
        $Acts = \Cake\ORM\TableRegistry::get('Acts');
        // Not published, not safe
        $projectId = 'e5e2988e-2f1c-4902-ba1a-e0f577413f23';

        // Form
        // ----
        $this->get('/user/projects/edit/' . $projectId);
        $this->assertResponseOk();

        // Invalid Id
        // ----------
        $this->get('/user/projects/edit/ffffffff-2f1c-4902-ba1a-e0f577413f23');
        $this->assertResponseError();

        // Minor update
        // ------------
        $postData = [
            'name' => 'New name for this project',
            'status' => 1,
            'isMinor' => true
        ];
        $nbActs = $Acts->find()->count();
        $this->post('/user/projects/edit/' . $projectId, $postData);
        $nbActs2 = $Acts->find()->count();
        $this->assertEquals($nbActs, $nbActs2, 'Test #3');
        $this->assertRedirect('/user/projects');

        // Major update
        // ------------
        $postData = [
            'name' => 'New super name for this project',
            'status' => 1,
            'isMinor' => false
        ];
        $nbActs = $Acts->find()->count();
        $this->post('/user/projects/edit/' . $projectId, $postData);
        $nbActs2 = $Acts->find()->count();
        $this->assertEquals($nbActs + 1, $nbActs2, 'Test #4');
        $this->assertRedirect('/user/projects');
    }

    /**
     * Test delete action
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete();
    }
}
