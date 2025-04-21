    
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
