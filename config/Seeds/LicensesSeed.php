<?php

namespace Seeds;

use Migrations\AbstractSeed;

/**
 * Licenses seed.
 */
class LicensesSeed extends AbstractSeed
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
            ['name' => 'CC BY', 'link' => 'http://creativecommons.org/licenses/by/', 'icon' => 'creative-commons'],
            ['name' => 'CC BY-NC', 'link' => 'http://creativecommons.org/licenses/by-nc/', 'icon' => 'creative-commons'],
            ['name' => 'CC BY-NC-SA 2.0', 'link' => 'http://creativecommons.org/licenses/by-nc-sa/', 'icon' => 'creative-commons'],
            ['name' => 'MIT', 'link' => 'https://tldrlegal.com/license/mit-license', 'icon' => 'copyright']
        ];

        $table = $this->table('licenses');
        $table->insert($data)->save();
    }
}
