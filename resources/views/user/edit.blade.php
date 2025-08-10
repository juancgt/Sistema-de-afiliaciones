@extends('layouts.main')

@section('content-header')
    <h1><i class="fas fa-truck"></i> Tractocamiones</h1>
@endsection

@section('breadcrumb')
    <li class="active">
        <a href="#"><i class="fas fa-truck"></i> Tractocamiones</a>
    </li>
@endsection 

@section('content')
<section class="content-header">
    <h1>
    {{$title}}
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{ route($path_controller.'.index') }}" class="cargar_href"><i class="fa  fa-users"></i> Inicio</a></li>
    <li class="active">Editar</li>
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
                <h3 class="box-title">Editar</h3>
                </div>
                <!-- /.box-header -->
                {!! Form::open(['route' => [$path_controller.'.update',$id],'method' => 'PATCH','class'=>'form-horizontal confirm','role'=>'form','enctype'=>'multipart/form-data']) !!}
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('nombres') ? ' has-error' : '' }}">
                            <label for="nombres" class="col-md-4 control-label">* NOMBRES :</label>

                            <div class="col-md-6">
                                <input id="nombres" type="text" class="form-control upper" name="nombres" value="{{ $user->first_name }}" autocomplete="off" autofocus>

                                @if ($errors->has('nombres'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombres') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('apellidos') ? ' has-error' : '' }}">
                            <label for="apellidos" class="col-md-4 control-label">* APELLIDOS :</label>

                            <div class="col-md-6">
                                <input id="apellidos" type="text" class="form-control upper" name="apellidos" value="{{ $user->last_name  }}" autocomplete="off" autofocus>

                                @if ($errors->has('apellidos'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('apellidos') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                     
                        
                        <div class="form-group{{ $errors->has('correo_electronico') ? ' has-error' : '' }}">
                            <label for="correo_electronico" class="col-md-4 control-label">CORREO ELECTRONICO :</label>

                            <div class="col-md-6">
                                <input id="correo_electronico" type="email" class="form-control" name="correo_electronico" value="{{ $user->email  }}" autocomplete="off" autofocus>

                                @if ($errors->has('correo_electronico'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('correo_electronico') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-group{{ $errors->has('usuario') ? ' has-error' : '' }}">
                            <label for="usuario" class="col-md-4 control-label">* USUARIO :</label>

                            <div class="col-md-6">
                                <input id="usuario" type="text" class="form-control" name="usuario" value="{{ $user->name  }}" autocomplete="off" autofocus>

                                @if ($errors->has('usuario'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usuario') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('contraseña') ? ' has-error' : '' }}">
                            <label for="contraseña" class="col-md-4 control-label">* CONTRASEÑA :</label>

                            <div class="col-md-6">
                                <input id="contraseña" type="password" class="form-control" name="contraseña" value="{{ old('contraseña') }}" autofocus>

                                @if ($errors->has('contraseña'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contraseña') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('foto') ? ' has-error' : '' }}">
                            <label for="foto" class="col-md-4 control-label">FOTO :</label>

                            <div class="col-md-6">
                                <input id="files" type="file" class="form-control" name="foto" value="" autofocus>

                                @if ($errors->has('foto'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('foto') }}</strong>
                                    </span>
                                @endif
                                <div id="img">
                                    <output id="list">
                                        @if($user->photo!=null)
                                        <?php 
                                        $foto=$user->photo;
                                        header("Content-type: image/jpg image/png");
                                        $my_bytea=stream_get_contents($foto);
                                        ?>
                                        <img with="200px" height="200px" src="data:image/jpeg;base64,{{$my_bytea}}" class="user-image" alt="User Image">
                                        @endif
                                    </output>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="form-group{{ $errors->has('rol') ? ' has-error' : '' }}">
                            <label for="rol" class="col-md-4 control-label">* ROL :</label>

                            <div class="col-md-6">

                                <select class="form-control selectpicker" name="rol" id="rol" data-live-search="true">
                                    
                                    @foreach($roles as $key=>$item)
                                        <?php $bol=false;?>
                                        @foreach($rol as $kkey=>$iitem)
                                            @if($item->id===$iitem->id)
                                                <?php $bol=true;?>
                                            @endif
                                        @endforeach
                                        @if($bol)
                                            <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endif

                                    @endforeach
                                </select>
                                <!--<input id="rol" type="text" class="form-control" name="rol" value="{{ old('rol') }}" autofocus>-->

                                @if ($errors->has('rol'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rol') }}</strong>
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
