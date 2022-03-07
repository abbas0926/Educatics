<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/


Route::redirect('/', '/login');

Route::group(['middleware'=>['universal','web',InitializeTenancyByDomainOrSubdomain::class]] , function (){
    Auth::routes(['register'=>false]);
});


 
Route::group([ 'middleware' => ['web' ,
        PreventAccessFromCentralDomains::class ,
        InitializeTenancyByDomainOrSubdomain::class  ]
    ], function () {
      
        Route::get('/home', function () {
            
            if (session('status')) {
                dd("hey");
                return redirect()->route('tenant.home')->with('status', session('status'));
            }
        
            return redirect()->route('tenant.home');
        });
        Route::group(['prefix' => 'admin', 'as' => 'tenant.', 'namespace' => 'App\Http\Controllers\Tenant', 'middleware' => ['auth' ,
        PreventAccessFromCentralDomains::class ,
        InitializeTenancyByDomainOrSubdomain::class  ]
    ], function () {
    
    Route::get('/', 'HomeController@index')->name('home');
    
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Task Status
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tag
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Task
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendar
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Expense Category
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Income Category
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expense
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::resource('expenses', 'ExpenseController');

    // Income
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::resource('incomes', 'IncomeController');

    // Expense Report
    Route::delete('expense-reports/destroy', 'ExpenseReportController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('expense-reports', 'ExpenseReportController');

    // Lead
    Route::delete('leads/destroy', 'LeadController@massDestroy')->name('leads.massDestroy');
    Route::resource('leads', 'LeadController');

    // Lead Interaction
    Route::delete('lead-interactions/destroy', 'LeadInteractionController@massDestroy')->name('lead-interactions.massDestroy');
    Route::post('lead-interactions/media', 'LeadInteractionController@storeMedia')->name('lead-interactions.storeMedia');
    Route::post('lead-interactions/ckmedia', 'LeadInteractionController@storeCKEditorImages')->name('lead-interactions.storeCKEditorImages');
    Route::resource('lead-interactions', 'LeadInteractionController');

    // Formation
    Route::delete('formations/destroy', 'FormationController@massDestroy')->name('formations.massDestroy');
    Route::post('formations/media', 'FormationController@storeMedia')->name('formations.storeMedia');
    Route::post('formations/ckmedia', 'FormationController@storeCKEditorImages')->name('formations.storeCKEditorImages');
    Route::resource('formations', 'FormationController');

    // Promotion
    Route::delete('promotions/destroy', 'PromotionController@massDestroy')->name('promotions.massDestroy');
    Route::resource('promotions', 'PromotionController');

    // Group
    Route::delete('groups/destroy', 'GroupController@massDestroy')->name('groups.massDestroy');
    Route::resource('groups', 'GroupController');

    // Student
    Route::delete('students/destroy', 'StudentController@massDestroy')->name('students.massDestroy');
    Route::post('students/media', 'StudentController@storeMedia')->name('students.storeMedia');
    Route::post('students/ckmedia', 'StudentController@storeCKEditorImages')->name('students.storeCKEditorImages');
    Route::resource('students', 'StudentController');

    // Teacher
    Route::delete('teachers/destroy', 'TeacherController@massDestroy')->name('teachers.massDestroy');
    Route::post('teachers/media', 'TeacherController@storeMedia')->name('teachers.storeMedia');
    Route::post('teachers/ckmedia', 'TeacherController@storeCKEditorImages')->name('teachers.storeCKEditorImages');
    Route::resource('teachers', 'TeacherController');

    // Classroom
    Route::delete('classrooms/destroy', 'ClassroomController@massDestroy')->name('classrooms.massDestroy');
    Route::post('classrooms/media', 'ClassroomController@storeMedia')->name('classrooms.storeMedia');
    Route::post('classrooms/ckmedia', 'ClassroomController@storeCKEditorImages')->name('classrooms.storeCKEditorImages');
    Route::resource('classrooms', 'ClassroomController');

    // Site Setting
    Route::delete('site-settings/destroy', 'SiteSettingController@massDestroy')->name('site-settings.massDestroy');
    Route::resource('site-settings', 'SiteSettingController');

    // Lesson
    Route::delete('lessons/destroy', 'LessonController@massDestroy')->name('lessons.massDestroy');
    Route::post('lessons/media', 'LessonController@storeMedia')->name('lessons.storeMedia');
    Route::post('lessons/ckmedia', 'LessonController@storeCKEditorImages')->name('lessons.storeCKEditorImages');
    Route::resource('lessons', 'LessonController');
    // student presences
    Route::resource('presences','StudentPresencesController');
    // Employee Presence
    Route::delete('employee-presences/destroy', 'EmployeePresenceController@massDestroy')->name('employee-presences.massDestroy');
    Route::resource('employee-presences', 'EmployeePresenceController');

    // Employee
    Route::delete('employees/destroy', 'EmployeeController@massDestroy')->name('employees.massDestroy');
    Route::post('employees/media', 'EmployeeController@storeMedia')->name('employees.storeMedia');
    Route::post('employees/ckmedia', 'EmployeeController@storeCKEditorImages')->name('employees.storeCKEditorImages');
    Route::resource('employees', 'EmployeeController');

    // Event
    Route::delete('events/destroy', 'EventController@massDestroy')->name('events.massDestroy');
    Route::post('events/media', 'EventController@storeMedia')->name('events.storeMedia');
    Route::post('events/ckmedia', 'EventController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::resource('events', 'EventController');

    // Marketing Campaign
    Route::delete('marketing-campaigns/destroy', 'MarketingCampaignController@massDestroy')->name('marketing-campaigns.massDestroy');
    Route::post('marketing-campaigns/media', 'MarketingCampaignController@storeMedia')->name('marketing-campaigns.storeMedia');
    Route::post('marketing-campaigns/ckmedia', 'MarketingCampaignController@storeCKEditorImages')->name('marketing-campaigns.storeCKEditorImages');
    Route::resource('marketing-campaigns', 'MarketingCampaignController');

    // Student Payment
    Route::delete('student-payments/destroy', 'StudentPaymentController@massDestroy')->name('student-payments.massDestroy');
    Route::post('student-payments/media', 'StudentPaymentController@storeMedia')->name('student-payments.storeMedia');
    Route::post('student-payments/ckmedia', 'StudentPaymentController@storeCKEditorImages')->name('student-payments.storeCKEditorImages');
    Route::resource('student-payments', 'StudentPaymentController');

    // Invoice
    Route::delete('invoices/destroy', 'InvoiceController@massDestroy')->name('invoices.massDestroy');
    Route::resource('invoices', 'InvoiceController');

    // Invoice Item
    Route::delete('invoice-items/destroy', 'InvoiceItemController@massDestroy')->name('invoice-items.massDestroy');
    Route::resource('invoice-items', 'InvoiceItemController');

    // Salary
    Route::delete('salaries/destroy', 'SalaryController@massDestroy')->name('salaries.massDestroy');
    Route::resource('salaries', 'SalaryController');

    // Post Category
    Route::delete('post-categories/destroy', 'PostCategoryController@massDestroy')->name('post-categories.massDestroy');
    Route::resource('post-categories', 'PostCategoryController');

    // Article
    Route::delete('articles/destroy', 'ArticleController@massDestroy')->name('articles.massDestroy');
    Route::post('articles/media', 'ArticleController@storeMedia')->name('articles.storeMedia');
    Route::post('articles/ckmedia', 'ArticleController@storeCKEditorImages')->name('articles.storeCKEditorImages');
    Route::resource('articles', 'ArticleController');

    // Testimonial
    Route::delete('testimonials/destroy', 'TestimonialController@massDestroy')->name('testimonials.massDestroy');
    Route::resource('testimonials', 'TestimonialController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
    }
);



