<?php
    require '../includes/dbcon.php';
    require 'functions.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        REQUEST FORM
    </title>

    <!-- stylesheet -->
    <link rel="stylesheet" href="assets/style.css">

    <!-- jquery -->
    <script src="assets/jquery.min.js" nonce="<?=$_SERVER['HTTP_X_NONCE']?>"></script>
    
</head>

<body>

    <section class="container">
        <header>Certificate of Appearance</header>
        
        <form action="reqForm.inc.php" method="post" class="form" id="form">

            <h5>Fields with (*) are required.</h5>
            <div class="column">
                <div class="input-box">
                    <label for="fullname"> * Full Name (First Name, Middle Initial, Last Name):</label> <span id="name_error"></span>
                    <input type="text" name="fullname"placeholder="Enter First Name, Middle Initial, Last Name" id="fullname"/>
                    
                </div>
                <div class="input-box">
                    <label for="hospital_affiliation"> * Hospital Affiliation:</label> <span id="hospaff_error"></span> 
                    <input type="text" name="hospital_affiliation" placeholder="Enter Hospital Affiliation" id="hospital_affiliation"/>
                    
                </div>
            </div>

            <div class="input-box">
                <label for="address"> * Address:</label> <span id="address_error"></span>
                <input type="text" name="address" placeholder="Enter Address" id="address" autocomplete="address-line1"/>
            </div>

            <div class="column">
                <div class="input-box">
                    <label for="mobile_number"> * Mobile Number:</label> <span id="num_error"></span>
                    <input type="text" name="mobile_number" placeholder="Enter Mobile Number" id="mobile_number"/>
                </div>
                <div class="input-box">
                    <label for="email_address"> * Email Address:</label> <span id="email_error"></span>
                    <input type="text" name="email_address" placeholder="Enter Email Address" id="email_address"/>
                </div>
            </div>

            

            <div class="input-box req-docs">
                <div class="column column_req">
                    <div class="input-box">
                        <h3 id="title2">Document Requesting</h3>
                    </div>

                    <div class="input-box" hidden>
                        <label for="ctrl_no">Control No.</label>
                        <input type="text" id="ctrl_no" name="ctrl_no" value="<?= htmlspecialchars($ctrl_no) ?>" class="form-control" readonly />
                    </div>
                </div>

                <hr>

                <div class="row">
                    <!-- <input type="text" class="form-control req" name="reqno[]" id="reqno" value="1" readonly="" hidden> -->
                    
                    <div class="input-box">
                        <label for="trainingDate">Date From:</label>
                        <input type="date" id="trainingDate" name="trainingDate" class="form-control" required/>
                    </div>
                    <div class="input-box">
                        <label for="trainingDateTo">Date To:</label>
                        <input type="date" id="trainingDateTo" name="trainingDateTo" class="form-control" required/>
                    </div>

                    <div class="input-box">
                        <label for="certDesignation">Document Requesting:</label>
                        <select class="select-box" name="certDesignation" class="certDesignation" id="certDesignation" required>
                            <option value="" selected hidden>Document Requesting:</option>
                            <option value="Appearance">Certificate of Appearance</option>
                        </select>
                    </div>
                    
                    <!-- <div class="input-box">
                        <label for="trainingCert">Title:</label>
                        <select class="select-box" name="trainingCert[]" id="trainingCert" required>
                            <option value="" selected hidden>Title:</option>
                        </select>
                    </div>
                    
                    <div class="others input-box">
                        <label for="otherTrainingCert">Others:</label>
                        <input name="otherTrainingCert[]" id="otherTrainingCert" type="text" placeholder="Input Title"/>
                    </div> -->
                </div>
                    <!-- <div id="next"></div> -->
                    <!-- <button type="button" class="addReq" id="addReq" name="addReq">Add New Request</button> -->
            </div>
        
            <div class="subnotes">
                <h3>Note:</h3>
                <p>- Please take note of your CONTROL NO. It will needed to track your request.</p>
                <p>- Only one original certificate per training will be issued.</p>
                <p>- Certificates for seminars, updates, and orientation are released after the training.</p>
                <p>- A valid government issued ID is needed upon release of the document.</p>
                <p>- Unclaimed documents will be disposed after 3 months from the application date.</p>
            </div>

            <div class="checkbox">
                <input type="checkbox" class="checks" id="checks" >
                <label for="checks">By clicking, I agree to the <a class="modal-open" href="#tncModal">Privacy Policy.</a></label>
            </div>

            <div class="modal" id="tncModal">
                <div class="modal-content">
                    <a href="#" class="modal-close" title="Close Modal">X</a>
                    <h3>PRIVACY POLICY</h3>
                    <div class="modal-area">
                        <p>The <b>Philippine Heart Center</b> understands the importance of your privacy and is committed to maintain the confidentiality of your Personal, Sensitive, and Privileged Information ("Personal Data") through establisment of security measure, providing notice of our privacy practices with respect to your Personal Data pursuant to Republic Act No. of 2012 ("Data Privacy Act"), related laws to issuances.</p>
                        </br>
                        <p>We only collect, retain and share records of your Personal Data with your consent. We use these records to enable our healthcare providers to provide quality medical care, to process billings for the services we have provided, and to enable us to meet our professional medical, and legal obligations.</p>
                        </br>
                        <p>Rest assured that only authorized medical personnel have access to your Personal Data. Digital copies containing Personal Data will be securely stored in our database. Physical copies will be stored in a secured location for a minimum of 15 years or as long as it is needed for a legitimate business purpose. After which, physical records shall be disposed of accordingly, while digital digital files shall be securely deleted.</p>
                        </br>
                        <b>RIGHTS OF DATA SUBJECT</b>
                        <p>Under the Data Privacy Act, any person whose Personal Data are collected, stored, and processed is called "Data Subject". Insitutionals which deals with these information are duly bound to uphold the Rights of Data Subjects as well as to adhere to general data privacy principles and the requirements of lawful processing.</p></br>
                        <p>The following are your Rights as Data Subjects with respect to your Personal Data: (1) right to be informed; (2) right to access; (3) right to object; (4) right to erasure or blocking; (5) right to damage; (6) right to rectify; (7) right to data portability; and (8) right to file a complaint witht the National Privacy Commission.</p></br>
                        <p>For any question about the exercise of your rights or comments about this Privacy Notice, please contact our Data Protection Officer at 89252401 local 3215. You may also browse our page ...</p></br>
                    </div>
                    <a href="#" class="modal-foot" title="Close Modal">Close</a>
                </div>
            </div>

            <span id="submit_error"></span>
            <button class="btn" id="submit" name="submit">Submit</button>
            

        </form>
    </section>

    
    <!-- reqForm js -->
    <script src="assets/reqForm.js" nonce="<?=$_SERVER['HTTP_X_NONCE']?>"></script>

    <!-- disables browser back/previous button -->
    <script>
        $(document).ready(function() {
            function disableBack() { window.history.forward() }

            window.onload = disableBack();
            window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
        });
    </script>

</body>
</html>
