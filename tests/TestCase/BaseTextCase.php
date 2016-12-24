<?php
/**
 * Created by PhpStorm.
 * User: mtancoigne
 * Date: 24/12/16
 * Time: 03:49
 */

namespace App\Test\TestCase;

use Cake\TestSuite\IntegrationTestCase;

class BaseTextCase extends IntegrationTestCase
{
    /**
     * Users credentials to put in session in order to create a fake authentication
     *
     * @var array
     */
    public $userCreds = [];

    /**
     * Constructor that loads some fixtures data for simpler reference
     *
     * @param string $name Name
     * @param array $data  Data
     * @param string $dataName Data name
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $userFixtures = new \App\Test\Fixture\UsersFixture();
        $this->userCreds = [
            'closed' => ['Auth' => ['User' => $userFixtures->records[0]]],
            'admin' => ['Auth' => ['User' => $userFixtures->records[1]]],
            'author' => ['Auth' => ['User' => $userFixtures->records[2]]],
            'inactive' => ['Auth' => ['User' => $userFixtures->records[3]]],
            'locked' => ['Auth' => ['User' => $userFixtures->records[4]]],
        ];
    }
}
