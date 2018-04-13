<?php

use Illuminate\Database\Seeder;

class PrioritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $priorities = [
            ['name' => 'low', 'order' => '1'],
            ['name' => 'medium', 'order' => '2'],
            ['name' => 'high', 'order' => '3'],
        ];
        forEach ($priorities as $p) {
            DB::table('priorities')->insert(
                [
                    'name' => $p['name'], 
                    'order' => $p['order'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
