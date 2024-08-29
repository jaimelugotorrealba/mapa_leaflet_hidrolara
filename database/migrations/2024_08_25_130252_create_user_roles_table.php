<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->timestamps();
        });
        $this->insertRoles();
        $this->insertUserRoles();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }

    private function insertRoles(): void
    {
        $rolesSql = [
            ['name' => 'Administrador', 'status' => 'A'],
            ['name' => 'Jefe', 'status' => 'A'],
            ['name' => 'Visitante', 'status' => 'A']
        ];
        DB::table('roles')->insert($rolesSql);
    }

    private function insertUserRoles(): void
    {
        $userRolesSql = [
            ['user_id' => 1, 'role_id' => 1]
        ];
        DB::table('user_roles')->insert($userRolesSql);
    }
};
