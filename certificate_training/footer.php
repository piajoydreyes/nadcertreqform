    
    <!-- reqForm js -->
    <script src="assets/reqForm2.js" nonce="<?=$_SERVER['HTTP_X_NONCE']?>"></script>


    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    $(document).ready(function() {

        $('#submit').on('click', function(e) {
            e.preventDefault(); // prevent form from submitting immediately

            let isValid = true;

            // Clear previous error indicators
            $('input, select').removeClass('invalid');
            $('span[id$="_error"]').text('');

            // Validate required input fields
            const fields = [
                { id: '#fullname', error: '#name_error', message: 'Full name is required' },
                { id: '#hospital_affiliation', error: '#hospaff_error', message: 'Hospital affiliation is required' },
                { id: '#address', error: '#address_error', message: 'Address is required' },
                { id: '#mobile_number', error: '#num_error', message: 'Mobile number is required' },
                { id: '#email_address', error: '#email_error', message: 'Email address is required' }
            ];

            fields.forEach(field => {
                const value = $(field.id).val().trim();
                if (value === '') {
                    isValid = false;
                    $(field.id).addClass('invalid');
                    $(field.error).text(field.message).css('color', 'red');
                }
            });

            // Validate dynamic request fields
            $("input[name='trainingDate[]']").each(function() {
                if ($(this).val() === '') {
                    isValid = false;
                    $(this).addClass('invalid');
                }
            });

            $("select[name='certDesignation[]']").each(function() {
                if ($(this).val() === '') {
                    isValid = false;
                    $(this).addClass('invalid');
                }
            });

            $("select[name='trainingCert[]']").each(function() {
                if ($(this).val() === '') {
                    isValid = false;
                    $(this).addClass('invalid');
                }
            });

            // Check if Privacy Policy is accepted
            if (!$('#checks').is(':checked')) {
                isValid = false;
                Swal.fire({
                    icon: 'warning',
                    title: 'Please accept the Privacy Policy',
                    confirmButtonColor: '#3085d6'
                });
                return;
            }

            // Final check
            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Please fill out all required fields',
                    confirmButtonColor: '#d33'
                });
            } else {
                // Confirmation and auto-submit
                Swal.fire({
                    icon: 'success',
                    title: 'Form is valid!',
                    text: 'Submitting your request...',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    // This ensures that the form is submitted to reqForm.inc.php
                    $('#form').submit(); // submit the form to reqForm.inc.php
                });
            }
        });

    });
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
