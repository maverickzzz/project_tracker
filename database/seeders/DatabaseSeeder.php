<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'email' => 'maverick.9988@gmail.com',
            'password' => Hash::make('seagate'),
            'usergroup_id' => 1,
        ]);

        \App\Models\UserGroup::factory()->create([
            'name' => 'Administrator',
        ]);

        // \App\Models\ProjectOwner::factory()->create([
        //     'name' => 'Matt Kayne',
        //     'country' => 'Indonesia',
        //     'contact_number' => '123456',
        //     'user_id' => 1,
        // ]);

        // \App\Models\Project::factory()->create([
        //     'name' => 'SBM',
        //     'user_id' => 1,
        //     'owner_id' => 1,
        //     'url' => 'https://www.google.com',
        //     'is_active' => true
        // ]);

        // \App\Models\Payment::factory()->create([
        //     'owner_id' => 1,
        //     'project_id' => 1,
        //     'user_id' => 1,
        //     'date' => '2016-09-14',
        //     'amount' => 1000000
        // ]);

        // \App\Models\Service::factory()->create([
        //     'user_id' => 1,
        //     'type' => 'Maintenance',
        //     'owner_id' => 1,
        //     'project_id' => 1,
        //     'start_date' => '2023-05-01',
        //     'end_date' => '2024-04-30',
        //     'currency' => 'IDR',
        //     'amount' => 100000,
        //     'notes' => '1',
        //     'is_active' => true
        // ]);

        // \App\Models\Service::factory()->create([
        //     'user_id' => 1,
        //     'type' => 'SEO',
        //     'owner_id' => 1,
        //     'project_id' => 1,
        //     'start_date' => '2023-05-01',
        //     'end_date' => '2024-04-30',
        //     'currency' => 'IDR',
        //     'amount' => 100000,
        //     'notes' => '1',
        //     'is_active' => true
        // ]);

        // \App\Models\Service::factory()->create([
        //     'user_id' => 1,
        //     'type' => 'Domain',
        //     'owner_id' => 1,
        //     'project_id' => 1,
        //     'start_date' => '2023-05-01',
        //     'end_date' => '2024-04-30',
        //     'currency' => 'IDR',
        //     'amount' => 100000,
        //     'notes' => '1',
        //     'is_active' => true
        // ]);

        // \App\Models\Service::factory()->create([
        //     'user_id' => 1,
        //     'type' => 'Hosting',
        //     'owner_id' => 1,
        //     'project_id' => 1,
        //     'start_date' => '2023-05-01',
        //     'end_date' => '2024-04-30',
        //     'currency' => 'IDR',
        //     'amount' => 100000,
        //     'notes' => '1',
        //     'is_active' => true
        // ]);

        // \App\Models\ServiceLog::factory()->create([
        //     'user_id' => 1,
        //     'service_id' => 1,
        //     'start_date' => '2023-05-01',
        //     'end_date' => '2024-04-30',
        //     'currency' => 'IDR',
        //     'amount' => 100000,
        //     'notes' => '1',
        //     'is_active' => true
        // ]);

        // \App\Models\ServiceLog::factory()->create([
        //     'user_id' => 1,
        //     'service_id' => 2,
        //     'start_date' => '2023-05-01',
        //     'end_date' => '2024-04-30',
        //     'currency' => 'IDR',
        //     'amount' => 100000,
        //     'notes' => '1',
        //     'is_active' => true
        // ]);

        // \App\Models\ServiceLog::factory()->create([
        //     'user_id' => 1,
        //     'service_id' => 3,
        //     'start_date' => '2023-05-01',
        //     'end_date' => '2024-04-30',
        //     'currency' => 'IDR',
        //     'amount' => 100000,
        //     'notes' => '1',
        //     'is_active' => true
        // ]);

        // \App\Models\ServiceLog::factory()->create([
        //     'user_id' => 1,
        //     'service_id' => 4,
        //     'start_date' => '2023-05-01',
        //     'end_date' => '2024-04-30',
        //     'currency' => 'IDR',
        //     'amount' => 100000,
        //     'notes' => '1',
        //     'is_active' => true
        // ]);
    }
}
