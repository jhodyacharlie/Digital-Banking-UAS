<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('users', 'no_card')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('no_card')->nullable()->unique()->after('email');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'no_card')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropUnique('users_no_card_unique');
                $table->dropColumn('no_card');
            });
        }
    }
};
