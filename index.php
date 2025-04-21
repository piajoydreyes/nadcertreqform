
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
    Online Request of Training Certificate
  </title>
  <!--     Fonts and icons     -->
  <link href="./assets/fonts/fonts.css" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="./assets/fonts/fontawesome.js" crossorigin="anonymous"></script>
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/dash.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="">
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('./assets/img/signup-cover.jpg'); background-position: top;">
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
        <div class="col-xl-8 col-lg-12 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header pb-0 text-center">
              <h4 class="font-weight-bolder">Online Request Form</h4>
              <p class="mb-0"></p>
            </div>
            <div class="card-body">

              <form action="certificate_training/reqForm.php">
                <div class="text-center">
                  <button type="submit" class="btn btn-xl btn-primary btn-lg w-100 mt-4 mb-0">Request Training Certificate</button>
                </div>
              </form>

              <form action="certificate_appearance/reqForm.php">
                <div class="text-center">
                  <button type="" class="btn btn-xl btn-primary btn-lg w-100 mt-4 mb-0">Certificate of Appearance</button>
                </div>
              </form>

              <form action="reqTracker.php">
                <div class="text-center">
                  <button type="submit" class="btn btn-xl btn-light btn-lg w-100 mt-4 mb-3">Track Your Request</button>
                </div>
              </form>
            </div>
            <div class="card-footer text-center pt-0 px-lg-2 px-1">
              <p class="mb-0 text-sm mx-auto">
                <a href="admin/login.php" class="text-primary text-gradient font-weight-bold">Admin</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
 
  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="./assets/js/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/dashboard.min.js?v=2.0.4"></script>
</body>

</html>