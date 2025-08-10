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
                        <h3 class="box-title">Asignar Actividad</h3>
                    </div>
                    <div class="box-body">

                    {!! Form::open(['route' => 'area_actividad.store','method' => 'POST','class'=>'']) !!}
                                <input type="hidden" value="{{$id}}" name="id_area">
                                <div class="col-md-4 col-md-offset-2">
                                    <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label for="area" class="col-md-12 control-label">ESPECIALIDAD :</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input id="area" type="text" class="form-control upper" name="area" value="{{$area->nombre}}" readonly="readonly">
                                                
                                                @if ($errors->has('area'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('area') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('actividad') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label for="actividad" class="col-md-12 control-label">ACTIVIDAD :</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select class="form-control selectpicker" name="actividad" data-live-search="true">
                                                    <option value="">Seleccione</option>
                                                    @foreach($actividad as $key=>$item)
                                                    <option value="{{$item->id}}">{{$item->actividad}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('actividad'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('actividad') }}</strong>
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
                            <th>Actividad</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datos as $key=>$item)
                        <tr>
                            <td>{{$item->actividad}}</td>
                            <td>
                            <p>{{print($item->descripcion)}}</p>
                            <br>
                            Inicio: {{$item->inicio}}
                            <br>
                            Hasta: {{$item->fin}}
                            </td>
                            <td>
                                <span class="label label-primary">Activo</span>
                            </td>
                            <td class="text-center">
                                {!! Form::open(['method' => 'DELETE','route' => ['area_actividad.destroy', $item->id.'-'.$id],'style'=>'display:inline','class'=>'destroyForm']) !!}
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





        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Asignar Aporte</h3>
                    </div>
                    <div class="box-body">

                    {!! Form::open(['route' => 'area_aporte.store','method' => 'POST','class'=>'']) !!}
                                <input type="hidden" value="{{$id}}" name="id_area">
                                <div class="col-md-4 col-md-offset-2">
                                    <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label for="area" class="col-md-12 control-label">ESPECIALIDAD :</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input id="area" type="text" class="form-control upper" name="area" value="{{$area->nombre}}" readonly="readonly">
                                                
                                                @if ($errors->has('area'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('area') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('aporte') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label for="aporte" class="col-md-12 control-label">APORTE :</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select class="form-control selectpicker" name="aporte" data-live-search="true">
                                                    <option value="">Seleccione</option>
                                                    @foreach($area_aporte as $key=>$item)
                                                    <option value="{{$item->id}}">{{$item->motivo}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('aporte'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('aporte') }}</strong>
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
                            <th>Actividad</th>
                            <th>Motivo</th>
                            <th>Descripcion</th>
                            <th>Monto</th>
                            <th>Plazo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($aporte as $key=>$item)
                        <tr>
                            <td>{{$item->aporte}}</td>
                            <td>{{$item->descripcion}}</td>
                            <td>{{$item->monto}}</td>
                            <td>{{$item->plazo}}</td>
                            <td>
                                <span class="label label-primary">Activo</span>
                            </td>
                            <td class="text-center">
                                {!! Form::open(['method' => 'DELETE','route' => ['area_aporte.destroy', $item->id.'-'.$id],'style'=>'display:inline','class'=>'destroyForm']) !!}
                                    <button class="btn btn-danger btn-delete" data-toggle="tooltip" data-placement="bottom" title="Eliminar"><i class="fa fa-remove"></i></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Actividad</th>
                            <th>Motivo</th>
                            <th>Descripcion</th>
                            <th>Monto</th>
                            <th>Plazo</th>
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
