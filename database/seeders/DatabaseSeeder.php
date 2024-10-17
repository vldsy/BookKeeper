<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Author;
use App\Models\Book;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use File;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    protected $faker;

    /**
     * Create a new seeder instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->faker = $this->withFaker();
    }

    /**
     * Get a new Faker instance.
     *
     * @return \Faker\Generator
     */
    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Author::truncate();
        //Book::truncate();

        Author::where('id', '>', 0)->delete();
        Book::where('id', '>', 0)->delete();

        $json = File::get("database/data/books.json");

        $books = json_decode($json);

        foreach ($books as $key => $value) {

            if ($value->author === "Unknown") {
                continue;
            }

            if (strlen($value->title) >= 45) {
                continue;
            }

            $author_id = -1;

            if (!Author::where('name', $value->author)->exists()) {
                $author_id = Author::create([
                    "name" => $value->author,
                    "email" => $this->faker->unique()->safeEmail,
                    "age" => $this->faker->numberBetween($min = 22, $max = 96),
                ])->id;
            } else {
                $author_id = Author::where('name', $value->author)->first()->id;
            }

            Book::create([
                "title" => $value->title,
                "author_id" => $author_id,
                "genre" => "fiction",
            ]);
        }

        /*
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */

        // Create 2 users
        //User::truncate();
        User::where('id', '>', 0)->delete();

        $password = "12345";

        User::create([
            'name' => "John Doe",
            'email' => "johndoe@gmail.com",
            'email_verified_at' => now(),
            'password' => bcrypt($password),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => "Bill Gates",
            'email' => "billgates@gmail.com",
            'email_verified_at' => now(),
            'password' => bcrypt($password),
            'remember_token' => Str::random(10),
        ]);


    }
}
