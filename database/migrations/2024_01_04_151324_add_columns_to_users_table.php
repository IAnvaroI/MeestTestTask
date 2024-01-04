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
            $table->renameColumn('name', 'firstname');
            $table->string('lastname', 255);
            $table->date('birth_date');
            $table->string('gender', 10); //know that there can be boolean field but there are also transgenders)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('firstname', 'name');
            $table->dropColumn([
                'lastname',
                'birth_date',
                'gender',
            ]);
        });
    }
};
