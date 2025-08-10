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
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="col-md-4 control-label">* NOMBRE :</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control upper" name="nombre" value="{{ old('nombre') }}" autocomplete="off" autofocus>

                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                            <label for="descripcion" class="col-md-4 control-label">DESCRIPCION :</label>

                            <div class="col-md-6">
                                <textarea id="descripcion" rows="6" class="form-control upper" name="descripcion" autofocus>{{ old('descripcion') }}</textarea>
                                @if ($errors->has('descripcion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
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
                        <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                            <label for="telefono" class="col-md-4 control-label">TELEFONO :</label>

                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control upper" name="telefono" value="{{ old('telefono') }}" autocomplete="off" autofocus>

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
