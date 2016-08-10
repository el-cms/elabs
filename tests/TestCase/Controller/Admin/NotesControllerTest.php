<?php

namespace App\Test\TestCase\Controller\Admin;

use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\Admin\NotesController Test Case
 */
class NotesControllerTest extends IntegrationTestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.languages', // Needed for some layout vars
        'app.licenses',
        'app.notes',
        'app.users',
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
     * Tests the index function
     */
    public function testIndex()
    {
        // Set session data
        $this->session($this->userCreds['admin']);
        $this->get('/admin/notes');

        // No error
        $this->assertResponseOk();
    }

    /**
     * Tests the view function
     */
    public function testView()
    {
        $this->markTestIncomplete('Missing fixtures');
        $notePk = '';
        // Set session data
        $this->session($this->userCreds['admin']);
        $this->get('/admin/notes/view/' . $notePk);

        // No error
        $this->assertResponseOk();
    }

    /**
     * Tests the changeState function
     */
    public function testChangeStateToLocked()
    {
        $this->markTestIncomplete('Missing fixtures');
        $notePk = '';
        $Notes = \Cake\ORM\TableRegistry::get('Notes');

        // Set session data
        $this->session($this->userCreds['admin']);

        // Lock
        // ----
        $this->get('/admin/notes/change_state/' . $notePk . '/lock');
        // Checks the new state
        $nb = $Notes->find('all', ['conditions' => ['id' => $notePk, 'status' => 2]])->count();
        $this->assertEquals(1, $nb, 'Note cannot be locked');
        // No error
        $this->assertRedirect('/admin/notes');

        // Unlock
        // ------
        $this->get('/admin/notes/change_state/' . $notePk . '/unlock');
        // Checks the new state
        $nb = $Notes->find('all', ['conditions' => ['id' => $notePk, 'status' => 1]])->count();
        $this->assertEquals(1, $nb, 'Note cannot be unlocked');
        // No error
        $this->assertRedirect('/admin/notes');

        // Remove
        // ------
        $this->get('/admin/notes/change_state/' . $notePk . '/remove');
        // Checks the new state
        $nb = $Notes->find('all', ['conditions' => ['id' => $notePk, 'status' => 3]])->count();
        $this->assertEquals(1, $nb, 'Note cannot be removed');
        // No error
        $this->assertRedirect('/admin/notes');

        // Unlock again (should be impossible)
        // ------------
        $this->get('/admin/notes/change_state/' . $notePk . '/lock');
        // Checks the new state
        $nb = $Notes->find('all', ['conditions' => ['id' => $notePk, 'status' => 2]])->count();
        $this->assertEquals(0, $nb, 'Removed note was unlocked');

        // Error
        $this->assertResponseError();

        // Ajax
        $this->markTestIncomplete('Missing ajax test');
    }
}
