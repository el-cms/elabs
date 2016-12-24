<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         1.2.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Test\TestCase\Controller;

use Cake\Core\Configure;
use Cake\TestSuite\IntegrationTestCase;

/**
 * PagesControllerTest class
 */
class PagesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.languages', // Needed for some layout vars
    ];

    /**
     * testDisplay method
     *
     * @return void
     */
    public function testDisplay()
    {
        $this->get('/pages/display/about');
        $this->assertResponseOk();
        $this->assertResponseContains('About');
        $this->assertResponseContains('<!DOCTYPE html>');
    }

    /**
     * Test that missing template renders 404 page in production
     *
     * @return void
     */
    public function testMissingTemplate()
    {
        Configure::write('debug', false);
        $this->get('/pages/display/not_existing');

        $this->assertResponseError();
        $this->assertResponseContains('Error');
    }

    /**
     * Test that missing template in debug mode renders missing_template error page
     *
     * @return void
     */
    public function testMissingTemplateInDebug()
    {
        Configure::write('debug', true);
        $this->get('/pages/display/not_existing');

        $this->assertResponseFailure();
        $this->assertResponseContains('Missing Template');
        $this->assertResponseContains('Stacktrace');
        $this->assertResponseContains('not_existing.ctp');
    }

    /**
     * Test directory traversal protection
     *
     * @return void
     */
    public function testDirectoryTraversalProtection()
    {
        $this->get('/pages/display/../Layout/ajax');
        $this->assertResponseCode(403);
        $this->assertResponseContains('Forbidden');
    }
}
