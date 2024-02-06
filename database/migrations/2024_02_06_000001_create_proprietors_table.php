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
        Schema::create('proprietors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('unit_entitlement');
            $table->string('email')->unique();
            $table->string('postal_address');
            $table->dateTime('date_created');
            $table->bigInteger('user_id')->unsigned()->unique();
            $table->bigInteger('account_id')->unsigned()->unique();

            $table->foreign("user_id")
                ->references("id")
                ->on("users")
                ->onDelete("cascade");

            $table->foreign("account_id")
                ->references("id")
                ->on("accounts")
                ->onDelete("cascade");

            // $table->unsignedInteger('column_name')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proprietors');
    }
};
