<?php

namespace Database\Seeders\Admin;

use App\Models\CrmStatus;
use Illuminate\Database\Seeder;

class CrmStatusTableSeeder extends Seeder
{
    public function run()
    {
        $crmStatuses = [
            [
                'id'         => 1,
                'name'       => 'Lead',
                'created_at' => '2022-02-18 01:24:26',
                'updated_at' => '2022-02-18 01:24:26',
            ],
            [
                'id'         => 2,
                'name'       => 'Customer',
                'created_at' => '2022-02-18 01:24:26',
                'updated_at' => '2022-02-18 01:24:26',
            ],
            [
                'id'         => 3,
                'name'       => 'Partner',
                'created_at' => '2022-02-18 01:24:26',
                'updated_at' => '2022-02-18 01:24:26',
            ],
        ];

        CrmStatus::insert($crmStatuses);
    }
}
