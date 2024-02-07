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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->boolean('is_active');
            $table->timestamps();

            $table->bigInteger('owner_id')->unsigned()->unique();
            $table->bigInteger('subscription_id')->unsigned()->unique();

            $table->foreign("owner_id")
                ->references("id")
                ->on("customers")
                ->onDelete("cascade");

            $table->foreign("subscription_id")
                ->references("id")
                ->on("subscriptions")
                ->onDelete("cascade");
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
