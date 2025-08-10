@extends('layouts.main')

@section('content')
<section class="content-header">
    <h1>
    {{$title}}
    
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{ route($path_controller.'.index') }}"><i class="fa fa-th-list"></i> Inicio</a></li>
    <li class="active">Saldo</li>
    <!--<li class="active">Data tables</li>-->
    </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box -->

                <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Datos Cliente</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-condensed">
                    <tr>
                        <th>NOMBRES: </th>
                        <td>{{$data->nombres}}</td>
                    </tr>
                    <tr>
                        <th>APELLIDO PATERNO: </th>
                        <td>{{$data->paterno}}</td>
                    </tr>
                    <tr>
                        <th>APELLIDO MATERNO: </th>
                        <td>{{$data->materno}}</td>
                    </tr>
                    <tr>
                        <th>C.I.: </th>
                        <td>{{$data->ci_nit}}</td>
                    </tr>
                    <tr>
                        <th>DIRECCION: </th>
                        <td>{{$data->direccion}}</td>
                    </tr>
                    <tr>
                        <th>TELEFONO: </th>
                        <td>{{$data->telefono}}</td>
                    </tr>
                    <tr>
                        <th>ESTADO: </th>
                        <td>
                        @if($data->estado==='habilitado')
                        HABILITADO
                        @else
                        INHABILITADO
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <th>FECHA DE CREACION: </th>
                        <td>{{$data->fecha_creacion}}</td>
                    </tr>

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
                <!-- /.box -->

                <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista</h3>
                    <div class="pull-right">
                    <!--<a class="btn btn-sm btn-success" href="{{ route($path_controller.'.create') }}" role="button">
                    <i class="fa fa-plus">
                    </i>
                    Nuevo
                    </a>-->
                    </div>
                </div>
                <!-- /.box-header -->





                <!--modal registro saldo-->
                <div class="modal fade" id="modal-saldo">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Saldo</h4>
                        </div>
                        {!! Form::open(['route' => 'saldo.store', 'method'=> 'POST','class'=> 'form-horizontal add-saldo','role'=>'form'] ) !!}    
                        <input type="hidden" name="id_salida" id="id_salida" value="">
                        <div class="modal-body">
                            <div class="form-group{{ $errors->has('saldo') ? ' has-error' : '' }}" id="_saldo">
                                <label for="saldo" class="col-md-4 control-label">* SALDO :</label>

                                <div class="col-md-7">
                                    <input id="saldo" type="number" class="form-control upper" name="saldo" value="{{ old('saldo') }}" mautocomplete="off" max="">

                                    
                                        <span class="help-block" id="saldomsg">
                                            <strong>{{ $errors->first('saldo') }}</strong>
                                        </span>
                                    
                                </div>
                            </div>                                    
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary registrar_compra">Registrar</button>
                        </div> 
                        {!! Form::close() !!}
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!--end modal-->




                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Nro</th>
                        <th>Fecha</th>
                        <th>Costo Total</th>
                        <th>A Cuenta</th>
                        <th>Saldo</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; ?>
                        @foreach($datos as $key=>$item)
                        <tr>
                            <td>{{++$i}}</td>
                            
                            <td>{{$item->fecha_creacion}}</td>
                            <td>{{round($item->precio_total,3)}}</td>
                            <?php $max=$item->precio_total-$model->saldo($item->id_salida);?>
                            <td>{{round($model->saldo($item->id_salida),2)}}</td>
                            <td>{{round($max,2)}}</td>
                            <td>
                                @if($item->precio_total!=$model->saldo($item->id_salida))
                                    Pendiente
                                @else
                                    Saldado
                                @endif
                            </td>
                            
                            <td class="text-center">
                                <!--<a class="btn btn-primary" href="{{ route($path_controller.'.edit',$item->id_persona) }}"><i class="fa fa-edit"></i></a>-->
                                @if($max>0)
                                <button class="btn btn-sm btn-success" role="button" title="Agragar Saldo" onclick="add_saldo({{$item->id_salida}},{{$max}});">
                                    <i class="fa fa-plus">
                                    </i>
                                </button>
                                @endif

                                <a class="btn btn-info btn-info" href="{{ route('detalle_salida.show', $item->id_salida) }}" title="Detalle compra"><i class="fa fa-eye"></i></a>

                                {{--@if($item->estado==='habilitado')
                                {!! Form::open(['method' => 'DELETE','route' => [$path_controller.'.destroy', $item->id_persona],'style'=>'display:inline','class'=>'confirm']) !!}
                                    <button class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Dar de baja" ><i class="fa fa-remove"></i></button>
                                {!! Form::close() !!}
                                @else
                                {!! Form::open(['method' => 'DELETE','route' => [$path_controller.'.destroy', $item->id_persona],'style'=>'display:inline','class'=>'confirm']) !!}
                                    <button class="btn btn-success " data-toggle="tooltip" data-placement="bottom" title="Habilitar"><i class="fa fa-check"></i></button>
                                {!! Form::close() !!}
                                @endif--}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Nro</th>
                        <th>Fecha</th>
                        <th>Costo Total</th>
                        <th>A Cuenta</th>
                        <th>Saldo</th>
                        <th>Estado</th>
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
    </section>
@endsection

@push('scripts')
<script>
    function add_saldo(id_salida,max){
        //alert(id_salida);
        //alert(max);
        $("#saldo").attr({
        "max" : max,        // substitute your own
        "min" : 0          // values (or variables) here
        });
        document.getElementById("saldo").value="";
        document.getElementById("id_salida").value=id_salida;
        $('#modal-saldo').modal('show');
    };
    $(document).on("submit",".add-saldo",function(e) {
        
        $.ajax({
            type:"POST",
            url:$(this).attr('action'),
            data:$(this).serialize(),
            success: function(data){
                console.log(data);
                $( ".close" ).trigger( "click" );
                location.reload();
            },
            error: function(dataError){
                //$("#articulo").selectpicker("refresh");
                var errors = $.parseJSON(dataError.responseText);
                console.log(errors);
                if(errors['errors'].length != 0){                    
                        
                   alert("error");
                }
            }
        })
        return false;
    });   
</script>
@endpush
