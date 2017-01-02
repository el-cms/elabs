<?php
/**
 * Created by PhpStorm.
 * User: mtancoigne
 * Date: 24/12/16
 * Time: 03:49
 */

namespace App\Test\TestCase;

use Cake\TestSuite\IntegrationTestCase;
use \App\Test\Fixture\UsersFixture;

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
     * @param array $data Data
     * @param string $dataName Data name
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $userFixtures = new UsersFixture();

        $this->userCreds = [
//            'closed' => ['Auth' => ['User' => $userFixtures->records[0]]],
            'admin' => ['Auth' => ['User' => $userFixtures->records[1]]],
            'author' => ['Auth' => ['User' => $userFixtures->records[2]]],
//            'inactive' => ['Auth' => ['User' => $userFixtures->records[3]]],
//            'locked' => ['Auth' => ['User' => $userFixtures->records[4]]],
            'public' => ['Auth' => ['User' => []]],
        ];
    }

    /**
     * Testes authorisation on a page that don't redirects the user on success
     *
     * @param array $statuses Users to check
     * @param string $path URL
     * @param array $methods Methods (post/get for now)
     *
     * @return void
     */
    public function assertAuthIsOkFor(array $statuses, string $path, array $methods)
    {
        foreach ($this->userCreds as $status => $credentials) {
            if (in_array($status, $statuses)) {
                $this->assertAccessOk($credentials, $path, $methods, "access for '$status' ($path) failed.");
            } else {
                $this->assertAccessFails($credentials, $path, $methods, "access denial for '$status' ($path) failed.");
            }
        }
    }

    /**
     * Testes a successful action for a given user
     *
     * @param array $session User configuration value for Auth
     * @param string $path URL to check
     * @param array $methods Methods to check (post, get)
     * @param string|null $message Failure message. Will be preceded with the method
     *
     * @return void
     */
    public function assertAccessOk(array $session, string $path, array $methods, string $message = null)
    {
        $this->session($session);
        foreach ($methods as $m) {
            try {
                switch ($m) {
                    case 'get':
                        $this->get($path);
                        break;
                    case 'post':
                        $this->post($path);
                        break;
                }
                $this->assertResponseOk();
            } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
                $this->fail($e->getMessage() . "\n > $m - $message");
            }
        }
    }

    /**
     * Testes a denied action for a given user
     *
     * @param array $session User configuration value for Auth
     * @param string $path URL to check
     * @param array $methods Methods to check (post, get)
     * @param string|null $message Failure message. Will be preceded with the method
     *
     * @return void
     */
    public function assertAccessFails(array $session, string $path, array $methods, string $message = null)
    {
        $this->session($session);
        foreach ($methods as $m) {
            try {
                switch ($m) {
                    case 'get':
                        $this->get($path);
                        break;
                    case 'post':
                        $this->post($path);
                        break;
                }
                $this->assertResponseError();
            } catch (\PHPUnit_Framework_ExpectationFailedException $e) {
                $this->fail($e->getMessage() . "\n > $message");
            }
        }
    }
}
