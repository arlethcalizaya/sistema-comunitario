<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->string('lastname')->nullable()->after('name');
            $table->string('phone')->nullable()->after('email');
            $table->string('role')->default('user')->after('password'); // user o admin
            $table->string('status')->default('active')->after('role');
        });
    }
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['lastname', 'phone', 'role', 'status']);
        });
    }
};