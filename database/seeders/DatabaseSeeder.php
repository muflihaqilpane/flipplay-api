<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Muflih Aqil Pane',
            'email' => 'muflih@student.umm.ac.id',
            'password' => Hash::make('password123'),
        ]);

        Media::create([
            'title' => 'Attack on Titan',
            'type' => 'Anime',
            'genre' => 'Action',
            'rating' => 9.0,
            'total_episodes' => 75,
        ]);

        Media::create([
            'title' => 'One Piece',
            'type' => 'Manga',
            'genre' => 'Adventure',
            'rating' => 9.2,
            'total_episodes' => 1100,
        ]);
    }
}
