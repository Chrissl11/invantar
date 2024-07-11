<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['status_name' => 'Verfügbar'],
            ['status_name' => 'In Benutzung'],
            ['status_name' => 'Nicht verfügbar'],
        ];
        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}
