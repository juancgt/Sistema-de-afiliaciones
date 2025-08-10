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
                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="col-md-4 control-label">* NOMBRE :</label>

                            <div class="col-md-6">
                                
                                <input type="text" name="nombre" id="nombre" class="form-control upper">
                                
                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                            <label for="descripcion" class="col-md-4 control-label">DESCRIPCION:</label>

                            <div class="col-md-6">
                                <textarea class="form-control upper" name="descripcion" id="descripcion" cols="10" rows="10" autofocus>{{ old('descripcion') }}</textarea>

                                @if ($errors->has('descripcion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
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
