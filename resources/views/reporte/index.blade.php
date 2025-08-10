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
                        <h3 class="box-title">Reporte de ventas y reservas</h3>
                    </div>
                    <div class="box-body">

                    {!! Form::open(['url' => 'reporte_pdf','method' => 'POST','class'=>'']) !!}
                                
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('desde') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label for="desde" class="col-md-12 control-label">DESDE :</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input id="desde" type="date" class="form-control upper" name="desde" value="" required>
                                                
                                                
                                                @if ($errors->has('desde'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('desde') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('hasta') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label for="hasta" class="col-md-12 control-label">HASTA :</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <input id="desde" type="date" class="form-control upper" name="hasta" value="" required>
                                                @if ($errors->has('hasta'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('hasta') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('afiliado') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label for="afiliado" class="col-md-12 control-label">AFILIADO :</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select class="form-control selectpicker" name="afiliado" data-live-search="true">

                                                    <option value="todos">TODOS</option>
                                                    @foreach($data as $item)
                                                    <option value="{{$item->id}}">{{$item->nombres}} {{$item->apellidos}}</option>
                                                    @endforeach

                                                </select>
                                                @if ($errors->has('afiliado'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('afiliado') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('institucion') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label for="institucion" class="col-md-12 control-label">INSTITUCION :</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select class="form-control selectpicker" name="institucion" data-live-search="true">

                                                    <option value="todos">TODOS</option>
                                                    @foreach($institucion as $item)
                                                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                                                    @endforeach

                                                </select>
                                                @if ($errors->has('institucion'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('institucion') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('especialidad') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label for="especialidad" class="col-md-12 control-label">ESPECIALIDAD :</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select class="form-control selectpicker" name="especialidad" data-live-search="true">

                                                    <option value="todos">TODOS</option>
                                                    @foreach($area as $item)
                                                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                                                    @endforeach

                                                </select>
                                                @if ($errors->has('especialidad'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('especialidad') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('plan_pago') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <label for="plan_pago" class="col-md-12 control-label">PLAN DE PAGO :</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select class="form-control selectpicker" name="plan_pago" data-live-search="true">

                                                    <option value="todos">TODOS</option>
                                                    <option value="contado">CONTADO</option>
                                                    <option value="cuotas">A CUOTAS</option>

                                                </select>
                                                @if ($errors->has('plan_pago'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('plan_pago') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12">
                                    <div class="pull-right">
                                        <input type="submit" class="btn  btn-primary" value="Imprimir" >
                                    </div>
                                </div>
                            {!! Form::close() !!}  
                        

                    </div>
                </div>
            </div>
        </div>
      
        <!-- /.row -->
    </section>
@endsection

@push('scripts')
<script>
  

  
</script>
@endpush
