<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{getenv('APP_TITLE')}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link id="favicon" rel="icon" type="image/x-icon" href="{{base_url()}}assets/favicon/favicon.ico">
  
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{base_url()}}assets/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{base_url()}}assets/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{base_url()}}assets/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{base_url()}}assets/AdminLTE/dist/css/AdminLTE.min.css">
  <!-- SweetAlert -->
  <link rel="stylesheet" href="{{base_url()}}assets/sweetalert/dist/sweetalert.css">
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{base_url()}}"><b>{{getenv('APP_TITLE_SHORT')}}</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">{{getenv('APP_TITLE')}}</p>

    <form action="{{base_url()}}log/in" method="post">
      @php
      if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('nip')) {
        $class = 'form-group has-feedback has-error';
        $message = ci()->session->flashdata('errors')->first('nip');
      } else {
        $class = 'form-group has-feedback';
        $message = '';
      }
      @endphp
      <div class="{{$class}}">
        <div data-toggle="tooltip" title="{{$message}}">
          <input name="nip" type="text" class="form-control" placeholder="NIP" value="{{ci()->session->flashdata('old') ? ci()->session->flashdata('old')['nip'] : ''}}">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
      </div>

      @php
      if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('password')) {
        $class = 'form-group has-feedback has-error';
        $message = ci()->session->flashdata('errors')->first('password');
      } else {
        $class = 'form-group has-feedback';
        $message = '';
      }
      @endphp
      <div class="{{$class}}">
        <div data-toggle="tooltip" title="{{$message}}">
          <input name="password" type="password" class="form-control" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-4 pull-right">
          <button type="submit" class="btn btn-primary btn-block">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{base_url()}}assets/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{base_url()}}assets/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SweetAlert -->
<script src="{{base_url()}}assets/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
$(function() {
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
@if(ci()->session->flashdata('alert'))
<script type="text/javascript">
    swal('{{ ci()->session->flashdata('alert')['title'] }}', '{{ ci()->session->flashdata('alert')['message'] }}', '{{ ci()->session->flashdata('alert')['class'] }}');
</script>
@endif
</body>
</html>
