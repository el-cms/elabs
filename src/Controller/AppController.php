<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\I18n\I18n;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * User preference to display nsfw content
     * @var bool
     */
    public $seeNSFW = null;

    /**
     * Default options for pagination
     * @var array
     */
    public $paginate = [
        'order' => ['created' => 'desc'],
        'maxLimit' => 10,
    ];

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Act');
        $this->loadComponent('Flash');
        $this->loadComponent('CakeDC/Users.UsersAuth');

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        $this->loadComponent('Security');
        $this->loadComponent('Csrf');

        /*
         * Safe for work option
         */
        if (is_null($this->request->session()->read('seeNSFW'))) {
            $this->_setSFWState('hide');
        }
        $this->seeNSFW = $this->request->session()->read('seeNSFW');

        /*
         * Site language option
         */
        if (is_null($this->request->session()->read('language'))) {
            // Create the languages list
            $this->_setLanguagesList();
            // Add language info to session
            $this->_setLanguage();
        }
    }

    /**
     * Before filter callback
     *
     * @param \Cake\Event\Event $event The beforeFilter event.
     *
     * @return void
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // "Public" AppController, so all actions allowed
        $this->Auth->allow();
        // Making the seeNSFW variable available in view
        $this->set('seeNSFW', $this->seeNSFW);
        // Making language list and current language variables available in views
        $lang = $this->request->session()->read('language');
        $this->set('availableLanguages', $this->request->session()->read('languages'));
        $this->set('siteLanguage', $lang);
        I18n::locale($this->_getFolderNameFromLangCode($lang));
        // Making currently authentified user infos available in view
        $authUser = null;
        if (!is_null($this->Auth->user('id'))) {
            $authUser = $this->Auth->user();
        }
        $this->set('authUser', $authUser);
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        //$this->set('currentController', \Cake\Utility\Inflector::underscore($this->request->params['controller']));
        if (!array_key_exists('_serialize', $this->viewVars) &&
                in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    /**
     * Changes the state of the seeNSFW value in session
     *
     * @param string $state New state, can be 'hide' or 'show'
     *
     * @return void
     */
    protected function _setSFWState($state = 'hide')
    {
        $this->request->session()->write('seeNSFW', ($state === 'show') ? true : false);
    }

    /**
     * Sets values in session with user preferences.
     *
     *
     * @return void
     */
    protected function _setUserPreferences()
    {
        $preferences = $this->Auth->user('preferences');
        $preferences += \Cake\Core\Configure::read('cms.defaultUserPreferences');
        $this->_setLanguage($preferences['defaultSiteLanguage']);
        $this->_setSFWState(($preferences['showNSFW'] === '1') ? 'show' : 'hide');
        $this->request->session()->write('defaultWritingLanguage', $preferences['defaultWritingLanguage']);
        $this->request->session()->write('defaultWritingLicense', $preferences['defaultWritingLicense']);
    }

    /**
     * Clear user specific preferences
     *
     * @return void
     */
    protected function _clearUserPreferences()
    {
        $this->request->session()->delete('defaultWritingLanguage');
        $this->request->session()->delete('defaultWritingLicense');
    }

    /**
     * Finds available website translations and write them in session
     *
     * @return void
     */
    protected function _setLanguagesList()
    {
        $Languages = \Cake\ORM\TableRegistry::get('Languages');
        $languages = $Languages->find('all', [
            'conditions' => [
                'has_site_translation' => true
            ],
            'fields' => ['name', 'has_site_translation', 'translation_folder', 'iso639_1'],
            'order' => ['name' => 'asc'],
        ]);
        $this->request->session()->write('languages', $languages->toArray());
    }

    /**
     * Changes the current language in session
     *
     * @param string $lang Language translation folder name
     *
     * @return void
     */
    protected function _setLanguage($lang = null)
    {
        $this->request->session()->write('language', $this->_getLangCodeFromFolderName($lang));
    }

    /**
     * Returns the iso639-1 code for a given translation folder name.
     * Note that the 'language' entry in session array should have been previously
     * populated by `_setLanguagesList()`
     *
     * @param string $folderName Language folder name
     *
     * @return string
     */
    protected function _getLangCodeFromFolderName($folderName)
    {
        $langCode = null;
        // Available languages
        $availableLanguages = $this->request->session()->read('languages');
        // Current languages
        if (is_null($folderName)) {
            $folderName = \Cake\Core\Configure::read('cms.defaultSiteLang');
        }
        // Find current language code in available languages
        foreach ($availableLanguages as $l) {
            if ($l['translation_folder'] === $folderName) {
                $langCode = $l['iso639_1'];
            }
        }

        return $langCode;
    }

    /**
     * Returns the translation folder name for a given language iso639-1 code.
     * Note that the 'languages' entry in session array should have been previously
     * populated by `_setLanguagesList()`
     *
     * @param string $langCode Language iso639-1 code.
     *
     * @return string
     */
    protected function _getFolderNameFromLangCode($langCode)
    {
        $folderName = null;
        // Available languages
        $availableLanguages = $this->request->session()->read('languages');
        // Current languages
        if (is_null($langCode)) {
            $langCode = \Cake\Core\Configure::read('cms.defaultSiteLang');
        }
        // Find current language code in available languages
        foreach ($availableLanguages as $l) {
            if ($l['iso639_1'] === $langCode) {
                $folderName = $l['translation_folder'];
            }
        }

        return $folderName;
    }

    /**
     * Switch the value of SFW state.
     *
     * @param string $state New state, can be 'hide' or 'show'
     *
     * @return void
     */
    public function switchSFW($state = 'hide')
    {
        $this->_setSFWState($state);
        $this->redirect($this->referer());
    }

    /**
     * Changes the language to a given one.
     *
     * @param string $lang Language folder name in src/Locale
     *
     * @return void
     */
    public function changeLanguage($lang = null)
    {
        $this->_setLanguage($lang);
        $this->redirect($this->referer());
    }
}
