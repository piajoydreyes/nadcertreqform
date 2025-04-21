<?php
require_once 'header.php';
?>
    <section class="container-confirm">
        
        <header>Request Submitted!</header>
        </br>
        </br>
        <p>
            We have successfully received your request on <b> [Date of Submission] </b> with reference number <b> [reference number] </b>.
            </br>
            </br>
            Your request is being processed. Please allow us 2-3 business day for our team to review and respond to your request.
            </br>
            </br>
            If you have any questions, feel free to reach out to us at 02-89252401 local 3544/3545 or email at nad@phc.gov.ph
            </br>
            </br>
        <form action="../reqTracker.php">
            <button class="btnReq">Check Request Status</button>
        </form>
    </section>

<?php
require_once 'footer.php';
?>