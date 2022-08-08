<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use App\Models\Avatar;
use App\Models\ChatRoom;
use App\Models\Friend;
use App\Models\Hobby;
use App\Models\Payment;
use App\Models\UserAvatar;
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
        $faker = Factory::create();
        $ava = [
            'default',
            'Animal 1',
            'Animal 2',
            'Animal 3',
            'Rabbit 1',
            'Neko 1',
            'Usagyuun 1',
            'Usagyuun 2',
            'Bugcat 1',
            'Popuko 1',
            'Pipimi 1'
        ];

        Avatar::create([
            'name' => 'default',
            'price' => 0,
            'image' => '/img/avatar/default.png'
        ]);

        for($i = 2;$i<=11;$i++){
            Avatar::create([
                'name' => $ava[$i-1],
                'price' => $faker->numberBetween(50, 100000),
                'image' => '/img/avatar/'.($i-1).'.png'
            ]);
        }
        
        for($i=1;$i<=20;$i++){
            User::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'password' => bcrypt('password'),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'age' => $faker->numberBetween(12, 40),
                'coin' => $faker->numberBetween(0, 1000),
                'instagram_link' => 'https://www.instagram.com/username',
                'phone' => $faker->phoneNumber(),
                'address' => $faker->address(),
                'avatar_id' => 1,
                'is_incognito' => false,
            ]);
        }

        $hobby = [
            'Fishing', 'Cooking', 'Playing Game', 'Reading Book', 'Dancing', 'Basketball', 'Watch Anime', 'Watch Drama', 'Car Collector'
        ];

        for($i=1;$i<=20;$i++){
            $idx = $faker->numberBetween(0, count($hobby)-1);
            Hobby::create([
                'user_id' => $i,
                'hobby' => $hobby[$idx],
                'photo' => '/img/user_photo/'.($idx+1).'.png',
                'description' => $faker->text(200)
            ]);
        }

        Friend::create([
            'friend_1' => 1,
            'friend_2' => 6,
            'is_confirmed' => true
        ]);
        ChatRoom::create([
            'friend_1' => 1,
            'friend_2' => 6
        ]);
        Friend::create([
            'friend_1' => 1,
            'friend_2' => 7,
            'is_confirmed' => true
        ]);
        ChatRoom::create([
            'friend_1' => 1,
            'friend_2' => 7
        ]);
        Friend::create([
            'friend_1' => 1,
            'friend_2' => 8,
            'is_confirmed' => true
        ]);
        ChatRoom::create([
            'friend_1' => 1,
            'friend_2' => 8
        ]);
        Friend::create([
            'friend_1' => 2,
            'friend_2' => 6,
            'is_confirmed' => true
        ]);
        ChatRoom::create([
            'friend_1' => 2,
            'friend_2' => 6
        ]);
        Friend::create([
            'friend_1' => 1,
            'friend_2' => 10,
            'is_confirmed' => false
        ]);
        Friend::create([
            'friend_1' => 1,
            'friend_2' => 15,
            'is_confirmed' => false
        ]);
        
        UserAvatar::create([
            'user_id' => 1,
            'avatar_id' => 1,
            'is_a_gift' => false,
            'gift_giver' => null
        ]);
        Payment::create([
            'user_id' => 1,
            'payment_type' => 'avatar',
            'amount' => 500,
            'avatar_id' => 1,
            'is_a_gift' => false,
            'payment_method' => 'Credit Card'
        ]);
    }
}
