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
        GameName::factory()->count(10)->create();
    }
}
