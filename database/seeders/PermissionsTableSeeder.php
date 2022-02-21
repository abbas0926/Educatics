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
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 18,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 21,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 22,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 23,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 24,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 25,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 26,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 27,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 28,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 29,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 30,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 31,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 32,
                'title' => 'task_create',
            ],
            [
                'id'    => 33,
                'title' => 'task_edit',
            ],
            [
                'id'    => 34,
                'title' => 'task_show',
            ],
            [
                'id'    => 35,
                'title' => 'task_delete',
            ],
            [
                'id'    => 36,
                'title' => 'task_access',
            ],
            [
                'id'    => 37,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 38,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 39,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 40,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 41,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 42,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 43,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 44,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 45,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 46,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 47,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 48,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 49,
                'title' => 'expense_create',
            ],
            [
                'id'    => 50,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 51,
                'title' => 'expense_show',
            ],
            [
                'id'    => 52,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 53,
                'title' => 'expense_access',
            ],
            [
                'id'    => 54,
                'title' => 'income_create',
            ],
            [
                'id'    => 55,
                'title' => 'income_edit',
            ],
            [
                'id'    => 56,
                'title' => 'income_show',
            ],
            [
                'id'    => 57,
                'title' => 'income_delete',
            ],
            [
                'id'    => 58,
                'title' => 'income_access',
            ],
            [
                'id'    => 59,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 60,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 61,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 62,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 63,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 64,
                'title' => 'crm_access',
            ],
            [
                'id'    => 65,
                'title' => 'lead_create',
            ],
            [
                'id'    => 66,
                'title' => 'lead_edit',
            ],
            [
                'id'    => 67,
                'title' => 'lead_show',
            ],
            [
                'id'    => 68,
                'title' => 'lead_delete',
            ],
            [
                'id'    => 69,
                'title' => 'lead_access',
            ],
            [
                'id'    => 70,
                'title' => 'lead_interaction_create',
            ],
            [
                'id'    => 71,
                'title' => 'lead_interaction_edit',
            ],
            [
                'id'    => 72,
                'title' => 'lead_interaction_show',
            ],
            [
                'id'    => 73,
                'title' => 'lead_interaction_delete',
            ],
            [
                'id'    => 74,
                'title' => 'lead_interaction_access',
            ],
            [
                'id'    => 75,
                'title' => 'schooling_access',
            ],
            [
                'id'    => 76,
                'title' => 'formation_create',
            ],
            [
                'id'    => 77,
                'title' => 'formation_edit',
            ],
            [
                'id'    => 78,
                'title' => 'formation_show',
            ],
            [
                'id'    => 79,
                'title' => 'formation_delete',
            ],
            [
                'id'    => 80,
                'title' => 'formation_access',
            ],
            [
                'id'    => 81,
                'title' => 'promotion_create',
            ],
            [
                'id'    => 82,
                'title' => 'promotion_edit',
            ],
            [
                'id'    => 83,
                'title' => 'promotion_show',
            ],
            [
                'id'    => 84,
                'title' => 'promotion_delete',
            ],
            [
                'id'    => 85,
                'title' => 'promotion_access',
            ],
            [
                'id'    => 86,
                'title' => 'group_create',
            ],
            [
                'id'    => 87,
                'title' => 'group_edit',
            ],
            [
                'id'    => 88,
                'title' => 'group_show',
            ],
            [
                'id'    => 89,
                'title' => 'group_delete',
            ],
            [
                'id'    => 90,
                'title' => 'group_access',
            ],
            [
                'id'    => 91,
                'title' => 'student_create',
            ],
            [
                'id'    => 92,
                'title' => 'student_edit',
            ],
            [
                'id'    => 93,
                'title' => 'student_show',
            ],
            [
                'id'    => 94,
                'title' => 'student_delete',
            ],
            [
                'id'    => 95,
                'title' => 'student_access',
            ],
            [
                'id'    => 96,
                'title' => 'teacher_create',
            ],
            [
                'id'    => 97,
                'title' => 'teacher_edit',
            ],
            [
                'id'    => 98,
                'title' => 'teacher_show',
            ],
            [
                'id'    => 99,
                'title' => 'teacher_delete',
            ],
            [
                'id'    => 100,
                'title' => 'teacher_access',
            ],
            [
                'id'    => 101,
                'title' => 'setting_access',
            ],
            [
                'id'    => 102,
                'title' => 'classroom_create',
            ],
            [
                'id'    => 103,
                'title' => 'classroom_edit',
            ],
            [
                'id'    => 104,
                'title' => 'classroom_show',
            ],
            [
                'id'    => 105,
                'title' => 'classroom_delete',
            ],
            [
                'id'    => 106,
                'title' => 'classroom_access',
            ],
            [
                'id'    => 107,
                'title' => 'site_setting_create',
            ],
            [
                'id'    => 108,
                'title' => 'site_setting_edit',
            ],
            [
                'id'    => 109,
                'title' => 'site_setting_show',
            ],
            [
                'id'    => 110,
                'title' => 'site_setting_delete',
            ],
            [
                'id'    => 111,
                'title' => 'site_setting_access',
            ],
            [
                'id'    => 112,
                'title' => 'lesson_create',
            ],
            [
                'id'    => 113,
                'title' => 'lesson_edit',
            ],
            [
                'id'    => 114,
                'title' => 'lesson_show',
            ],
            [
                'id'    => 115,
                'title' => 'lesson_delete',
            ],
            [
                'id'    => 116,
                'title' => 'lesson_access',
            ],
            [
                'id'    => 117,
                'title' => 'employee_management_access',
            ],
            [
                'id'    => 118,
                'title' => 'employee_presence_create',
            ],
            [
                'id'    => 119,
                'title' => 'employee_presence_edit',
            ],
            [
                'id'    => 120,
                'title' => 'employee_presence_show',
            ],
            [
                'id'    => 121,
                'title' => 'employee_presence_delete',
            ],
            [
                'id'    => 122,
                'title' => 'employee_presence_access',
            ],
            [
                'id'    => 123,
                'title' => 'employee_create',
            ],
            [
                'id'    => 124,
                'title' => 'employee_edit',
            ],
            [
                'id'    => 125,
                'title' => 'employee_show',
            ],
            [
                'id'    => 126,
                'title' => 'employee_delete',
            ],
            [
                'id'    => 127,
                'title' => 'employee_access',
            ],
            [
                'id'    => 128,
                'title' => 'marketing_management_access',
            ],
            [
                'id'    => 129,
                'title' => 'event_create',
            ],
            [
                'id'    => 130,
                'title' => 'event_edit',
            ],
            [
                'id'    => 131,
                'title' => 'event_show',
            ],
            [
                'id'    => 132,
                'title' => 'event_delete',
            ],
            [
                'id'    => 133,
                'title' => 'event_access',
            ],
            [
                'id'    => 134,
                'title' => 'marketing_campaign_create',
            ],
            [
                'id'    => 135,
                'title' => 'marketing_campaign_edit',
            ],
            [
                'id'    => 136,
                'title' => 'marketing_campaign_show',
            ],
            [
                'id'    => 137,
                'title' => 'marketing_campaign_delete',
            ],
            [
                'id'    => 138,
                'title' => 'marketing_campaign_access',
            ],
            [
                'id'    => 139,
                'title' => 'student_payment_create',
            ],
            [
                'id'    => 140,
                'title' => 'student_payment_edit',
            ],
            [
                'id'    => 141,
                'title' => 'student_payment_show',
            ],
            [
                'id'    => 142,
                'title' => 'student_payment_delete',
            ],
            [
                'id'    => 143,
                'title' => 'student_payment_access',
            ],
            [
                'id'    => 144,
                'title' => 'invoice_create',
            ],
            [
                'id'    => 145,
                'title' => 'invoice_edit',
            ],
            [
                'id'    => 146,
                'title' => 'invoice_show',
            ],
            [
                'id'    => 147,
                'title' => 'invoice_delete',
            ],
            [
                'id'    => 148,
                'title' => 'invoice_access',
            ],
            [
                'id'    => 149,
                'title' => 'invoice_item_create',
            ],
            [
                'id'    => 150,
                'title' => 'invoice_item_edit',
            ],
            [
                'id'    => 151,
                'title' => 'invoice_item_show',
            ],
            [
                'id'    => 152,
                'title' => 'invoice_item_delete',
            ],
            [
                'id'    => 153,
                'title' => 'invoice_item_access',
            ],
            [
                'id'    => 154,
                'title' => 'salary_create',
            ],
            [
                'id'    => 155,
                'title' => 'salary_edit',
            ],
            [
                'id'    => 156,
                'title' => 'salary_show',
            ],
            [
                'id'    => 157,
                'title' => 'salary_delete',
            ],
            [
                'id'    => 158,
                'title' => 'salary_access',
            ],
            [
                'id'    => 159,
                'title' => 'web_site_access',
            ],
            [
                'id'    => 160,
                'title' => 'post_category_create',
            ],
            [
                'id'    => 161,
                'title' => 'post_category_edit',
            ],
            [
                'id'    => 162,
                'title' => 'post_category_show',
            ],
            [
                'id'    => 163,
                'title' => 'post_category_delete',
            ],
            [
                'id'    => 164,
                'title' => 'post_category_access',
            ],
            [
                'id'    => 165,
                'title' => 'article_create',
            ],
            [
                'id'    => 166,
                'title' => 'article_edit',
            ],
            [
                'id'    => 167,
                'title' => 'article_show',
            ],
            [
                'id'    => 168,
                'title' => 'article_delete',
            ],
            [
                'id'    => 169,
                'title' => 'article_access',
            ],
            [
                'id'    => 170,
                'title' => 'testimonial_create',
            ],
            [
                'id'    => 171,
                'title' => 'testimonial_edit',
            ],
            [
                'id'    => 172,
                'title' => 'testimonial_show',
            ],
            [
                'id'    => 173,
                'title' => 'testimonial_delete',
            ],
            [
                'id'    => 174,
                'title' => 'testimonial_access',
            ],
            [
                'id'    => 175,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
