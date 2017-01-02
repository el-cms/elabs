<?php

namespace App\Test\TestCase\Controller\User;

use App\Test\TestCase\BaseTextCase;

/**
 * App\Controller\User\NotesController Test Case
 */
class NotesControllerTest extends BaseTextCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.notes',
        'app.languages', // Needed for some layout vars
        'app.licenses',
        'app.users',
        'app.acts',
        'app.projects',
        'app.projects_notes',
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
        $this->get('/user/notes');
        $nb = count($this->_controller->viewVars['notes']);
        $this->assertEquals(4, $nb, 'Test #1');
        $this->assertResponseOk();

        // Sfw filter
        // ----------
        // Sfw only
        $this->get('/user/notes/index/safe/all');
        $nb = count($this->_controller->viewVars['notes']);
        $this->assertEquals(3, $nb, 'Test #2');
        $this->assertResponseOk();

        // Unsafe only
        $this->get('/user/notes/index/unsafe/all');
        $nb = count($this->_controller->viewVars['notes']);
        $this->assertEquals(1, $nb, 'Test #3');
        $this->assertResponseOk();

        // Status filter
        // ------------
        // Locked
        $this->get('/user/notes/index/all/locked');
        $nb = count($this->_controller->viewVars['notes']);
        $this->assertEquals(1, $nb, 'Test #4');
        $this->assertResponseOk();
    }

    /**
     * Test add action
     *
     * @return void
     */
    public function testAdd()
    {
        // Enable CSRF related mocks
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        // Set session data
        $this->session($this->userCreds['author']);
        $Notes = \Cake\ORM\TableRegistry::get('Notes');

        // Form
        // ----
        $this->get('/user/notes/add');
        $this->assertResponseOk();

        // Addition
        // --------
        $nb = $Notes->find()->count();
        $postData = [
            'text' => 'TEST POST FOR TESTS',
            'sfw' => true,
            'status' => 0,
            'license_id' => 1,
            'language_id' => 'eng'
        ];
        $this->post('/user/notes/add', $postData);
        // Count notes after insert
        $nb2 = $Notes->find()->count();
        $this->assertEquals($nb + 1, $nb2, 'Test #1');
        // Redirection
        $this->assertRedirect('/user/notes');

        // As another user & acts insert
        $Acts = \Cake\ORM\TableRegistry::get('Acts');
        $nbActs = $Acts->find()->count();
        $postData = [
            'text' => 'TEST POST AS ANOTHER USER',
            'user_id' => '70c8fff0-1338-48d2-b93b-942a26e4d685',
            'sfw' => true,
            'status' => 1,
            'license_id' => 1,
            'language_id' => 'eng'
        ];
        // Find the note for the current user
        $this->post('/user/notes/add', $postData);
        $nb = $Notes->find('all', ['conditions' => ['user_id' => 'c5fba703-fd07-4a1c-b7b0-345a77106c32', 'text' => 'TEST POST AS ANOTHER USER']])->count();
        $this->assertEquals(1, $nb, 'Test #2');
        // Acts
        $nbActs2 = $Acts->find()->count();
        $this->assertEquals($nbActs + 1, $nbActs2, 'Test #3');
        // Redirection
        $this->assertRedirect('/user/notes');
    }

    /**
     * Test edit action
     *
     * @return void
     */
    public function testEdit()
    {
        // Enable CSRF related mocks
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        // Set session data
        $this->session($this->userCreds['author']);
        $Notes = \Cake\ORM\TableRegistry::get('Notes');
        $Acts = \Cake\ORM\TableRegistry::get('Acts');
        // Not published, not safe
        $noteId = 'c5fba703-fd07-4a1c-b7b0-345a76c36c31';

        // Form
        // ----
        $this->get('/user/notes/edit/' . $noteId);
        $this->assertResponseOk();

        // Invalid Id
        // ----------
        $this->get('/user/notes/edit/70c8fff0-1338-48d2-b93b-942a26eddddd');
        $this->assertResponseError();

        // Minor update with status force
        // ------------------------------
        $nbActs = $Acts->find()->count();
        $postData = [
            'text' => 'New text for this note',
            'status' => 0,
            'isMinor' => true
        ];
        $this->post('/user/notes/edit/' . $noteId, $postData);
        $nb = $Notes->find('all', ['conditions' => ['id' => $noteId, 'status' => 1, 'text' => 'New text for this note']])->count();
        $nbActs2 = $Acts->find()->count();
        $this->assertEquals(1, $nb, 'Test #1');
        $this->assertEquals($nbActs, $nbActs2, 'Test #2');
        $this->assertRedirect('/user/notes');

        // Major, draft to publication
        // ---------------------------
        $postData = [
            'text' => 'New text for this note',
            'isMinor' => false
        ];
        $nbActs = $Acts->find()->count();
        $this->post('/user/notes/edit/' . $noteId, $postData);
        $nbActs2 = $Acts->find()->count();
        $this->assertEquals($nbActs + 1, $nbActs2, 'Test #3');
        $this->assertRedirect('/user/notes');
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
