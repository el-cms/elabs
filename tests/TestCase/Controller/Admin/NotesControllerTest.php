<?php

namespace App\Test\TestCase\Controller\Admin;

use App\Test\TestCase\BaseTextCase;

/**
 * App\Controller\Admin\NotesController Test Case
 */
class NotesControllerTest extends BaseTextCase
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
        'app.acts'
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
        $notePk = 'c5fba703-fd07-4a1c-b7b0-345a76c36c32';
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
        $notePk = 'c5fba703-fd07-4a1c-b7b0-345a76c36c32';
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
    }
}
