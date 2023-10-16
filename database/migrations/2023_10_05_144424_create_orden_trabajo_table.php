<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenTrabajoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_trabajo', function (Blueprint $table) {
            $table->id();
            $table->string('numero_oc');
            $table->enum('tipo_proceso', [
                'estruccion', 'sellado', 'micro perforado'
            ]);
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes'); // Asegúrate de que la tabla se llame 'clientes'
            $table->unsignedBigInteger('producto_id'); // Cambié id_nombre_producto a producto_id para que sea más claro
            $table->foreign('producto_id')->references('id')->on('productos'); // Asegúrate de que la tabla se llame 'productos'
            $table->date('fecha');
            $table->integer('cantidad');
            $table->date('fecha_comprometida');
            $table->string('status_oc');
            $table->decimal('porcentaje_progreso', 5, 2); // 100.00
            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('orden_trabajo');
    }
}
