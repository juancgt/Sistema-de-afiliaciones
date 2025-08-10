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
        <li><i class="fa  fa-users"></i class="active"> Inicio</li>
        <!--<li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>-->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Asignar Permiso</h3>
                    </div>
                    <div class="box-body">

                    {!! Form::open(['route' => 'permission.store','method' => 'POST','class'=>'']) !!}
                                <input type="hidden" value="{{$id}}" name="id_rol">
                                <div class="col-md-4 col-md-offset-2">
                                    <div class="form-group{{ $errors->has('rol') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label for="rol" class="col-md-12 control-label">ROL :</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input id="rol" type="text" class="form-control upper" name="rol" value="{{$rol->name}}" readonly="readonly">
                                                
                                                @if ($errors->has('rol'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('rol') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('permiso') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label for="permiso" class="col-md-12 control-label">PERMISO :</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select class="form-control selectpicker" name="permiso" data-live-search="true">
                                                    <option value="">Seleccione</option>
                                                    @foreach($permiso as $key=>$item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('permiso'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('permiso') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="pull-right">
                                        
                                        <input type="submit" class="btn btn-block btn-primary" value="Agregar" >
                                    </div>
                                </div>
                            {!! Form::close() !!}  
                        

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
            <!-- /.box -->

            <div class="box">
                <div class="box-header">
                <h3 class="box-title">Lista</h3>
                <!--<div class="pull-right">
                    <a class="btn btn-sm btn-success cargar_href" href="{{ route($path_controller.'.create') }}" role="button">
                    <i class="fa fa-plus">
                    </i>
                    Nuevo
                    </a>
                </div>-->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datos as $key=>$item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->description}}</td>
                            <td>
                                <span class="label label-primary">Activo</span>
                            </td>
                            <td class="text-center">
                                {!! Form::open(['method' => 'DELETE','route' => ['permission.destroy', $item->id.'-'.$id],'style'=>'display:inline','class'=>'destroyForm']) !!}
                                    <button class="btn btn-danger btn-delete" data-toggle="tooltip" data-placement="bottom" title="Eliminar"><i class="fa fa-remove"></i></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection

@push('scripts')
<script>
  

  
</script>
@endpush
