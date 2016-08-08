<?php

use Migrations\AbstractSeed;
use \Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Text;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => Text::uuid(), 'email' => 'admin@example.com', 'username' => 'administrator', 'realname' => 'Manuel Tancoigne', 'password' => (new DefaultPasswordHasher)->hash('adminadmin'), 'created' => '2015-11-09 09:54:45', 'modified' => '2016-07-18 06:38:05', 'role' => 'admin', 'see_nsfw' => '1', 'status' => '1', 'preferences' => '{}']
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
