@extends('layouts.main')

@section('content')
<section class="content-header">
    <h1>
    {{$title}}
    
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{ route($path_controller.'.index') }}"><i class="fa fa-th-list"></i> Inicio</a></li>
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
                {!! Form::open(['route' => $path_controller.'.store', 'method'=> 'POST','class'=> 'form-horizontal confirm','role'=>'form'] ) !!}    
                    <input type="hidden" name="ajax" value="no">
                    <input type="hidden" name="tipo_persona" value="CLIENTE">
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="col-md-4 control-label">* NOMBRE :</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control upper" name="nombre" value="{{ old('nombre') }}" autofocus>

                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('apellido_paterno') ? ' has-error' : '' }}">
                            <label for="apellido_paterno" class="col-md-4 control-label">APELLIDO PATERNO :</label>

                            <div class="col-md-6">
                                <input id="apellido_paterno" type="text" class="form-control upper" name="apellido_paterno" value="{{ old('apellido_paterno') }}" autofocus>
                                @if ($errors->has('apellido_paterno'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('apellido_paterno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('apellido_materno') ? ' has-error' : '' }}">
                            <label for="apellido_materno" class="col-md-4 control-label">APELLIDO MATERNO :</label>

                            <div class="col-md-6">
                            <input id="apellido_materno" type="text" class="form-control upper" name="apellido_materno" value="{{ old('apellido_materno') }}" autofocus>
                                @if ($errors->has('apellido_materno'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('apellido_materno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>               
                        <div class="form-group{{ $errors->has('ci') ? ' has-error' : '' }}">
                            <label for="ci" class="col-md-4 control-label">* C.I. :</label>

                            <div class="col-md-6">
                            <input id="ci" type="text" class="form-control upper" name="ci" value="{{ old('ci') }}" autofocus>
                                @if ($errors->has('ci'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ci') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                            <label for="direccion" class="col-md-4 control-label">DIRECCION :</label>

                            <div class="col-md-6">
                            <input id="direccion" type="text" class="form-control upper" name="direccion" value="{{ old('direccion') }}" autofocus>
                                @if ($errors->has('direccion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('direccion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                            <label for="telefono" class="col-md-4 control-label">TELEFONO :</label>

                            <div class="col-md-6">
                            <input id="telefono" type="text" class="form-control upper" name="telefono" value="{{ old('telefono') }}" autofocus>
                                @if ($errors->has('telefono'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telefono') }}</strong>
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
</section>
@endsection

@push('scripts')
<script>
</script>
@endpush
