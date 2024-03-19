<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            "name" => "Mattias Duarte",
            "email" => "mattias@correo.com",
            "password" => Hash::make("Admin123"),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        DB::table('users')->insert([
            "name" => "Innova Code",
            "email" => "innovacode@correo.com",
            "password" => Hash::make("Admin123"),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

    }
}
