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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active');
            $table->timestamp('start_date')->useCurrent();
            $table->timestamp('renewal_date');
            $table->timestamps();

            $table->bigInteger('plan_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned()->unique();

            $table->foreign("plan_id")
                ->references("id")
                ->on("plans")
                ->onDelete("cascade");

            $table->foreign("customer_id")
                ->references("id")
                ->on("customers")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
