<?php



/** @var \Illuminate\Database\Eloquent\Factory $factory */ 

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Thread::class, function ($faker){
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        
        'title' => $faker->sentence,
        'body' => $faker->paragraph
    ];
});


$factory->define(App\Reply::class, function ($faker){
    return [
        'thread_id' => function () {
            return factory('App\Thread')->create()->id;
        },
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        
        'body' => $faker->paragraph
    ];
});
