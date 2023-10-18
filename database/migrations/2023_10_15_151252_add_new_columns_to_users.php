<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')
                  ->nullable();
            $table->enum('gender', ['laki-laki', 'perempuan'])
                  ->nullable();
            $table->date('birth_date')
                  ->nullable();
            $table->string('job')
                  ->nullable();
            $table->text('address')
                  ->nullable();
            $table->text('about')
                  ->nullable();            
            $table->unsignedBigInteger('role_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
