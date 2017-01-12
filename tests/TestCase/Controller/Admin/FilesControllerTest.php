<?php

namespace App\Test\TestCase\Controller\Admin;

use App\Test\TestCase\BaseTextCase;

/**
 * App\Controller\Admin\FilesController Test Case
 */
class FilesControllerTest extends BaseTextCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.acts',
        'app.albums',
        'app.albums_files',
        'app.files',
        'app.files_tags',
        'app.languages', // Needed for some layout vars
        'app.languages',
        'app.licenses',
        'app.projects',
        'app.projects_files',
        'app.tags',
        'app.users',
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
    }
}
