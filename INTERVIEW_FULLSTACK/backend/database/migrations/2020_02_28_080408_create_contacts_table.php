<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('job_title');
            $table->string('company_name');
            $table->integer('age');
            $table->dateTime('created_at');
            $table->dateTime('edited_at');
        });*/
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            //$table->timestamps();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('job_title');
            $table->string('company_name');
            $table->integer('age');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

        });
        DB::statement('ALTER TABLE contacts ADD FULLTEXT search(first_name,last_name,job_title,company_name)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function($table) {
            $table->dropIndex('search');
        });
        //Schema::drop('contacts');
        Schema::dropIfExists('contacts');
    }
}
