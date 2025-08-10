@extends('layouts.main')

@section('content')
<section class="content-header">
    <h1>
    {{$title}}
    
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{ route($path_controller.'.index') }}" class="cargar_href"><i class="fa  fa-users"></i> Inicio</a></li>
    <li class="active">Ver</li>
    <!--<li class="active">Data tables</li>-->
    </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->

          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Ver Datos</h3>
              <div class="pull-right">
                <a class="btn btn-sm btn-success" href="{{url('credencial/'.$id)}}" role="button">
                <i class="fa fa-file-pdf-o">
                </i>
                Imprimir credencial
                </a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tr>
                  <td rowspan="17" width="20%">
                  @if($datos->foto!=null)
                    <?php 
                      $foto=$datos->foto;
                      header("Content-type: image/jpg image/png");
                      $my_bytea=stream_get_contents($foto);
                    ?>
                    <img with="200px" height="200px" src="data:image/jpeg;base64,{{$my_bytea}}" class="user-image" alt="User Image">
                  @else
                    <img src="../img/user2-160x160.jpg" alt="Imagen de Usuario" width="100%">
                  @endif
                  </td>
                  <th>NRO. MATRICULA: </th>
                  <td>{{$datos->item}}</td>
                </tr>
                <tr>
                  <th>NOMBRES: </th>
                  <td>{{$datos->nombres}}</td>
                </tr>
                <tr>
                  <th>APELLIDOS: </th>
                  <td>{{$datos->apellidos}}</td>
                </tr>
                <tr>
                  <th>C.I.: </th>
                  <td>{{$datos->ci}}</td>
                </tr>
                <tr>
                  <th>SEXO: </th>
                  <td>{{$datos->sexo}}</td>
                </tr>
                <tr>
                  <th>DIRECCION: </th>
                  <td>{{$datos->direccion}}</td>
                </tr>
                
                <tr>
                  <th>ESTADO CIVIL: </th>
                  <td>{{$datos->estado_civil}}</td>
                </tr>
                <tr>
                  <th>FECHA DE NACIMIENTO: </th>
                  <td>{{$datos->fecha_nacimiento}}</td>
                </tr>
                <tr>
                  <th>TELEFONO: </th>
                  <td>{{$datos->telefono}}</td>
                </tr>
                <tr>
                  <th>CORREO ELECTRONICO: </th>
                  <td>{{$datos->correo}}</td>
                </tr>
                <tr>
                  <th>INSTITUCION: </th>
                  <td>{{$datos->institucion->nombre}}</td>
                </tr>
                <tr>
                  <th>ESPECIALIDAD: </th>
                  <td>{{$datos->area->nombre}}</td>
                </tr>
                <tr>
                  <th>ESTADO: </th>
                  <td>
                  @if($datos->estado==='habilitado')
                    HABILITADO
                  @else
                    INHABILITADO
                  @endif
                  </td>
                </tr>
                <tr>
                  <th>FECHA REGISTRO: </th>
                  <td>{{$datos->created_at}}</td>
                </tr>
                <tr>
                  <th>FECHA AFILIACION: </th>
                  <td>{{$datos->fecha_afiliacion}}</td>
                </tr>
                <tr>
                  <th>FECHA TITULACION: </th>
                  <td>{{$datos->fecha_titulacion}}</td>
                </tr>

              </table>
            </div>


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
                        <input type="hidden" name="id_cliente" id="id_cliente" value="">
                        <input type="hidden" name="id_aporte" id="id_aporte" value="">
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
                        <th>Motivo</th>
                        <th>Plazo</th>
                        <th>Total</th>
                        <th>A Cuenta</th>
                        <th>Saldo</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; 
                        
                        ?>
                        @foreach($datos->afiliado_aporte as $key=>$item)
                        <tr>
                            @if($datos->fecha_afiliacion<$item->plazo)
                            <td>{{++$i}}</td>
                            <td>{{$item->motivo}}</td>
                            <td>{{$item->plazo}}</td>
                            <td>{{round($item->monto,2)}}</td>
                            <?php $max=$item->monto-$model->saldo($datos->id,$item->id);?>
                            <td>{{round($model->saldo($datos->id,$item->id),2)}}</td>
                            <td>{{round($max,2)}}</td>
                            <td>
                                
                                @if($item->monto!=$model->saldo($datos->id,$item->id))
                                    Deudor
                                @else
                                    Cancelado
                                @endif
                            </td>
                            
                            <td class="text-center">
                                
                                @if($max>0)
                                <button class="btn btn-sm btn-success" role="button" title="Pagar" onclick="add_saldo({{$datos->id}},{{$item->id}},{{$max}});">
                                    <i class="fa fa-plus">
                                    </i>
                                </button>
                                @endif

                                
                                <a class="btn btn-sm btn-success" href="{{url('recibo/'.$datos->id.'/'.$item->id)}}" role="button">
                                  <i class="fa fa-print">
                                  </i>
                                  Recibo
                                </a>
                                <a class="btn btn-sm btn-success" href="{{url('detalle/'.$datos->id.'/'.$item->id)}}" role="button">
                                  <i class="fa fa-file-pdf-o">
                                  </i>
                                  Detalle
                                </a>
                                
                                

                              
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        @foreach($datos->area->aporte as $key=>$item)
                        <tr>
                            @if($datos->fecha_afiliacion<$item->plazo)
                            <td>{{++$i}}</td>
                            <td>{{$item->motivo}}</td>
                            <td>{{$item->plazo}}</td>
                            <td>{{round($item->monto,2)}}</td>
                            <?php $max=$item->monto-$model->saldo($datos->id,$item->id);?>
                            <td>{{round($model->saldo($datos->id,$item->id),2)}}</td>
                            <td>{{round($max,2)}}</td>
                            <td>
                                
                                @if($item->monto!=$model->saldo($datos->id,$item->id))
                                    Deudor
                                @else
                                    Cancelado
                                @endif
                            </td>
                            
                            <td class="text-center">
                                
                                @if($max>0)
                                <button class="btn btn-sm btn-success" role="button" title="Pagar" onclick="add_saldo({{$datos->id}},{{$item->id}},{{$max}});">
                                    <i class="fa fa-plus">
                                    </i>
                                </button>
                                @endif

                                
                                <a class="btn btn-sm btn-success" href="{{url('recibo/'.$datos->id.'/'.$item->id)}}" role="button">
                                  <i class="fa fa-print">
                                  </i>
                                  Recibo
                                </a>
                                <a class="btn btn-sm btn-success" href="{{url('detalle/'.$datos->id.'/'.$item->id)}}" role="button">
                                  <i class="fa fa-file-pdf-o">
                                  </i>
                                  Detalle
                                </a>
                                

                              
                            </td>
                            @endif
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
      <!-- /.row -->
    </section>
@endsection

@push('scripts')
<script>
    function add_saldo(id_cliente,id_aporte,max){
        //alert(id_salida);
        //alert(max);
        $("#saldo").attr({
        "max" : max,        // substitute your own
        "min" : 0          // values (or variables) here
        });
        document.getElementById("saldo").value="";
        document.getElementById("id_cliente").value=id_cliente;
        document.getElementById("id_aporte").value=id_aporte;
        $('#modal-saldo').modal('show');
    };
    $(document).on("submit",".add-saldo",function(e) {
        
        $.ajax({
            type:"POST",
            url:$(this).attr('action'),
            data:$(this).serialize(),
            success: function(data){
                //lert("entro");
                console.log(data);
                //return false;
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
