<?php

namespace Database\Seeders;

use App\Models\Goal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = array(
            array('name' => 'Bottom bracket'),
            array('name' => 'Puncture'),
            array('name' => 'New pedals'),
            array('name' => 'Gears'),
            array('name' => 'New psaddle'),
            array('name' => 'Braces'),
            array('name' => 'Wheel re-build'),
            array('name' => 'Truing'),
            array('name' => 'Bike assemble'),
            array('name' => 'Broken spoke'),
        );
        foreach ($names as $name) {
            Goal::create([
                'name' => $name['name'],
            ]);
        }
    }
}
