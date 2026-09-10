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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->after('id')->constrained('roles');
            $table->foreignId('office_id')->after('role_id')->constrained('offices');
            $table->foreignId('department_id')->after('office_id')->constrained('departments');

            $table->string('phone')->nullable()->after('email');
            $table->enum('status', ['pending', 'active', 'rejected'])
                ->default('pending')
                ->after('password');
            $table->timestamp('approved_at')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['office_id']);
            $table->dropForeign(['department_id']);

            $table->dropColumn([
                'role_id',
                'office_id',
                'department_id',
                'phone',
                'status',
                'approved_at',
            ]);
        });
    }
};
