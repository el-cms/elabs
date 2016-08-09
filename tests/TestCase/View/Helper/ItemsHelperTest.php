<?php

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ItemsHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ItemsHelper Test Case
 */
class ItemsHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\ItemsHelper
     */
    public $ItemsHelper;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->ItemsHelper = new ItemsHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemsHelper);

        parent::tearDown();
    }

    /**
     * Test fileConfig method
     *
     * @return void
     */
    public function testFileConfig()
    {
        // Image
        $results = ['icon' => 'file-image-o', 'element' => 'image',];
        $this->assertEquals($results, $this->ItemsHelper->fileConfig('test.jpg'));
        // Audio
        $results = ['icon' => 'file-audio-o', 'element' => 'audio',];
        $this->assertEquals($results, $this->ItemsHelper->fileConfig('test.mp3'));
        // Video
        $results = ['icon' => 'file-video-o', 'element' => 'video',];
        $this->assertEquals($results, $this->ItemsHelper->fileConfig('test.mp4'));
        // Text
        $results = ['icon' => 'file-text-o', 'element' => 'text',];
        $this->assertEquals($results, $this->ItemsHelper->fileConfig('test.md'));
        // Other
        $results = ['icon' => 'file-o', 'element' => 'other',];
        $this->assertEquals($results, $this->ItemsHelper->fileConfig('test.blend'));
    }
}
