<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToStudentPaymentsTable extends Migration
{
    public function up()
    {
        Schema::table('student_payments', function (Blueprint $table) {
            $table->unsignedBigInteger('charged_by_id')->nullable();
            $table->foreign('charged_by_id', 'charged_by_fk_6012734')->references('id')->on('users');
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->foreign('invoice_id', 'invoice_fk_6012779')->references('id')->on('invoices');
        });
    }
}
