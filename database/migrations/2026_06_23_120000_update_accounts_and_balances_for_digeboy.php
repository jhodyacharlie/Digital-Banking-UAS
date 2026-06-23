<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('accounts', function (Blueprint $table) {
            if (! Schema::hasColumn('accounts', 'account_number')) {
                $table->string('account_number', 30)->nullable()->unique();
            }

            if (! Schema::hasColumn('accounts', 'account_name')) {
                $table->string('account_name', 100)->nullable();
            }

            if (! Schema::hasColumn('accounts', 'account_type')) {
                $table->string('account_type', 30)->default('Tabungan');
            }

            if (! Schema::hasColumn('accounts', 'status')) {
                $table->string('status', 20)->default('Aktif');
            }
        });

        if (Schema::hasColumn('accounts', 'name')) {
            DB::table('accounts')
                ->orderBy('id')
                ->select('id', 'name')
                ->get()
                ->each(function ($account) {
                    DB::table('accounts')
                        ->where('id', $account->id)
                        ->update([
                            'account_number' => 'DGB-' . str_pad((string) $account->id, 4, '0', STR_PAD_LEFT),
                            'account_name' => $account->name ?? 'Nasabah Digeboy',
                        ]);
                });
        }

        Schema::table('balances', function (Blueprint $table) {
            if (! Schema::hasColumn('balances', 'last_transaction_at')) {
                $table->timestamp('last_transaction_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('balances', function (Blueprint $table) {
            if (Schema::hasColumn('balances', 'last_transaction_at')) {
                $table->dropColumn('last_transaction_at');
            }
        });

        Schema::table('accounts', function (Blueprint $table) {
            if (Schema::hasColumn('accounts', 'account_number')) {
                $table->dropUnique(['account_number']);
                $table->dropColumn('account_number');
            }

            if (Schema::hasColumn('accounts', 'account_name')) {
                $table->dropColumn('account_name');
            }

            if (Schema::hasColumn('accounts', 'account_type')) {
                $table->dropColumn('account_type');
            }

            if (Schema::hasColumn('accounts', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
