<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Initial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('institucion',function(Blueprint $table){
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->string('descripcion')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('estado')->default("habilitado");
            $table->integer('id_usuario')->unsigned();
            $table->timestamps();
            $table->foreign('id_usuario')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::create('area',function(Blueprint $table){
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->string('descripcion')->nullable();
            $table->string('estado')->default("habilitado");
            $table->integer('id_usuario')->unsigned();
            $table->timestamps();
            $table->foreign('id_usuario')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
        
        Schema::create('afiliado',function(Blueprint $table){
            $table->increments('id');
            $table->integer('item')->nullable();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('ci')->unique();
            $table->string('sexo');
            $table->date('fecha_nacimiento')->nullable();
            $table->string('direccion')->nullable();
            $table->string('estado_civil');
            $table->integer('telefono')->nullable();
            $table->string('correo')->unique()->nullable();
            $table->binary('foto')->nullable();
            $table->string('estado')->default("habilitado");
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_institucion')->unsigned();
            $table->integer('id_area')->unsigned();
            $table->date('fecha_afiliacion')->nullable();
            $table->date('fecha_titulacion')->nullable();
            $table->timestamps();
            $table->foreign('id_usuario')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_institucion')->references('id')->on('institucion')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_area')->references('id')->on('area')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('actividad',function(Blueprint $table){
            $table->increments('id');
            $table->string('actividad');
            $table->dateTime('inicio');
            $table->dateTime('fin');
            $table->string('archivo')->nullable();
            $table->string('descripcion');
            $table->string('estado')->default("habilitado");
            $table->integer('id_usuario')->unsigned();
            $table->timestamps();
            $table->foreign('id_usuario')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('area_actividad',function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_area')->unsigned();
            $table->integer('id_actividad')->unsigned();
            $table->integer('id_usuario')->unsigned();
            $table->timestamps();
            $table->foreign('id_area')->references('id')->on('area')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_actividad')->references('id')->on('actividad')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
        
        
        Schema::create('aporte',function(Blueprint $table){
            $table->increments('id');
            $table->string('motivo');
            $table->string('descripcion')->nullable();
            $table->float('monto')->default('0');
            $table->date('plazo');
            $table->string('tipo')->default('especialidad');
            $table->string('estado')->default("habilitado");
            $table->integer('id_usuario')->unsigned();
            $table->timestamps();
            $table->foreign('id_usuario')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('area_aporte',function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_area')->unsigned();
            $table->integer('id_aporte')->unsigned();
            $table->integer('id_usuario')->unsigned();
            $table->timestamps();
            $table->foreign('id_area')->references('id')->on('area')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_aporte')->references('id')->on('aporte')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::create('afiliado_aporte',function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_afiliado')->unsigned();
            $table->integer('id_aporte')->unsigned();
            $table->integer('id_usuario')->unsigned();
            $table->timestamps();
            $table->foreign('id_afiliado')->references('id')->on('afiliado')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_aporte')->references('id')->on('aporte')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('saldo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_aporte')->unsigned();
            $table->integer('id_afiliado')->unsigned();
            $table->float('saldo')->unsigned();
            $table->string('estado')->default("habilitado");
            $table->integer('id_usuario')->unsigned();
            $table->timestamps();
            $table->foreign('id_aporte')->references('id')->on('aporte')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_afiliado')->references('id')->on('afiliado')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        
        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saldo');
        Schema::dropIfExists('afiliado');
        Schema::dropIfExists('institucion');
        
        Schema::dropIfExists('area_aporte');
        Schema::dropIfExists('area_actividad');
        Schema::dropIfExists('area');
        Schema::dropIfExists('actividad');
        Schema::dropIfExists('aporte');
        
        
    }
}


