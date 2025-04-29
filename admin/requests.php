<?php
    session_start();
    
    // Check if user is logged in
    if (!isset($_SESSION['uid']) || !isset($_SESSION['uName'])) {
        header("Location: login.php");
        exit();
    }

    $uid = $_SESSION['uid'];
    $uName = $_SESSION['uName'];
    $uEmail = $_SESSION['eMail'];
    $uFName = $_SESSION['fName'];
    $uLName = $_SESSION['lName'];

    //db
    require '../includes/dbcon.php'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    MAIN DASHBOARD
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

<body class="g-sidenav-show bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="# " target="_blank">
        <img src="../assets/img/logo_phc.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-uppercase"> ADMIN <?= htmlspecialchars($uFName) ?> </span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link " href="dashboard.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-copy-04 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Requests</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="payments.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-danger text-sm opacity-10"></i>
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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Requests</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Requests</h6>
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
      <div class="row">
          <div class="col-12">
              <div class="card mb-4">
                  <div class="card-header pb-0">
                      <h6>Document Requests</h6>
                  </div>
                  <div class="card-body px-0 pt-0 pb-2">

                  <?php 
                    // Fetch all requests
                    $query = "SELECT * FROM tbl_cert_req ORDER BY ctrl_no";
                    $query_run = $connPDODBNADCERTDOC->query($query);

                    // Prepare a grouped array
                    $groupedRequests = [];

                    if ($query_run->rowCount() > 0) {
                        while ($row = $query_run->fetch(PDO::FETCH_ASSOC)) {
                            $ctrl_no = $row['ctrl_no'];

                            if (!isset($groupedRequests[$ctrl_no])) {
                                // Initialize the first entry
                                $groupedRequests[$ctrl_no] = [
                                    'fullname' => $row['fullname'],
                                    'processingofficer' => $row['processingofficer'],
                                    'status' => $row['status'],
                                    'certdesignation' => [],
                                    'trainingcert' => [],
                                    'othertrainingcert' => [],
                                    'trainingdate' => [],
                                    'remarks' => $row['remarks'],
                                    'releasedate' => $row['releasedate']
                                ];
                            }

                            // Collect multiple entries
                            $groupedRequests[$ctrl_no]['certdesignation'][] = $row['certdesignation'];
                            $groupedRequests[$ctrl_no]['trainingcert'][] = $row['trainingcert'];
                            $groupedRequests[$ctrl_no]['othertrainingcert'][] = $row['othertrainingcert'];

                            if (!is_null($row['trainingdate'])) {
                                $trainDate = strtotime($row['trainingdate']);
                                if ($trainDate > 0) {
                                    $groupedRequests[$ctrl_no]['trainingdate'][] = date("M d, Y", $trainDate);
                                }
                            }
                        }
                    }
                  ?>

                    <div class="table-responsive p-0">
                      <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Control No.</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Full Name</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Training / Certificate</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Title</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Other Title</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Training Date</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Processing Officer</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Remarks</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Release Date</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>

                          <?php if (!empty($groupedRequests)): ?>
                            <?php foreach ($groupedRequests as $ctrl_no => $details): ?>
                                <tr>
                                    <td class="align-middle text-center">
                                        <h6 class="mb-0 text-sm"><?= htmlspecialchars($ctrl_no) ?></h6>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs text-secondary mb-0"><?= htmlspecialchars($details['fullname']) ?></p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs text-secondary mb-0"><?= htmlspecialchars(implode(", ", $details['certdesignation'])) ?></p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs text-secondary mb-0"><?= htmlspecialchars(implode(", ", $details['trainingcert'])) ?></p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs text-secondary mb-0"><?= htmlspecialchars(implode(", ", $details['othertrainingcert'])) ?></p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs text-secondary mb-0"><?= htmlspecialchars(implode(", ", $details['trainingdate'])) ?></p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs text-secondary text-uppercase mb-0"><?= htmlspecialchars($details['processingofficer']) ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <?php 
                                          $status = $details['status'];
                                          if ($status === "Requested") {
                                            echo '<span class="badge badge-sm bg-gradient-info">Requested</span>';
                                          } elseif ($status === "For Payment") {
                                            echo '<span class="badge bg-gradient-warning text-white">For Payment</span>';
                                          } elseif ($status === "Paid") {
                                            echo '<span class="badge bg-gradient-success text-white">Paid</span>';
                                          } elseif ($status === "For Releasing") {
                                            echo '<span class="badge bg-gradient-primary text-white">For Releasing</span>';
                                          } elseif ($status === "Released") {
                                            echo '<span class="badge bg-gradient-danger text-white">Released</span>';
                                          }
                                        ?>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs text-secondary mb-0"><?php echo $details['remarks'] ?></p>
                                    </td>
                                    <td class="align-middle text-center">
                                      <p class="text-xs text-secondary mb-0">
                                        <?php 
                                        if(!is_null($details['releasedate']))
                                        {
                                          $reDate = strtotime($details['releasedate']);
                                          if ($reDate > 0)
                                          {
                                            echo date("M d, Y", strtotime($details['releasedate']));
                                          }
                                        }
                                        ?>
                                      </p>
                                    </td>
                                    <td  class="align-middle text-center text-lg">

                                    <form action="editRequest.php" method="POST">
                                      <input type="hidden" name="editDocReqID" value="<?= htmlspecialchars($ctrl_no) ?>">
                                      <button type="submit" class="btn btn-warning btn-xs mb-0" name="editDocReqBtn">
                                          <i class="fas fa-pencil-alt">
                                          </i>
                                          Edit
                                      </button>
                                    </form>
                                </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">No Request Found.</td>
                                </tr>
                          <?php endif; ?>
                            
                        </tbody>
                      </table>
                    </div>
                  </div>
              </div>
          </div>
      </div>

        <!-- FOOTER -->
        <footer class="footer pt-5  ">
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