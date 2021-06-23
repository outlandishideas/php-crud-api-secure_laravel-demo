<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $db = new \PDO("sqlite:".__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."animals.sqlite");
        $sql = file_get_contents(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."animals_source_data.sql");
        $db->exec($sql);
    }
}
