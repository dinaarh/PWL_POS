<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profils', function (Blueprint $table) {
            $table->string('nama_lengkap')->nullable()->after('foto');
            $table->string('email')->nullable()->after('nama_lengkap');
            $table->string('no_hp')->nullable()->after('email');
            $table->text('alamat')->nullable()->after('no_hp');
            $table->string('role')->nullable()->after('alamat');
        });
    }

    public function down(): void
    {
        Schema::table('profils', function (Blueprint $table) {
            $table->dropColumn(['nama_lengkap', 'email', 'no_hp', 'alamat', 'role']);
        });
    }
};
