<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('stock_updated')
                ->default(false)
                ->after('confirm')
                ->comment('Đã xử lý tồn kho chưa (true: đã trừ kho, false: chưa)');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('stock_updated');
        });
    }
};

