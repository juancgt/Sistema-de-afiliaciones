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
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista</h3>
              <div class="pull-right">
                <a class="btn btn-sm btn-success cargar_href" href="{{ route($path_controller.'.create') }}" role="button">
                <i class="fa fa-plus">
                </i>
                Nuevo
                </a>
              </div>
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
                            <a class="btn btn-primary btn-update" href="{{ route($path_controller.'.edit',$item->id) }}" title="Editar"><i class="fa fa-edit"></i></a>
                            {!! Form::open(['method' => 'DELETE','route' => [$path_controller.'.destroy', $item->id],'style'=>'display:inline','class'=>'destroyForm']) !!}
                                <button class="btn btn-danger btn-delete" data-toggle="tooltip" data-placement="bottom" title="Eliminar"><i class="fa fa-remove"></i></button>
                            {!! Form::close() !!}
                            <a class="btn btn-success" href="{{ route($path_controller.'.show',$item->id) }}" title="Agregar Permiso"><i class="fa fa-plus"></i></a>
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
