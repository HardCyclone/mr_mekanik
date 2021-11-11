<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login Mr.Mekanik</title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>asset/dashboard/images/favicon.png">
  <link href="<?php echo base_url() ?>asset/dashboard/css/style.css" rel="stylesheet">

</head>

<body class="h-100">
  <div class="authincation h-100">
    <div class="container-fluid h-100">
      <div class="row justify-content-center h-100 align-items-center">
        <div class="col-md-4">
          <?php
          $this->load->helper('form');
          $error = $this->session->flashdata('error');
          if ($error) {
          ?>
            <div class="alert alert-danger fade show" role="alert"><?php echo $error; ?></div>
          <?php }
          $success = $this->session->flashdata('success');
          if ($success) {
          ?>
            <div class="alert alert-success fade show" role="alert"><?php echo $success; ?></div>
          <?php } ?>
          <div class="authincation-content">
            <div class="row no-gutters">
              <div class="col-xl-12">
                <div class="auth-form">
                  <h4 class="text-center mb-4">Sign in your account</h4>
                  <form action="<?php echo base_url() ?>user/autentikasi" method="post">
                    <div class="form-group">
                      <label><strong>Email</strong></label>
                      <input type="text" class="form-control" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                      <label><strong>Password</strong></label>
                      <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!--**********************************
        Scripts
    ***********************************-->
  <!-- Required vendors -->
  <script src="<?php echo base_url() ?>asset/dashboard/vendor/global/global.min.js"></script>
  <script src="<?php echo base_url() ?>asset/dashboard/js/quixnav-init.js"></script>
  <script src="<?php echo base_url() ?>asset/dashboard/js/custom.min.js"></script>

</body>

</html>