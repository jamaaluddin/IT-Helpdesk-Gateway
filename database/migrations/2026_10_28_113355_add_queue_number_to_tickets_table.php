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
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedInteger('queue_number')
                ->nullable()
                ->after('ticket_number');

            $table->date('queue_date')
                ->nullable()
                ->after('queue_number');

            $table->unique(
                ['queue_date', 'queue_number'],
                'tickets_queue_date_number_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropUnique('tickets_queue_date_number_unique');

            $table->dropColumn([
                'queue_number',
                'queue_date',
            ]);
        });
    }
};
