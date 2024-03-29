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
        Schema::create('contributions', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 9,2);
            $table->timestamps();

            $table->bigInteger('corporation_id')->unsigned();
            $table->bigInteger('proprietor_id')->unsigned();

            $table->foreign("corporation_id")
                ->references("id")
                ->on("corporations")
                ->onDelete("cascade");

            $table->foreign("proprietor_id")
                ->references("id")
                ->on("proprietors")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributions');
    }
};
