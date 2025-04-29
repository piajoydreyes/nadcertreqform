<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    SIGN UP
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

<body class="">
  <main class="main-content  mt-0">
    <div class="page-header min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('../assets/img/signup-cover.jpg'); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <!-- <h1 class="text-white mb-2 mt-5">Welcome!</h1> -->
            <!-- <p class="text-lead text-white">Use these awesome forms to login or create new account in your project for free.</p> -->
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card card-profile">
            <div class="card-header text-center pt-4">
              <h5>Sign Up</h5>
            </div>
            <div class="card-body">
              <form role="form" action="codes.php" method="post" id="form">
                <div class="mb-3">
                  <input type="text" class="form-control" placeholder="First Name" aria-label="First Name" name="firstname" id="firstname" >
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control" placeholder="Last Name" aria-label="Last Name" name="lastname" id="lastname">
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control" placeholder="Username" aria-label="Username" name="username" id="username">
                </div>
                <div class="mb-3">
                  <input type="email" class="form-control" placeholder="Email" aria-label="Email" name="regemail" id="regemail">
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" placeholder="Password" aria-label="Password" autocomplete="new-password" name="password" id="password">
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" placeholder="Confirm Password" aria-label="Confirm Password" autocomplete="new-password" name="confirmpass" id="confirmpass">
                </div>
                <div class="form-check form-check-info text-start">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                  <label class="form-check-label" for="flexCheckDefault">
                    I agree on the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary w-100 my-4 mb-2" id="submitReg" name="submitReg">Sign Up</button>
                </div>
                <p class="text-sm mt-3 mb-0">Already have an account? <a href="login.php" class="text-primary font-weight-bold">Sign In</a></p>
              </form>
            </div>
          </div>
          
          <!-- Back Button -->
          <div class="backBtnContainer" style="margin-top: 15px; text-align: center;">
              <form action="../index.php" method="POST">
                  <button type="submit" class="btn btn-secondary">
                      <i class="fas fa-arrow-left"></i> Back
                  </button>
              </form>
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

  <!-- SweetAlert -->
  <script src="js/sweetalert.min.js"></script>

  <?php
  if(isset($_SESSION['status']) && $_SESSION['status'] !='')
  {
      ?>
      <script>
          // script for adding users
          swal({
          title: "<?php echo $_SESSION['status']; ?>",
          icon: "<?php echo $_SESSION['status_code']; ?>",
          });
      </script>
      <?php
      unset($_SESSION['status']);
  }
  ?>

</body>

</html>