<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $mainDBName = maindDatabaseNameFromAppName();
        Schema::create('permission_user', function (Blueprint $table) use($mainDBName) {
            $table->bigIncrements('id');
            $table->bigInteger('permission_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on($mainDBName.'.users')->onUpdate('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onUpdate('cascade');
            $table->unique(['user_id', 'permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_user');
    }
};
