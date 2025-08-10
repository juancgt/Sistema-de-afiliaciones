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
                <h3 class="box-title">Datalle Actividad</h3>
                <!--<div class="pull-right">
                    <a class="btn btn-sm btn-success" href="{{url('credencial/'.$id)}}" role="button">
                    <i class="fa fa-file-pdf-o">
                    </i>
                    Imprimir credencial
                    </a>
                </div>-->
                </div>
                <!-- /.box-header -->
                <div class="box-body ">
                    <div class="active tab-pane" id="activity">
                        <!-- Post -->
                        <div class="post">
                            <div class="user-block">
                                
                                    <span class="username">
                                    <a href="#">{{$datos->actividad}}</a>
                                    
                                    </span>
                                    <span><a class="username" href="{{$datos->archivo}}">Ver Documento</a></span>
                                    <span class="description">Inicio de Actividad - {{$datos->inicio}}</span>
                                    <span class="description">Hasta - {{$datos->fin}}</span>
                                    
                                    
                                    
                            </div>
                            <!-- /.user-block -->
                            <p>
                                
                                {{print($datos->descripcion)}}
                                
                            </p>
                        

                        
                        </div>
                        <!-- /.post -->
                        <!-- /.post -->
                    
                    </div>
                <!-- /.box-body -->
                </div>
            <!-- /.box -->
            </div>
        <!-- /.col -->
        </div>
      <!-- /.row -->
    </div>
    </section>
@endsection

@push('scripts')

@endpush
