<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSidebarMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('sidebar_menus', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Menu name
            $table->string('route_name')->nullable(); // Laravel route
            $table->string('icon')->nullable(); // optional icon class
            $table->unsignedBigInteger('parent_id')->nullable(); // for submenus
            $table->integer('order')->default(0); // display order
            $table->string('roles')->nullable(); // comma-separated role_ids
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
        Schema::dropIfExists('sidebar_menus');
    }
}
