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
                {!! Form::open(['route' => [$path_controller.'.update',$id],'method' => 'PATCH','class'=>'form-horizontal confirm','role'=>'form']) !!}
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('actividad') ? ' has-error' : '' }}">
                            <label for="actividad" class="col-md-4 control-label">* ACTIVIDAD :</label>

                            <div class="col-md-6">
                                
                                <textarea id="actividad" type="text" class="form-control upper" name="actividad" autocomplete="off" autofocus>{{ $datos->actividad  }} </textarea>
                                @if ($errors->has('actividad'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('actividad') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('inicio_actividad') ? ' has-error' : '' }}">
                            <label for="inicio_actividad" class="col-md-4 control-label">* INICIO ACTIVIDAD :</label>
                            <?php  $datetime = new DateTime($datos->inicio);   ?>
                            <div class="col-md-6">
                            <input id="inicio_actividad" type="datetime-local" class="form-control" name="inicio_actividad" value="{{$datetime->format('Y-m-d\TH:i:s')}}"  autofocus>
                                @if ($errors->has('inicio_actividad'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('inicio_actividad') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('fin_actividad') ? ' has-error' : '' }}">
                            <label for="fin_actividad" class="col-md-4 control-label">* FIN ACTIVIDAD :</label>
                            <?php  $datetime = new DateTime($datos->fin);   ?>
                            <div class="col-md-6">
                            <input id="fin_actividad" type="datetime-local" class="form-control" name="fin_actividad" value="{{ $datetime->format('Y-m-d\TH:i:s')  }}" autocomplete="off" autofocus>
                                @if ($errors->has('fin_actividad'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fin_actividad') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                                <label class="col-md-12 ">* DESCRIPCION DE LA ACTIVIDAD</label>
                                <div class="col-md-12">
                                    <textarea id="descripcion" name="descripcion" rows="10" cols="80">{{ $datos->descripcion  }}</textarea>
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
                                    Editar
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
    $(function () {
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace('descripcion')
      //bootstrap WYSIHTML5 - text editor
      $('.textarea').wysihtml5()
  });
</script>
@endpush
