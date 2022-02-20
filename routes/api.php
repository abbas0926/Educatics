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
