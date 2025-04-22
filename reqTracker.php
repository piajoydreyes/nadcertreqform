<?php
    require 'includes/dbcon.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>TRACK REQUEST</title>
  <link href="assets/fonts/fonts.css" rel="stylesheet" />
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="assets/fonts/fontawesome.js" crossorigin="anonymous"></script>
  <link id="pagestyle" href="assets/css/dash.css?v=2.0.4" rel="stylesheet" />
  <link rel="stylesheet" href="assets/style2.css">
  <script src="assets/jquery.min.js" nonce="<?= $_SERVER['HTTP_X_NONCE'] ?>"></script>
</head>

<body>
<section class="container reqTrack">
  <header class="trackTitle">Track your Request:</header>
  <form action="" method="POST" class="formReq">
    <div class="columnReq">
      <div class="input-box inputCtrl">
        <input type="text" name="search" placeholder="Enter your Control No.">
      </div>
      <div class="input-box trackCtrl">
        <button class="trackReq" type="submit" name="submit">Track</button>
      </div>
    </div>
  </form>

<?php
if (isset($_POST['submit'])) {
    $ctrlno = $_POST['search'];

    $sql = "SELECT 
                u.*, 
                c.user_id, c.ctrl_no, c.fullname, c.certdesignation, 
                c.trainingcert, c.othertrainingCert, c.trainingdate, 
                c.processingofficer, c.status, c.releasedate 
            FROM tbl_user u
            JOIN tbl_cert_req c ON u.ctrl_no = c.ctrl_no
            WHERE c.ctrl_no = :ctrlno";

    $stmt = $connPDODBNADCERTDOC->prepare($sql);
    $stmt->bindParam(':ctrlno', $ctrlno);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <table id="requests">
        <tr>
            <th id="reqTh">Control No.</th>
            <th>Full Name</th>
            <th>Document Requesting</th>
            <th>Title</th>
            <th>Other Title</th>
            <th>Training Date</th>
            <th>Release Date</th>
            <th>Processing Officer</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php if ($results): ?>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td id="reqTh"><?= htmlspecialchars($row['ctrl_no']) ?></td>
                    <td><?= htmlspecialchars($row['fullname']) ?></td>
                    <td><?= htmlspecialchars($row['certdesignation']) ?></td>
                    <td><?= htmlspecialchars($row['trainingcert']) ?></td>
                    <td><?= htmlspecialchars($row['othertrainingcert']) ?></td>
                    <td><?= date("M d, Y", strtotime($row['trainingdate'])) ?></td>
                    <td id="reqTd">
                        <?php 
                            if (!is_null($row['releasedate']) && strtotime($row['releasedate']) > 0) {
                                echo date("M d, Y", strtotime($row['releasedate']));
                            }
                        ?>
                    </td>
                    <td class="text-center text-uppercase"><?= htmlspecialchars($row['processingofficer']) ?></td>
                    <?php
                        $status = $row['status'];
                        $ctrl = htmlspecialchars($row['ctrl_no']);
                        echo "<td id='reqTd'>$status</td>";

                        if ($status === "For Payment") {
                            echo "<td id='reqTd'>
                                    <form action='#' method='POST'>
                                        <input type='hidden' name='reqPaymentID' value='$ctrl'>
                                        <button type='submit' class='btn btn-info btn-xs mb-0' name='reqPaymentBtn'>
                                            <i class='fas fa-wallet'></i> Pay
                                        </button>
                                    </form>
                                  </td>";
                        } else {
                            echo "<td></td>";
                        }
                    ?>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="10">No Request Found.</td></tr>
        <?php endif; ?>
    </table>
<?php } ?>


</section>

<!-- Core JS -->
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="assets/js/plugins/chartjs.min.js"></script>
<script async defer src="assets/js/buttons.js"></script>
<script src="assets/js/dashboard.min.js?v=2.0.4"></script>
</body>
</html>
