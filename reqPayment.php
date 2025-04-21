<?php
  include('includes/dbcon.inc.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    PAYMENT
  </title>
  <!--     Fonts and icons     -->
  <link href="assets/fonts/fonts.css" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="assets/fonts/fontawesome.js" crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/dash.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="">
  <main class="main-content  mt-0">
    <div class="page-header min-vh-50 pt-5 pb-11 m-3 border-radius-lg bg-primary">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5"></h1>
            <p class="text-lead text-white"></p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-8 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              <h5>ORDER OF PAYMENT</h5>
            </div>
            <div class="card-body">

              
                <div class="table-responsive p-0">
               
                    <table class="table align-items-center mb-0">
                    <?php
                if (isset($_POST['reqPaymentBtn']))
                {
                  $ctrl_no = $_POST['reqPaymentID'];

                  $query = "SELECT * FROM tbl_cert_payment WHERE ctrl_no = '$ctrl_no' ";
                  $query_run = mysqli_query($conn, $query);

              ?>
                        <thead>
                            <tr>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Description</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Quantity</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Unit Price</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Amount to Pay</th>
                            </tr>
                        </thead>

              <?php
                if(mysqli_num_rows ($query_run) >0)
                {
                  while ($row = mysqli_fetch_array($query_run))
                  {
                    
              
              ?>
                        <tbody>
                            <tr>
                                <td class="align-middle text-center">
                                    <h6 class="mb-0 text-sm"><?php echo $row['description'] ?></h6>
                                </td>
                                <td class="align-middle text-center">
                                    <h6 class="mb-0 text-sm"><?php echo $row['quantity'] ?></h6>
                                </td>
                                <td class="align-middle text-center">
                                    <h6 class="mb-0 text-sm">PHP <?php echo $row['unitPrice'] ?></h6>
                                </td>
                                <td class="align-middle text-center">
                                    <h6 class="mb-0 text-lg">PHP <?php echo $row['totalPrice'] ?></h6>
                                </td>
                            </tr>
                        </tbody>
              <?php
                
              }
            }
              ?>
                    </table>
                </div>
            
                <p class="text-center mt-5">Please pay the total Amout to Pay in the cashier. Input and submit the Official Receipt Number below. </p>
                
                <hr class="horizontal dark mt-2">
                <form role="form" action="includes/submitOR.inc.php" method="post" id="form">
                  <div class="mb-2">
                    <label for="ctrl_no">Control No.:</label>
                    <input type="text" class="form-control text-center" placeholder="Input Your Request Control Number Here" aria-label="Control Number" name="ctrl_no" id="ctrl_no">
                  </div>
                  <div class="mb-2">
                    <label for="or_num">Official Receipt No.:</label>
                    <input type="text" class="form-control text-center" placeholder="Input Official Receipt Number Here" aria-label="Official Receipt Number" name="or_num" id="or_num">
                  </div>
                  <div class="text-center">
                      <button type="submit" class="btn btn-primary w-100 my-2 mb-2" id="submitOR" name="submitOR">Submit</button>
                  </div>
                </form>

              <?php
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <!-- Github buttons -->
  <script async defer src="../assets/js/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/dashboard.min.js?v=2.0.4"></script>
</body>

</html>