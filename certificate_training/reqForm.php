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
    

    <style>
        .invalid {
            border: 1px solid red;
        }
    </style>
    
    
</head>

<body>

    <section class="container">
        <header>Training Certificate Request Form</header>
        
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

            <div class="phc-applicants">
                <h3>For PHC Applicants Only</h3>
                <div class="column">
                    <div class="input-box">
                        <label for="employee_no">Employee No.:</label>
                        <input type="number" name="user_id" id="user_id" hidden/>
                        <input type="number" name="employee_no" id="employee_no" placeholder="Enter Employee No." />
                    </div>
                    <div class="input-box">
                        <label for="uad">UAD:</label>
                        <input type="date" name="uad" id="uad" placeholder="Enter UAD" />
                    </div>
                    <div class="input-box">
                        <label for="position">Position:</label>
                        <input type="text" name="position" id="position" placeholder="Enter Position" />
                    </div>
                    <div class="input-box">
                        <label for="unit">Unit:</label>
                        <input type="text" name="unit" id="unit" placeholder="Enter Unit" />
                    </div>
                </div>

                <div class="column">
                    <div class="input-box">
                        <label for="tentative_resig_date">Date of Tentative Resignation:</label>
                        <input type="date" name="tentative_resig_date" id="tentative_resig_date" placeholder="Enter Date of Tentative Resignation"/>
                    </div>
                    <div class="input-box">
                        <label for="final_resig_date">Date of Final Resignation:</label>
                        <input type="date" name="final_resig_date" id="final_resig_date" placeholder="Enter Date of Final Resignation"/>
                    </div>
                </div>
            </div>

            <div class="input-box req-docs">
                <div class="column column_req">
                    <div class="input-box">
                        <h3 id="title2">Document Requesting</h3>
                    </div>


                    <div class="input-box" hidden>
                        <label for="ctrl_no">Control No.</label>
                        <input type="text" id="ctrl_no" name="ctrl_no" value="<?= htmlspecialchars($ctrl_no) ?>" class="form-control" readonly/>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <input type="text" class="form-control req" name="reqno[]" id="reqno" value="1" readonly="" hidden>
                    
                    <div class="input-box">
                        <label for="trainingDate">Date:</label>
                        <input type="date" id="trainingDate" name="trainingDate[]" class="form-control" required/>
                    </div>
                    
                    <div class="input-box">
                        <label for="certDesignation">Document Requesting:</label>
                        <select class="select-box" name="certDesignation[]" class="certDesignation" id="certDesignation" required>
                            <option value="" selected hidden>Document Requesting:</option>
                            <option value="Nurses">Training for Nurses</option>
                            <option value="Ward Clerks">Training for Ward Clerks</option>
                            <option value="Nursing Attendants">Training for Nursing Attendants</option>
                            <option value="Nurses">Certification for Nurses</option>
                            <option value="Ward Clerks">Certification for Ward Clerks</option>
                            <option value="Nursing Attendants">Certification for Nursing Attendants</option>
                        </select>
                    </div>
                    
                    <div class="input-box">
                        <label for="trainingCert">Title:</label>
                        <select class="select-box" name="trainingCert[]" id="trainingCert" required>
                            <option value="" selected hidden>Title:</option>
                        </select>
                    </div>
                    
                    <div class="others input-box">
                        <label for="otherTrainingCert">Others:</label>
                        <input name="otherTrainingCert[]" id="otherTrainingCert" type="text" placeholder="Input Title"/>
                    </div>
                </div>
                    <div id="next"></div>
                    <button type="button" class="addReq" id="addReq" name="addReq">Add New Request</button>
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
    <script src="assets/reqForm2.js" nonce="<?=$_SERVER['HTTP_X_NONCE']?>"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    // $(document).ready(function() {
    //     $('#submit').on('click', function(e) {
    //         e.preventDefault(); // prevent form from submitting immediately

    //         let isValid = true;

    //         // Clear previous error indicators
    //         $('input, select').removeClass('invalid');
    //         $('span[id$="_error"]').text('');

    //         // Validate required input fields
    //         const fields = [
    //             { id: '#fullname', error: '#name_error', message: 'Full name is required' },
    //             { id: '#hospital_affiliation', error: '#hospaff_error', message: 'Hospital affiliation is required' },
    //             { id: '#address', error: '#address_error', message: 'Address is required' },
    //             { id: '#mobile_number', error: '#num_error', message: 'Mobile number is required' },
    //             { id: '#email_address', error: '#email_error', message: 'Email address is required' }
    //         ];

    //         fields.forEach(field => {
    //             const value = $(field.id).val().trim();
    //             if (value === '') {
    //                 isValid = false;
    //                 $(field.id).addClass('invalid');
    //                 $(field.error).text(field.message).css('color', 'red');
    //             }
    //         });

    //         // Validate dynamic request fields
    //         $("input[name='trainingDate[]']").each(function() {
    //             if ($(this).val() === '') {
    //                 isValid = false;
    //                 $(this).addClass('invalid');
    //             }
    //         });

    //         $("select[name='certDesignation[]']").each(function() {
    //             if ($(this).val() === '') {
    //                 isValid = false;
    //                 $(this).addClass('invalid');
    //             }
    //         });

    //         $("select[name='trainingCert[]']").each(function() {
    //             if ($(this).val() === '') {
    //                 isValid = false;
    //                 $(this).addClass('invalid');
    //             }
    //         });

    //         // Check if Privacy Policy is accepted
    //         if (!$('#checks').is(':checked')) {
    //             isValid = false;
    //             Swal.fire({
    //                 icon: 'warning',
    //                 title: 'Please accept the Privacy Policy',
    //                 confirmButtonColor: '#3085d6'
    //             });
    //             return;
    //         }

    //         If form is valid, submit directly to reqForm.inc.php
    //         if (isValid) {
    //             $('#form').submit(); // Direct form submission
    //         } else {
    //             Swal.fire({
    //                 icon: 'error',
    //                 title: 'Please fill out all required fields',
    //                 confirmButtonColor: '#d33'
    //             });
    //         }
    //     });
    // });
    </script>


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