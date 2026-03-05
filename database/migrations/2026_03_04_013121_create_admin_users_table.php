<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminusers', function (Blueprint $table) {

            $table->id();
            
            $table->longText('profile_img')->nullable();
            $table->string('name', 50);
            $table->string('gender', 100)->nullable();
            $table->string('designation', 255)->nullable();

            // Role foreign key
            $table->foreignId('role_id')
                ->constrained()
                ->onDelete('cascade');

            // Unique email and username
            $table->string('email', 191)->unique();
            $table->string('username', 50)->unique();

            // Password 255 for bcrypt
            $table->string('password', 255);

            $table->boolean('two_step_enabled')->default(1);
            $table->boolean('device_check_enabled')->default(1);

            $table->string('otp', 50)->nullable();
            $table->string('remember_token', 100)->nullable();

            // Changed from status to is_active
            $table->boolean('is_active')->default(1);

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
        Schema::dropIfExists('admin_users');
    }
}
