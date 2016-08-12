<?php

namespace App\Test\TestCase\Controller;

use App\Controller\PagesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\PagesController Test Case
 */
class PagesControllerTest extends IntegrationTestCase
{

    /**
     * Test display method
     *
     * @return void
     */
    public function testDisplay()
    {
        $this->get('/pages/display/about');
        $this->assertResponseOk();
    }
}
