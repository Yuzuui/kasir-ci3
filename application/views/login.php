
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url()?>assets/skydash/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/skydash/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/skydash/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url()?>assets/skydash/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url()?>assets/skydash/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              
              <h4>T Mart</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" action="<?= base_url('auth/login')?>" method="POST">
                <div class="form-group">
                  <input type="texx" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" name="username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password">
                </div>
                <div class="mt-3">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Let me in</button>
                </div>
                <div id="menghilang">
                    <?php echo $this->session->flashdata('alert', true);?>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?= base_url()?>assets/skydash/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?= base_url()?>assets/skydash/js/off-canvas.js"></script>
  <script src="<?= base_url()?>assets/skydash/js/hoverable-collapse.js"></script>
  <script src="<?= base_url()?>assets/skydash/js/template.js"></script>
  <script src="<?= base_url()?>assets/skydash/js/settings.js"></script>
  <script src="<?= base_url()?>assets/skydash/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
