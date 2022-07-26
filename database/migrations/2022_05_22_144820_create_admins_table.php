<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->enum('is_admin', ['3', '2', '1'])->default('1');
            $table->text('profile_photo')->nullable();
            $table->string('branch_name');
            $table->string('website');
            $table->enum('branch_type', ['Institute', 'School', 'Coaching']);
            $table->text('address');
            $table->string('contact', 11);
            $table->string('state');
            $table->string('district');
            $table->string('country')->default('India');
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('admins');
    }
}
