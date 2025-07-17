<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $judul_halaman ?> </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url()?>assets/skydash/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/skydash/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/skydash/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->

    <link rel="stylesheet" href="<?= base_url()?>assets/skydash/vendors/ti-icons/css/themify-icons.css">

    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url()?>assets/skydash/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url()?>assets/skydash/images/favicon.png" />

    <link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="index.html"><img
                        src="<?= base_url()?>assets/skydash/images/logo.svg" class="mr-2" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img
                        src="<?= base_url()?>assets/skydash/images/logo-mini.svg" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src="<?= base_url()?>assets/skydash/images/faces/face28.jpg" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item">
                                <i class="ti-settings text-primary"></i>
                                Passwod
                            </a>
                            <a class="dropdown-item" href="<?= base_url('auth/logout') ?>">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <?php $halaman = $this->uri->segment(1);?>
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item <?php if($halaman == 'home'){echo 'active';}?>">
                        <a class="nav-link" href="<?= base_url('home')?>">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <?php if($this->session->userdata('level')=='admin'){?>
                    <li class="nav-item <?php if($halaman == 'produk'){echo 'active';}?>">
                        <a class="nav-link" href="<?= base_url('produk')?>">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Produk</span>
                        </a>
                    </li>
                    <li class="nav-item <?php if($halaman == 'user'){echo 'active';}?>">
                        <a class="nav-link" href="<?= ('user')?>">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">User</span>
                        </a>
                    </li>
                    <?php }?>
                    <li class="nav-item <?php if($halaman == 'penjualan'){echo 'active';}?>">
                        <a class="nav-link" href="<?= base_url('penjualan')?>">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Penjualan</span>
                        </a>
                    </li>
                    <li class="nav-item <?php if($halaman == 'pelanggan'){echo 'active';}?>">
                        <a class="nav-link" href="<?= base_url('pelanggan')?>">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Pelanggan</span>
                        </a>
                    </li>
                    
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">

                        <?= $contents; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    
    <!-- partial -->
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="<?= base_url()?>assets/skydash/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url()?>assets/skydash/vendors/chart.js/Chart.min.js">
    </script>


    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url()?>assets/skydash/js/off-canvas.js"></script>
    <script src="<?= base_url()?>assets/skydash/js/hoverable-collapse.js"></script>
    <script src="<?= base_url()?>assets/skydash/js/template.js"></script>
    <script src="<?= base_url()?>assets/skydash/js/settings.js"></script>
    <script src="<?= base_url()?>assets/skydash/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?= base_url()?>assets/skydash/js/dashboard.js"></script>
    <script src="<?= base_url()?>assets/skydash/js/Chart.roundedBarCharts.js">
    </script>
    <!-- End custom js for this page-->
    <script>
    $('#menghilang').delay('slow').slideDown('slow').delay(1000).slideUp(600);
    </script>

</body>

</html>