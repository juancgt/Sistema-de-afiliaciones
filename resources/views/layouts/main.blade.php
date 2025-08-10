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
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Sistema </b>Afiliaciones</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">

        <i class="fa fa-bars"></i>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            
            @if(Auth::user()->photo!=NULL)
              <?php 
              $foto=Auth::user()->photo;
              header("Content-type: image/jpg image/png");
              $my_bytea=stream_get_contents($foto);
              ?>
              <img src="data:image/jpeg;base64,{{$my_bytea}}" class="user-image" alt="User Image">
            @else
              <img src="/img/user2-160x160.jpg" class="user-image" alt="User Image">
            @endif
              
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                
                @if(Auth::user()->photo!=NULL)
                  <img src="data:image/jpeg;base64,{{$my_bytea}}" class="img-circle" alt="User Image">
                @else
                  <img src="/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                @endif
                <p>
                {{ Auth::user()->name }}
                  <small>{{ Auth::user()->username }}</small>
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <!--<a href="#" class="btn btn-default btn-flat">Profile</a>-->
                </div>
                <div class="pull-right">
                <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        Cerrar Sesion
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                  
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if(Auth::user()->photo!=NULL)
            <img src="data:image/jpeg;base64,{{$my_bytea}}" class="img-circle" alt="User Image">
          @else
            <img src="/img/user2-160x160.jpg" class="img-circle" alt="User Image">
          @endif
          
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> En Linea</a>
        </div>
      </div>
      <!-- search form -->
      <!--<form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->  
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header danger">MENU</li>
        <li>
          <a href="{{url('/')}}">
            <i class="fa fa-th"></i> <span>Inicio</span>
          </a>
        </li>
        
        @permission('ADMINISTRADOR')
        <li class="treeview">
          <a>
            <i class="fa fa-gear"></i>
            <span>Administracion</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{url('role')}}">
              <i class="fa fa-unlock-alt"></i> <span>Rol</span>
              </a>
            </li>
            <li>
              <a href="{{url('user')}}">
              <i class="fa fa-user-secret"></i> <span>Usuario</span>
              </a>
            </li>
          </ul>
        </li>
        @endpermission
        
        @permission('AFILIACION')
        <li class="treeview">
          <a>
            <i class="fa fa-institution"></i>
            <span>Afiliacion</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{url('especialidad')}}">
                <i class="fa fa-archive"></i> <span>Especialidad</span>
              </a>
            </li>
            <li>
              <a href="{{url('institucion')}}">
                <i class="fa fa-picture-o"></i> <span>Institucion</span>
              </a>
            </li>
            <li>
              <a href="{{url('afiliado')}}">
                <i class="fa fa-archive"></i> <span>Afiliado</span>
              </a>
            </li>
            
          </ul>
        </li>
        @endpermission

        @permission('ACTIVIDAD')
        <li class="treeview">
          <a>
            <i class="fa fa-shopping-cart"></i>
            <span>Actividad</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{url('actividad')}}">
                <i class="fa fa-cart-arrow-down"></i> <span>R. Actividad</span>
              </a>
            </li>
          </ul>
        </li>
        @endpermission
        @permission('APORTE')
        <li class="treeview">
          <a>
            <i class="fa fa-shopping-cart"></i>
            <span>Aporte</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{url('aporte')}}">
                <i class="fa fa-cart-arrow-down"></i> <span>R. Aporte</span>
              </a>
            </li>
          </ul>
        </li>
        @endpermission
        @permission('REPORTE')
        <li class="treeview">
          <a>
            <i class="fa fa-print"></i>
            <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{url('reporte')}}">
                <i class="fa fa-print"></i> <span>R. Aporte</span>
              </a>
            </li>
          </ul>
        </li>
        @endpermission

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!--<section class="content-header">
      <h1>
        Blank page
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>-->

    <!-- Main content -->
    <section class="content">
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 0.0.1
    </div>
    <strong>Prueba</strong>
    reserved.
  </footer>


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
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
