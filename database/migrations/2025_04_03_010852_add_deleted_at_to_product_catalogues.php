<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('product_catalogues', function (Blueprint $table) {
            $table->softDeletes(); // Thêm cột deleted_at
        });
    }

    public function down(): void
    {
        Schema::table('product_catalogues', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Xóa cột deleted_at nếu rollback
        });
    }
};
