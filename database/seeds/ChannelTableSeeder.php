<?php

use App\Channel;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ChannelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([
            'name' => 'Laravel 7',
            'slug' => Str::slug('Laravel 7')
        ]);
        Channel::create([
            'name' => 'Vue 3',
            'slug' => Str::slug('Vue 3')
        ]);
        Channel::create([
            'name' => 'Angular 7',
            'slug' => Str::slug('Angular 7')
        ]);
        Channel::create([
            'name' => 'Node Js',
            'slug' => Str::slug('Node Js')
        ]);
    }
}
