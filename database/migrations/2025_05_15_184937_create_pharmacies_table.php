<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmaciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('pharmacies', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('adresse');
        $table->string('email')->nullable();
        $table->string('telephone')->nullable();
        $table->enum('statut', ['prospect', 'client_actif', 'client_inactif']);
        $table->string('region')->nullable();
        $table->string('departement')->nullable();
        $table->unsignedBigInteger('user_id'); // Le commercial
        $table->integer('volume_commande')->default(0);
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pharmacies');
    }
}
