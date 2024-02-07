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
            $table->integer('lot_number')->unique();
            $table->string('email')->unique();
            $table->decimal('maintenance_fee', 8,2);
            $table->string('postal_address')->nullable();
            $table->dateTime('date_created');

            $table->bigInteger('corporation_id')->unsigned();

            $table->foreign("corporation_id")
                ->references("id")
                ->on("corporations")
                ->onDelete("cascade");

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
