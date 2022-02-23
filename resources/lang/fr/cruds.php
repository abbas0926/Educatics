<?php

return [
    'userManagement' => [
        'title'          => 'Gestion des utilisateurs',
        'title_singular' => 'Gestion des utilisateurs',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Rôles',
        'title_singular' => 'Rôle',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Utilisateurs',
        'title_singular' => 'Utilisateur',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'photo'                    => 'Photo',
            'photo_helper'             => ' ',
            'attachements'             => 'Attachements',
            'attachements_helper'      => ' ',
            'salary'                   => 'Salary',
            'salary_helper'            => ' ',
        ],
    ],
    'userAlert' => [
        'title'          => 'User Alerts',
        'title_singular' => 'User Alert',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'Alert Text',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Alert Link',
            'alert_link_helper' => ' ',
            'user'              => 'Users',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],
    'taskManagement' => [
        'title'          => 'Task management',
        'title_singular' => 'Task management',
    ],
    'taskStatus' => [
        'title'          => 'Statuses',
        'title_singular' => 'Status',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'taskTag' => [
        'title'          => 'Tags',
        'title_singular' => 'Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'task' => [
        'title'          => 'Tasks',
        'title_singular' => 'Task',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'tag'                => 'Tags',
            'tag_helper'         => ' ',
            'attachment'         => 'Attachment',
            'attachment_helper'  => ' ',
            'due_date'           => 'Due date',
            'due_date_helper'    => ' ',
            'assigned_to'        => 'Assigned to',
            'assigned_to_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'tasksCalendar' => [
        'title'          => 'Calendar',
        'title_singular' => 'Calendar',
    ],
    'expenseManagement' => [
        'title'          => 'Gestion des dépenses',
        'title_singular' => 'Gestion des dépenses',
    ],
    'expenseCategory' => [
        'title'          => 'Catégories de dépenses',
        'title_singular' => 'Catégorie de dépenses',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'incomeCategory' => [
        'title'          => 'Catégories de revenu',
        'title_singular' => 'Catégorie de revenu',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'expense' => [
        'title'          => 'Dépenses',
        'title_singular' => 'Dépense',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'expense_category'        => 'Expense Category',
            'expense_category_helper' => ' ',
            'entry_date'              => 'Entry Date',
            'entry_date_helper'       => ' ',
            'amount'                  => 'Amount',
            'amount_helper'           => ' ',
            'description'             => 'Description',
            'description_helper'      => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated At',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted At',
            'deleted_at_helper'       => ' ',
            'title'                   => 'Title',
            'title_helper'            => ' ',
        ],
    ],
    'income' => [
        'title'          => 'Revenus',
        'title_singular' => 'Revenus',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'income_category'        => 'Income Category',
            'income_category_helper' => ' ',
            'entry_date'             => 'Entry Date',
            'entry_date_helper'      => ' ',
            'amount'                 => 'Amount',
            'amount_helper'          => ' ',
            'description'            => 'Description',
            'description_helper'     => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated At',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted At',
            'deleted_at_helper'      => ' ',
        ],
    ],
    'expenseReport' => [
        'title'          => 'Rapport mensuel',
        'title_singular' => 'Rapport mensuel',
        'reports'        => [
            'title'             => 'Rapports',
            'title_singular'    => 'Rapport',
            'incomeReport'      => 'Rapport de revenus',
            'incomeByCategory'  => 'Revenu par catégorie',
            'expenseByCategory' => 'Dépenses par catégorie',
            'income'            => 'Revenus',
            'expense'           => 'Dépense',
            'profit'            => 'Gains',
        ],
    ],
    'crm' => [
        'title'          => 'CRM',
        'title_singular' => 'CRM',
    ],
    'lead' => [
        'title'          => 'Leads',
        'title_singular' => 'Lead',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'first_name'                => 'First Name',
            'first_name_helper'         => ' ',
            'last_name'                 => 'Last Name',
            'last_name_helper'          => ' ',
            'email'                     => 'Email',
            'email_helper'              => ' ',
            'phone'                     => 'Phone',
            'phone_helper'              => ' ',
            'status'                    => 'Status',
            'status_helper'             => ' ',
            'source'                    => 'Source',
            'source_helper'             => ' ',
            'notes'                     => 'Notes',
            'notes_helper'              => ' ',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
            'formation'                 => 'Formation',
            'formation_helper'          => ' ',
            'events'                    => 'Events',
            'events_helper'             => ' ',
            'marketing_campaign'        => 'Marketing Campaign',
            'marketing_campaign_helper' => ' ',
        ],
    ],
    'leadInteraction' => [
        'title'          => 'Lead Interactions',
        'title_singular' => 'Lead Interaction',
        'fields'         => [
            'id'                           => 'ID',
            'id_helper'                    => ' ',
            'lead'                         => 'Lead',
            'lead_helper'                  => ' ',
            'communication_channel'        => 'Communication Channel',
            'communication_channel_helper' => ' ',
            'notes'                        => 'Notes',
            'notes_helper'                 => ' ',
            'user'                         => 'User',
            'user_helper'                  => ' ',
            'created_at'                   => 'Created at',
            'created_at_helper'            => ' ',
            'updated_at'                   => 'Updated at',
            'updated_at_helper'            => ' ',
            'deleted_at'                   => 'Deleted at',
            'deleted_at_helper'            => ' ',
        ],
    ],
    'schooling' => [
        'title'          => 'Schooling',
        'title_singular' => 'Schooling',
    ],
    'formation' => [
        'title'          => 'Formations',
        'title_singular' => 'Formation',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'title'                 => 'Title',
            'title_helper'          => ' ',
            'description'           => 'Description',
            'description_helper'    => ' ',
            'price'                 => 'Price',
            'price_helper'          => ' ',
            'featured_image'        => 'Featured Image',
            'featured_image_helper' => ' ',
            'duration'              => 'Duration',
            'duration_helper'       => ' ',
            'syllabus'              => 'Syllabus  (50 mb max)',
            'syllabus_helper'       => ' ',
            'status'                => 'Status',
            'status_helper'         => ' ',
            'slug'                  => 'Slug',
            'slug_helper'           => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'promotion' => [
        'title'          => 'Promotion',
        'title_singular' => 'Promotion',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'formation'            => 'Formation',
            'formation_helper'     => ' ',
            'starting_date'        => 'Starting Date',
            'starting_date_helper' => ' ',
            'ending_date'          => 'Ending Date',
            'ending_date_helper'   => ' ',
            'price'                => 'Price',
            'price_helper'         => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'name'                 => 'Name',
            'name_helper'          => ' ',
            'student'              => 'Students',
            'student_helper'       => ' ',
        ],
    ],
    'group' => [
        'title'          => 'Groups',
        'title_singular' => 'Group',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'promotion'         => 'Promotion',
            'promotion_helper'  => ' ',
            'student'           => 'Students',
            'student_helper'    => ' ',
        ],
    ],
    'student' => [
        'title'          => 'Students',
        'title_singular' => 'Student',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'attachements'          => 'Attachements',
            'attachements_helper'   => ' ',
            'first_name'            => 'First Name',
            'first_name_helper'     => ' ',
            'last_name'             => 'Last Name',
            'last_name_helper'      => ' ',
            'email'                 => 'Email',
            'email_helper'          => ' ',
            'birthdate'             => 'Birthdate',
            'birthdate_helper'      => ' ',
            'adresse'               => 'Adresse',
            'adresse_helper'        => ' ',
            'study_level'           => 'Study Level',
            'study_level_helper'    => ' ',
            'establishement'        => 'Establishement',
            'establishement_helper' => ' ',
            'photo'                 => 'Photo',
            'photo_helper'          => ' ',
            'matricule'             => 'Matricule',
            'matricule_helper'      => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'teacher' => [
        'title'          => 'Teachers',
        'title_singular' => 'Teacher',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'first_name'        => 'First Name',
            'first_name_helper' => ' ',
            'last_name'         => 'Last Name',
            'last_name_helper'  => ' ',
            'email'             => 'Email',
            'email_helper'      => ' ',
            'phone'             => 'Phone',
            'phone_helper'      => ' ',
            'photo'             => 'Photo',
            'photo_helper'      => ' ',
            'cv'                => 'CV',
            'cv_helper'         => ' ',
            'speciality'        => 'Speciality',
            'speciality_helper' => ' ',
            'salary'            => 'Salary',
            'salary_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'setting' => [
        'title'          => 'Settings',
        'title_singular' => 'Setting',
    ],
    'classroom' => [
        'title'          => 'Classrooms',
        'title_singular' => 'Classroom',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'capacity'          => 'Capacity',
            'capacity_helper'   => ' ',
            'equipments'        => 'Equipments',
            'equipments_helper' => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'siteSetting' => [
        'title'          => 'Site Settings',
        'title_singular' => 'Site Setting',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'key'               => 'Key',
            'key_helper'        => ' ',
            'value'             => 'Value',
            'value_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'lesson' => [
        'title'          => 'Lessons',
        'title_singular' => 'Lesson',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'group'                   => 'Group',
            'group_helper'            => ' ',
            'teacher'                 => 'Teacher',
            'teacher_helper'          => ' ',
            'start_at'                => 'Start At',
            'start_at_helper'         => ' ',
            'ends_at'                 => 'Ends At',
            'ends_at_helper'          => ' ',
            'classroom'               => 'Classroom',
            'classroom_helper'        => ' ',
            'support'                 => 'Support',
            'support_helper'          => ' ',
            'homework'                => 'Homework',
            'homework_helper'         => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'presence_student'        => 'Presence Student',
            'presence_student_helper' => ' ',
            'done'                    => 'Done',
            'done_helper'             => ' ',
        ],
    ],
    'employeeManagement' => [
        'title'          => 'Employee Management',
        'title_singular' => 'Employee Management',
    ],
    'employeePresence' => [
        'title'          => 'Employee Presence',
        'title_singular' => 'Employee Presence',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'employee'          => 'Employee',
            'employee_helper'   => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
            'note'              => 'Note',
            'note_helper'       => ' ',
            'started_at'        => 'Started At',
            'started_at_helper' => ' ',
            'ended_at'          => 'Ended At',
            'ended_at_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'employee' => [
        'title'          => 'Employees',
        'title_singular' => 'Employee',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'title'               => 'Title',
            'title_helper'        => ' ',
            'first_name'          => 'First Name',
            'first_name_helper'   => ' ',
            'last_name'           => 'Last Name',
            'last_name_helper'    => ' ',
            'phone'               => 'Phone',
            'phone_helper'        => ' ',
            'email'               => 'Email',
            'email_helper'        => ' ',
            'status'              => 'Status',
            'status_helper'       => ' ',
            'photo'               => 'Photo',
            'photo_helper'        => ' ',
            'attachements'        => 'Attachements',
            'attachements_helper' => ' ',
            'salary'              => 'Salary',
            'salary_helper'       => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
        ],
    ],
    'marketingManagement' => [
        'title'          => 'Marketing',
        'title_singular' => 'Marketing',
    ],
    'event' => [
        'title'          => 'Events',
        'title_singular' => 'Event',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'title'                 => 'Title',
            'title_helper'          => ' ',
            'price'                 => 'Price',
            'price_helper'          => ' ',
            'start_at'              => 'Start At',
            'start_at_helper'       => ' ',
            'ends_at'               => 'Ends At',
            'ends_at_helper'        => ' ',
            'slug'                  => 'Slug',
            'slug_helper'           => ' ',
            'featured_image'        => 'Featured Image',
            'featured_image_helper' => ' ',
            'description'           => 'Description',
            'description_helper'    => ' ',
            'gallery'               => 'Gallery',
            'gallery_helper'        => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'marketingCampaign' => [
        'title'          => 'Marketing Campaigns',
        'title_singular' => 'Marketing Campaign',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'gallery'           => 'Gallery',
            'gallery_helper'    => ' ',
            'manager'           => 'Manager',
            'manager_helper'    => ' ',
            'budget'            => 'Budget',
            'budget_helper'     => ' ',
            'formation'         => 'Related formations',
            'formation_helper'  => ' ',
            'events'            => 'Related Events',
            'events_helper'     => ' ',
            'lead'              => 'Subscribed Leads',
            'lead_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'expenses'          => 'Expenses',
            'expenses_helper'   => ' ',
        ],
    ],
    'studentPayment' => [
        'title'          => 'Student Payments',
        'title_singular' => 'Student Payment',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'charged_by'            => 'Charged By',
            'charged_by_helper'     => ' ',
            'amount'                => 'Amount',
            'amount_helper'         => ' ',
            'payment_method'        => 'Payment Method',
            'payment_method_helper' => ' ',
            'attachement'           => 'Attachement',
            'attachement_helper'    => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'invoice'               => 'Invoice',
            'invoice_helper'        => ' ',
        ],
    ],
    'invoice' => [
        'title'          => 'Invoices',
        'title_singular' => 'Invoice',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'student'             => 'Student',
            'student_helper'      => ' ',
            'deadline'            => 'Deadline',
            'deadline_helper'     => ' ',
            'tva'                 => 'TVA',
            'tva_helper'          => ' ',
            'total'               => 'Total',
            'total_helper'        => ' ',
            'total_to_pay'        => 'Total To Pay',
            'total_to_pay_helper' => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'subject'             => 'Subject',
            'subject_helper'      => ' ',
        ],
    ],
    'invoiceItem' => [
        'title'          => 'Invoice Item',
        'title_singular' => 'Invoice Item',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'formation'         => 'Formation',
            'formation_helper'  => ' ',
            'event'             => 'Event',
            'event_helper'      => ' ',
            'quantity'          => 'Quantity',
            'quantity_helper'   => ' ',
            'price'             => 'Price',
            'price_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'salary' => [
        'title'          => 'Salaries',
        'title_singular' => 'Salary',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'employee'            => 'Employee',
            'employee_helper'     => ' ',
            'month'               => 'Month',
            'month_helper'        => ' ',
            'taken_salary'        => 'Taken Salary',
            'taken_salary_helper' => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
        ],
    ],
    'webSite' => [
        'title'          => 'Web Site',
        'title_singular' => 'Web Site',
    ],
    'postCategory' => [
        'title'          => 'Post Category',
        'title_singular' => 'Post Category',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'slug'               => 'Slug',
            'slug_helper'        => ' ',
            'subtitle'           => 'Subtitle',
            'subtitle_helper'    => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'article' => [
        'title'          => 'Article',
        'title_singular' => 'Article',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'title'                 => 'Title',
            'title_helper'          => ' ',
            'slug'                  => 'Slug',
            'slug_helper'           => ' ',
            'subtitle'              => 'Subtitle',
            'subtitle_helper'       => ' ',
            'content'               => 'Content',
            'content_helper'        => ' ',
            'featured_image'        => 'Featured Image',
            'featured_image_helper' => ' ',
            'gallery'               => 'Gallery',
            'gallery_helper'        => ' ',
            'status'                => 'Status',
            'status_helper'         => ' ',
            'author'                => 'Author',
            'author_helper'         => ' ',
            'category'              => 'Category',
            'category_helper'       => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'testimonial' => [
        'title'          => 'Testimonial',
        'title_singular' => 'Testimonial',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'content'           => 'Content',
            'content_helper'    => ' ',
            'rating'            => 'Rating',
            'rating_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'modals'=>[
        'confirm_delete'=>'Êtes-vous sûr de bien vouloir supprimer cet élément?',
        'accept_delete'=>'Oui!',
        'confirm_action'=>'Veuillez confirmer cette action!',
    ]
];
