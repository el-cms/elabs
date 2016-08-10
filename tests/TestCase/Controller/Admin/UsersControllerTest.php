<?php

namespace App\Test\TestCase\Controller\Admin;

use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\Admin\UsersController Test Case
 */
class UsersControllerTest extends IntegrationTestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.languages', // Needed for some layout vars
        'app.users',
        'app.files',
        'app.notes',
        'app.posts',
        'app.projects',
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
     * Test for the Index function
     */
    public function testIndex(){
        // Set session data
        $this->session($this->userCreds['admin']);
        $this->get('/admin/users');

        // No error
        $this->assertResponseOk();
    }
    
    /**
     * Test for the View function
     */
    public function testView(){
        // Set session data
        $this->session($this->userCreds['admin']);
        $this->get('/admin/users/view/c5fba703-fd07-4a1c-b7b0-345a77106c32');

        // No error
        $this->assertResponseOk();

    }
    
    /**
     * Test for the Lock function
     */
    public function testLock(){
        $userPK='c5fba703-fd07-4a1c-b7b0-345a77106c32';
        $Users=\Cake\ORM\TableRegistry::get('Users');
        
        // Set session data
        $this->session($this->userCreds['admin']);

        // Lock
        // ----
        $this->get('admin/users/lock/'.$userPK.'/lock');
        // Verify state
        $nb=$Users->find('all', ['conditions'=>['id'=>$userPK, 'status'=>2]])->count();
        $this->assertEquals(1, $nb);
        $this->assertRedirect('admin/users');

        // Unlock
        // ------
        $this->get('admin/users/lock/'.$userPK.'/unlock');
        // Verify state
        $nb=$Users->find('all', ['conditions'=>['id'=>$userPK, 'status'=>1]])->count();
        $this->assertEquals(1, $nb);
        $this->assertRedirect('admin/users');

        // Test with a removed user
        $userPK='38bffe56-5406-4f18-a9d2-f3b2a59608a5';
        $this->get('admin/users/lock/'.$userPK.'/lock');
        // Verify state
        $this->assertResponseError();
    }
    
    /**
     * Test for the Close function
     */
    public function testClose(){
        $userPK='c5fba703-fd07-4a1c-b7b0-345a77106c32';
        $Users=\Cake\ORM\TableRegistry::get('Users');
        // Set session data
        $this->session($this->userCreds['admin']);
        $this->get('admin/users/close/'.$userPK);
        // Verify state
        $nb=$Users->find('all', ['conditions'=>['id'=>$userPK, 'status'=>3]])->count();
        $this->assertEquals(1, $nb);
        $this->assertRedirect('admin/users');

        // Test with a removed user
        $this->get('admin/users/close/'.$userPK.'/close');
        // Verify state
        $this->assertResponseError();
    }
    
    /**
     * Test for the Activate function
     */
    public function testActivate(){
        $userPK='e0b4c82b-3e99-4fe3-9b5f-dd71fac997e3';
        $Users=\Cake\ORM\TableRegistry::get('Users');
        // Set session data
        $this->session($this->userCreds['admin']);
        $this->get('admin/users/activate/'.$userPK);
        // Verify state
        $nb=$Users->find('all', ['conditions'=>['id'=>$userPK, 'status'=>1]])->count();
        $this->assertEquals(1, $nb);
        $this->assertRedirect('admin/users');

        // Test with an user for whom activation is not pending
        $userPK='c5fba703-fd07-4a1c-b7b0-345a77106c32';
        $this->get('admin/users/activate/'.$userPK.'/lock');
        // Verify state
        $this->assertResponseError();
    }

}
