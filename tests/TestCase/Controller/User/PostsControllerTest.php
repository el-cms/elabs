<?php

namespace App\Test\TestCase\Controller\User;

use App\Test\TestCase\BaseTextCase;

/**
 * App\Controller\User\PostsController Test Case
 */
class PostsControllerTest extends BaseTextCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.acts',
        'app.languages', // Needed for some layout vars
        'app.licenses',
        'app.posts',
        'app.posts_tags',
        'app.projects',
        'app.projects_posts',
        'app.tags',
        'app.users',
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
        $this->get('/user/posts');
        $nb = count($this->_controller->viewVars['posts']);
        $this->assertEquals(6, $nb, 'Test #1');
        $this->assertResponseOk();

        // Sfw filter
        // ----------
        // Sfw only
        $this->get('/user/posts/index/safe/all');
        $nb = count($this->_controller->viewVars['posts']);
        $this->assertEquals(2, $nb, 'Test #2');
        $this->assertResponseOk();

        // Unsafe only
        $this->get('/user/posts/index/unsafe/all');
        $nb = count($this->_controller->viewVars['posts']);
        $this->assertEquals(4, $nb, 'Test #3');
        $this->assertResponseOk();

        // Status filter
        // -------------
        // Drafts only
        $this->get('/user/posts/index/all/drafts');
        $nb = count($this->_controller->viewVars['posts']);
        $this->assertEquals(2, $nb, 'Test #4');
        $this->assertResponseOk();

        // Published
        $this->get('/user/posts/index/all/published');
        $nb = count($this->_controller->viewVars['posts']);
        $this->assertEquals(2, $nb, 'Test #5');
        $this->assertResponseOk();

        // Locked
        $this->get('/user/posts/index/all/locked');
        $nb = count($this->_controller->viewVars['posts']);
        $this->assertEquals(1, $nb, 'Test #6');
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
        $currentUserId = $this->userCreds['author']['Auth']['User']['id'];
        $Posts = \Cake\ORM\TableRegistry::get('Posts');

        // Form
        // ----
        $this->get('/user/posts/add');
        $this->assertResponseOk();

        // Addition
        // --------
        $nb = $Posts->find()->count();
        $postData = [
            'title' => 'TEST POST FOR TESTS',
            'excerpt' => '__SFW__ and published',
            'text' => 'Some text',
            'sfw' => true,
            'status' => 0,
            'license_id' => 1,
            'language_id' => 'eng',
            'hide_from_acts' => 0,
        ];
        $this->post('/user/posts/add', $postData);
        // Count posts after insert
        $nb2 = $Posts->find()->count();
        $this->assertEquals($nb + 1, $nb2, 'Test #1');
        // Redirection
        $this->assertRedirect('/user/posts');

        // As another user & acts insert
        $Acts = \Cake\ORM\TableRegistry::get('Acts');
        $nbActs = $Acts->find()->count();
        $postData = [
            'title' => 'TEST POST AS ANOTHER USER',
            'excerpt' => '__SFW__ and published',
            'text' => 'Some text',
            'user_id' => '70c8fff0-1338-48d2-b93b-942a26e4d685',
            'sfw' => true,
            'status' => 1,
            'license_id' => 1,
            'language_id' => 'eng',
            'hide_from_acts' => 0,
        ];
        // Find the post for the current user
        $this->post('/user/posts/add', $postData);
        $nb = $Posts->find('all', ['conditions' => ['user_id' => $currentUserId, 'title' => 'TEST POST AS ANOTHER USER']])->count();
        $this->assertEquals(1, $nb, 'Test #2');
        // Acts
        $nbActs2 = $Acts->find()->count();
        $this->assertEquals($nbActs + 1, $nbActs2, 'Test #3');
        // Redirection
        $this->assertRedirect('/user/posts');
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
        $Posts = \Cake\ORM\TableRegistry::get('Posts');
        $Acts = \Cake\ORM\TableRegistry::get('Acts');

        // Not published, not safe
        $postId = 'fffe1c4a-6edc-4a2b-aaf5-457a3151a13c';

        // Form
        // ----
        $this->get('/user/posts/edit/' . $postId);
        $this->assertResponseOk();

        // Invalid Id
        // ----------
        $this->get('/user/posts/edit/a2e76afd-4624-44a5-b07c-1560f9e7fcec');
        $this->assertResponseError();

        // Minor update
        // ------------
        $nbActs = $Acts->find()->count();
        $postData = [
            'title' => 'New title for this post',
            'status' => 0,
            'isMinor' => true
        ];
        $this->post('/user/posts/edit/' . $postId, $postData);
        $nb = $Posts->find('all', ['conditions' => ['id' => $postId, 'title' => 'New title for this post']])->count();
        $nbActs2 = $Acts->find()->count();
        $this->assertEquals(1, $nb, 'Test #1');
        $this->assertEquals($nbActs, $nbActs2, 'Test #2');
        $this->assertRedirect('/user/posts');

        // Minor, draft to publication
        // ---------------------------
        $postData = [
            'title' => 'New title for this post',
            'status' => 1,
            'isMinor' => true
        ];
        $nbActs = $Acts->find()->count();
        $this->post('/user/posts/edit/' . $postId, $postData);
        $nbActs2 = $Acts->find()->count();
        $this->assertEquals($nbActs + 1, $nbActs2, 'Test #3');
        $this->assertRedirect('/user/posts');

        // Minor, pub to draft
        // ---------------------------
        $postData = [
            'title' => 'New title for this post',
            'status' => 0,
            'isMinor' => true
        ];
        $nbActs = $Acts->find()->count();
        $this->post('/user/posts/edit/' . $postId, $postData);
        $nbActs2 = $Acts->find()->count();
        $this->assertEquals($nbActs - 1, $nbActs2, 'Test #4');
        $this->assertRedirect('/user/posts');

        // Major, draft to publication
        // ---------------------------
        $postData = [
            'title' => 'New title for this post',
            'status' => 1,
            'isMinor' => false
        ];
        $nbActs = $Acts->find()->count();
        $this->post('/user/posts/edit/' . $postId, $postData);
        $nbActs2 = $Acts->find()->count();
        $this->assertEquals($nbActs + 1, $nbActs2, 'Test #5');
        $this->assertRedirect('/user/posts');
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
