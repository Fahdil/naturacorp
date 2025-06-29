<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // id AUTO_INCREMENT
            $table->string('prenom', 100)->nullable();
            $table->string('nom', 100)->nullable();
            $table->string('email')->unique();
            $table->text('mot_de_passe_hash');
            $table->enum('role', ['commercial', 'admin', 'owner']);
            $table->timestamps(); // created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
