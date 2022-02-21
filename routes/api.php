<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Crm Status
    Route::apiResource('crm-statuses', 'CrmStatusApiController');

    // Crm Customer
    Route::apiResource('crm-customers', 'CrmCustomerApiController');

    // Crm Note
    Route::apiResource('crm-notes', 'CrmNoteApiController');

    // Crm Document
    Route::post('crm-documents/media', 'CrmDocumentApiController@storeMedia')->name('crm-documents.storeMedia');
    Route::apiResource('crm-documents', 'CrmDocumentApiController');

    // Task Status
    Route::apiResource('task-statuses', 'TaskStatusApiController');

    // Task Tag
    Route::apiResource('task-tags', 'TaskTagApiController');

    // Task
    Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TaskApiController');

    // Feature
    Route::apiResource('features', 'FeatureApiController');

    // Package
    Route::post('packages/media', 'PackageApiController@storeMedia')->name('packages.storeMedia');
    Route::apiResource('packages', 'PackageApiController');

    // Tenant
    Route::post('tenants/media', 'TenantApiController@storeMedia')->name('tenants.storeMedia');
    Route::apiResource('tenants', 'TenantApiController');

    // Domain
    Route::apiResource('domains', 'DomainApiController');

    // Payment
    Route::apiResource('payments', 'PaymentApiController');

    // Theme
    Route::post('themes/media', 'ThemeApiController@storeMedia')->name('themes.storeMedia');
    Route::apiResource('themes', 'ThemeApiController');
});

Route::group(['prefix' => 'v1', 'as' => 'api.tenant', 'namespace' => 'Api\V1\Tenant', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Lead
    Route::apiResource('leads', 'LeadApiController');

    // Lead Interaction
    Route::post('lead-interactions/media', 'LeadInteractionApiController@storeMedia')->name('lead-interactions.storeMedia');
    Route::apiResource('lead-interactions', 'LeadInteractionApiController');

    // Formation
    Route::post('formations/media', 'FormationApiController@storeMedia')->name('formations.storeMedia');
    Route::apiResource('formations', 'FormationApiController');

    // Promotion
    Route::apiResource('promotions', 'PromotionApiController');

    // Group
    Route::apiResource('groups', 'GroupApiController');

    // Student
    Route::post('students/media', 'StudentApiController@storeMedia')->name('students.storeMedia');
    Route::apiResource('students', 'StudentApiController');

    // Teacher
    Route::post('teachers/media', 'TeacherApiController@storeMedia')->name('teachers.storeMedia');
    Route::apiResource('teachers', 'TeacherApiController');

    // Classroom
    Route::post('classrooms/media', 'ClassroomApiController@storeMedia')->name('classrooms.storeMedia');
    Route::apiResource('classrooms', 'ClassroomApiController');

    // Site Setting
    Route::apiResource('site-settings', 'SiteSettingApiController');

    // Lesson
    Route::post('lessons/media', 'LessonApiController@storeMedia')->name('lessons.storeMedia');
    Route::apiResource('lessons', 'LessonApiController');

    // Employee Presence
    Route::apiResource('employee-presences', 'EmployeePresenceApiController');

    // Employee
    Route::post('employees/media', 'EmployeeApiController@storeMedia')->name('employees.storeMedia');
    Route::apiResource('employees', 'EmployeeApiController');

    // Event
    Route::post('events/media', 'EventApiController@storeMedia')->name('events.storeMedia');
    Route::apiResource('events', 'EventApiController');

    // Marketing Campaign
    Route::post('marketing-campaigns/media', 'MarketingCampaignApiController@storeMedia')->name('marketing-campaigns.storeMedia');
    Route::apiResource('marketing-campaigns', 'MarketingCampaignApiController');

    // Student Payment
    Route::post('student-payments/media', 'StudentPaymentApiController@storeMedia')->name('student-payments.storeMedia');
    Route::apiResource('student-payments', 'StudentPaymentApiController');

    // Invoice
    Route::apiResource('invoices', 'InvoiceApiController');

    // Invoice Item
    Route::apiResource('invoice-items', 'InvoiceItemApiController');

    // Salary
    Route::apiResource('salaries', 'SalaryApiController');
});
