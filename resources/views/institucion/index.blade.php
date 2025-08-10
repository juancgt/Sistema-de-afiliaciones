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
        <li><i class="fa fa-th-list"></i class="active"> Inicio</li>
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
                <a class="btn btn-sm btn-success" href="{{ route($path_controller.'.create') }}" role="button">
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
                    <th>Nro</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                    <?php $i=0; ?>
                    @foreach($data as $key=>$item)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$item->nombre}}</td>
                        <td>{{$item->descripcion}}</td>
                        <td>{{$item->direccion}}</td>
                        <td>{{$item->telefono}}</td>
                        
                        <td class="text-center">
                            <a class="btn btn-primary" href="{{ route($path_controller.'.edit',$item->id) }}" title="Editar"><i class="fa fa-edit"></i></a>
                            
                            {{--<a class="btn btn-info btn-info" href="{{ route($path_controller.'.show', $item->id) }}" title="Agregar Modalidad de Pago"><i class="fa fa-eye"></i></a>--}}

                          @if($item->estado==='habilitado')
                            {!! Form::open(['method' => 'DELETE','route' => [$path_controller.'.destroy', $item->id],'style'=>'display:inline','class'=>'confirm']) !!}
                                <button class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Dar de baja" ><i class="fa fa-remove"></i></button>
                            {!! Form::close() !!}
                            @else
                            {!! Form::open(['method' => 'DELETE','route' => [$path_controller.'.destroy', $item->id],'style'=>'display:inline','class'=>'confirm']) !!}
                                <button class="btn btn-success " data-toggle="tooltip" data-placement="bottom" title="Habilitar"><i class="fa fa-check"></i></button>
                            {!! Form::close() !!}
                          @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Nro</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Acción</th>
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
