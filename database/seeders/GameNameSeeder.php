<?php

namespace Database\Seeders;

use App\Models\GameName;
use Database\Factories\GameNameFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(GameNameFactory::class);
        $names = array(
            array('name' => 'Canoeing'), 
            array('name' => 'Morning Runs'),
            array('name' => 'Track Runs'),
            array('name' => 'Frisbee'),
            array('name' => 'Lead Cycling'),
            array('name' => 'Lead Walks'),
            array('name' => 'Cooking'),
            array('name' => 'Gardening'),
            array('name' => 'Pickelball'),
        );
        foreach ($names as $name) {
            GameName::create([
             'name' => $name['name'],
           ]);
        }
    }
}
