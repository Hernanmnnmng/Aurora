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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // For scanning
            $table->string('event_name');
            $table->dateTime('event_date');
            $table->string('customer_name');
            $table->string('customer_email')->nullable();
            $table->string('seat')->nullable();
            $table->boolean('used')->default(false);
            $table->dateTime('used_at')->nullable();
            $table->dateTime('expires_at')->nullable();
            $table->boolean('cancelled')->default(false);
            $table->dateTime('cancelled_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};