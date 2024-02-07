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
        Schema::create('corporations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('number')->unique();
            $table->timestamps();

            $table->bigInteger('account_holder_id')->unsigned()->unique();
            $table->bigInteger('account_id')->unsigned()->unique();

            $table->foreign("account_holder_id")
                ->references("id")
                ->on("customers")
                ->onDelete("cascade");

            $table->foreign("account_id")
                ->references("id")
                ->on("accounts")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corporations');
    }
};
