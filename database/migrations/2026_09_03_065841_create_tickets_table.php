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

            $table->string('ticket_number')->unique();

            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('office_id')->constrained('offices');
            $table->foreignId('department_id')->constrained('departments');
            $table->foreignId('category_id')->constrained('ticket_categories');

            $table->string('subject');
            $table->text('description');

            // Catatan penyelesaian tiket oleh IT Support
            $table->text('resolution_notes')->nullable();

            // Lokasi file bukti penyelesaian tiket
            $table->string('evidence')->nullable();

            $table->enum('priority', ['low', 'medium', 'high', 'critical'])
                ->default('medium');

            $table->enum('status', [
                'open',
                'assigned',
                'in_progress',
                'waiting',
                'resolved',
                'closed',
            ])->default('open');

            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamp('closed_at')->nullable();

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
