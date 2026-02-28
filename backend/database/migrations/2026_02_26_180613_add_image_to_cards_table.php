<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('cards', function (Blueprint $table) {
            $table->string('image')->nullable()->after('pack_id');
        });
    }

    public function down() {
        Schema::table('cards', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};