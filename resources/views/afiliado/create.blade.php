@extends('layouts.main')

@section('content')
<section class="content-header">
    <h1>
    {{$title}}
    
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{ route($path_controller.'.index') }}" class="cargar_href"><i class="fa  fa-users"></i> Inicio</a></li>
    <li class="active">Crear</li>
    <!--<li class="active">Data tables</li>-->
    </ol>
</section>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">Registro</h3>
                </div>
                <!-- /.box-header -->
                {!! Form::open(['route' => $path_controller.'.store', 'method'=> 'POST','class'=> 'form-horizontal confirm','role'=>'form','enctype'=>'multipart/form-data'] ) !!}    
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('numero_matricula') ? ' has-error' : '' }}">
                            <label for="numero_matricula" class="col-md-4 control-label">* NUMERO DE MATRICULA :</label>

                            <div class="col-md-6">
                                <input id="numero_matricula" type="number" class="form-control upper" name="numero_matricula" value="{{ old('numero_matricula') }}" autocomplete="off" autofocus>

                                @if ($errors->has('numero_matricula'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('numero_matricula') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('nombres') ? ' has-error' : '' }}">
                            <label for="nombres" class="col-md-4 control-label">* NOMBRES :</label>

                            <div class="col-md-6">
                                <input id="nombres" type="text" class="form-control upper" name="nombres" value="{{ old('nombres') }}" autocomplete="off" autofocus>

                                @if ($errors->has('nombres'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombres') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('apellidos') ? ' has-error' : '' }}">
                            <label for="apellidos" class="col-md-4 control-label">* APELLIDOS:</label>

                            <div class="col-md-6">
                                <input id="apellidos" type="text" class="form-control upper" name="apellidos" value="{{ old('apellidos') }}" autocomplete="off" autofocus>

                                @if ($errors->has('apellidos'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('apellidos') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ci') ? ' has-error' : '' }}">
                            <label for="ci" class="col-md-4 control-label">* CI:</label>

                            <div class="col-md-6">
                                <input id="ci" type="text" class="form-control upper" name="ci" value="{{ old('ci') }}" autocomplete="off" autofocus>

                                @if ($errors->has('ci'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ci') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('sexo') ? ' has-error' : '' }}">
                            <label for="ci" class="col-md-4 control-label">* SEXO:</label>
                            <div class="radio">
                            

                                <div class="col-md-6">
                                    
                                
                                    <label>
                                        <input type="radio" name="sexo" value="MASCULINO" checked> MASCULINO
                                    </label>
                                    <label>
                                        <input type="radio" name="sexo" value="FEMENINO"> FEMENINO
                                    </label>
                                    @if ($errors->has('sexo'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('sexo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 
                        </div>
                        <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                            <label for="direccion" class="col-md-4 control-label">DIRECCION :</label>

                            <div class="col-md-6">
                                <input id="direccion" type="text" class="form-control upper" name="direccion" value="{{ old('direccion') }}" autocomplete="off" autofocus>

                                @if ($errors->has('direccion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('direccion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('estado_civil') ? ' has-error' : '' }}">
                            <label for="estado_civil" class="col-md-4 control-label">* ESTADO CIVIL :</label>

                            <div class="col-md-6">
                                <select class="form-control selectpicker" name="estado_civil" id="estado_civil" data-live-search="true">
                                    <option value="SOLTERO">SOLTERO(A)</option>
                                    <option value="CASADO">CASADO(A)</option>
                                    <option value="VIUDO">VIUDO(A)</option>
                                    <option value="DIVORCIADO">DIVORCIADO(A)</option>

                                </select>
                                @if ($errors->has('estado_civil'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('estado_civil') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('fecha_nacimiento') ? ' has-error' : '' }}">
                            <label for="fecha_nacimiento" class="col-md-4 control-label">* FECHA DE NACIMIENTO :</label>

                            <div class="col-md-6">
                                <input id="fecha_nacimiento" type="date" class="form-control" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" autocomplete="off" autofocus>

                                @if ($errors->has('fecha_nacimiento'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                            <label for="telefono" class="col-md-4 control-label">TELEFONO :</label>

                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" autocomplete="off" autofocus>

                                @if ($errors->has('telefono'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('correo') ? ' has-error' : '' }}">
                            <label for="correo" class="col-md-4 control-label">CORREO ELECTRONICO :</label>

                            <div class="col-md-6">
                                <input id="correo" type="email" class="form-control" name="correo" value="{{ old('correo') }}" placeholder="Ejemplo: roxana@gmail.com" autocomplete="off" autofocus>

                                @if ($errors->has('correo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('correo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       
                        <div class="form-group{{ $errors->has('foto') ? ' has-error' : '' }}">
                            <label for="foto" class="col-md-4 control-label">FOTO :</label>

                            <div class="col-md-6">
                                <input id="files" type="file" class="form-control" name="foto" value="{{ old('foto') }}" autofocus>

                                @if ($errors->has('foto'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('foto') }}</strong>
                                    </span>
                                @endif
                                <div id="img">
                                    <output id="list"></output>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="form-group{{ $errors->has('institucion') ? ' has-error' : '' }}">
                            <label for="institucion" class="col-md-4 control-label">* INSTITUCION :</label>

                            <div class="col-md-6">

                                <select class="form-control selectpicker" name="institucion" id="institucion" data-live-search="true">
                                    <option value="">Seleccione</option>
                                    @foreach($institucion as $key=>$item)
                                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                                    @endforeach
                                    
                                    
                                </select>
                                <!--<input id="rol" type="text" class="form-control" name="rol" value="{{ old('rol') }}" autofocus>-->

                                @if ($errors->has('institucion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('institucion') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2 ">
                                <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-institucion" role="button">
                                <i class="fa fa-plus">
                                </i>
                                
                                </a>
                            </div>
                        </div>


                        


                        <div class="form-group{{ $errors->has('especialidad') ? ' has-error' : '' }}">
                            <label for="especialidad" class="col-md-4 control-label">* ESPECIALIDAD :</label>

                            <div class="col-md-6">

                                <select class="form-control selectpicker" name="especialidad" id="especialidad" data-live-search="true">
                                    <option value="">Seleccione</option>
                                    @foreach($area as $key=>$item)
                                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                                    @endforeach
                                    
                                </select>
                                <!--<input id="rol" type="text" class="form-control" name="rol" value="{{ old('rol') }}" autofocus>-->

                                @if ($errors->has('especialidad'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('especialidad') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2 ">
                                <a class="btn btn-sm btn-success" title="Agregar Especialidad" data-toggle="modal" data-target="#modal-especialidad" role="button">
                                <i class="fa fa-plus">
                                </i>
                                
                                </a>
                            </div>
                        </div>
                        <?php 
                            $fecha_actual = date("Y-m-d"); 
                            $fecha__=date("Y-m-d",strtotime($fecha_actual."+ 365 days"));

                            
                        ?>
                        <div class="form-group{{ $errors->has('fecha_afiliacion') ? ' has-error' : '' }}">
                            <label for="fecha_afiliacion" class="col-md-4 control-label">* FECHA DE AFILIACION :</label>

                            <div class="col-md-6">
                                <input id="fecha_afiliacion" type="date" class="form-control" name="fecha_afiliacion" value="{{ $fecha_actual }}" autocomplete="off" autofocus>

                                @if ($errors->has('fecha_afiliacion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha_afiliacion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('fecha_titulacion') ? ' has-error' : '' }}">
                            <label for="fecha_titulacion" class="col-md-4 control-label">* FECHA DE TITULACION :</label>

                            <div class="col-md-6">
                                <input id="fecha_titulacion" type="date" class="form-control" name="fecha_titulacion" value="{{ old('fecha_titulacion') }}" autocomplete="off" autofocus>

                                @if ($errors->has('fecha_titulacion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha_titulacion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('fecha_vencimiento') ? ' has-error' : '' }}">
                            <label for="fecha_vencimiento" class="col-md-4 control-label">* FECHA DE VENCIMIENTO :</label>

                            <div class="col-md-6">
                                <input id="fecha_vencimiento" type="date" class="form-control" name="fecha_vencimiento" value="{{ $fecha__ }}" readonly="readonly">

                                @if ($errors->has('fecha_vencimiento'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha_vencimiento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('aporte_mensual') ? ' has-error' : '' }}">
                            <label for="aporte" class="col-md-4 control-label">APORTE MENSUAL :</label>

                            <div class="col-md-6">
                                <input id="aporte_mensual" type="text" class="form-control upper" name="aporte_mensual"  value="80" readonly="readonly">

                                @if ($errors->has('aporte_mensual'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('aporte_mensual') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('aporte_anual') ? ' has-error' : '' }}">
                            <label for="aporte_anual" class="col-md-4 control-label">APORTE ANUAL :</label>

                            <div class="col-md-6">
                                <input id="aporte_anual" type="text" class="form-control upper" name="aporte_anual"  value="960" readonly="readonly">

                                @if ($errors->has('aporte_anual'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first(' ') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

               

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


<!--modal institucion-->
<div class="modal fade" id="modal-institucion">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Registrar Institución</h4>
        </div>
        {!! Form::open(['url' => 'afiliado_institucion', 'method'=> 'POST','class'=> 'form-horizontal regis_institucion','role'=>'form'] ) !!}
        <div class="modal-body">
            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}" id="nombre">
                <label for="nombre" class="col-md-4 control-label">* NOMBRE :</label>

                <div class="col-md-6">
                    <input id="_nombre" type="text" class="form-control upper" name="nombre" value="{{ old('nombre') }}" autocomplete="off" autofocus>

                    <span class="help-block" id="nombremsg">
                        <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                    
                </div>
            </div>
            <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}" id="descripcion">
                <label for="descripcion" class="col-md-4 control-label">DESCRIPCION :</label>

                <div class="col-md-6">
                    <textarea id="_descripcion" rows="6" class="form-control upper" name="descripcion" autofocus>{{ old('descripcion') }}</textarea>
                    <span class="help-block" id="descripcionmsg">
                        <strong>{{ $errors->first('descripcion') }}</strong>
                    </span>
                </div>
            </div>
            <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}" id="direccion">
                <label for="direccion" class="col-md-4 control-label">DIRECCION :</label>

                <div class="col-md-6">
                    <input id="_direccion" type="text" class="form-control upper" name="direccion" value="{{ old('direccion') }}" autocomplete="off" autofocus>

                    @if ($errors->has('direccion'))
                        <span class="help-block" id="direccionmsg">
                            <strong>{{ $errors->first('direccion') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}" id="_telefono_">
                <label for="telefono" class="col-md-4 control-label">TELEFONO :</label>

                <div class="col-md-6">
                    <input id="_telefono" type="text" class="form-control upper" name="telefono" value="{{ old('telefono') }}" autocomplete="off" autofocus>

                    
                        <span class="help-block" id="telefonomsg">
                            <strong>{{ $errors->first('telefono') }}</strong>
                        </span>
                    
                </div>
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div> 
        {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--end modal-->


<!--modal especialidad-->
<div class="modal fade" id="modal-especialidad">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Registrar Especialidad</h4>
        </div>
        {!! Form::open(['url' => 'afiliado_especialidad', 'method'=> 'POST','class'=> 'form-horizontal regis_especialidad','role'=>'form'] ) !!}
        <div class="modal-body">
            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}" id="_nombre_">
                <label for="nombre" class="col-md-4 control-label">* NOMBRE :</label>

                <div class="col-md-6">
                    <input id="__nombre" type="text" class="form-control upper" name="nombre" value="{{ old('nombre') }}" autocomplete="off" autofocus>

                    
                        <span class="help-block" id="_nombremsg">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                    
                </div>
            </div>
            <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}" id="_descripcion_">
                <label for="descripcion" class="col-md-4 control-label">DESCRIPCION :</label>

                <div class="col-md-6">
                    <textarea id="__descripcion" rows="6" class="form-control upper" name="descripcion" autofocus>{{ old('descripcion') }}</textarea>
                    
                        <span class="help-block" id="_descripcionmsg">
                            <strong>{{ $errors->first('descripcion') }}</strong>
                        </span>
                    
                </div>
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div> 
        {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--end modal-->



</section>
@endsection

@push('scripts')
<script>

    $('#fecha_vencimiento').keyup(function(){
            var Mcantidad = $('#Mcantidad').val()
            $('#aporte_total').val(0);
    })

    



    $(document).on("submit",".regis_institucion",function(e) {        
        //return false;
        e.preventDefault(e);
        $.ajax({
            type:"POST",
            url:$(this).attr('action'),
            data:$(this).serialize(),
            success: function(data){

                console.log(data);
                $("#institucion").append('<option value="'+data['id']+'" selected>'+data['nombre']+'</option>');
                $("#institucion").selectpicker("refresh");
                $( ".close" ).trigger( "click" );
                //location.reload();
                //console.log(data);
                //alert("entro");
                //return false;
            },
            error: function(dataError){
                //$("#articulo").selectpicker("refresh");
                var errors = $.parseJSON(dataError.responseText);
                console.log(errors);
                if(errors['errors'].length != 0){                    
                    //alert("entro");
                    if('nombre' in errors['errors']){
                        $('#nombre').addClass('has-error')
                        $('#nombremsg').html(' '+errors['errors']['nombre'][0])
                    }
                    else{
                        $('#nombre').removeClass('has-error')
                        $('#nombremsg').html('')
                    }
                    if('descripcion' in errors['errors']){
                        $('#descripcion').addClass('has-error')
                        $('#descripcionmsg').html(' '+errors['errors']['descripcion'][0])
                    }
                    else{
                        $('#descripcion').removeClass('has-error')
                        $('#descripcionmsg').html('')
                    }
                    if('direccion' in errors['errors']){
                        $('#direccion').addClass('has-error')
                        $('#direccionmsg').html(' '+errors['errors']['direccion'][0])
                    }
                    else{
                        $('#direccion').removeClass('has-error')
                        $('#direccionmsg').html('')
                    }
                    if('telefono' in errors['errors']){
                        $('#_telefono_').addClass('has-error')
                        $('#telefonomsg').html(' '+errors['errors']['telefono'][0])
                    }
                    else{
                        $('#_telefono_').removeClass('has-error')
                        $('#telefonomsg').html('')
                    }
                    
                }
            }
        })
        return false;
    });


    $(document).on("submit",".regis_especialidad",function(e) {        
        //return false;
        e.preventDefault(e);
        $.ajax({
            type:"POST",
            url:$(this).attr('action'),
            data:$(this).serialize(),
            success: function(data){
                $("#especialidad").append('<option value="'+data['id']+'" selected>'+data['nombre']+'</option>');
                $("#especialidad").selectpicker("refresh");
                $( ".close" ).trigger( "click" );
                //console.log(data);
                //alert("entro");
                //return false;
            },
            error: function(dataError){
                //$("#articulo").selectpicker("refresh");
                var errors = $.parseJSON(dataError.responseText);
                console.log(errors);
                if(errors['errors'].length != 0){                    
                    //alert("entro");
                    if('nombre' in errors['errors']){
                        $('#_nombre_').addClass('has-error')
                        $('#_nombremsg').html(' '+errors['errors']['nombre'][0])
                    }
                    else{
                        $('#nombre').removeClass('has-error')
                        $('#nombremsg').html('')
                    }
                    if('descripcion' in errors['errors']){
                        $('#_descripcion_').addClass('has-error')
                        $('#_descripcionmsg').html(' '+errors['errors']['descripcion'][0])
                    }
                    else{
                        $('#_descripcion_').removeClass('has-error')
                        $('#_descripcionmsg').html('')
                    }
                    
                }
            }
        })
        return false;
    });


    function archivo(evt) {
        var files = evt.target.files; // FileList object

        // Obtenemos la imagen del campo "file".
        for (var i = 0, f; f = files[i]; i++) {
        //Solo admitimos imágenes.
        if (!f.type.match('image.*')) {
            continue;
        }

        var reader = new FileReader();

        reader.onload = (function(theFile) {
            return function(e) {
                // Insertamos la imagen
                document.getElementById("list").innerHTML = ['<img with="200px" height="200px" class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
            };
        })(f);

        reader.readAsDataURL(f);
        }
    }
    document.getElementById('files').addEventListener('change', archivo, false);
</script>
@endpush
