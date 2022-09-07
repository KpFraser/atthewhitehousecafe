<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = array(
            array('name' => 'Organiser'),
            array('name' => 'Leader'),
            array('name' => 'Assistant'),

        );
        foreach ($names as $name) {
            Role::create([
                'name' => $name['name'],
            ]);
        }
    }
}
