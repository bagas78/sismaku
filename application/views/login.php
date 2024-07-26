
<!DOCTYPE html>
<html>
<head> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <title>LOGIN | GABRIEL MAJU JAYA FARM</title>
  <!-- <link rel="shortcut icon" href="<?php echo base_url() ?>assets/gambar/icon.ico" /> -->
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 --> 
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/Ionicons/css/ionicons.min.css"> 
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/plugins/iCheck/square/blue.css">

  <!--sweetalert-->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/sweetalert/sweetalert2.css">
  <script src="<?php echo base_url() ?>assets/sweetalert/sweetalert2.js"></script>

  <style type="text/css">
    #loader {
        position: absolute;
        left: 45%;
        top: 30%;
        z-index: 1;
        width: 140px;
        height: 45px;
        font-size: 18px;
        opacity: 40%;
    }
    .footer{
      background: #eee;
      box-shadow: 0px 2px 0px 0px rgb(0 0 0 / 25%), 0px 4px 4px 2px rgb(0 0 0 / 28%);
      padding: 1%;
    }
    .login-box{
      width: 460px;
    }
    @media (max-width: 767px) {
      .login-box{
        width: 95vw;
      }
    }
  </style>

</head>

<button style="display: none;" id="loader" class="btn btn-danger" type="button" disabled>
  <i class="fa fa-spinner fa-spin"></i>
  Loading...
</button>


<body class="hold-transition login-page" style="background: url('<?=base_url('assets/gambar/ayam.jpg')?>');
    background-repeat: repeat;"> 
<div class="login-box">

  <!-- /.login-logo -->
  <div class="login-box-body" style="box-shadow: 0 1px 5px 0 rgb(0 0 0 / 49%), 0 3px 30px 0 rgb(0 0 0 / 39%);">

    <h3 style="font-weight: bolder;" class="login-box-msg">Login Aplikasi <i class="fa fa-lock"></i></h3>

    <form action="<?php echo base_url() ?>login/auth" method="post">
      <div class="form-group has-feedback">
        <label>Email</label>
        <input type="text" class="form-control" name="user_email" required="">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <label>Kata Sandi</label>
        <input type="password" class="form-control" name="user_password" required="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">

        <div class="col-xs-6">
          <button type="reset" class="btn btn-block btn-flat btn-danger">Reset <i class="fa fa-times"></i></button>
        </div>

        <div class="col-xs-6">
          <button type="submit" class="btn btn-block btn-flat btn-success">Login <i class="fa fa-angle-double-right"></i></button>
        </div>

      </div>
    </form>

  </div>
  <p class="footer" align="center"><b>SISMAKU</b> ( Sistem Informasi Manajemen Keuangan )</p>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url() ?>adminLTE/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });


<?php if ($this->session->flashdata('gagal')): ?>

Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: '<?php echo $this->session->flashdata('gagal'); ?>',
});

<?php endif ?>


$(document).ready(function () {
   $(':submit').on("click", function () {
        
        $('#loader').css('display', '');
   });
});

</script>
</body>
</html>
