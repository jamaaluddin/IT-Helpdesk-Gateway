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
        Schema::create('maintenance_records', function (Blueprint $table) {
    $table->id();

    $table->foreignId('maintenance_schedule_id')
        ->constrained('maintenance_schedules')
        ->cascadeOnDelete();

    $table->foreignId('asset_id')
        ->constrained('assets');

    $table->foreignId('performed_by')
        ->constrained('users');

    $table->text('analysis')->nullable();
    $table->text('action');
    $table->text('result')->nullable();
    $table->text('remarks')->nullable();

    $table->enum('condition_after', [
        'good',
        'minor_damage',
        'major_damage',
        'broken'
    ])->nullable();

    $table->timestamp('performed_at');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_records');
    }
};
