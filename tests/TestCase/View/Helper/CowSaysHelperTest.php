<?php

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\CowSaysHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\CowSaysHelper Test Case
 */
class CowSaysHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\CowSaysHelper
     */
    public $CowSaysHelper;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->CowSaysHelper = new CowSaysHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CowSaysHelper);

        parent::tearDown();
    }

    /**
     * Test say method
     *
     * @return void
     */
    public function testSay()
    {
        // Basic
        $results = '<pre class = "cow-box">/-------------\
| Hello world |
\-------------/
        \   ^__^
         \  (oo)\_______
            (__)\       )\/\
                ||----w |
                ||     ||</pre>';

        $this->assertEquals($results, $this->CowSaysHelper->say('Hello world'));

        // Custom:
        $results = '<pre class = "cow-box"><span class="cow_class"><span class="balloon_class">+-------------+
( <span class="msg_class">Hello, nice</span> )
( <span class="msg_class">world</span>       )
(     <span class="sign_class">~ Me ~ </span> )
+-------------+</span>
        o   ^__^
         o  (xx)\_______
            (__)\       )\/\
             U  ||----w |
                ||     ||</span></pre>';
        $this->assertEquals($results, $this->CowSaysHelper->say("Hello, nice\nworld", [
                    'sign' => 'Me',
                    'eyes' => 'dead',
                    'speakLines' => 'think',
                    'corners' => 'square',
                    'signClass' => 'sign_class',
                    'msgClass' => 'msg_class',
                    'balloonClass' => 'balloon_class',
                    'cowClass' => 'cow_class']));
    }

    /**
     * Test sayError method
     *
     * @return void
     */
    public function testSayError()
    {
        $this->markTestSkipped('Everything is random here.');
    }
}
