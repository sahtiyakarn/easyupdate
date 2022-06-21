<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('registration')->unique();
            $table->string('admission_date');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('profile_photo')->nullable();
            $table->string('batch_time');
            $table->string('course');
            $table->string('guardion_name');
            $table->string('mother_name')->nullable();
            $table->text('address');
            $table->string('contact_no');
            $table->integer('fee');
            $table->string('qualification');
            $table->string('birth_date');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->enum('fee_no', ['1', '2', '3']);
            $table->boolean('fee_information')->default(0);
            $table->enum('is_active', ['0', '1'])->default(1);
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
