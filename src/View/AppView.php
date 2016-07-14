<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\View;

use Cake\View\View;

/**
 * Application View
 *
 * Your application’s default view class
 *
 * @link http://book.cakephp.org/3.0/en/views.html#the-app-view
 */
class AppView extends View
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading helpers.
     *
     * e.g. `$this->loadHelper('Html');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadHelper('Html', ['className' => 'AppHtml', 'App' => \Cake\Core\Configure::read('App')]);
        $this->loadHelper('Form', [
            'className' => 'BootstrapUI.Form',
            'templates' => [
                'select' => '<select name="{{name}}"{{attrs}} class="form-control">{{content}}</select>',
                'dateWidget' => '<ul class="list-inline"><li class="year">{{year}}</li><li class="month">{{month}}</li><li class="day">{{day}}</li></ul>',
                'help'=>'<p class="help-block"><i class="fa fa-info-circle"></i> {{content}}</p>'
            ]
        ]);
        $this->loadHelper('Flash', ['className' => 'BootstrapUI.Flash']);
//        $this->loadHelper('Paginator', ['className' => 'BootstrapUI.Paginator']);
        $this->loadHelper('Gravatar.Gravatar');
        $this->loadHelper('Tanuck/Markdown.Markdown', ['parser' => 'GithubMarkdown']);

        $this->Paginator->templates([
//            'nextActive' => '<li class="next"><a rel="next" href="{{url}}">{{text}}</a></li>',
//            'nextDisabled' => '<li class="next disabled"><a href="" onclick="return false;">{{text}}</a></li>',
//            'prevActive' => '<li class="prev"><a rel="prev" href="{{url}}">{{text}}</a></li>',
//            'prevDisabled' => '<li class="prev disabled"><a href="" onclick="return false;">{{text}}</a></li>',
//            'counterRange' => '{{start}} - {{end}} of {{count}}',
//            'counterPages' => '{{page}} of {{pages}}',
//            'first' => '<li class="first"><a href="{{url}}">{{text}}</a></li>',
//            'last' => '<li class="last"><a href="{{url}}">{{text}}</a></li>',
//            'number' => '<li><a href="{{url}}">{{text}}</a></li>',
//            'current' => '<li class="active"><a href="">{{text}}</a></li>',
//            'ellipsis' => '<li class="ellipsis">...</li>',
            'sort' => '<a href="{{url}}" class="{{class}}"><span class="fa fa-fw fa-sort"></span>&nbsp;{{text}}</a>',
            'sortAsc' => '<a href="{{url}}" class="{{class}}"><span class="fa fa-fw fa-sort-amount-desc"></span>&nbsp;{{text}}</a>',
            'sortDesc' => '<a href="{{url}}" class="{{class}}"><span class="fa fa-fw fa-sort-amount-asc"></span>&nbsp;{{text}}</a>',
            'sortAscLocked' => '<a href="{{url}}" class="{{class}}"><span class="fa fa-fw fa-sort-amount-asc"></span>&nbsp;{{text}}</a>',
            'sortDescLocked' => '<a href="{{url}}" class="{{class}}"><span class="fa fa-fw fa-sort-amount-desc"></span>&nbsp;{{text}}</a>'
        ]);
    }
}
