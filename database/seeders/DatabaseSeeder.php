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

        DB::table('roles')->insert([
            "name" => "Admin",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        DB::table('roles')->insert([
            "name" => "Employee",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);


        // OBTENER LOS ROLES DE LA DB
        $roles = DB::table('roles')->get();
        
        DB::table('users')->insert([
            "name" => "Mattias Duarte",
            "email" => "mattias@correo.com",
            "role_id" => $roles[0]->id,
            "password" => Hash::make("Admin123"),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        DB::table('users')->insert([
            "name" => "Innova Code",
            "email" => "innovacode@correo.com",
            "role_id" => $roles[0]->id,
            "password" => Hash::make("Admin123"),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

    }
}
