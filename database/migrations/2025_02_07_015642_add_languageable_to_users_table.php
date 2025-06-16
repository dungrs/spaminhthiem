<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLanguageableToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->nullableMorphs('languageable');  // Thêm cột 'languageable_type' và 'languageable_id'
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropMorphs('languageable');
        });
    }
}
