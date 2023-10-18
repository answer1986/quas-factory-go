<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('material_base');
            $table->string('pintura');
            $table->decimal('medida', 8, 2); // Asume que puedes tener hasta 8 dígitos en total y 2 decimales.
            $table->decimal('ancho', 8, 2);  // Asume que puedes tener hasta 8 dígitos en total y 2 decimales.
            $table->text('observaciones')->nullable();
            $table->string('foto')->nullable(); //ruta del archivo de la imagen
            $table->unsignedInteger('cantidad'); // Asume que no tendrás valores negativos.
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
