<?php

    session_destroy();
    unset($_SESSION['uid']);
    header('Location: login.php');