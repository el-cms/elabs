<?php

use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Text;
use Migrations\AbstractSeed;

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
        $time = date("Y-m-d H:i:s");
        $data = [
            [
                'id' => Text::uuid(),
                'email' => 'admin@example.com',
                'username' => 'administrator',
                'first_name' => 'Administrator',
                'last_name' => 'of the website',
                'password' => (new DefaultPasswordHasher)->hash('adminadmin'),
                'created' => $time,
                'modified' => $time,
                'role' => 'admin',
                'active' => '1',
                'preferences' => json_encode(Cake\Core\Configure::read('cms.defaultUserPreferences')),
                'is_superuser' => true,
            ]
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
