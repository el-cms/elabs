<?php

namespace App\Test\TestCase\Controller\Admin;

use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\Admin\FilesController Test Case
 */
class FilesControllerTest extends IntegrationTestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.languages', // Needed for some layout vars
        'app.files',
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
        $this->get('/admin/files');

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
        $this->get('/admin/files/view/4aa59eb5-35c6-42c1-91e2-f8c6a6cb8539');

        // No error
        $this->assertResponseOk();
    }

    /**
     * Tests the changeState function
     */
    public function testChangeStateToLocked()
    {
        $filePk = '4aa59eb5-35c6-42c1-91e2-f8c6a6cb8539';
        $Files = \Cake\ORM\TableRegistry::get('Files');

        // Set session data
        $this->session($this->userCreds['admin']);

        // Lock
        // ----
        $this->get('/admin/files/change_state/' . $filePk . '/lock');
        // Checks the new state
        $nb = $Files->find('all', ['conditions' => ['id' => $filePk, 'status' => 2]])->count();
        $this->assertEquals(1, $nb, 'File cannot be locked');
        // No error
        $this->assertRedirect('/admin/files');

        // Unlock
        // ------
        $this->get('/admin/files/change_state/' . $filePk . '/unlock');
        // Checks the new state
        $nb = $Files->find('all', ['conditions' => ['id' => $filePk, 'status' => 1]])->count();
        $this->assertEquals(1, $nb, 'File cannot be unlocked');
        // No error
        $this->assertRedirect('/admin/files');

        // Remove
        // ------
        $this->get('/admin/files/change_state/' . $filePk . '/remove');
        // Checks the new state
        $nb = $Files->find('all', ['conditions' => ['id' => $filePk, 'status' => 3]])->count();
        $this->assertEquals(1, $nb, 'File cannot be removed');
        // No error
        $this->assertRedirect('/admin/files');

        // Unlock again (should be impossible)
        // ------------
        $this->get('/admin/files/change_state/' . $filePk . '/lock');
        // Checks the new state
        $nb = $Files->find('all', ['conditions' => ['id' => $filePk, 'status' => 2]])->count();
        $this->assertEquals(0, $nb, 'Removed file was unlocked');

        // Error
        $this->assertResponseError();

        // Ajax
        $this->markTestIncomplete('Missing ajax test');
    }
}
