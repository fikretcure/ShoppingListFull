<?php

namespace Database\Seeders;

use App\Models\user;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new user;
        $user->first_name = 'ORHAN';
        $user->last_name = 'ÜSKÜPLÜ';
        $user->email = "orhan@gmail.com";
        $user->password = Hash::make("orhan");
        $user->type = 0;
        $user->save();
        /*  */
        $user_2 = new user;
        $user_2->first_name = 'MELEK';
        $user_2->last_name = 'BOZKURT';
        $user_2->email = "melek@gmail.com";
        $user_2->password = Hash::make("melek");
        $user_2->type = 0;
        $user_2->save();
        /*  */
        $user_3 = new user;
        $user_3->first_name = 'DENİZ';
        $user_3->last_name = 'BARGA';
        $user_3->email = "deniz@gmail.com";
        $user_3->password = Hash::make("deniz");
        $user_3->type = 1;
        $user_3->save();
        /*  */
        $cars = Http::withHeaders([
            'x-rapidapi-host' => 'car-data.p.rapidapi.com',
            'x-rapidapi-key' => '5fd03a64b0msh513b2dcc3a4cdb7p18df32jsn2065e74645d5'
        ])->get('https://car-data.p.rapidapi.com/cars/makes');
        $colors = ["KIRMIZI", "MAVİ", "YEŞİL", "SİYAH", "BEYAZ"];
        foreach ($cars->json() as $item) {
            $products = new product();
            $products->name = Str::upper($item);
            $products->price = rand(100, 599) * 1000;
            $products->km = rand(10, 99) * 1000;
            $products->color = $colors[rand(0, 4)];
            $products->quantity = rand(10, 199);
            $products->save();
        }
    }
}
