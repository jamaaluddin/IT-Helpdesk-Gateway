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
        Schema::create('server_maintenance', function (Blueprint $table) {
            $table->id();

            $table->foreignId('office_id')
                ->constrained('offices');

            $table->foreignId('performed_by')
                ->constrained('users');

            $table->string('ip_address')->nullable();
            $table->string('security')->nullable();
            $table->string('bandwidth')->nullable();

            $table->date('maintenance_date');

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
        Schema::dropIfExists('server_maintenance');
    }
};
