<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['customer_catalogue_id']);
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_catalogue_id')->nullable()->change();

            $table->foreign('customer_catalogue_id')->references('id')->on('customer_catalogues')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['customer_catalogue_id']);
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_catalogue_id')->default(0)->change();

            $table->foreign('customer_catalogue_id')->references('id')->on('customer_catalogues')->onDelete('cascade');
        });
    }
};
