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
