<?php
  include('sessions.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    PAYMENTS
  </title>
  <!--     Fonts and icons     -->
  <link href="../assets/fonts/fonts.css" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="../assets/fonts/fontawesome.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/dash.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="# " target="_blank">
        <img src="../assets/img/logo_phc.png" class="navbar-brand-img h-100" alt="main_logo">
        <?php

        ?>
        <span class="ms-1 font-weight-bold text-uppercase"> ADMIN <?php echo $_SESSION['uname']; ?> </span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="requests.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-copy-04 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Requests</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="payments.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-badge text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Payments</span>
          </a>
        </li>

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="login.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>
      </ul>
    </div>
    
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Payments</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Payments</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
    
      <div class="col-12 mt-3">
        <div class="card mb-4">
          <div class="card-header pb-0">
              <h6>Payments Overview</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">

          <?php 
              // $query = "SELECT tbl_cert_req.*, tbl_cert_payment.ctrl_no, tbl_cert_payment.description, tbl_cert_payment.quantity, tbl_cert_payment.unitPrice, tbl_cert_payment.totalPrice, tbl_cert_payment.or_num FROM tbl_cert_req
              // RIGHT JOIN tbl_cert_payment ON tbl_cert_req.ctrl_no = tbl_cert_payment.ctrl_no ";
              // $query = "SELECT tbl_cert_payment.*, tbl_cert_req.ctrl_no, tbl_cert_req.processingOfficer FROM tbl_cert_payment JOIN tbl_cert_req WHERE tbl_cert_payment.ctrl_no = tbl_cert_req.ctrl_no ";
              // $query = "SELECT tbl_cert_payment.*, tbl_cert_req.ctrl_no, tbl_cert_req.processingOfficer FROM tbl_cert_payment JOIN tbl_cert_req WHERE tbl_cert_payment.ctrl_no = tbl_cert_req.ctrl_no ";
               $query = "SELECT * FROM tbl_cert_payment";
              $query_run = mysqli_query($conn, $query);
          ?>

            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Control No.</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Description</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Quantity</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Unit Price</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Total Price</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">OR Number</th>
                      <!-- <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Processing Officer</th> -->
                    </tr>
                </thead>
                <tbody>
                <?php
                    // if(mysqli_num_rows ($query_run) > 0)
                    // {
                    //     while($row = mysqli_fetch_array($query_run))
                    //     {
                    foreach ($query_run as $row)
                    {
                            ?>
                                  <tr>
                                      <td class="align-middle text-center">
                                          <h6 class="mb-0 text-sm"><?php echo $row['ctrl_no'] ?></h6>
                                      </td>
                                      <td class="align-middle text-center">
                                          <p class="text-xs text-secondary mb-0"><?php echo $row['description'] ?></p>
                                      </td>
                                      <td class="align-middle text-center">
                                          <p class="text-xs text-secondary mb-0"><?php echo $row['quantity'] ?></p>
                                      </td>
                                      <td class="align-middle text-center">
                                          <p class="text-xs text-secondary mb-0"><?php echo $row['unitPrice'] ?></p>
                                      </td>
                                      <td class="align-middle text-center">
                                          <p class="text-xs text-secondary mb-0"><?php echo $row['totalPrice'] ?></p>
                                      </td>
                                      <td class="align-middle text-center">
                                          <p class="mb-0 text-sm font-weight-bolder"><?php echo $row['or_num'] ?></p>
                                      </td>
                                      
                                  </tr>
                              
 
                            <?php
                        }
                    // }
                    // else 
                    // {
                    //     ?>
                    <!-- //         <tr>
                    //             <td colspan="7">No Request Found.</td>
                    //         </tr> -->
                         <?php
                    // }
                ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>


      <footer class="footer pt-5">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                developed by
                <a href="#" class="font-weight-bold" target="_blank">Management Information Systems Division</a>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!-- Github buttons -->
  <script async defer src="../assets/js/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/dashboard.min.js?v=2.0.4"></script>
</body>

</html>