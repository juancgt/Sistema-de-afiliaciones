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
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tr>
                  <td rowspan="11" width="20%">
                  @if($datos->photo!=null)
                    <?php 
                      $foto=$datos->photo;
                      header("Content-type: image/jpg image/png");
                      $my_bytea=stream_get_contents($foto);
                    ?>
                    <img with="200px" height="200px" src="data:image/jpeg;base64,{{$my_bytea}}" class="user-image" alt="User Image">
                  @else
                    <img src="../img/user2-160x160.jpg" alt="Imagen de Usuario" width="100%">
                  @endif
                  </td>
                  <th>USUARIO: </th>
                  <td>{{$datos->name}}</td>
                </tr>
                <tr>
                  <th>CORREO: </th>
                  <td>{{$datos->email}}</td>
                </tr>
                
                <?php $bol=true;?>
                @foreach($rol as $key=>$item)
                <tr>
                  @if($bol)
                  <th>ROL: </th>
                  <?php $bol=false;?>
                  @endif
                  <td>{{$item->name}}</td>
                </tr>
                @endforeach
                <tr>
                  <th>NOMBRES: </th>
                  <td>{{$datos->first_name}}</td>
                </tr>
                <tr>
                  <th>APELLIDOS: </th>
                  <td>{{$datos->last_name}}</td>
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
                  <th>FECHA CREACION: </th>
                  <td>{{$datos->created_at}}</td>
                </tr>

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

@endpush
