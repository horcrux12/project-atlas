<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $title;?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  
  <!-- Plugin css for this page -->
  <?php if (isset($css)){echo $css;}?>
  <!-- End plugin css for this page -->
  
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.png" />
</head>
<body class="with-welcome-text">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="<?php echo base_url();?>">
            <img src="<?php echo base_url();?>assets/images/logo/logo.svg" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini" href="index.html">
            <img src="<?php echo base_url();?>assets/images/logo/logo-mini.svg" alt="logo" />
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h3 class="welcome-text">Menu <span class="text-black fw-bold"><?= $title;?></span></h3>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown"> 
            <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="icon-bell"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="countDropdown" style="max-height : 20rem; overflow-y : auto;">
              <div class="dropdown-divider"></div>
              <?php if(count($data['notifikasi']) < 0) { ?>
              <?php for ($i=0; $i < count($data['notifikasi']); $i++) {?> 
                <?php 
                  $urlNotifikasi = base_url();
                  if ($this->session->userdata('level') == 1) {
                    $urlNotifikasi .= "data-pembelian/proses-pembelian/";
                  }else {
                    $urlNotifikasi .= "data-pembelian/detail-pembelian/";
                  }
                  $urlNotifikasi .= $data['notifikasi'][$i]['id_pembelian'];
                ?>
                <a class="dropdown-item preview-item btn-notifikasi" href="<?= $urlNotifikasi; ?>" data-id="<?= $data['notifikasi'][$i]['id']; ?>">
                <!-- <a class="dropdown-item preview-item btn-notifikasi" href="#" data-test="<?= $data['notifikasi'][$i]['id']; ?>"> -->
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark"><?= $data['notifikasi'][$i]['nama']; ?> </p>
                    <p class="fw-light small-text mb-0"> <?= $data['notifikasi'][$i]['pesan']; ?> </p>
                  </div>
                </a>
              <?php }}else { ?>
                <a class="dropdown-item preview-item" href="javascript:void(0);">
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">Tidak ada Notifikasi</p>
                  </div>
                </a>
              <?php } ?>
            </div>
          </li>
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="<?php echo base_url();?>assets/images/faces/default_user.png" alt="<?php echo ($this->session->userdata('nama') != "" ? $this->session->userdata('nama'):'User')?>"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="<?php echo base_url();?>assets/images/faces/default_user.png" alt="<?php echo ($this->session->userdata('nama') != "" ? $this->session->userdata('nama'):'User')?>">
                <p class="mb-1 mt-3 font-weight-semibold"><?php echo ($this->session->userdata('nama') != "" ? $this->session->userdata('nama'):'User')?></p>
              </div>
              <a class="dropdown-item" href="<?php echo base_url();?>logout"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <?php 
          if($this->session->userdata('level') == 1){
            $this->load->view('sidebar-admin');
          }else {
            $this->load->view('sidebar-user');
          }
        ?>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <!-- Main Content -->
          <?php
            if($page_content != '') {
              $this->load->view($page_content);
            }
          ?>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © <?php echo date("Y");?>. All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="<?php echo base_url();?>assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- <script src="<?php echo base_url();?>assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script> -->
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- <script src="<?php echo base_url();?>assets/vendors/chart.js/Chart.min.js"></script> -->
  <!-- <script src="<?php echo base_url();?>assets/vendors/progressbar.js/progressbar.min.js"></script> -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?php echo base_url();?>assets/js/off-canvas.js"></script>
  <script src="<?php echo base_url();?>assets/js/hoverable-collapse.js"></script>
  <script src="<?php echo base_url();?>assets/js/template.js"></script>
  <script src="<?php echo base_url();?>assets/js/settings.js"></script>
  <script src="<?php echo base_url();?>assets/js/todolist.js"></script>
  <!-- endinject -->
  <script>
    let baseUrl = '<?= base_url();?>';
    let tombolNotifikasi = document.querySelectorAll('.btn-notifikasi');

    tombolNotifikasi.forEach(el => {
      el.addEventListener('click', (e) => {
        e.preventDefault();
        dataNotifikasi = {
          status : "Read",
          id : el.dataset.id
        }
        let options = {
            method : 'POST',
            headers : {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body : JSON.stringify(dataNotifikasi)
        }

        fetch(`${baseUrl}read-notifikasi`, options)
          .then(res => res.json())
          .then(d => {
            console.log(d);
            window.location.href = `${baseUrl}data-pembelian`;
          })
          .catch(err => console.log(err));
      })  
    });

    
  </script>
  <!-- Custom js for this page-->
  <!-- <script src="<?php echo base_url();?>assets/js/jquery.cookie.js" type="text/javascript"></script> -->
  <!-- <script src="<?php echo base_url();?>assets/js/Chart.roundedBarCharts.js"></script> -->
  <?php if (isset($js)){echo $js;}?>
  <!-- End custom js for this page-->
</body>


</html>

