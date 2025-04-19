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

            if (Schema::hasColumn('users', 'name')) {
                $table->dropColumn('name');
            }
            $table->string('username')->unique()->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable()->after('email');
            $table->text('address')->nullable()->after('avatar');
            $table->tinyInteger('status')->default(1)->after('address')->comment('1: active / 0: deactivated');
            $table->boolean('is_deleted')->default(false)->after('status');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username','first_name','last_name','phone','avatar', 'address', 'status', 'is_deleted']);
            $table->string('name')->nullable();
        });
    }
};
