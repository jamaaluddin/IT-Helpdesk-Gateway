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
        Schema::create('maintenance_schedules', function (Blueprint $table) {
    $table->id();

    $table->foreignId('asset_id')
        ->constrained('assets')
        ->cascadeOnDelete();

    $table->foreignId('office_id')
        ->constrained('offices');

    $table->foreignId('scheduled_by')
        ->constrained('users');

    $table->date('scheduled_date');
    $table->date('actual_date')->nullable();

    $table->enum('status', [
        'scheduled',
        'completed',
        'cancelled',
        'rescheduled'
    ])->default('scheduled');

    $table->text('result')->nullable();
    $table->text('remarks')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_schedules');
    }
};
