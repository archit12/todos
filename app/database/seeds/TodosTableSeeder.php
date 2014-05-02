<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TodosTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 5) as $todo)
		{
			foreach (range(1,5) as $user) {
				Todo::create([
					'user_id' => $user,
					'task' => "SampleTask {$todo}",
					'priority' => 1,
					'deadline' => $faker->date(),
					'done' => false
				]);	
			}
		}
	}

}