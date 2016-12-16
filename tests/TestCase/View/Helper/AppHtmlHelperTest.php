<?php

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\AppHtmlHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\AppHtmlHelper Test Case
 */
class AppHtmlHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\AppHtmlHelper
     */
    public $AppHtmlHelper;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->AppHtmlHelper = new AppHtmlHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AppHtmlHelper);

        parent::tearDown();
    }

    /**
     * Test icon method
     *
     * @return void
     */
    public function testIcon()
    {
        // No options
        $result = '<i class="fa-home fa-fw fa"></i>';
        $this->assertEquals($result, $this->AppHtmlHelper->icon('home'));

        // Fixed = false
        $result = '<i class="fa-home fa"></i>';
        $this->assertEquals($result, $this->AppHtmlHelper->icon('home', ['fixed' => false]));

        // Other icon set
        $result = '<i class="gi-home gi-fw gi"></i>';
        $this->assertEquals($result, $this->AppHtmlHelper->icon('home', ['iconSet' => 'gi']));

        // Additionnal class
        $result = '<i class="some_class fa-home fa-fw fa"></i>';
        $this->assertEquals($result, $this->AppHtmlHelper->icon('home', ['class' => 'some_class']));

        // All combined
        $result = '<i class="some_class gi-home gi"></i>';
        $this->assertEquals($result, $this->AppHtmlHelper->icon('home', ['class' => 'some_class', 'iconSet' => 'gi', 'fixed' => false]));
    }

    /**
     * Test iconT method
     *
     * @return void
     */
    public function testIconT()
    {
        // No options
        $result = '<i class="fa-home fa-fw fa"></i>&nbsp;test';
        $this->assertEquals($result, $this->AppHtmlHelper->iconT('home', 'test'));

        // Fixed = false
        $result = '<i class="fa-home fa"></i>&nbsp;test';
        $this->assertEquals($result, $this->AppHtmlHelper->iconT('home', 'test', ['fixed' => false]));

        // Other icon set
        $result = '<i class="gi-home gi-fw gi"></i>&nbsp;test';
        $this->assertEquals($result, $this->AppHtmlHelper->iconT('home', 'test', ['iconSet' => 'gi']));

        // Additionnal class
        $result = '<i class="some_class fa-home fa-fw fa"></i>&nbsp;test';
        $this->assertEquals($result, $this->AppHtmlHelper->iconT('home', 'test', ['class' => 'some_class']));

        // All combined
        $result = '<i class="some_class gi-home gi"></i>&nbsp;test';
        $this->assertEquals($result, $this->AppHtmlHelper->iconT('home', 'test', ['class' => 'some_class', 'iconSet' => 'gi', 'fixed' => false]));
    }

    /**
     * Test arrayToString method
     *
     * @return void
     */
    public function testArrayToString()
    {
        $array = ['some', 'strings', 'to', 'assemble', 'put together'];

        // Simple call
        $result = "Some, strings, to, assemble and put together";
        $this->assertEquals($result, $this->AppHtmlHelper->arrayToString($array));

        // No uppercase
        $result = "some, strings, to, assemble and put together";
        $this->assertEquals($result, $this->AppHtmlHelper->arrayToString($array, ['uppercase' => false]));

        // No 'And' separator
        $result = "Some, strings, to, assemble, put together";
        $this->assertEquals($result, $this->AppHtmlHelper->arrayToString($array, ['and' => false]));

        // All options
        $result = "some, strings, to, assemble, put together";
        $this->assertEquals($result, $this->AppHtmlHelper->arrayToString($array, ['uppercase' => false, 'and' => false]));
    }

    /**
     * Test reportLink method
     *
     * @return void
     */
    public function testReportLink()
    {
        //function reportLink($target = null, $options = []) title icon
        // Simple call
        $result = '<a href="#" data-toggle="modal" data-target="#reportModal" data-itemtarget="/">Report this</a>';
        $this->assertEquals($result, $this->AppHtmlHelper->reportLink());

        $result = '<a href="#" data-toggle="modal" data-target="#reportModal" data-itemtarget="otherTarget">Report this</a>';
        $this->assertEquals($result, $this->AppHtmlHelper->reportLink('otherTarget'));

        // Custom title
        $result = '<a href="#" data-toggle="modal" data-target="#reportModal" data-itemtarget="/">Other title</a>';
        $this->assertEquals($result, $this->AppHtmlHelper->reportLink(null, ['title' => 'Other title']));

        // Custom icon
        $result = '<a href="#" data-toggle="modal" data-target="#reportModal" data-itemtarget="/"><i class="fa-flag fa-fw fa"></i>&nbsp;Report this</a>';
        $this->assertEquals($result, $this->AppHtmlHelper->reportLink(null, ['icon' => true]));

        // All together
        $result = '<a href="#" data-toggle="modal" data-target="#reportModal" data-itemtarget="otherTarget"><i class="fa-flag fa-fw fa"></i>&nbsp;Other title</a>';
        $this->assertEquals($result, $this->AppHtmlHelper->reportLink('otherTarget', ['title' => 'Other title', 'icon' => true]));
    }

    /**
     * Test displayMD method
     *
     * @return void
     */
    public function testDisplayMD()
    {
        $this->markTestSkipped('Test too complex to be in a helper file.');
    }

    /**
     * Test langLabel method
     *
     * @return void
     */
    public function testLangLabel()
    {
        /*
         * public function langLabel($content, $isoCode, $options = [])
          {
          $options += [
          'class' => null,
          'label' => true,
          'tag' => 'span',
          ];
         */
        // Simple call
        /*$result = '<span class="label label-language" lang="eng">English</span>';
        $this->assertEquals($result, $this->AppHtmlHelper->langLabel('English', 'eng'));

        // Class option
        $result = '<span class="other classes label label-language" lang="eng">English</span>';
        $this->assertEquals($result, $this->AppHtmlHelper->langLabel('English', 'eng', ['class' => 'other classes']));

        // Label option
        $result = '<span lang="eng">English</span>';
        $this->assertEquals($result, $this->AppHtmlHelper->langLabel('English', 'eng', ['label' => false]));

        // Tag
        $result = '<div class="label label-language" lang="eng">English</div>';
        $this->assertEquals($result, $this->AppHtmlHelper->langLabel('English', 'eng', ['tag' => 'div']));

        // All tests
        $result = '<div class="other class" lang="eng">English</div>';
        $this->assertEquals($result, $this->AppHtmlHelper->langLabel('English', 'eng', ['label' => false, 'class' => 'other class', 'tag' => 'div']));
         */
        $this->markTestIncomplete();
    }

    /**
     * Test checkIcon method
     *
     * @return void
     */
    public function testCheckIcon()
    {
        // True
        $result = '<i class="fa-check-circle-o fa-fw fa"></i>';
        $this->assertEquals($result, $this->AppHtmlHelper->checkIcon(true));

        // False
        $result = '<i class="fa-circle-o fa-fw fa"></i>';
        $this->assertEquals($result, $this->AppHtmlHelper->checkIcon(false));
    }

    /**
     * Test langAttr method
     *
     * @return void
     */
    public function testLangAttr()
    {
//        $this->assertEquals('', $this->AppHtmlHelper->langAttr('en'));
//        $this->assertEquals('', $this->AppHtmlHelper->langAttr('en', true));
//        $this->assertEquals(' lang="fr"', $this->AppHtmlHelper->langAttr('fr'));
//        $this->assertEquals('lang="fr"', $this->AppHtmlHelper->langAttr('fr', true));
        $this->markTestIncomplete();
    }
}
