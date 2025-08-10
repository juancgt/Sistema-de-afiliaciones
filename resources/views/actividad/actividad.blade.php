<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name')}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/css/custom.css">

    <link rel="stylesheet" href="/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="/css/dataTables.bootstrap.min.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/css/bootstrap3-wysihtml5.min.css">
    <!-- Custom styles -->
    @stack('styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->




  <!-- =============================================== -->

 

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content">
 
    <section class="content">
    
        <section class="content-header">
            <h1>
            <center>
            {{$datos->actividad}}
            </center>
            </h1>
            
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                <!-- /.box -->

                    <div class="box box-primary">
                        <div class="box-header">
                        
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
                                        
                                            
                                            
                                            <span class="description">Inicio de Actividad - {{$datos->inicio}}</span>
                                            <span class="description">Hasta - {{$datos->fin}}</span>
                                            <span><a class="username" href="{{$datos->archivo}}">Ver Documento</a></span>
                                            
                                            
                                            
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        
                                        <?php  print "$datos->descripcion"?>
                                        
                                        
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

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

<!-- ./wrapper -->
<script src="/plugins/moment/moment-with-locales.js"></script>
<!--<script src="{{secure_asset('plugins/moment/moment.min.js')}}"></script>-->
<!-- jQuery 3 -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/plugins/jquerySlimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/js/adminlte.min.js"></script>

<!-- select -->
<script src="/js/bootstrap-select.min.js"></script>

<!-- dataTables -->
<script src="/js/jquery.dataTables.min.js"></script>

<script src="/js/bootbox.min.js"></script>

<script src="/js/ckeditor.js"></script>
<script src="/js/bootstrap3-wysihtml5.all.min.js"></script>

<script>
  
  $(document).ready(function () {
    
    $(".upper").on('keyup', function(e){
        var $input = $(e.target);
        $input.val($input.val().toUpperCase());
    });
    
  });
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
     


      var estado=true;
      $('.confirm').on('submit',function(e){
     // previene el envío normal del formulario 
        if(estado)
        {


          e . preventDefault ();
          var _form = $(this);
          bootbox.confirm({
              message: "Esta seguro de realizar la operación?",
              buttons: {
                  confirm: {
                      label: 'Aceptar',
                      className: 'btn-success'
                  },
                  cancel: {
                      label: 'Cancelar',
                      className: 'btn-danger'
                  }
              },
              callback: function (result) {
                if(result)
                {
                  estado=false;
                  _form.submit();
                }
                
              }
          });
          
        }
  })
  

});
</script>
<!-- Custom scripts -->
@stack('scripts')
</body>
</html>



