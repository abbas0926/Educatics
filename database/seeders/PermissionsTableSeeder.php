<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'basic_c_r_m_access',
            ],
            [
                'id'    => 18,
                'title' => 'crm_status_create',
            ],
            [
                'id'    => 19,
                'title' => 'crm_status_edit',
            ],
            [
                'id'    => 20,
                'title' => 'crm_status_show',
            ],
            [
                'id'    => 21,
                'title' => 'crm_status_delete',
            ],
            [
                'id'    => 22,
                'title' => 'crm_status_access',
            ],
            [
                'id'    => 23,
                'title' => 'crm_customer_create',
            ],
            [
                'id'    => 24,
                'title' => 'crm_customer_edit',
            ],
            [
                'id'    => 25,
                'title' => 'crm_customer_show',
            ],
            [
                'id'    => 26,
                'title' => 'crm_customer_delete',
            ],
            [
                'id'    => 27,
                'title' => 'crm_customer_access',
            ],
            [
                'id'    => 28,
                'title' => 'crm_note_create',
            ],
            [
                'id'    => 29,
                'title' => 'crm_note_edit',
            ],
            [
                'id'    => 30,
                'title' => 'crm_note_show',
            ],
            [
                'id'    => 31,
                'title' => 'crm_note_delete',
            ],
            [
                'id'    => 32,
                'title' => 'crm_note_access',
            ],
            [
                'id'    => 33,
                'title' => 'crm_document_create',
            ],
            [
                'id'    => 34,
                'title' => 'crm_document_edit',
            ],
            [
                'id'    => 35,
                'title' => 'crm_document_show',
            ],
            [
                'id'    => 36,
                'title' => 'crm_document_delete',
            ],
            [
                'id'    => 37,
                'title' => 'crm_document_access',
            ],
            [
                'id'    => 38,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 39,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 40,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 41,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 42,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 43,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 44,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 45,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 46,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 47,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 48,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 49,
                'title' => 'task_create',
            ],
            [
                'id'    => 50,
                'title' => 'task_edit',
            ],
            [
                'id'    => 51,
                'title' => 'task_show',
            ],
            [
                'id'    => 52,
                'title' => 'task_delete',
            ],
            [
                'id'    => 53,
                'title' => 'task_access',
            ],
            [
                'id'    => 54,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 55,
                'title' => 'feature_create',
            ],
            [
                'id'    => 56,
                'title' => 'feature_edit',
            ],
            [
                'id'    => 57,
                'title' => 'feature_show',
            ],
            [
                'id'    => 58,
                'title' => 'feature_delete',
            ],
            [
                'id'    => 59,
                'title' => 'feature_access',
            ],
            [
                'id'    => 60,
                'title' => 'package_create',
            ],
            [
                'id'    => 61,
                'title' => 'package_edit',
            ],
            [
                'id'    => 62,
                'title' => 'package_show',
            ],
            [
                'id'    => 63,
                'title' => 'package_delete',
            ],
            [
                'id'    => 64,
                'title' => 'package_access',
            ],
            [
                'id'    => 65,
                'title' => 'tenant_create',
            ],
            [
                'id'    => 66,
                'title' => 'tenant_edit',
            ],
            [
                'id'    => 67,
                'title' => 'tenant_show',
            ],
            [
                'id'    => 68,
                'title' => 'tenant_delete',
            ],
            [
                'id'    => 69,
                'title' => 'tenant_access',
            ],
            [
                'id'    => 70,
                'title' => 'domain_create',
            ],
            [
                'id'    => 71,
                'title' => 'domain_edit',
            ],
            [
                'id'    => 72,
                'title' => 'domain_show',
            ],
            [
                'id'    => 73,
                'title' => 'domain_delete',
            ],
            [
                'id'    => 74,
                'title' => 'domain_access',
            ],
            [
                'id'    => 75,
                'title' => 'setting_create',
            ],
            [
                'id'    => 76,
                'title' => 'setting_edit',
            ],
            [
                'id'    => 77,
                'title' => 'setting_show',
            ],
            [
                'id'    => 78,
                'title' => 'setting_delete',
            ],
            [
                'id'    => 79,
                'title' => 'setting_access',
            ],
            [
                'id'    => 80,
                'title' => 'payment_create',
            ],
            [
                'id'    => 81,
                'title' => 'payment_edit',
            ],
            [
                'id'    => 82,
                'title' => 'payment_show',
            ],
            [
                'id'    => 83,
                'title' => 'payment_delete',
            ],
            [
                'id'    => 84,
                'title' => 'payment_access',
            ],
            [
                'id'    => 85,
                'title' => 'theme_create',
            ],
            [
                'id'    => 86,
                'title' => 'theme_edit',
            ],
            [
                'id'    => 87,
                'title' => 'theme_show',
            ],
            [
                'id'    => 88,
                'title' => 'theme_delete',
            ],
            [
                'id'    => 89,
                'title' => 'theme_access',
            ],
            [
                'id'    => 90,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
